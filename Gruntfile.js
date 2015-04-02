module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dist: {
        files: {
          'public/css/app.css': 'resources/assets/scss/app.scss'
        }
      }
    },

    copy: {
      modern: {
        expand: true,
        cwd: 'resources/assets/vendor/components/foundation/js/',
        src: '**',
        dest: 'public/dist/js/',
        filter: 'isFile',
      },
      fonts: {
        expand: true,
        cwd: 'resources/assets/vendor/components/font-awsome/fonts/',
        src: '**',
        dest: 'public/dist/fonts/',
        filter: 'isFile',
      },
      liteuploader: {
        expand: true,
        cwd: 'resources/assets/vendor/components/lite-uploader/',
        src: '*.js',
        dest: 'public/dist/lite-uploader/',
        filter: 'isFile',
      },
      datetimepicker: {
        expand: true,
        cwd: 'resources/assets/vendor/components/datetimepicker/',
        src: '**',
        dest: 'public/dist/datetimepicker/',
        filter: 'isFile',
      },
      jstimezone: {
        expand: true,
        cwd: 'resources/assets/vendor/components/jsTimezoneDetect/',
        src: '*.js',
        dest: 'public/dist/jstimezone/',
        filter: 'isFile',
      }
    },

    concat: {
      css: {
        src: [
        'resources/assets/vendor/components/foundation/css/normalize.css',
        'resources/assets/vendor/components/font-awsome/css/font-awesome.css',
        'public/dist/datetimepicker/jquery.datetimepicker.css',
        'public/css/app.css',
        ],
        dest: 'public/dist/css/compiled.css'
      },
      js: {
        src: [
        'resources/assets/vendor/components/moment/moment.js',
        'public/js/**/*.js',
        'public/js/*.js',
        ],
        dest: 'public/dist/js/compiled.js'
      }
    },

    cssmin: {
      css: {
        src: 'public/dist/css/compiled.css',
        dest: 'public/dist/css/compiled.min.css'
      }
    },

    uglify: {
      js: {
        files: {
          'public/dist/js/compiled.min.js': ['public/dist/js/compiled.js']
        }
      },
      options: {
        mangle: false
      }
    },

    watch: {
      files: [ 'public/css/*', 'public/js/*', 'resources/assets/scss/*' ],
      tasks: [ 'sass', 'concat:css', 'cssmin:css', 'concat:js', 'uglify:js']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-ng-annotate');

  grunt.registerTask('default', [
    'sass',
    'copy:modern',
    'copy:fonts',
    'copy:liteuploader',
    'copy:datetimepicker',
    'copy:jstimezone',
    'concat:css',
    'cssmin:css',
    'concat:js',
    'uglify:js'
  ]);
};
