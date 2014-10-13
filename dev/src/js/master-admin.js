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
