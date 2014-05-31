$(document).ready(function(){

  $('.top_menu_item').click(function(){
    // FIXME: We're not accounting for middle mouse button clicks due to issues with Chrome
    window.location.href = 'index.php?dispatch='+$(this).attr('href');
  });

  $('#second-top-nav').css('margin-left','-' + $('#second-top-nav').offset().left + 'px');

});