$(document).ready(function(){
  // var width = $('body').width();
  $('#header_img').css({
   'width':       $('body').width(),
   'margin-left': '-' + $('#header_img').offset().left + 'px',
  });
});