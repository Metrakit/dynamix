//Pager dynamic
var PagerAdminMaster = function (){
  //Attibuts

  //Methods
  this.start = function () {
    initListeners();
  }

  var initListeners = function () {

    //Add blocks
    $('body').on('click', '.block-template', function (e) {
      e.preventDefault();
      var me    = $(e.target);
          href  = me.attr('href');
      $.post(href, {}, function (data) {
        $('#page-template').append(data);
      });
    });

    //Remove line of blocks
    $('body').on('click', '.page-lineblock-remove-btn', function (e) {  
      var me = $(e.target);
      if (me.parent().hasClass('show-line')) {
        me.parent().removeClass('show-line');
      } else {
        me.parent().addClass('show-line');        
      }
    });
    $('body').on('click', '.page-lineblock-confirm-remove-btn', function (e) {
      $(e.target).closest('.page-block-remove').slideUp('slow', function (e) {
        $(this).remove();
      });
    });
    
    //Récupération de tous les formulaires de la pages /page/create
    $('body').on('click', '.btn-submit-page', function (e) {
      var forms = $('form');

      //check validation of selects
      /*$.post('/admin/page', {}, function (data) {
        //use the page_id

        for (var o in forms) {
          postBlockForm(forms[o]);
        } 
      });*/
    });

    //Soumition d'un formulaire d'un block
    var postBlockForm = function (form ) {
      $.post(WhereWeCreateThis, {}, function (data) {
        
      });
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

    initListeners();
  }
  
  var initListeners = function () {
    $('body').on('click', 'button.remove', function (e) {
      e.preventDefault();

      var form = $(e.target).closest('form');
      $('#modal-confirm-delete').modal();
      $('body').on('click', '#modal-confirm-delete .confirm', function (e){
        form.submit();
      });
    });
  };

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








//Pager dynamic
/*var PagerAdminMaster = function (){
  //Attibuts
  var draw = false,
      area = null,
      pc_col_1_width = 8.3333,
      count_col = 12,
      offsetXBootstrap = 0,
      cssOffsetXBootstrap = 0,
      btnBlockTypeCreate = $('.block-presenter-call-to-create').html(),
      indexBlock = 1,
      locale_id_class = '.block-locale-id-';
  
  this.start = function (e) {
    area = $('.page-block-drawing-area');
    area.on("mousemove mousedown mouseup", draw_block );

    //!!!TODO!!!//
    //ici on va mettre les meme écouteurs que pour la création d'un block
    //sauf qu'on prend que l'axe X
    //Et on va transvaser (à gauche) dans le offsetboostrap et moins la taille, et à droite on ajoute ou réduit
    //area.on("mousemove mousedown mouseup", draw_block );
    
    //Resfull DELETE
    $('body').on('click', '.drawn-block-show .remove', function (e) {
      var className = locale_id_class + $(this).parent('.drawn-block').data('index');
      $(className).remove();
    });

    $('body').on('click', '.action-in-block a', function (e) {
      //les 'block' contienent un index dans $.data('index')
      e.preventDefault();

      var me = $(this),
          href = me.attr('href'),
          block = me.closest('.action-in-block');

      block.parent().addClass('drawn-block-type-chosen');
      href += '?index='+block.parent().data('index')+'&current_locale='+$('.tab-pane.active').attr('data-locale-id');
      $.get(href, function (data) {
        putContent(locale_id_class, block, data, makeJs);
      });
    });

    //for dom
    var putContent = function (locale_id_class, block, data, callback) {
      $(locale_id_class + block.parent().data("index")).html(data.form);
      callback(data);
    }
    //for js
    var makeJs = function (data) {
      for( var o in data ) {
        switch(o) {
          case 'script':
            console.log(data[o]);
            eval(data[o]);
            break;
        }
      }
    }
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
        $('<div class="drawn-block current block-locale-id-' + indexBlock + '"></div><div class="clearfix"></div>')
          .data("index",indexBlock)
          .appendTo( area );
        indexBlock++;
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
      console.log('--------------');
      console.log(offsetBootstrap(block, offsetX));
      console.log(offsetXBootstrap);
        var block_width = offsetBootstrap(block, offsetX) - offsetXBootstrap;
        draw = false;
        if (block_width >= 0) {
          area.find('.clearfix').remove();     
          block.prev().removeClass('last');
          block
              .addClass('drawn-block-show last col-sm-'+(block_width)+(offsetXBootstrap != 0?' col-sm-offset-'+cssOffsetXBootstrap:''))
              .removeClass('current')
              .removeAttr('style');

          block.removeData('offsetX offsetY');
          block.data({ 
            "responsive_width":block_width,
            "responsive_trigger":"sm",
            "responsive_offset":(offsetXBootstrap != 0?cssOffsetXBootstrap:null)
          });


          block.append(btnBlockTypeCreate);
          block.prepend('<div class="remove"><span class="glyphicon glyphicon-remove"></span></div>');
        }

        if (block_width == 0) {
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
};*/
