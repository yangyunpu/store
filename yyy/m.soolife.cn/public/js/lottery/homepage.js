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
    // 初始化抽奖金额
    var rule =parseInt($("#rule_money").val());
    $(".box-man").find("span").html(rule);


    $(".good-btm").on("click",function(){
        var skuid = $(this).data("skuid");
        var fullid = $(this).data("fullid");
        var fcid = $(this).data("fcid");
        $.ajax({
            url : "/lottery/addcart.html",
            contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
            dataType : 'json',
            type : 'post',
            data :{"skuid":skuid,"fullid":fullid,"fcid":fcid},
            success : function(d) {
                if (d.success) {
                    $(".price").html("￥"+d.data.price)
                } else {
                    alert(d.msg);
                }
            }
        });
    })
})