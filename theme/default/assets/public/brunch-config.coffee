exports.config =
  paths:
    public: '../../../../public/theme/default/public'
    compass: './config.rb'
    watched: [
      'app', 
      './../../../../workbench/dynamix/i18n/public/public',
      './../../../../workbench/dynamix/pager/public/public',
      './../../../../workbench/dynamix/core/public/public',
    ]

  files:
    javascripts:
      joinTo: 
        # Main
        '/js/master.js': [
          'bower_components/bootstrap/**',
          '../../../../vendor/dynamix/i18n/public/public/**',
          '../../../../vendor/dynamix/pager/public/public/**',
          '../../../../vendor/dynamix/core/public/public/**',
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
          '../../../../vendor/dynamix/i18n/public/public/**',
          '../../../../vendor/dynamix/pager/public/public/**',
          '../../../../vendor/dynamix/core/public/public/**',
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
      manifest: './../../../../app/config/assets/theme/public-default.json'
      srcBasePath: '../../../../public/theme/default/'
      destBasePath: '../../../../public/theme/default/'
      autoClearOldFiles: true
      targets: ['master.js','master.css']
      environments: ['production']
      alwaysRun: false
    assetsmanager:
      copyTo:
        '../../../uploads/system/public-favicon' : ['app/img/favicon/*']