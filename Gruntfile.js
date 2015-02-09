module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dist: {
        files: {
          'public/css/app.css': 'public/scss/app.scss'
        }
      }
    },

    copy: {
      modern: {
        expand: true,
        cwd: 'public/vendor/components/foundation/js/',
        src: '**',
        dest: 'public/dist/js/',
        filter: 'isFile',
      },
      fonts: {
        expand: true,
        cwd: 'public/vendor/components/font-awsome/fonts/',
        src: '**',
        dest: 'public/dist/fonts/',
        filter: 'isFile',
      },
      liteuploader: {
        expand: true,
        cwd: 'public/vendor/components/lite-uploader/',
        src: '*.js',
        dest: 'public/dist/lite-uploader/',
        filter: 'isFile',
      }
    },

    concat: {
      css: {
        src: [
        'public/vendor/components/foundation/css/normalize.css',
        'public/vendor/components/font-awsome/css/font-awesome.css',
        'public/css/app.css',
        ],
        dest: 'public/dist/css/compiled.css'
      },
      js: {
        src: [
        'public/vendor/components/moment/moment.js',
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
      files: [ 'public/css/*', 'public/js/*', 'public/scss/*' ],
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
    'concat:css',
    'cssmin:css',
    'concat:js',
    'uglify:js'
  ]);
};
