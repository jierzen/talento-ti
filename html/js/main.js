(function($){"use strict";var fullHeight=function(){$('.js-fullheight').css('height',$(window).height());$(window).resize(function(){$('.js-fullheight').css('height',$(window).height());});};fullHeight();$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});})(jQuery);

$(function () {
  $('[data-toggle="popover"]').popover()
})

$(function(){

 $('#busca-habilidades').keyup(function(){
   var that = this, $allListElements = $('#habilidades > li');
  var $matchingListElements = $allListElements.filter(function(i, li){
      var listItemText = $(li).text().toUpperCase(), searchText = that.value.toUpperCase();
      return ~listItemText.indexOf(searchText);
  });
  $allListElements.hide();
  $matchingListElements.show();
 });

 $('.busca-tabla').keyup(function(){
   var that = this, $allListElements = $('.tabla-busca tbody > tr');
  var $matchingListElements = $allListElements.filter(function(i, tr){
      var listItemText = $(tr).text().toUpperCase(), searchText = that.value.toUpperCase();
      return ~listItemText.indexOf(searchText);
  });
  $allListElements.hide();
  $matchingListElements.show();
 });
});


$(document).ready(function() {
    $('.dataTable').DataTable();
} );
