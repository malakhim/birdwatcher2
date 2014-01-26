$(document).ready(function(){
  $('#how_does_it_work_scroller').vTicker('init',
      {
        pause: 2000,
        showItems: 1,
        height: 48,
      }
    );
  // while(1){
  //   window.setTimeout(function(){
  //     $('.for_the_sellers_block').css('box-shadow','10px 10px 5px #888888')
  //   },2000);
  //   $('.for_the_sellers_block').css('box-shadow','0');
  //   window.setTimeout(function(){
  //     $('.for_the_buyers_block').css('box-shadow','10px 10px 5px #888888')
  //   },2000);
  //   $('.for_the_buyers_block').css('box-shadow','0');
  // }
  // 

  $('.for_the_buyers_block .learn_more_box').click(function(){
    show_slider('buyer');
  });

  $('.for_the_sellers_block .learn_more_box').click(function(){
    show_slider('seller');
  });

  $('#background_img').css('margin-left','-' + $('#background_img').offset().left + 'px');
});

function show_slider(group){
  console.log($('.billibuys_home_slider').css('display'));
  if($('.billibuys_home_slider').css('display') == 'none'){
    $('html, body').animate({scrollTop: $('.about_billibuys_block').offset().top},500); 
  }else{
    $('html, body').animate({scrollTop: $('.billibuys_home_slider').offset().top},500);     
  }
  $('.billibuys_home_slider').hide('slow');
  $('.da-slider').cslider({
    end: true
  });
  if(group.indexOf('buyer') !== -1){
    $('.sellerslider').hide('fast');
    $('.sellerslider').cslider({
      autoplay:true,
      current: 0,
      bgincrement: 0,
      page: 0
    });    
    $('.buyerslider').show();
  }else if(group.indexOf('seller') !== -1){
    $('.buyerslider').hide('fast');
    $('.buyerslider').cslider({
      autoplay:true,
      current: 0,
      bgincrement: 0,
      page: 0
    });        
    $('.sellerslider').show();
  }
  $('.billibuys_home_slider').show('slow');
}