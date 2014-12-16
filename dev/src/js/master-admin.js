var PagerAdminMaster = function (){
  //Attibuts
  var draw = false;
  var dp = null;
  
  this.start = function (e) {
    dp = $('#page-block-drawing-area');
    dp.on("mousemove mousedown mouseup", draw_block );
  }

  var draw_block = function (e) {
    //console.log(e);
    var offsetX = e.offsetX,
        offsetY = e.offsetY,
        dpCurrent = dp.find('.drawn-block.current'),
        dpCurrent_data = dpCurrent.data();
    
    if ( e.type === 'mousemove' ) {
        
        // If ".drawnBox.current" doesn't exist, create it.
        if ( dpCurrent.length < 1 ) {
            $('<div class="drawn-block current"></div>').appendTo( dp );
        }
        
        var drawCSS = {};

        // If drawing is initiated.
        if ( draw ) {

            // Determine the direction.
            
            // xLeft
            if ( dpCurrent_data.offsetX > offsetX ) {
                drawCSS['right'] = dp.width() - dpCurrent_data.offsetX,
                drawCSS['left'] = 'auto',
                drawCSS['width'] = dpCurrent_data.offsetX - offsetX;
            }
            // xRight
            else if ( dpCurrent_data.offsetX < offsetX ) {
                drawCSS['left'] = dpCurrent_data.offsetX,
                drawCSS['right'] = 'auto',
                drawCSS['width'] = offsetX - dpCurrent_data.offsetX;
            }
            
            // yUp
            if ( dpCurrent_data.offsetY > offsetY ) {
                drawCSS['bottom'] = dp.height() - dpCurrent_data.offsetY,
                drawCSS['top'] = 'auto',
                drawCSS['height'] = dpCurrent_data.offsetY - offsetY;
            }
            // yDown
            else if ( dpCurrent_data.offsetY < offsetY ) {
                drawCSS['top'] = dpCurrent_data.offsetY,
                drawCSS['bottom'] = 'auto',
                drawCSS['height'] = offsetY - dpCurrent_data.offsetY;
            }

        }

        if ( !draw && dpCurrent.length > 0 ) {

            dpCurrent.css({
                top: offsetY,
                left: offsetX
            });
        }
        
        if ( draw ) {
            dpCurrent.css( drawCSS );
        } 
        
    }

    if ( e.type === 'mousedown' ) {
        e.preventDefault();
        draw = true;
        dpCurrent.css('display','block');
        dpCurrent.data({ "offsetX": offsetX, "offsetY": offsetY });      
        
    }
    else if ( e.type === 'mouseup' ) {
        draw = false;        
        dpCurrent.prev().removeClass('last');
        dpCurrent
            .css('display','block')
            .addClass('last')
            .removeClass('current');

    }
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