exports.config =
  paths:
    public: './../../../public'
    compass: './config.rb'
    watched: ['app']

  files:
    javascripts:
      joinTo: 
        # Main
        '/public/js/master.js': /^(bower_components[\/\\]bootstrap|bower_components[\/\\]bootstrap-datepicker|bower_components[\/\\]bootstrap-filestyle|app[\/\\]public)/
        '/admin/js/master.js': /^(bower_components[\/\\]bootstrap|bower_components[\/\\]metisMenu|bower_components[\/\\]fancybox|bower_components[\/\\]ckeditor|bower_components[\/\\]bootstrapcolorpicker|app[\/\\]admin)/

        # Vendor, copy
        '/public/js/vendor/response.min.js': /^(bower_components[\/\\]responsejs)/
        '/public/js/vendor/head.min.js': /^(bower_components[\/\\]headjs)/
        '/public/js/vendor/jquery.min.js': /^(bower_components[\/\\]jquery)/
        '/public/js/vendor/media.match.min.js': /^(bower_components[\/\\]media-match)/

        '/admin/js/vendor/response.min.js': /^(bower_components[\/\\]responsejs)/
        '/admin/js/vendor/head.min.js': /^(bower_components[\/\\]headjs)/
        '/admin/js/vendor/jquery.min.js': /^(bower_components[\/\\]jquery)/
        '/admin/js/vendor/media.match.min.js': /^(bower_components[\/\\]media-match)/

    stylesheets:
      joinTo:
        '/public/css/master.css': /^(app|bower_components[\/\\]bootstrap|bower_components[\/\\]bootstrap-datepicker)/
        '/admin/css/master.css': /^(app|bower_components[\/\\]bootstrap|bower_components[\/\\]bootstrap-datepicker)/

  modules:
    wrapper: false
    definition: false

  conventions:
    # we don't want javascripts in asset folders to be copied like the one in
    # the bootstrap assets folder
    assets: /assets[\\/](?!javascripts)/

  plugins:
    cleancss:
      keepSpecialComments: 0
      removeEmpty: true
    sass:
      debug: 'comments'
      allowCache: true
    fingerprint:
      manifest: '../app/config/assets/assets.json'
      srcBasePath: '../public/'
      destBasePath: '../public/'
      autoClearOldFiles: true
      targets: ['master.js','master.css']