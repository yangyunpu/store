//starmarket   javascript
(function(){
    //5个圈圈
    $(".classify ul li").on("click",function(){
        var url_search = $(".classify").attr("url_search");
        var code = $.trim($(this).attr("code"));
        window.location.href=url_search+"/cat/"+code+".html?refe=market";
    })

})();


(function(){
    //点击nav
    var url_goods = $(".market_more").attr("url_goods");
    $(".slider_nav>ul>li").eq(0).addClass('active');
    $(".slider_nav>ul>li").on("click",function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        //获取code
        var code = $.trim($(this).attr("code"));
        var index = 1
        $.ajax({
            url : "/market.html",
            type : "post",
            dataType :"json",
            data : {
                "code" : code,
                "index" : index,
            },
            success : function(kaka){
                $(".searhloading").remove();
                $(".market_more").remove();
                var data_list = kaka.data;
                var append_data = '';
                var append_mata = '';
                if(data_list == ''){
                    return;
                }else{

                    for(var i in data_list){
                        if(data_list[i].logo == ''){
                            append_data += '<div class="more_goods"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="/public/img/minet/defaultimg.png" alt=""></a></div><p class="goodsname">'+data_list[i].name+'</p><p class="piece">￥'+data_list[i].shop_price+'</p></div>';
                        }else{
                            append_data += '<div class="more_goods"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="'+data_list[i].logo+'" alt=""></a></div><p class="goodsname">'+data_list[i].name+'</p><p class="piece">￥'+data_list[i].shop_price+'</p></div>';
                        }
                        
                    }
                }
              append_mata = '<div class="market_more" id="market_more'+code+'">'+append_data+'</div>';
              $('.market_more_box').append(append_mata);

            }

        })
    });
   /*  end*/

   //下来加载
   var index = 1;
   $(window).scroll(function(){
        var code = $(".active").attr("code");
        var url_goods = $(".market_more").attr("url_goods");
        var totalheight = parseInt($(this).height())+parseInt($(this).scrollTop());
        var documentHeight =  $(document).height();
        if(totalheight >= documentHeight){
        if($('.searhloading').attr('value') == 1){
            return false;
        }
         ++index;
         scroll_load(index,url_goods,code);
     }

    });

   function scroll_load(index,url_goods,code){
        if($('.xing_like').children().last().is('.nomore')){
            return;
        };
     $.ajax({
        url : "/market.html",
        type : "post",
        dataType :"json",
        data : {
            "code" : code,
            "index" : index,
        },
        beforeSend:function(){
            $('.market_more').append('<div class="searhloading" value="1" style="height:30px;font-size:15px;line-height:30px;text-align:center;width:100%;"><i class="icon-spin icon-spinner"></i>正在加载中...</div>');
            setTimeout(function(){
                $(".searhloading").remove();
            },1000);
        },
        success : function(kaka){
            $(".searhloading").remove();
            var data_list = kaka.data;
            var append_data = '';
            if(data_list == ''){
                return;
            }else{
                for(var i in data_list){
                    if(data_list[i].logo == ''){
                        append_data += '<div class="more_goods"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="/public/img/minet/defaultimg.png" alt=""></a></div><p class="goodsname">'+data_list[i].name+'</p><p class="piece">￥'+data_list[i].shop_price+'</p></div>';
                    }else{
                        append_data += '<div class="more_goods"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="'+data_list[i].logo+'" alt=""></a></div><p class="goodsname">'+data_list[i].name+'</p><p class="piece">￥'+data_list[i].shop_price+'</p></div>';
                    }
                    
                }
            }
          $('.market_more').append(append_data);

        }

    });

   }


 
    //zhichao_hu 
    //缓动返回顶部
    function myEvent(obj,ev,fn){
        if(obj.attachEvent){
            obj.attachEvent('on'+ev,fn);
        }else{
            obj.addEventListener(ev,fn,false);
        }
    }
    myEvent(window,'load',function(){
        var oRTT=document.getElementById('to_head');
        var pH=document.documentElement.clientHeight;
        var nav = $('.lcy_starmarket .slider_nav');
        var nav_scrolltop = nav.offset().top;
        
        var timer=null;
        var scrollTop;
        window.onscroll=function(){
            scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
            if(scrollTop >=nav_scrolltop){
                nav.css({
                        'position': 'fixed',
                        'top': '44px'
                });              
            }else{
                nav.css('position','static');               
            }
            if(scrollTop>=pH){
                oRTT.style.display='block';
            }else{
                oRTT.style.display='none';
            }
            return scrollTop;
        };
        oRTT.onclick=function(){
            clearInterval(timer);
            timer=setInterval(function(){
                var now=scrollTop;
                var speed=(0-now)/10;
                speed=speed>0?Math.ceil(speed):Math.floor(speed);
                if(scrollTop==0){
                    clearInterval(timer);
                }
                document.documentElement.scrollTop=scrollTop+speed;
                document.body.scrollTop=scrollTop+speed;
            }, 30);
        }
    });


})();

