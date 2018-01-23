$(function(){
    var mySwiper = new Swiper('.swiper-container',{
        pagination: '.pagination',
        autoplay : 2000,
        speed:300,
        loop:true,
        autoplayDisableOnInteraction : false
    })
    $('.hl-banner').bind("click",function(){
        $(".hkl-fex").show();
        $(".hkl-neir").show();
        // 初始化底层页面
        document.onwheel=function(){
            return false;
        }
        document.ontouchmove=function(){
            return false;
        }
    })
    $('.neir-img').bind("click",function(){
        $(".hkl-fex").hide();
        $(".hkl-neir").hide();
        document.onwheel=function(){
            return true;
        }
        document.ontouchmove=function(){
            return true;
        }
        // 初始化底层页面
    })
})