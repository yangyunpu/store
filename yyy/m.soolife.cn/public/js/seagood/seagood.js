/*!
 * 在写入cookie之前执行该操作
 * 
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

(function(){	
    mui.init({
		swipeBack:true //启用右滑关闭功能
	});
	var slider = mui("#slider");
	slider.slider({
		interval: 5000
	});
//点击下载框消失
	var back2 = $('.lcy_seagood .header_top .back2');
	var head = $('.lcy_seagood .header_top');
	var main = $('.lcy_seagood .main_box');
	var seacher = $('.lcy_seagood .search_page');
	var hide = $('.lcy_seagood .search_page .search_page_top .hide_x')
	back2.click(function(){
		head.hide();
		main.hide();
		seacher.show();
	});	
	hide.click(function(){
		head.show();
		main.show();
		seacher.hide();
	});	


	function myEvent(obj,ev,fn){
		if(obj.attachEvent){
			obj.attachEvent('on'+ev,fn);
		}else{
			obj.addEventListener(ev,fn,false);
		}
	}
	myEvent(window,'load',function(){
		var timer=null;
		var scrollTop;
		var header_top = $('.header_top');
		var title = $('.title');
		var back = $('.lcy_seagood .header_top .back_btn')
		var back2 = $('.lcy_seagood .header_top .back2_btn')
		var bg;
		window.onscroll=function(){
			scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
			//首页头部的变色
			var _opacity =Math.floor((scrollTop/137)*6)/10;	
			if(_opacity>0.7){
				 _opacity = 0.7;
				title.css('color','#000');
				back.removeClass("back");
				back.addClass("back_change");
				back2.removeClass("back2");
				back2.addClass("back2_change");
			}else{
				title.css('color','#fff');
				back.removeClass("back_change");
				back.addClass("back");
				back2.removeClass("back2_change");
				back2.addClass("back2");				
			}
			bg = 'rgba(255,255,255,'+_opacity+')';
			border = '1px solid rgba(165,165,165,'+_opacity+')';
			scrollTop == 0 ? header_top.css({'background':'none','border':'0'}) : header_top.css({'background':bg,'border-bottom':border});
			
		};
	});



	var skip = 0;
	var url_goods = $(".goodslist").attr("url_goods");
	//alert(url_goods);
	$(window).scroll(function(){
		var totalheight = parseInt($(this).height())+parseInt($(this).scrollTop());
        var documentHeight =  $(document).height();
        if(totalheight >= documentHeight){
        if($('.searhloading').attr('value') == 1){
            return false;
        }
        
         skip +=10;
         scroll_load(skip,url_goods);
        }

	});
	function scroll_load(skip,url_goods){
		if($('.goodslist').children().last().is('.nomore')){
        return;
      }
        $.ajax({
        	url      : "/download.html",
        	type     : "post",
        	dataType : "json",
        	data     : {
        		"skip" : skip,
        	},
        	beforeSend:function(){
    		$('.goodslist').append('<div class="searhloading" value="1" style="height:30px;font-size:15px;text-align:center"><i class="icon-spin icon-spinner"></i>正在加载中...</div>');
    	},
    	success : function(data){
         $(".searhloading").remove();
         var data_list = data.data.items;
         var append_data = '';
         if(data_list.length == 0){
         	$('.goodslist').append('<div class="evaluate nomore" style="border:1x solid #ccc;height:50px;line-height:50px;font-size:14px">&nbsp;&nbsp;没有更多此类商品了哦！！！</div>');
         }else{
         	for(i in data_list){
         	append_data += '<a href="'+url_goods+'/'+data_list[i].id+'.html"><div class="goodsbox"><div class="goods_img"><img src="'+data_list[i].logo+'" alt=""></a></div><div class="goods_content"><p class="word"> <span class="color">海外精品</span>'+data_list[i].name+'</p><div class="content_l"><p class="piece">￥<span>'+data_list[i].price+'</span><!-- <span class="discount"></span> --></p><p class="date"><del>￥'+data_list[i].market_price+'</del></p></div><div class="content_r"><p class="country"><!-- <img src="/public/img/seagood/country_i.png" alt=""> --><span></span></p></div></div></div> </a>';
	        }
	        $('.goodslist').append(append_data);
         }
         
    	 }
        })
	
}


  $(".search").on("click",function(){
  	var url_search = $(".search").attr("url_search");
  	var text = $.trim($('#text').val());
  	//alert(text);
  	if(text == ''){
  		return false;
  	}
  	 $.base64.utf8encode = true;
  	 var url =$.base64.btoa(text);
     window.location.href=url_search+"/search?keyword="+url;
  });

  //按enter键按搜索键统一的效果
	document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];    
             if(e && e.keyCode==13){ // enter 键
                //按enter键执行
                var url_search = $(".search").attr("url_search");
  	            var text = $.trim($('#text').val());
                if(text == '')
                {
                    return false;
                }
                 $.base64.utf8encode = true;
                 var url =$.base64.btoa(text);
                 window.location.href=url_search+"/search?keyword="+url;
            }
        }; 
	

})();
//写入cookie
(function(){
     $(function(){ 
              var text = $.trim($('#text').val());
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
                var url_search = $(".search").attr("url_search");
                var text = $.trim($(this).text());
                $('#text').val(text);
                if(text == '')
                        {
                            return false;
                        }
                        //加密
                 $.base64.utf8encode = true;
                 var url =$.base64.btoa(text);
                 window.location.href=url_search+"/search?keyword="+url;

            });
     });  


})();
//单击垃圾桶删除cookie历史记录
(function(){
    $(".clear_img").on("click",function(){
           $.cookie('history', '', { expires: -1 }); // 删除 cookie
           $(".history > li").remove();
        
    })

})();


