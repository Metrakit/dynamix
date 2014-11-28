//Object MasterAdmin
var MasterAdmin = function (){
  this.start = function (){
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


/*$('body').click( function (e) {
  console.log(e);
});*/

//Block
var blockMapEnter = function () {
  var me    = $(this),
      index = me.index();

  if( !me.hasClass('hover') ) {      
    //reset
    $('.block-map').removeClass('hover');

    //set
    for ( var i = 0; i < index; i++ ) {
      $(me.parent().children()[i]).addClass('hover');
    }
    me.addClass('hover');
  }
}
var blockMapLeave = function () {
  $('.block-map').removeClass('hover');
}
//Listen hover
$('body .block-map').on({mouseenter: blockMapEnter,mouseleave: blockMapLeave});

//First step = Choose width
$('body').on('click','.block-map', function (e) {
  var width = $(this).attr('data-width');
  //Set input width the width on 12 (x/12)
  $('input[name=block-width]').val(width);
  //Remove listener for hover 
  $('body .block-map').off({mouseenter: blockMapEnter,mouseleave: blockMapLeave});
  //Fix state
  $('.block-create').addClass('step-1-ok');
});
//If want to change
$('body').on('click','.block-create.step-1-ok .block-map', function (e) {
  //reset .hover
  $('.block-map').removeClass('hover');
  //Remove state
  $('.block-create').removeClass('step-1-ok');
  //Set listener for hover
  $('body .block-map').on({mouseenter: blockMapEnter,mouseleave: blockMapLeave});
  //Set input to empty string
  $('input[name=block-width]').val('');
});

//Second step !
//Show button with css...
//When a choice is done, get presenter of module


