$(document).ready(function () {
   
//-------------轮播----------------------
 var mySwiper = new Swiper('.swiper-container',{
        pagination: '.pagination',
        autoplay : 2000,
    	speed:300,
        loop:true,
        autoplayDisableOnInteraction : false
  })
 // 点击搜索按钮
 $(".search").click(function(){
 	$(".wrap").hide();
 	$(".seek").show();
    // 初始化
    $(".search_auto").val("");
 })
 $(".seeked").click(function(){
    $(".wrap").hide();
    $(".seek").show();
     // 初始化
    $(".search_auto").val("");
 })
$(".seekser").click(function(){
    $(".wrap").hide();
    $(".seek").show();
     // 初始化
    $(".search_auto").val("");
 })
$(".lj_seek").click(function(){
 	$(".wrap").hide();
 	$(".seek").show();
     // 初始化
    $(".search_auto").val("");
 })
 $(".HnavigationLeft").click(function(){
 	$(".seek").hide();
 	$(".wrap").show();
     // 初始化
    $(".search_auto").val("");
 })
//-------------------------------搜索框begin-------------------------------------------- 
$('.Hdelete').click(function(){
    $('.Hhistoryspan').html('');
    $('.Hdelete').attr('style','display:none');
    $('.Hhistory h3').attr('style','display:none');
})
//---------------------------------------------------------------------------
// 回到顶部
    Soo('back-ceil').sooBcakCeil({
        positionR:'20px',
        positionB:'60px',
        showRange:1000,
        instant:true
    });
// 顶部导航变色

    var changeRangeTotal = 182;
    var changeRange = changeRangeTotal/2;
    var opacityMax = 1;
    var scrollTop;
    var _opacity;
    var _opacitys;

    // window.addEventListener('scroll',function(){
        
        //     scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        //     var ratio =changeRange/opacityMax;
        //     if(scrollTop>0){
        //         var _opacity = Math.floor((scrollTop/ratio)*100)/100; 
        //         $(".lj_shad").css("opacity",_opacity);
        //         if(scrollTop>91){
        //             $(".lj_shad").hide();
        //             $(".head").hide();
        //             $(".head2").show();
        //             $(".lj_shad2").show();
        //             _opacitys = Math.floor((2-_opacity)*100)/100;
        //             $(".lj_shad2").css("opacity",_opacitys);
        //         }
        //     }else if(0<scrollTop<91){
        //         $(".head").show();
        //         $(".head2").hide();

        //     }else if(91<scrollTop<=182){
        //         $(".head").hide();
        //         $(".head2").show();

        //     }
        //     if(scrollTop >= 182) return;
    // });

window.addEventListener('scroll',function(){
        
        scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        var ratio =changeRange/opacityMax;
        var _opacityd = Math.floor((scrollTop/ratio)*100)/100;
     
        if(scrollTop<91){
            $(".head").show();
            $(".head2").hide();
            $(".lj_shad").show();
            $(".lj_shad2").hide();
             _opacity = Math.floor((scrollTop/ratio)*100)/100;
            $(".lj_shad").css("opacity",_opacity);
        }else if(scrollTop>91.5){
            $(".head").hide();
            $(".head2").show();
            $(".lj_shad").hide();
            $(".lj_shad2").show();
             _opacitys = Math.floor((2-_opacityd)*100)/100;
            $(".lj_shad2").css("opacity",_opacitys);
        }
        // if(scrollTop>=183) return;

    });





 //领星币
     // $(".getbtn").on("click",function(){
     //    $.ajax({
     //        url      : "/mindex/getCoin",
     //        type     : "post",
     //        dataType : "json",
     //        ContentType:"application/x-www-form-urlencoded",
     //        success : function(data){
     //            if(data.data.success){
     //                $(this).html("已领取");

     //            }else if(data.data.msg == '当前用户已退出登录,请重新登录'){
     //                go_login();
     //            }else{
     //                alert("当前网络较慢");
     //            }
     //        }

     //    });
     // })

    var type ;
    var size = 10;
    var  index = 1 ;

    /**
    * 
    * @return 
    * @param  登录并且调回当前页面
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    function go_login(){
        var url_member       = $(".login").attr("data-url-member");
        $.base64.utf8encode  = true;
        var url              = $.base64.btoa(window.location.href);
        window.location.href = url_member+"/login.html?return_url="+url;
    }
   /**
    * 
    * @return 
    * @param  下拉加载更多
    * @author junjie_lei@soolife.com.cn
    * @date 
    */
    //下拉刷新////////////////////////////////////////////////////////////////////////////
    var door = 0;
    window.onscroll=function(){
        var a = $(window).height(); //是获取当前 也就是你浏览器所能看到的页面的那部分的高度
        var c = document.body.clientHeight;//可见区域高度
        var e = $(document).scrollTop();
        if(door == 1) return;
        if(a+e == c){
            index++;
            // size = index*20;
            $.ajax({
                url: '/mindex/guesslike',
                type: 'POST',
                dataType: 'json',
                data : {
                    "type":type,
                    "index": index,
                    "size" : size
                },
                success:function(res){
                    append_data(res)
                }
            });
            return;
        };
    };
    // 下拉刷新 处理ajax
    function append_data(res){
        var data = res.msg;
        var str = '';
        if(res.msg){
            for(var i=0;i<data.length;i++){
                     str+='<li class="items">'
                        +'<a href="'+data[i].url+'/'+ data[i].sku_id +'.html">'
                        +'<div class="imgs">'
                        +'<img src="'+data[i].logo +'">'
                        +'</div>'
                        +'<div class="words">'
                        +'<p>'+data[i].sku_name+'</p>'
                        +'<p>￥'+ data[i].act_price +'</p>'
                        +'</div>'
                        +'</a>'
                        +'</li>';                                           
            };                  
        }else{
            door = 1;
            str = '<p style="text-align:center;">没有更多商品了...</p>';
        };
        $('.lj_like ul').append(str);
    };
// ------------------------------首页搜索--------------------------------
$(function(){
    /**
    * 
    * @return 
    * @param  
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    (function (factory) {
        if (typeof define === 'function' && define.amd) {
            define(['jquery'], factory);
        } else {
            factory(jQuery);
        }
    }(function ($) {

        var pluses = /\+/g;

        function encode(s) {
            return config.raw ? s : encodeURIComponent(s);
        }

        function decode(s) {
            return config.raw ? s : decodeURIComponent(s);
        }

        function stringifyCookieValue(value) {
            return encode(config.json ? JSON.stringify(value) : String(value));
        }

        function parseCookieValue(s) {
            if (s.indexOf('"') === 0) {
                s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
            }

            try {
                s = decodeURIComponent(s.replace(pluses, ' '));
            } catch(e) {
                return;
            }

            try {
                // If we can't parse the cookie, ignore it, it's unusable.
                return config.json ? JSON.parse(s) : s;
            } catch(e) {}
        }

        function read(s, converter) {
            var value = config.raw ? s : parseCookieValue(s);
            return $.isFunction(converter) ? converter(value) : value;
        }

        var config = $.cookie = function (key, value, options) {

            // Write
            if (value !== undefined && !$.isFunction(value)) {
                options = $.extend({}, config.defaults, options);

                if (typeof options.expires === 'number') {
                    var days = options.expires, t = options.expires = new Date();
                    t.setDate(t.getDate() + days);
                }

                return (document.cookie = [
                    encode(key), '=', stringifyCookieValue(value),
                    options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                    options.path    ? '; path=' + options.path : '',
                    options.domain  ? '; domain=' + options.domain : '',
                    options.secure  ? '; secure' : ''
                ].join(''));
            }

            // Read

            var result = key ? undefined : {};
            var cookies = document.cookie ? document.cookie.split('; ') : [];

            for (var i = 0, l = cookies.length; i < l; i++) {
                var parts = cookies[i].split('=');
                var name = decode(parts.shift());
                var cookie = parts.join('=');

                if (key && key === name) {
                    result = read(cookie, value);
                    break;
                }
                if (!key && (cookie = read(cookie)) !== undefined) {
                    result[name] = cookie;
                }
            }

            return result;
        };

        config.defaults = {};

        $.removeCookie = function (key, options) {
            if ($.cookie(key) !== undefined) {
                $.cookie(key, '', $.extend({}, options, { expires: -1 }));
                return true;
            }
            return false;
        };

    }));


    /**
    * 
    * @return 
    * @param  单击搜索按钮
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    var firstcode='';
    $(".HnavigationRight").on("click",function(){
        // var url_search = $(".Hnavigation").attr("url_search");
        // var id   = $(".Hnavigation").attr("id");
        var text = $.trim($(".HnavigationCenter input").val());
        if(text == '') return;
        // $.base64.utf8encode = true;
        //  var url =$.base64.btoa(text);
        //  url = url.replace(/\+/g, "-"); 
        //  window.location.href=url_search + '/newcategory/threecate.html?keyword='+url;


         // var inputbox = $('#inputbox').val();  
         // if(text) checkCookie(text); 
         var goHref = '/newcategory/threecate.html?firstcode='+firstcode+'&keyword='+text+'&csstag=9';
         window.location.href=goHref;
    });


    /**
    * 
    * @return 
    * @param  单击热搜标签跳转
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    $("body").on("click",".hot",function(){
     // $(".hot").on("click",function(){
        // var url_search = $(".Hnavigation").attr("url_search");
        var text = $.trim($(this).text());

        $(".HnavigationCenter input").val(text);
        if(text == '')  return;
        // $.base64.utf8encode = true;
        // var url =$.base64.btoa(text);
        // url = url.replace(/\+/g, "-");

        // window.location.href=url_search+"/newcategory/threecate.html?keyword="+url;
        var goHref = '/newcategory/threecate.html?firstcode='+firstcode+'&keyword='+text+'&csstag=9';
         window.location.href=goHref;
    });
    
    /**
    * 
    * @return 
    * @param  按enter键按搜索键统一的效果
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];    
            if(e && e.keyCode==13){ // enter 键
                //按enter键执行
                // var url_search = $(".Hnavigation").attr("url_search");
                var text = $.trim($(".HnavigationCenter input").val());
                if(text == '') return;
                 //加密
                //  $.base64.utf8encode = true;
                //  var url =$.base64.btoa(text);
                //  url = url.replace(/\+/g, "-");
                // window.location.href=url_search+"/newcategory/threecate.html?keyword="+url;
// console.log(text);return;
                var goHref = '/newcategory/threecate.html?firstcode='+firstcode+'&keyword='+text+'&csstag=9';
                window.location.href=goHref;
        }
    }; 


    /**
    * 
    * @return 
    * @param  in cookie
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    (function(){
        $(function(){ 
              var text = $.trim($(".HnavigationCenter input").val());
              var history;
              var json="["; 
              var json1;  //json1是第一次注入cookie以后的第一个json，"此时还不是数组" 以点带面的处理  
              var canAdd= true;  //var json1=eval("({sitename:'dreamdu',sitedate:new Date(1996, 04, 11, 12, 0, 0)})"); 
              if(!$.cookie("history")){  
                    //第一次的时候需要初始化  
                    history = $.cookie("history","{text:\""+text+"\"}"); 
              }else {  
                    //已经存在 
                    history = $.cookie("history");
                    json1 = eval("("+history+")");
                    $(json1).each(function(){  
                        if(this.text==text){  
                            canAdd=false; 
                            return false; 
                        } 
                    })  
                    if(canAdd){  
                         $(json1).each(function(){  
                            json = json + "{\"text\":\""+this.text+"\"},"; 
                         })  
                         json = json + "{\"text\":\""+text+"\"}]"; 
                         $.cookie("history",json,{expires:1}); 
                    } 
              }  
         }) 

    })();

    /**
    * 
    * @return 
    * @param  get cookie
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    //zvar status = true;
    (function(){
        $(function(){ 
          if($.cookie("history")){
            /*if(status){
                setTimeout(function(){
                    window.location.reload(); 
                        
                },1000)
               
            }
            status = false; */
            var json = eval($.cookie("history"));
            var append_data = '';
            var list ="";  
            $(json).each(function(){ 
            list = list +'"+this.text+"'; 
            function strJsonToJsonByEval(list){ 
                    var json = eval("(" + list +")");//转换为json对象 
                    return json;
                }
            })
            for(var i = 0 ;i<json.length;i++){
                 if(json[i].text == "" || typeof(json[i].text) == "undefined"){
                      json.splice(i,1);
                      i--;
                 }
                          
            }
            if(json != '' ){
                json.reverse();
                for(var i in json){
                    append_data += '<span class="hot">'+json[i].text+'</span>';
                }
                $('.Hhistoryspan').append(append_data);
            }else{
                $(".Hhistory").remove();

            }               
          }        
        });  

    })();


    
    $('.Hdelete').click(function(){
        // 刷新页面
        // window.location.reload(); 
        $.cookie('history', '', { expires: -1 }); // 删除 cookie
        $(".Hhistoryspan span").remove();
        // $(".Hhistory").remove();
     
    })
})


// --------------------------------------------------------------------
})