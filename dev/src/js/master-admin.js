var PagerAdminMaster = function (){
  //Attibuts
  var draw = false,
      area = null,
      pc_col_1_width = 8.3333,
      count_col = 12,
      offsetXBootstrap = 0,
      cssOffsetXBootstrap = 0,
      btnBlockTypeCreate = $('.block-presenter-call-to-create').html();
  
  this.start = function (e) {
    area = $('#page-block-drawing-area');
    area.on("mousemove mousedown mouseup", draw_block );

    $('body').on('click', '.drawn-block-show .remove', function (e) {
      console.log(e);
      $(this).parent('.drawn-block').remove();
    });

    $('body').on('click', '.action-in-block a', function (e) {
      e.preventDefault();

      var me = $(this),
          href = me.attr('href');

      $.get(href, function (data) {
        //for dom
        console.log(me.parent('.action-in-block'));
        me.closest('.action-in-block').html(data.form);
        //for js
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
      });
    });
  }

  var draw_block = function (e) {
    //console.log(e);
    var offsetX = e.offsetX,
        offsetY = e.offsetY,
        block = area.find('.drawn-block.current'),
        block_data = block.data();
    
    if ( e.type === 'mousemove' ) { 
      // If ".drawnBox.current" doesn't exist, create it.
      if ( block.length < 1 ) {
        $('<div class="drawn-block current"></div><div class="clearfix"></div>').appendTo( area );
      }
      
      var drawCSS = {};
      // If drawing is initiated.
      if ( draw ) {
          // Determine the direction.
          // xLeft
          if ( block_data.offsetX > offsetX ) {
              drawCSS['right'] = area.width() - block_data.offsetX,
              drawCSS['left'] = 'auto',
              drawCSS['width'] = block_data.offsetX - offsetX;
          }
          // xRight
          else if ( block_data.offsetX < offsetX ) {
              drawCSS['left'] = block_data.offsetX,
              drawCSS['right'] = 'auto',
              drawCSS['width'] = offsetX - block_data.offsetX;
          }
          // yUp
          if ( block_data.offsetY > offsetY ) {
              drawCSS['bottom'] = area.height() - block_data.offsetY,
              drawCSS['top'] = 'auto',
              drawCSS['height'] = block_data.offsetY - offsetY;
          }
          // yDown
          else if ( block_data.offsetY < offsetY ) {
              drawCSS['top'] = block_data.offsetY,
              drawCSS['bottom'] = 'auto',
              drawCSS['height'] = offsetY - block_data.offsetY;
          }
      }

      if ( !draw && block.length > 0 ) {
          block.css({
              top: offsetY,
              left: offsetX
          });
      }
      
      if ( draw ) {
          block.css( drawCSS );
      }
    }

    if ( e.type === 'mousedown' ) {
        e.preventDefault();
        draw = true;
        block.css('display','block');
        block.data({ "offsetX": offsetX, "offsetY": offsetY }); 
        //
        //with or without offsetbootstrap
        offsetXBootstrap = offsetBootstrap(block, offsetX);
        cssOffsetXBootstrap = offsetXBootstrap;
        
        if (block.prev().length != 0) {
          if (e.clientY < block.prev().offset().top+100) {
            cssOffsetXBootstrap = 0;
            console.log('created under line');
          }
        }
        
    } else if ( e.type === 'mouseup' ) {
        draw = false;   
        area.find('.clearfix').remove();     
        block.prev().removeClass('last');
        block
            .addClass('drawn-block-show last col-sm-'+(offsetBootstrap(block, offsetX) - offsetXBootstrap)+(offsetXBootstrap != 0?' col-sm-offset-'+cssOffsetXBootstrap:''))
            .removeClass('current')
            .removeAttr('style');

        block.removeData('offsetX offsetY');
        block.data({ 
          "responsive_width":offsetBootstrap(block, offsetX) - offsetXBootstrap,
          "responsive_trigger":"sm",
          "responsive_offset":(offsetXBootstrap != 0?cssOffsetXBootstrap:null)
        });

        block.append(btnBlockTypeCreate);
        block.prepend('<div class="remove"><span class="glyphicon glyphicon-remove"></span></div>');

        if (offsetBootstrap(block, offsetX) - offsetXBootstrap == 0) {
          block.remove();
        }
    }
  }

  var magnet = function (block, offsetX) {
    var area_width = area.width();
        pc_offsetX = offsetX*100/area_width,
        ratio_count_col = count_col*pc_offsetX/100,
        floor_ratio_count_col = Math.floor(ratio_count_col);

    //si on a 6.4/12 on doit aller vvers 6 si on a 6.6 vers 7...
    if (ratio_count_col-floor_ratio_count_col < 0.5) {
      return pc_offsetX = floor_ratio_count_col*pc_col_1_width;
    }
    return pc_offsetX = (floor_ratio_count_col+1)*pc_col_1_width;
  }

  var offsetBootstrap = function (block, offsetX) {
    var area_width = area.width();
        pc_offsetX = offsetX*100/area_width,
        ratio_count_col = count_col*pc_offsetX/100,
        floor_ratio_count_col = Math.floor(ratio_count_col);

    //si on a 6.4/12 on doit aller vvers 6 si on a 6.6 vers 7...
    if (ratio_count_col-floor_ratio_count_col < 0.5) {
      return floor_ratio_count_col;
    }
    return floor_ratio_count_col+1;
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