sudo apt-get update

sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

sudo apt-get install -y vim curl python-software-properties
sudo add-apt-repository -y ppa:ondrej/php5
sudo apt-get update

sudo apt-get install -y php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-readline mysql-server-5.5 php5-mysql git-core php5-xdebug redis-server

cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF

sudo a2enmod rewrite

sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini
sed -i "s/disable_functions = .*/disable_functions = /" /etc/php5/cli/php.ini

sed -i "s/export APACHE_RUN_USER=www-data.*/export APACHE_RUN_USER=vagrant/" /etc/apache2/envvars
sed -i "s/export APACHE_RUN_GROUP=www-data.*/export APACHE_RUN_GROUP=vagrant/" /etc/apache2/envvars

sed -i "s/bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

sudo service apache2 restart

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

cp /etc/redis/redis.conf /etc/redis/redis.conf.default
cat << EOF | sudo tee /etc/redis/redis.conf
daemonize yes
pidfile /var/run/redis.pid
logfile /var/log/redis/redis.log
port 6379
bind 127.0.0.1
timeout 300
loglevel notice
## Default configuration options
databases 16
save 900 1
save 300 10
save 60 10000
rdbcompression yes
dbfilename dump.rdb
appendonly no
EOF

sudo service redis-server restart

mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root';"
mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'root';"
