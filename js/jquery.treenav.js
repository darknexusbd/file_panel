(function($) {
  $.fn.treeNav = function(options) {
    var setting = $.extend({
    }, options);
    return this.each(function() {
      var target = $(this);
      var folders = $(target).find("li[data-type='folder']");
      var folderIcon = document.createElement("span");
      $(folderIcon).addClass("folder").prependTo(folders);
      $(".folder").click(function() {
        $(this).toggleClass("open");
        var subItems = $(this).siblings("ul");
        $(subItems).slideToggle();
      });
    });
  };
})(jQuery);
