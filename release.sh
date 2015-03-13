#!/bin/bash

increment_version ()
{
  declare -a a=( ${1//./ } )
  declare -i len=${#a[@]}-1

  if [ ! -z $2 ] && [ $2 -le $len ]; then
    part=$2-1
  else
    part=$len
  fi

  ((a[$part]++))

  # any additional version points are set to 0
  for index in ${!a[*]}
  do
    if [[ $index -gt $part ]]; then
      a[$index]=0
    fi
  done

  new="${a[*]}"
  versionLabel="${new// /.}"
}

# file in which to update version number
versionFile="version.json"

# extract the current version
version=$(sed -n 's|\s*"version": "\(.*\)"|\1|p' $versionFile)

# increment the current version
increment_version $version $@

# establish branch and tag name variables
devBranch=develop
masterBranch=master
releaseBranch=release/$versionLabel

# create the release branch from the -develop branch
git checkout -b $releaseBranch $devBranch
echo -e "Create release branch $releaseBranch\n"

# find version number assignment ("= v1.5.5" for example)
# and replace it with newly specified version number
sed -i.backup -E "s/\"version\": \"[0-9.]+\"/\"version\": \"$versionLabel\"/" $versionFile $versionFile

# remove backup file created by sed command
rm $versionFile.backup

# commit version number increment
git commit -am "Incrementing version number to $versionLabel"
echo -e "\nIncrementing version number to\t$versionLabel\n"

# merge release branch with the new version number into master
git checkout $masterBranch
git merge --no-ff $releaseBranch -m "Update master version number to $versionLabel"
echo -e "Merge release into [ $masterBranch ] branch\n"

# create tag for new version from -master
git tag -a $versionLabel -m "Tagging the new version number to $versionLabel"
echo -e "Tagging\n"

# push up the master branch and the tag
git push
git push --tags
echo -e "Push up git changes to remote\n"

#curl -d "apiKey=6e6c29efa70a66fafd90f101de0b68ea&appVersion=$versionLabel" http://notify.bugsnag.com/deploy

# merge release branch with the new version number back into develop
git checkout $devBranch
git merge --no-ff $releaseBranch -m "Update develop version number to $versionLabel"
git push
echo -e "Switch back to [ $devBranch ] branch \n"

# remove release branch
git branch -d $releaseBranch
echo -e "Remove [ $releaseBranch ] branch \n"
