exports.config =
  paths:
    public: './../../../../public/theme/default/admin'
    compass: './config.rb'
    watched: [
      'app', 
      './../../../../workbench/dynamix/i18n/public/admin',
      './../../../../vendor/dynamix/i18n/public/admin',
      './../../../../workbench/dynamix/pager/public/admin',
      './../../../../vendor/dynamix/pager/public/admin',
      './../../../../workbench/dynamix/core/public/admin',
      './../../../../vendor/dynamix/core/public/admin',
    ]

  files:
    javascripts:
      joinTo: 
        # Main
        '/js/master.js': [
          'bower_components/bootstrap/**',
          'bower_components/fancybox/**',
          'bower_components/ckeditor/**',
          'bower_components/metisMenu/**',
          'bower_components/bootstrapcolorpicker/**',
          '../../../../vendor/dynamix/i18n/public/admin/**',
          '../../../../workbench/dynamix/i18n/public/admin/**',
          '../../../../vendor/dynamix/pager/public/admin/**',
          '../../../../workbench/dynamix/pager/public/admin/**',
          '../../../../vendor/dynamix/core/public/admin/**',
          '../../../../workbench/dynamix/core/public/admin/**',
          'app/**'
        ]

        # Vendor, copy
        '/js/vendor/response.min.js': /^(bower_components[\/\\]responsejs)/
        '/js/vendor/head.min.js': /^(bower_components[\/\\]headjs)/
        '/js/vendor/jquery.min.js': /^(bower_components[\/\\]jquery)/
        '/js/vendor/media.match.min.js': /^(bower_components[\/\\]media-match)/

    stylesheets:
      joinTo:
        '/css/master.css': [
          'bower_components/bootstrap/**',
          'bower_components/fontawesome/**',
          'bower_components/eonasdan-bootstrap-datetimepicker/**',
          'bower_components/fancybox/**',
          'bower_components/metisMenu/**',
          'bower_components/bootstrapcolorpicker/**',
          '../../../../vendor/dynamix/i18n/public/admin/**',
          '../../../../workbench/dynamix/i18n/public/admin/**',
          '../../../../vendor/dynamix/pager/public/admin/**',
          '../../../../workbench/dynamix/pager/public/admin/**',
          '../../../../vendor/dynamix/core/public/admin/**',
          '../../../../workbench/dynamix/core/public/admin/**',
          'app/**'
        ]

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
      manifest: './../../../../app/config/assets/theme/default.json'
      srcBasePath: '../public/'
      destBasePath: '../public/'
      autoClearOldFiles: true
      targets: ['master.js','master.css']
      environments: ['production']
      alwaysRun: false
    assetsmanager:
      copyTo:
        '../../../js' : ['bower_components/ckeditor']