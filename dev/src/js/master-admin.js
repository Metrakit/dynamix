var PagerAdminMaster = function (){
  this.start = function () {

  }

};

var SpeedNavigationAdminMaster = function (){
  this.start = function () {
    //Ajax loading page of admin ui
    $('body').on('click','#side-menu a', function (e) {
      //Disable native comportment
      e.preventDefault();
      //Show loader (pure css)
      $('.loader').fadeIn('fast');
      //post to get content
      $.get($(this).attr('href'), function (data) {
        //reset dom
        document.getElementById('section-filemanager').style.height = "0px";
        document.getElementById('section-page-header').innerHTML = '';
        document.getElementById('section-content').innerHTML = '';

        for( var o in data ) {
          //Only load text content
          switch(o) {
            case 'meta_title':
              document.title = data[o];
              break;
            case 'page-header':
              document.getElementById('section-page-header').innerHTML = data[o];
              break;
            case 'content':
              document.getElementById('section-content').innerHTML = data[o];
              break;
            case 'filemanager':
              document.getElementById('section-filemanager').style.height = "100%";
              document.getElementById('section-filemanager').innerHTML = data[o];
              break;
          }
        }
        //after replace part in dom, fadeout loader and getback menu !
        $('.loader').fadeOut('fast', function () {
          for( var o in data ) {
            switch(o) {
              case 'script':
                eval(data[o]);
                break;
              case 'scriptOnReady':
                eval(data[o]);
                break;
            }
          }
          $('#wrapper').removeClass('st-menu-open');

        });
      });

    });
  }
};



var NavigationAdminMaster = function (){
  this.start = function () {
    //Navigation admin (nav-left)
    $('body').on('click','.btn-nav-left', function (e) {
      var wrapper = $('#wrapper');
      if (wrapper.hasClass('st-menu-open') ) {
        wrapper.removeClass('st-menu-open');
      } else {
        wrapper.addClass('st-menu-open');
      }
    });
    $('body').on('click','#wrapper.st-menu-open #page-wrapper', function (e) {
      var wrapper = $('#wrapper');
      if (wrapper.hasClass('st-menu-open') ) {
        wrapper.removeClass('st-menu-open');
      }
    });
  }

};


//Object MasterAdmin
var MasterAdmin = function (){
  this.start = function (){
    var pagerService = new PagerAdminMaster();
    pagerService.start();

    var navigationAdminService = new NavigationAdminMaster();
    navigationAdminService.start();

    var speedNavigationAdminService = new SpeedNavigationAdminMaster();
    //speedNavigationAdminService.start();
  }
  
  this.checboxButtonListener = function () {
    //checkbox button states
    $('body').on('click', '.checkbox.checkbox-button .enable', function () 
    {
      if ($(this).hasClass('disabled')) {
        $(this).removeClass('disabled');  
      } else {
        $(this).addClass('disabled');
      }
    });
    
    $('body').on('click', '.checkbox.checkbox-button .disable', function () 
    {
      if ($(this).hasClass('enabled')) {
        $(this).removeClass('enabled');  
      } else {
        $(this).addClass('enabled');
      }
    });
  }

  this.switchCheckboxInitializr = function () {
    // JS is only used to add the <div>s
    var switches = document.querySelectorAll('input[type="checkbox"].ios-switch');

    for (var i=0, sw; sw = switches[i++]; ) {
      var div = document.createElement('div');
      div.className = 'switch';
      sw.parentNode.insertBefore(div, sw.nextSibling);
    }
  }

  this.switchRadioInitializr = function () {
    // JS is only used to add the <div>s
    var switches = document.querySelectorAll('input[type="radio"].ios-switch');

    for (var i=0, sw; sw = switches[i++]; ) {
      var div = document.createElement('div');
      div.className = 'switch';
      sw.parentNode.insertBefore(div, sw.nextSibling);
    }
  }

  this.watchMenuObjects = function () {
    var width = 0,
        o = 0,
        margin = 4;
    //console.log($('#navigation').children('.menu-objects'));
    $('#navigation .menu-objects').each( function (index) {
      width=width + $(this).width() + margin;
    });

      //width = width + $('#navigation').children('.menu-objects')[o].width();
      console.log(width + 1);
    

    $('#navigation').width(width + 1);
  }
}
var masterAdminClass = new MasterAdmin();