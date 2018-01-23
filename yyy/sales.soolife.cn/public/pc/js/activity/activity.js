$(function(){ 
	var mySwiper = new Swiper('.swiper-container',{
        pagination: '.pagination',
        autoplay : 3000,
    	  speed:500,
        loop:true,
        autoplayDisableOnInteraction : false
  	})
    var img_height = $(".swiper-slide").find('img').height();
    console.log(img_height);
    $(".swiper-container").css("height",img_height);
    $(".swiper-slide").find('img').css("height",img_height);
  	var _li = $(".floor").find("li");
  	var index = 0;
  	_li.on("click",function(){
            var color = $('input[name=floatbarclickcolor]').val();
            var fbcolor = $('input[name=floatingbottomcolor]').val();
            $(this).css("background",color);
  	    $(this).parent('a').siblings().find("li").css("background",fbcolor);
  	})
        
})