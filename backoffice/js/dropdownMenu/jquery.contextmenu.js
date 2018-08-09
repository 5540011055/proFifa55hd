jQuery.fn.contextPopup = function(menuData) {
  var obj           = null;
  function createMenu() {
    var menu = $('<ul class=contextMenuPlugin><div class=gutterLine></div></ul>')
                .appendTo(document.body);
    if (menuData.title) {
        $('<li class=header></li>').html(menuData.title).appendTo(menu);
    }
    menuData.items.forEach(function(item) {
    if (item) {
        var row = $('<li><a href="#"><img><span></span></a></li>').appendTo(menu);
        row.find('img').attr('src', item.icon);
        row.find('span').text(item.label);
        if (item.action) {
          row.find('a').click(item.action);
        }
        } else {
            $('<li class=divider></li>').appendTo(menu);
        }
    });
    menu.find('.header').html(menuData.title+' &nbsp;&nbsp;&nbsp;<span class="close" title="close"></span>&nbsp;');
    menu.find(".header .close").click(function(){obj = null;menu.remove();});    
    return menu;
  }

  // On contextmenu event (right click)
  this.click('contextmenu', function(e) {
    // Create and show menu
    if(obj==null){
        obj            = true;
        var menu = createMenu()
            .show()
            .css({zIndex:1000001, left:e.pageX + -10 /* nudge to the right, so the pointer is covering the title */, top:e.pageY-5})
            .bind('contextmenu', function() { return false; });
        menu.find('a').click(function() {
            obj = null;
            menu.remove();
        });
    }
    return false;
  });
  return this;
};