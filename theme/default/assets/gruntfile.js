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
        deployPublicPath:'../../../public/',
        deployPath: '../../../public/theme/default/',
        modulesPathVendor: './../../../vendor/dynamix/',
        modulesPathWorkbench: './../../../workbench/dynamix/',


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
                    config: '<%= srcPath %>admin/config.rb',
                    sassDir: '<%= srcPath %>admin/scss',
                    cssDir: '<%= distPath %>admin/css'
                }
            },
            //Public theme.css
            themePublic: {
              	options: {
                	config: '<%= srcPath %>public/config.rb',
                	sassDir: '<%= srcPath %>public/scss',
                	cssDir: '<%= distPath %>public/css'
            	}
            },
            //Vendor css
            vendorFontawesome: {
              options: {
                sassDir: '<%= bowerPath %>fontawesome/scss',
                cssDir: '<%= vendorPath %>css',
              }
            },

            //Module css
            modulesVendor: {
              options: {
                basePath: './../../..',
                sassDir: 'vendor/dynamix/*',
                cssDir: 'theme/default/assets/dist/vendor/css/modules/modules',
              }
            },
            modulesWorkbench: {
              options: {
                basePath: './../../..',
                sassDir: 'workbench/dynamix/*',
                cssDir: 'theme/default/assets/dist/vendor/css/modules/modules',
              }
            }
        },

        sass: {
            //Vendor css
            vendor: {
            	options: {
            		style: 'expanded'
            	},
                files: {
                    './dist/vendor/css/bootstrap.css': '<%= srcPath %>vendor/scss/bootstrap.scss'
                }
            }
        },

        cssmin:{
            combine: {
                files: {
                    // Main admin CSS
                    '<%= distPath %>admin/css/main.css':
                    [
                        //Vendor
                        '<%= vendorPath %>css/bootstrap.css',                                                              //1/6
                        '<%= vendorPath %>css/font-awesome.css',                                                           //2/6
                        '<%= bowerPath %>eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',    //3/6
                        '<%= bowerPath %>fancybox/source/jquery.fancybox.css',                                             //4/6        
                        '<%= bowerPath %>morrisjs/morris.css',                                                             //5/6
                        '<%= bowerPath %>metisMenu/dist/metisMenu.min.css',                                                //6/6
                        '<%= bowerPath %>bootstrapcolorpicker/dist/css/bootstrap-colorpicker.min.css',                     //7/7

                        //Modules
                        '<%= vendorPath %>css/modules/**/admin/**/*.css',
                    
                        //Theme
                        '<%= distPath %>admin/css/theme.css',                                                                    
                    ],

                    // Main public CSS
                    '<%= distPath %>public/css/main.css':
                    [
                        //Vendor 
                        '<%= vendorPath %>css/bootstrap.css',
                        
                        //Modules
                        '<%= vendorPath %>css/modules/**/public/**/*.css',
                        
                        //Theme
                        '<%= distPath %>public/css/theme.css',                                                                    
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
            assetAdmin: {
                // Fichiers à concaténer
                src: [
                    //Vendor
                    '<%= bowerPath %>bootstrap-sass-twbs/assets/javascripts/bootstrap.js',                                      //1/6
                    //'<%= bowerPath %>imagesloaded/imagesloaded.pkgd.min.js',                                                  //2/6
                    '<%= bowerPath %>metisMenu/dist/metisMenu.min.js',                                                          //3/6
                    '<%= bowerPath %>fancybox/source/jquery.fancybox.js',                                                       //4/6
                    '<%= bowerPath %>raphael/raphael-min.js',                                                                   //5/6
                    '<%= bowerPath %>ckeditor/ckeditor.js',                                                                     //6/6
                    '<%= bowerPath %>bootstrapcolorpicker/dist/js/bootstrap-colorpicker.min.js',                                //7/7


                    //Local vendor
                    '<%= srcPath %>admin/js/vendor/morris.js',                                    
                    '<%= srcPath %>admin/js/vendor/sb-admin-2.js',

                    //Theme
                    '<%= srcPath %>admin/js/theme.js',

                    //Modules
                    '<%= modulesPathVendor %>**/assets/admin/js/**/*.js',
                    '<%= modulesPathWorkbench %>**/assets/admin/js/**/*.js',
                ],
                // Fichier de destination
                dest:'<%= distPath %>admin/js/main.js'
            },
            assetPublic: {
                // Fichiers à concaténer
                src: [
                    //Vendor
                    '<%= bowerPath %>bootstrap-sass-twbs/assets/javascripts/bootstrap.js',
                    //'<%= bowerPath %>imagesloaded/imagesloaded.pkgd.min.js',

                    //Theme
                    '<%= srcPath %>public/js/theme.js',

                    //Modules
                    '<%= modulesPathVendor %>**/assets/public/js/**/*.js',
                    '<%= modulesPathWorkbench %>**/assets/public/js/**/*.js',

                    '<%= bowerPath %>moment/moment.js',
                ],
                // Fichier de destination
                dest:'<%= distPath %>public/js/main.js'
            }
        },

        // Minification
        uglify: {
            options: {
                // la date et le nom des fichiers minifiés sont insérés en commentaire en début de fichier
                banner:'/* <%= grunt.template.today("dd-mm-yyyy, HH:MM") %> */\n'
            },

            assetAdmin: {
                files:{
                    // Fichier de destination
                    '<%= concat.assetAdmin.dest %>':
                    // Fichier minifié
                    ['<%= concat.assetAdmin.dest %>']
                }
            },
            assetPublic: {
                files: {
                    // Fichier de destination
                    '<%= concat.assetPublic.dest %>':
                    // Fichier minifié
                    ['<%= concat.assetPublic.dest %>']
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
                mapping: '../../../app/config/assets/theme/default.json', //mapping file so your server can serve the right files
                srcBasePath: '<%= distPath %>', // the base Path you want to remove from the `key` string in the mapping file
                destBasePath: '<%= distPath %>', // the base Path you want to remove from the `value` string in the mapping file
                flatten: false // Set to true if you don't want to keep folder structure in the `key` value in the mapping file
            },
            jsAdmin: {
                src: ['<%= distPath %>admin/js/main.js'],
                dest: '<%= distPath %>admin/js'
            },
            jsPublic: {
                src: ['<%= distPath %>public/js/main.js'],
                dest: '<%= distPath %>public/js'
            },
            cssAdmin: {
                src: ['<%= distPath %>admin/css/main.css'],
                dest: '<%= distPath %>admin/css'
            },
            cssPublic: {
                src: ['<%= distPath %>public/css/main.css'],
                dest: '<%= distPath %>public/css'
            }
        },


        // Nettoyage des dossiers publics
        clean: {
            jsadmin: ["<%= distPath %>admin/js/main.*.js"],
            jspublic: ["<%= distPath %>public/js/main.*.js"],
            cssadmin: ["<%= distPath %>admin/css/*.css"],
            csspublic: ["<%= distPath %>public/css/*.css"],
            options: {
                force: true
            }
        },


        copy: {
          main: {
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

              // CKEditor
              {expand: true, cwd: '<%= bowerPath %>ckeditor/', src: ['**'], dest: '<%= deployPublicPath %>js/ckeditor/'},
              
              //ColorPicker
              {expand: true, cwd: '<%= bowerPath %>bootstrapcolorpicker/dist/img/', src: ['**'], dest: '<%= distPath %>admin/img/'},

              //Fonts
              {expand: true, src: ['<%= bowerPath %>fontawesome/fonts/*'], dest: '<%= distPath %>admin/fonts/', flatten: true},
              {expand: true, src: ['<%= bowerPath %>bootstrap-sass-twbs/assets/fonts/bootstrap/*'], dest: '<%= distPath %>admin/fonts/bootstrap/', flatten: true},
              {expand: true, src: ['<%= bowerPath %>bootstrap-sass-twbs/assets/fonts/bootstrap/*'], dest: '<%= distPath %>public/fonts/bootstrap/', flatten: true},

              //Images
              {expand: true, cwd: '<%= srcPath %>admin/img/sources/', src: ['**'], dest: '<%= distPath %>admin/img/'},
              {expand: true, cwd: '<%= srcPath %>public/img/sources/', src: ['**'], dest: '<%= distPath %>public/img/'},

            ]
          },
          deploy: {
            files: [
              {expand: true, cwd: '<%= distPath %>admin/', src: ['**'], dest: '<%= deployPath %>admin/'},            
              {expand: true, cwd: '<%= distPath %>public/', src: ['**'], dest: '<%= deployPath %>public/'},            
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
                tasks:['clean:cssadmin', 'compass:themeAdmin', 'cssmin', 'hash:cssAdmin'],
                options: {
                  livereload: true
                }    
            },

              themePublicSCSS: 
            {
                files: [
                        '<%= srcPath %>public/scss/**'
                ],
                tasks:['clean:csspublic', 'compass:themePublic', 'cssmin', 'hash:cssPublic'],
                options: {
                  livereload: true
                }    
            },                   

            themeAdminJS: 
            {
                files: [
                        '<%= srcPath %>admin/js/**'
                ],
                tasks:['concat:assetAdmin', 'clean:jsadmin', 'hash:jsAdmin'],
                options: {
                  livereload: true
                }    
            },

            themePublicJS: 
            {
                files: [
                        '<%= srcPath %>public/js/**'

                ],
                tasks:['clean:jspublic','concat:assetPublic', 'hash:jsPublic'],
                options: {
                  livereload: true
                }    
            },                   

            blade: 
            {
                files: ['<%= path %>theme/**/*.blade.php'],
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
    grunt.registerTask('deploy', ['copy:deploy']);

    // Tâches personnalisées pour la mise en prod
    grunt.registerTask('prod', ['clean', 'sass', 'compass', 'cssmin', 'concat', 'hash', 'copy']);

}
