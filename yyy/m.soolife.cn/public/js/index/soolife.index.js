    /**
    * 
    * @return  在写入cookie之前执行该操作
    * @param  index
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
    * @param  搜索
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    (function(){
        //单击搜索按钮
        $(".search").on("click",function(){
        var url_search = $(".header_top").attr("url_search");
        var $text = $.trim($("#text").val());
        if($text == '')
        {
            return false;
        }
         $.base64.utf8encode = true;
         var url =$.base64.btoa($text);
         url = url.replace(/\+/g, "-");
         window.location.href=url_search+"/search?keyword="+url;

        });


        //单击热搜标签跳转
        $(".hot").on("click",function(){
            var url_search = $(".header_top").attr("url_search");
            var $text = $.trim($(this).text());
            $('#text').val($text);
            if($text == '')
                    {
                        return false;
                    }
                    //加密
             $.base64.utf8encode = true;
             var url =$.base64.btoa($text);
             url = url.replace(/\+/g, "-");
             window.location.href=url_search+"/search?keyword="+url;

        });
        
        //按enter键按搜索键统一的效果
        document.onkeydown=function(event){
                var e = event || window.event || arguments.callee.caller.arguments[0];    
                 if(e && e.keyCode==13){ // enter 键
                    //按enter键执行
                     var url_search = $(".header_top").attr("url_search");
                     var $text = $("#text").val();
                    if($text == '')
                    {
                        return false;
                    }
                    //加密
                     $.base64.utf8encode = true;
                     var url =$.base64.btoa($text);
                     url = url.replace(/\+/g, "-");
                     window.location.href=url_search+"/search?keyword="+url;
                }
            }; 
        

    })();



    /**
    * 
    * @return 
    * @param  上啦加载更多
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    (function(){
        var $index = 0;
        var url_goods = $(".header_top").attr("url_goods");
        $(window).scroll(function(){
            var totalheight = parseInt($(this).height())+parseInt($(this).scrollTop());
            var documentHeight =  $(document).height();
            if(totalheight >= documentHeight){
            if($('.searhloading').attr('value') == 1){
                return false;
            }
             $index++;
             scroll_load($index,url_goods);
         }

        });

    function scroll_load($index,url_goods){
          if($('.xing_like').children().last().is('.nomore')){
            return;
        }
        $.ajax({
            url : "/downlading.html",
            type : "post",
            dataType :"json",
            data : {
                "index" :$index,
            },
            beforeSend:function(){
                $('.loading').append('<div class="searhloading" value="1" style="height:30px;margin-bottom:60px;font-size:15px;text-align:center"><i class="icon-spin icon-spinner"></i>正在加载中...</div>');
            },
            success : function(data){
                if(data.success){
                    console.log(data);
                    setTimeout(function(){
                        $(".searhloading").remove();
                        var data_list = data.data.Data;
                        var append_data = '';
                        if(data_list == ""){
                            $('.loading').append('<div class="evaluate nomore" style="border:1x solid #ccc;height:50px;line-height:50px;font-size:14px">&nbsp;&nbsp;没有更多此类商品了哦！！！</div>');
                        }else{
                            for(var i in data_list){
                                if(data_list[i].logo==""){
                                    append_data += '<div class="xing_like_goods_box"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="/public/img/minet/defaultimg.png" class="xing_like_goods_img"/></a></div><p class="xing_like_goods_word">'+'为您推荐的商品，希望你喜欢哦！'+'</p><span class="xing_like_goods_money">￥'+data_list[i].act_price+'</span></div>';
                                }else if(data_list[i].sku_name==""){
                                    append_data += '<div class="xing_like_goods_box"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="'+data_list[i].logo+'" class="xing_like_goods_img"/></a></div><p class="xing_like_goods_word">'+'为您推荐的商品，希望你喜欢哦！'+'</p><span class="xing_like_goods_money">￥'+data_list[i].act_price+'</span></div>';
                                }else{
                                    append_data += '<div class="xing_like_goods_box"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].sku_id+'.html"><img src="'+data_list[i].logo+'" class="xing_like_goods_img"/></a></div><p class="xing_like_goods_word">'+data_list[i].sku_name+'</p><span class="xing_like_goods_money">￥'+data_list[i].act_price+'</span></div>';
                                }
                        }
                        }                   
                      $('.xing_like').append(append_data);
                    },5)
                }else{
                    return;
                }
            }

        })
        }
    })();

    /**
    * 
    * @return 
    * @param  搜索历史记录
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    //写入cookie
    (function(){
         $(function(){ 
                  var $text = $("#text").val();
                  var history;
                  var json="["; 
                  var json1;  //json1是第一次注入cookie以后的第一个json，"此时还不是数组" 以点带面的处理  
                  var canAdd= true;  //var json1=eval("({sitename:'dreamdu',sitedate:new Date(1996, 04, 11, 12, 0, 0)})"); 
                  if(!$.cookie("history")){  
                  //第一次的时候需要初始化  
                  history = $.cookie("history","{text:\""+$text+"\"}"); 
                  }else {  
                  //已经存在 
                    history = $.cookie("history");
                    json1 = eval("("+history+")");
                    $(json1).each(function(){  
                    if(this.text==$text){  
                    canAdd=false; 
                    return false; 
                     } 
                     })  
                    if(canAdd){  
                     $(json1).each(function(){  
                     json = json + "{\"text\":\""+this.text+"\"},"; 
                    })  
                     json = json + "{\"text\":\""+$text+"\"}]"; 
                     $.cookie("history",json,{expires:1}); 
                     } 
              }  
        }) 

    })();
    //从cookie取出来
    (function(){
        $(function(){ 
          if($.cookie("history")){ 
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
                 for(var i = 0 ;i<json.length;i++)
                     {
                         if(json[i].text == "" || typeof(json[i].text) == "undefined")
                         {
                                  json.splice(i,1);
                                  i--;
                         }
                                  
                     }
                     if(json != '' ){
                        json.reverse();
                        for(var i in json){
                        append_data += '<li class="hot"><a>'+json[i].text+'</a></li>';
                        }
                        $('.history').append(append_data);
                     }             
            } 
                  //单击热搜标签跳转
                $(".hot").on("click",function(){
                    var url_search = $(".header_top").attr("url_search");
                    var $text = $.trim($(this).text());
                    $('#text').val($text);
                    if($text == '')
                            {
                                return false;
                            }
                            //加密
                     $.base64.utf8encode = true;
                     var url =$.base64.btoa($text);
                     url = url.replace(/\+/g, "-");
                     window.location.href=url_search+"/search?keyword="+url;

                });
         });  


    })();


    /**
    * 
    * @return 
    * @param  单击垃圾桶删除cookie历史记录
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    (function(){
        $(".clear_img").on("click",function(){
               $.cookie('history', '', { expires: -1 }); // 删除 cookie
               $(".history > li").remove();
            
        })

    })();


    (function(){    
        mui.init({
            swipeBack:true //启用右滑关闭功能
        });
        var slider = mui("#slider");

        slider.slider({//轮播
            interval: 2000
        });

        (function($) {//懒加载...
            $(document).imageLazyload({
                placeholder: '/public/img/defaultimg.png'
            });  
        })(mui);
       //点击热门搜索遮罩出现
        var y_search_box = $('#search_box');
        var y_search_page = $('.search_page');
        var y_content = $('.mui-content');
        var y_header = $('.header_top');
        var y_hide_x = $('.hide_x');
        y_search_box.click(function(){
            y_search_page.show();
            y_content.hide();
            y_header.hide();
        })
        y_hide_x.click(function(){
            y_search_page.hide();
            y_header.show();
            y_content.show();
        })

        //点击下载框消失
        var y_download_x = $('.download_x');
        var y_download_box = $('.download_box');
        y_download_x.click(function(){
            y_download_box.hide();
        }); 

        //点击下载按钮
        var download = $('#download');
        var download_mark = $('.download_mark');
        var mark_hide = $('.mark_hide');
        var android_btn = $('.mark_box_b');
        download.click(function(){
            open_app();
            download_mark.bind("touchmove",function(e){
                e.preventDefault();
            });
        });
        android_btn.click(function(event){
            var _data = $(this).attr('data');
            if(_data ==1){
                window.location.href = "SoolifeShopping://";
                setTimeout(function() {
                    document.location = 'http://app.soolife.cn/downloads.html?source=soolife&site=app.soolife.cn&referrer=0000';
                }, 2000);       
            }else if(_data ==0){
                download_mark.hide();                       
            }
        });
        mark_hide.click(function(){
            download_mark.hide();
        });


        /**
        * 
        * @return 
        * @param  跳转到app；
        * @author zhichao_hu@soolife.com.cn
        * @date 
        */
        function open_app(){//处理url
            function getUrlVars() {
                var vars = [],hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for (var i = 0; i < hashes.length; i++) {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            }       
            function getUrlVar(name) {
                return getUrlVars()[name];
            }

            var activeno = getUrlVar('activeno');
            if (activeno == undefined) {
                activeno = '';
            }
            
            function startApp(e) {//判断andriod或ios
                if (navigator.userAgent.match(/iPhone|mac|iPod|iPad/)&&navigator.userAgent.match(/Safari/)) {

                    window.location.href = "SoolifeShopping://";

                    setTimeout(function() {
                        document.location = 'https://itunes.apple.com/us/app/ru-ci-sheng-huo-shi-shang/id1116994060?mt=8';
                    }, 2000);

                }else{
                    download_mark.show();
                }
            }
            startApp();
        }     

    /**
    * 
    * @return 
    * @param  缓动返回顶部
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
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
            var timer=null;
            var scrollTop;
            var _search_bg = $('.search_bg');
            var bg;
            window.onscroll=function(){
                scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
            //debugger;
            //首页头部的变色
            var _opacity =Math.floor((scrollTop/160)*6)/10; 
                if(_opacity>0.6){
                     _opacity = 0.6;
                }
                bg = 'rgba(205,6,6,'+_opacity+')';
                if(scrollTop == 0){
                    _search_bg.css('background','-webkit-gradient(linear,0 -50%,0 100%,from(rgba(51, 51, 51, 0.6)),to(rgba(255,255,255,0)))');
                }else{
                    _search_bg.css('background',bg);
                }
                //scrollTop = 0 ?_search_bg.css('background','-webkit-gradient(linear,0 -50%,0 100%,from(rgba(51, 51, 51, 0.6)),to(rgba(255,255,255,0)))') : _search_bg.css('background',bg);



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
                }, 3);
            }
        });




    })();


