module.exports = function(grunt) {
	//Code grunt
	grunt.initConfig({
		//Configuration du projet et des tâches
		pkg: grunt.file.readJSON('package.json'),

		//Clean old hashed files !
		clean: {
			//Clean JS Hashed Files
			jsfront:
				["www/js/assets/main.min*"]
			,
			jsback:
				["www/js/assets/main.back.min*"]
			,
			//Clean CSS Hashed Files
			css:
				["www/css/assets/*"]
			
		},

		//Convertio SCSS => CSS
		compass: {
		    dist: {
		      options: {
		        config: 'www/config.rb',
		        sassDir: 'www/sass',
        		cssDir: 'www/css',
		      }
		    }
		},


		//Concaténation des feuilles de styles CSS
		cssmin:{
			combine:{
				//Feuilles de style principale
				front: {
					files:{
						'www/css/main.min.css':
						[
						 	'www/css/master.css'
						]
					}
				},
				//Feuilles de style du back office (complete la main)
				back: {
					files:{
						'www/css/main.back.min.css':
						[
						 	'www/css/backoffice/summernote.css',
						 	'www/css/backoffice/summernote-bs3.css',				 
						 	'www/css/backoffice/font-awesome.min.css'
						]
					}
				}
			},
			//Config de la tâche cssmin
			options:{
				'keepSpecialComments' : 0
			}
		},


		//Concatene les fchiers js
		concat:{
			front:{
				//Fichier à concaténer
				src:[
					//'www/js/vendor/jquery-migrate-1.2.1.min.js',
					'www/js/vendor/unveil.js',
					//'www/js/vendor/mustache.js',
					'www/js/vendor/jquery.cycle.all.js',
					'www/js/vendor/responsiveslideshow.js',
					'www/js/vendor/bootstrap.min.js',
			        'www/js/master.js'
			    ],
				//Fichier de destination
				dest:'www/js/main.min.js'
			},
			back:{
				//Fichier à concaténer
				src:[
					'www/js/vendor/summernote.min.js'
			    ],
				//Fichier de destination
				dest:'www/js/main.back.min.js'
			}
		},


		//I watch you guy
		watch:{
			//JS
			jsfront: {
				files: [
					//'www/js/vendor/jquery-migrate-1.2.1.min.js',
					'www/js/vendor/unveil.js',
					//'www/js/vendor/mustache.js',
					'www/js/vendor/jquery.cycle.all.js',
					'www/js/vendor/responsiveslideshow.js',
					'www/js/vendor/bootstrap.min.js',
			        'www/js/master.js'
			    ],
				tasks:['clean:jsfront','concat:front','hash:js'],
				
			},
			jsback: {
				files: [
					'www/js/vendor/summernote.min.js'
			    ],
				tasks:['clean:jsback','concat:back','hash:js'],
				
			},
			scss: {
				files: [
					'www/sass/**/*.scss'
				],
				tasks:['clean:css','compass','cssmin','hash:css'],
			}
		},


		//I will hash you face!!!
		hash: {
	        options: {
	            mapping: 'app/config/assets/assets.json', //mapping file so your server can serve the right files
	            srcBasePath: 'www/', // the base Path you want to remove from the `key` string in the mapping file
	            destBasePath: 'www/', // the base Path you want to remove from the `value` string in the mapping file
	            flatten: false // Set to true if you don't want to keep folder structure in the `key` value in the mapping file
	        },
	        js: {
	            src: ['www/js/main.min.js','www/js/main.back.min.js'],  //all your js that needs a hash appended to it
	            dest: 'www/js/assets' //where the new files will be created
	        },
	        css: {
	            src: ['www/css/main.min.css','www/css/main.back.min.css'],  //all your css that needs a hash appended to it
	            dest: 'www/css/assets' //where the new files will be created
	        }
	    }
	});



	//Chargement des plugins
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-hash');
	grunt.loadNpmTasks('grunt-contrib-watch');

	//Tâche par défaut
	grunt.registerTask('default',
						['csslint'],
						['cssmin'],
						['jshint'],
						['concat'],
						['uglify'],
						['imagemin'],
						['watch']);

	//Tâche personnalisée pour le développement
	grunt.registerTask('dev',
						['csslint'],
						['cssmin'],
						['jshint'],
						['concat'],
						['uglify'],
						['watch']);

	//Tâche personnalisée pour la mise en prod
	grunt.registerTask('prod',['imagemin']);
}






/*uglify:{
	options:{
		//la date et le nom des fichiers minifiés sont insérés en commentaire en début de fichier
		banner:'/* <%= grunt.template.today("dd-mm-yyyy, HH:MM") %> \n <%= concat.dist.src %> *\/n'
	},
	dist:{
		files:{
			//Fichier de destination
			'www/js/main.min.js':
			//Fichier minifié
			['<%= concat.dist.dest %>']
		}
	}
},*/


/*imagemin:{
	dynamic:{
		files: [{
			//Mode de ciblage dynamqiue
			expand:true,
			//Dossier contenant les sources
			cwd:'www/img/sources',
			//Fichiers à prendre en compte
			src:['*.{png,jpg,gif}'],
			//Dossier de destination
			dest:'www/img'
		}]
	}
},*/