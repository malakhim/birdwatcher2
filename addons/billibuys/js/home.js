$(document).ready(function(){
  $('#how_does_it_work_scroller').vTicker('init',
      {
        pause: 2000,
        showItems: 1,
        height: 48,
      }
    );
  $('#background_img').css('margin-left','-' + $('#background_img').offset().left + 'px');

  $('.da-slider').cslider({
    autoplay:true
  });
});