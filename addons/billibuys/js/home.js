$(document).ready(function(){
  $('.for_the_buyers_block .learn_more_box').click(function(){
    show_slider('buyer');
  });

  $('.for_the_sellers_block .learn_more_box').click(function(){
    show_slider('seller');
  });

  $('#background_img').css('margin-left','-' + $('#background_img').offset().left + 'px');

  $('.find_out_how_subbtn').click(function(){
    // $('html, body').animate({scrollTop: $('.how_does_it_work_block').offset().top},1000); 
    window.location.href = 'index.php?dispatch=billibuys.view';
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