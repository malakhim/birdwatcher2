$(document).ready(function(){
  var delay = 2000;
  // $('#how_does_it_work_scroller').vTicker('init',
  //     {
  //       pause: delay,
  //       startPaused: true,
  //       showItems: 1,
  //       height: 48,
  //       mousePause: false,
  //     }
  //   );

  // $('.for_the_buyers_block').repeat().toggleClass('highlighted').wait(delay, function(){
  //   // $('#how_does_it_work_scroller').vTicker('next', {animate: true});
  //   $('.for_the_sellers_block').toggleClass('highlighted').wait(delay)
  // });

  $('.for_the_buyers_block .learn_more_box').click(function(){
    show_slider('buyer');
  });

  $('.for_the_sellers_block .learn_more_box').click(function(){
    show_slider('seller');
  });

  $('#background_img').css('margin-left','-' + $('#background_img').offset().left + 'px');

  $('.find_out_how_subbtn').click(function(){
    $('html, body').animate({scrollTop: $('.how_does_it_work_block').offset().top},1000); 
  });

  $('.contact-link').click(function(){
    window.location.href = 'contact-us.html';
  });

  $('.login-link').click(function(){
    window.location.href = 'index.php?dispatch=auth.login_form';
  });

});

function show_slider(group){
  if(group.indexOf('buyer') !== -1 && $('.buyerslider').css('display') == 'none'){
    $('.billibuys_home_slider').hide('slow');
    $('.da-slider').cslider({
      end: true
    });
    $('.sellerslider').hide('fast');
    $('.sellerslider').cslider({
      autoplay:true,
      current: 0,
      bgincrement: 0,
      page: 0
    });    
    $('.buyerslider').show();
    $('.billibuys_home_slider').show('slow');
    $('html, body').animate({scrollTop: $('.billibuys_home_slider').offset().top},1000); 
  }else if(group.indexOf('seller') !== -1 && $('.sellerslider').css('display') == 'none'){
    $('.billibuys_home_slider').hide('slow');
    $('.da-slider').cslider({
      end: true
    });    
    $('.buyerslider').hide('fast');
    $('.buyerslider').cslider({
      autoplay:true,
      current: 0,
      bgincrement: 0,
      page: 0
    });        
    $('.sellerslider').show();
    $('.billibuys_home_slider').show('slow');
     $('html, body').animate({scrollTop: $('.billibuys_home_slider').offset().top},1000); 
  }
}