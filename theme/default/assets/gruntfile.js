module.exports = function (grunt) {
    // Code grunt
    grunt.initConfig({

        // Configuration du projet et des tâches
        pkg: grunt.file.readJSON('package.json'),

        // Paths
        srcPath: './src/',
        bowerPath: './bower_components/',
        vendorPath: './dist/vendor/',
        distPath: './dist/',


        /**
         *
         *  CSS Tasks
         *
         */
        // Compilation
        compass: {
            //Admin theme.css
            themeAdmin: {
              options: {
                //config: '<%= srcPath %>admin/config.rb',
                sassDir: '<%= srcPath %>admin/scss',
                cssDir: '<%= distPath %>admin/css',
                imagesDir: '<%= distPath %>admin/img',
                spriteLoadPath: '<%= distPath %>admin/img/',
                debugInfo: true,
              }
            },
            //Public theme.css
            themePublic: {
              	options: {
                	//config: '<%= srcPath %>public/config.rb',
                	sassDir: '<%= srcPath %>public/scss',
                	cssDir: '<%= distPath %>public/css',
                	imagesDir: '<%= distPath %>public/img',
                	spriteLoadPath: '<%= distPath %>public/img/',
                	debugInfo: true,
            	}
            },
            //Vendor css
            vendorFontawesome: {
              options: {
                sassDir: '<%= bowerPath %>fontawesome/scss',
                cssDir: '<%= vendorPath %>css',
              }
            },
        },

        sass: {
            //Vendor css
            vendor: {
            	options: {
            		style: 'expanded'
            	},
                files: {
                    './dist/vendor/css/bootstrap.css': './bower_components/bootstrap-sass-twbs/assets/stylesheets/_bootstrap.scss'
                }
            }
        },

        cssmin:{
            combine: {
                files: {
                    // Admin theme.css
                    '<%= distPath %>admin/css/theme.css':
                    [
                        '<%= distPath %>admin/css/theme.css',                                                                    
                    ],
                    // Admin vendor.css
                    '<%= distPath %>admin/css/vendor.css':
                    [    
                        '<%= vendorPath %>css/bootstrap.css',                                                            //1/6
                        '<%= vendorPath %>css/font-awesome.css',                                                        //2/6
                        '<%= bowerPath %>eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', //3/6
                        '<%= bowerPath %>fancybox/source/jquery.fancybox.css',                                            //4/6        
                        '<%= bowerPath %>morrisjs/morris.css',                                                            //5/6
                        '<%= bowerPath %>metisMenu/dist/metisMenu.min.css',                                                //6/6
                    ],

                    // Public theme.css
                    '<%= distPath %>public/css/theme.css':
                    [
                        '<%= distPath %>public/css/theme.css',                                                                    
                    ],
                    // Public vendor.css
                    '<%= distPath %>public/css/vendor.css':
                    [    
                        '<%= vendorPath %>css/bootstrap.css'
                    ]
                }
            },
            // Config de la tâche cssmin
            options: {

            }
        },



        /**
         *
         *  JS Tasks
         *
         */

        // Concatene les fchiers js
        concat: {
            options: {
              separator: ';\n',
            },
            themeAdmin: {
                // Fichiers à concaténer
                src: [
                    '<%= srcPath %>admin/js/theme.js'
                ],
                // Fichier de destination
                dest:'<%= distPath %>admin/js/theme.js'
            },
            vendorAdmin: {
                // Fichiers à concaténer
                src: [
                    '<%= bowerPath %>bootstrap-sass-twbs/assets/javascripts/bootstrap.js',    //1/6
                    '<%= bowerPath %>imagesloaded/imagesloaded.pkgd.min.js',                //2/6
                    '<%= vendorPath %>metisMenu/dist/metisMenu.min.js',                        //3/6
                    '<%= vendorPath %>fancybox/source/jquery.fancybox.js',                     //4/6
                    '<%= vendorPath %>raphael/raphael-min.js',                                //5/6
                    '<%= vendorPath %>tinymce/tinymce.min.js',                                //6/6

                    //Local vendor
                    '<%= srcPath %>admin/js/vendor/morris.js',                                    
                    '<%= srcPath %>admin/js/vendor/sb-admin-2.js',
                ],
                // Fichier de destination
                dest:'<%= distPath %>admin/js/vendor.js'
            },
            themePublic: {
                // Fichiers à concaténer
                src: [
                    '<%= srcPath %>public/js/theme.js'
                ],
                // Fichier de destination
                dest:'<%= distPath %>public/js/theme.js'
            },
            vendorPublic: {
                // Fichiers à concaténer
                src: [
                    '<%= bowerPath %>bootstrap-sass-twbs/assets/javascripts/bootstrap.js',
                    '<%= bowerPath %>imagesloaded/imagesloaded.pkgd.min.js'
                ],
                // Fichier de destination
                dest:'<%= distPath %>public/js/vendor.js'
            }
        },

        // Minification
        uglify: {
            options: {
                // la date et le nom des fichiers minifiés sont insérés en commentaire en début de fichier
                banner:'/* <%= grunt.template.today("dd-mm-yyyy, HH:MM") %> */\n'
            },

            themeAdmin: {
                files:{
                    // Fichier de destination
                    '<%= concat.themeAdmin.dest %>':
                    // Fichier minifié
                    ['<%= concat.themeAdmin.dest %>']
                }
            },
            vendorAdmin: {
                files: {
                    // Fichier de destination
                    '<%= concat.vendorAdmin.dest %>':
                    // Fichier minifié
                    ['<%= concat.vendorAdmin.dest %>']
                }
            },
            themePublic: {
                files:{
                    // Fichier de destination
                    '<%= concat.themePublic.dest %>':
                    // Fichier minifié
                    ['<%= concat.themePublic.dest %>']
                }
            },
            vendorPublic: {
                files: {
                    // Fichier de destination
                    '<%= concat.vendorPublic.dest %>':
                    // Fichier minifié
                    ['<%= concat.vendorPublic.dest %>']
                }
            }
        },



        /**
         *
         *  Other Tasks
         *
         */

        // Hashage des fichiers minimifié
        hash: {
            options: {
                mapping: './hash.json', //mapping file so your server can serve the right files
                srcBasePath: '<%= srcPath %>', // the base Path you want to remove from the `key` string in the mapping file
                destBasePath: '<%= distPath %>', // the base Path you want to remove from the `value` string in the mapping file
                flatten: false // Set to true if you don't want to keep folder structure in the `key` value in the mapping file
            },
            jsAdmin: {
                src: ['<%= distPath %>admin/js/theme.js','<%= distPath %>admin/js/vendor.js'],
                dest: '<%= distPath %>admin/js'
            },
            jsPublic: {
                src: ['<%= distPath %>public/js/theme.js','<%= distPath %>public/js/vendor.js'],
                dest: '<%= distPath %>public/js'
            },
            cssAdmin: {
                src: ['<%= distPath %>admin/css/theme.css','<%= distPath %>admin/css/vendor.css'],
                dest: '<%= distPath %>admin/css'
            },
            cssPublic: {
                src: ['<%= distPath %>public/css/theme.css','<%= distPath %>public/css/vendor.css'],
                dest: '<%= distPath %>public/css'
            }
        },


        // Nettoyage des dossiers publics
        clean: {
            js: ["<%= distPath %>*/js/*.js"],
            css: ["<%= distPath %>*/css*.css"],
            options: {
                force: true
            }
        },


        copy: {
          jsMap: {
            files: [
              // Modernizr
              {expand: false, src: ['<%= srcPath %>vendor/js/modernizr.min.js'], dest: '<%= distPath %>admin/js/vendor/modernizr.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= srcPath %>vendor/js/modernizr.min.js'], dest: '<%= distPath %>public/js/vendor/modernizr.min.js', filter: 'isFile'},
              
              // jQuery
              {expand: false, src: ['<%= bowerPath %>jquery/dist/jquery.min.js'], dest: '<%= distPath %>admin/js/vendor/jquery.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>jquery/dist/jquery.min.js'], dest: '<%= distPath %>public/js/vendor/jquery.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>jquery/dist/jquery.min.map'], dest: '<%= distPath %>admin/js/vendor/jquery.min.map', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>jquery/dist/jquery.min.map'], dest: '<%= distPath %>public/js/vendor/jquery.min.map', filter: 'isFile'},

              // HeadJS
              {expand: false, src: ['<%= bowerPath %>headjs/dist/1.0.0/head.min.js'], dest: '<%= distPath %>public/js/vendor/head.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>headjs/dist/1.0.0/head.min.js'], dest: '<%= distPath %>admin/js/vendor/head.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>headjs/dist/1.0.0/head.min.js.map'], dest: '<%= distPath %>public/js/vendor/head.min.js.map', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>headjs/dist/1.0.0/head.min.js.map'], dest: '<%= distPath %>admin/js/vendor/head.min.js.map', filter: 'isFile'},

              // ResponseJS
              {expand: false, src: ['<%= bowerPath %>responsejs/response.min.js'], dest: '<%= distPath %>public/js/vendor/response.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>responsejs/response.min.js'], dest: '<%= distPath %>admin/js/vendor/response.min.js', filter: 'isFile'},

              // Media-match
              {expand: false, src: ['<%= bowerPath %>media-match/media.match.min.js'], dest: '<%= distPath %>public/js/vendor/media.match.min.js', filter: 'isFile'},
              {expand: false, src: ['<%= bowerPath %>media-match/media.match.min.js'], dest: '<%= distPath %>admin/js/vendor/media.match.min.js', filter: 'isFile'},

            ]
          }
        },

        // Watchs
        watch: {
            
            themeAdminSCSS: 
            {
                files: [
                        '<%= srcPath %>admin/scss/**'
                ],
                tasks:['compass:themeAdmin', 'cssmin', 'clean:css', 'hash:cssAdmin'],
                options: {
                  livereload: true
                  }    
              },

              themePublicSCSS: 
            {
                files: [
                        '<%= srcPath %>public/scss/**'
                ],
                tasks:['compass:themePublic', 'cssmin', 'clean:css', 'hash:cssPublic'],
                options: {
                  livereload: true
                }    
            },                   

            themeAdminJS: 
            {
                files: [
                        '<%= srcPath %>admin/js/**'
                ],
                tasks:['concat:themeAdmin', 'clean:js', 'hash:jsAdmin'],
                options: {
                  livereload: true
                }    
            },

            themePublicJS: 
            {
                files: [
                        '<%= srcPath %>public/js/**'
                ],
                tasks:['concat:themePublic', 'clean:js', 'hash:jsPublic'],
                options: {
                  livereload: true
                }    
              },                   

            blade: 
            {
                files: ['<%= path %>app/**/*.blade.php'],
                options: {
                  livereload: true
                }    
            }
        }        
    });

    // Chargement des plugins
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-hash');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');


    // Tâches par défauts
    grunt.registerTask('default', ['clean', 'sass', 'compass', 'cssmin', 'concat', 'hash', 'copy', 'watch']);


    // Tâches personnalisées pour le développement
    grunt.registerTask('dev', ['clean', 'sass', 'compass', 'cssmin', 'concat', 'hash', 'copy', 'watch']);

	// Tâches personnalisées pour le développement
    grunt.registerTask('sassdebug', ['sass']);

    // Tâches personnalisées pour la mise en prod
    grunt.registerTask('prod', ['clean', 'sass', 'compass', 'cssmin', 'concat', 'uglify', 'imagemin', 'hash', 'copy', 'watch']);

}
