module.exports = function(grunt) {
	// Code grunt
	grunt.initConfig({

		// Configuration du projet et des tâches
		pkg: grunt.file.readJSON('package.json'),

		// Paths
		srcPath: 'src/',
		vendorPath: 'src/vendor/',
		distPath: 'dist/',


		/**
		 *
		 *  CSS Tasks
		 *
		 */
		// Compilation
		compass: {
		    back: {
		      options: {
		        config: '<%= srcPath %>admin/config.rb',
		        sassDir: '<%= srcPath %>admin/scss',
        		cssDir: '<%= srcPath %>admin/css',
		      }
		    },	
			front: {
		      options: {
		        config: '<%= srcPath %>public/config.rb',
		        sassDir: '<%= srcPath %>public/scss',
        		cssDir: '<%= srcPath %>public/css',
		      }
		    }
		},

		bower: {
		  dev: {
		    dest: 'dest/',
		    js_dest: 'dest/js',
		    css_dest: 'dest/styles',
		    options: {
		      packageSpecific: {
		      	ignorePackages: ['jquery'],
		        bootstrap: {
		          dest: 'public/fonts',
		          css_dest: 'public/css/bootstrap'
		        }
		      }
		    }
		  }
		}


		// Concaténation des feuilles de styles
		cssmin:{
			combine: {
				files: {
					// Feuilles de style principale
					'<%= srcPath %>css/main.min.css':
					[
						'<%= srcPath %>css/font-awesome.css',
						'<%= srcPath %>css/core.css'
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
			main: {
				// Fichiers à concaténer
				src: [
					 '<%= vendorPath %>bootstrap-sass-twbs/assets/javascripts/bootstrap.js',
					 '<%= vendorPath %>imagesloaded/imagesloaded.pkgd.min.js',
					 '<%= srcPath %>js/vendor/jquery.cbpFWSlider.min.js',
			         	 '<%= srcPath %>js/master.js'
			    ],
				// Fichier de destination
				dest:'<%= srcPath %>js/main.min.js'
			},
			back: {
				// Fichiers à concaténer
				src: [
					 '<%= srcPath %>js/master-admin.js'
			    ],
				// Fichier de destination
				dest:'<%= srcPath %>js/main.back.min.js'
			}
		},

		// Minification
		uglify: {
			options: {
				// la date et le nom des fichiers minifiés sont insérés en commentaire en début de fichier
				banner:'/* <%= grunt.template.today("dd-mm-yyyy, HH:MM") %> */\n'
			},

			main: {
				files:{
					// Fichier de destination
					'<%= srcPath %>js/main.min.js':
					// Fichier minifié
					['<%= concat.main.dest %>']
				}
			},

			back: {
				files: {
					// Fichier de destination
					'<%= srcPath %>js/main.back.min.js':
					// Fichier minifié
					['<%= concat.back.dest %>']
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
	            mapping: '<%= path %>app/config/assets/assets.json', //mapping file so your server can serve the right files
	            srcBasePath: '<%= srcPath %>', // the base Path you want to remove from the `key` string in the mapping file
	            destBasePath: '<%= distPath %>', // the base Path you want to remove from the `value` string in the mapping file
	            flatten: false // Set to true if you don't want to keep folder structure in the `key` value in the mapping file
	        },
	        js: {
	            src: ['<%= srcPath %>js/main.min.js','<%= srcPath %>js/main.back.min.js'],
	            dest: '<%= distPath %>js'
	        },
	        css: {
	            src: ['<%= srcPath %>css/main.min.css','<%= srcPath %>css/main.back.min.css'],
	            dest: '<%= distPath %>css'
	        }
	    },


	    // Nettoyage des dossiers publics
		clean: {
		  js: ["<%= distPath %>js/*.js"],
		  css: ["<%= distPath %>css/*.css"],
		  options: {
		      force: true
		  }
		},


		// Compression des images
		imagemin:{
			dynamic:{
				files: [{
					// Mode de ciblage dynamqiue
					expand:true,
					// Dossier contenant les sources
					cwd:'<%= srcPath %>img/sources',
					// Fichiers à prendre en compte
					src:['*.{png,jpg,gif}'],
					// Dossier de destination
					dest:'<%= distPath %>img'
				}]
			}
		},		


		copy: {
		  jsMap: {
		    files: [
		      // Modernizr
		      {expand: false, src: ['<%= srcPath %>js/vendor/modernizr.min.js'], dest: '<%= distPath %>js/vendor/modernizr.min.js', filter: 'isFile'},
		      
		      // jQuery
		      {expand: false, src: ['<%= vendorPath %>jquery/dist/jquery.min.js'], dest: '<%= distPath %>js/vendor/jquery.min.js', filter: 'isFile'},
		      {expand: false, src: ['<%= vendorPath %>jquery/dist/jquery.min.map'], dest: '<%= distPath %>js/vendor/jquery.min.map', filter: 'isFile'},

		      // HeadJS
		      {expand: false, src: ['<%= vendorPath %>headjs/dist/1.0.0/head.min.js'], dest: '<%= distPath %>js/vendor/head.min.js', filter: 'isFile'},
		      {expand: false, src: ['<%= vendorPath %>headjs/dist/1.0.0/head.min.js.map'], dest: '<%= distPath %>js/vendor/head.min.js.map', filter: 'isFile'},

		      // ResponseJS
		      {expand: false, src: ['<%= vendorPath %>responsejs/response.min.js'], dest: '<%= distPath %>js/vendor/response.min.js', filter: 'isFile'},

		      // Media-match
		      {expand: false, src: ['<%= vendorPath %>media-match/media.match.min.js'], dest: '<%= distPath %>js/vendor/media.match.min.js', filter: 'isFile'},

		    ]
		  },
		  images: {
		    files: [
		      {expand: true, cwd: '<%= srcPath %>favicon/', src: ['**'], dest: '<%= distPath %>favicon/', filter: 'isFile'}
		    ]
		  }
		},

		// Watchs
		watch: {
			
			mainJS: 
			{
				files: [
						'<%= vendorPath %>bootstrap-sass-twbs/assets/javascripts/bootstrap.js',
						'<%= vendorPath %>imagesloaded/imagesloaded.pkgd.min.js',
						'<%= srcPath %>js/vendor/jquery-scrollspy.js',
						'<%= srcPath %>js/master.js'
				],
				tasks:['concat:main', 'clean:js', 'hash:js'],
				options: {
	              livereload: true
	          	}	
          	},

 			backJS: 
			{
				files: [
						'<%= srcPath %>js/master-admin.js'
				],
				tasks:['concat:back', 'clean:js', 'hash:js'],
				options: {
	              livereload: true
	          	}	
          	},  

          	vendorJS: 
			{
				files: [
						'<%= vendorPath %>jquery/dist/**/*',
						'<%= vendorPath %>headjs/dist/**/*',
						'<%= vendorPath %>responsejs/**/*',
						'<%= vendorPath %>media-match/**/*'
				],
				tasks:['copy:jsMap'],
				options: {
	              livereload: true
	          	}	
          	},    	       	

			scss: 
			{
				files: [
					'<%= srcPath %>sass/**/*.scss'
			    ],
				tasks:['compass:dist', 'cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	}, 

			bootstrap: 
			{
				files: [
					'<%= vendorPath %>bootstrap-sass-twbs/assets/stylesheets/**/*.scss'
			    ],
				tasks:['compass:bootstrap', 'cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	},   

			fontawesome: 
			{
				files: [
					'<%= vendorPath %>font-awesome/scss/*.scss'
			    ],
				tasks:['compass:fontawesome', 'cssmin', 'clean:css', 'hash:css'],
				options: {
	              livereload: true
	          	}	
          	},   

			images: 
			{
				files: [
					'<%= srcPath %>favicon/**/*'
			    ],
				tasks:['copy:images'],
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
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-hash');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-bower');


	// Tâches par défauts
	grunt.registerTask('default', ['clean', 'compass', 'cssmin', 'concat', 'hash', 'copy', 'watch']);


	// Tâches personnalisées pour le développement
	grunt.registerTask('dev', ['clean', 'compass', 'cssmin', 'concat', 'hash', 'copy', 'watch']);

	// Tâches personnalisées pour la mise en prod
	grunt.registerTask('prod', ['clean', 'compass', 'cssmin', 'concat', 'uglify', 'imagemin', 'hash', 'copy', 'watch']);

}
