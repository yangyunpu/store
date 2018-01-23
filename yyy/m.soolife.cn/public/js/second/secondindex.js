var firstcode = $('#search_box').data('firstcode');
var itemurl = $('#threecate').data('itemurl');
var historyWord = getCookie("historyword").split('*&&*');
if(getCookie("historyword")){
	var historySpan='';
	for(var i=0;i<historyWord.length;i++){
		if(historyWord[i]) historySpan+='<a href="/newcategory/threecate.html?keyword='+historyWord[i]+'&csstag=9"><span>'+historyWord[i]+'</span></a>'
	};
	$('#newbox #box').html(historySpan);
}else{
	$('#new').hide();
	$('#newbox').hide();
};
$('#newbox #remove').click(function(){
	clearCookie('historyword');
	$('#new').hide();
	$('#newbox').hide();
});
///////
var key = 1;
//点击切换样式
$("#filter_view").toggle(function(){
	$('#sentiment').addClass('inlinestyle').removeClass('blockstyle');
	$('.blockb').show();
	$('.inlienb').hide(); 
},function(){
	$('#sentiment').addClass('blockstyle').removeClass('inlinestyle');
	$('.blockb').hide();
	$('.inlienb').show(); 
});
//滑动 
var mySwiper = new Swiper('.swiper-container',{
    pagination: '.pagination',
    autoplay : 2000,
	speed:300,
    loop:true,
    autoplayDisableOnInteraction : false
}) 
 
// var str="";
//点击人气、销量...
var categories = $('#catebtn_box').data('categories');
$('.filter_btn').click(function(){ 
	key = 1;
	$(this).addClass('active').siblings().removeClass('active');
	var sort = $(this).data('sort'); 
	parms.skip = 0;
	parms.sort = sort; 
	n=0;
	sortF(parms);
	// console.log(parms);
});
//点击价格
var piecekey=0;
$('#filter_piece').click(function(){
	key = 1;
	$(this).addClass('active').siblings().removeClass('active');
	if(piecekey==1){
		$('#piecea').show();
		$('#piecev').hide();
		piecekey=0; 
		parms.skip = 0;
		n=0;
		parms.sort = "price_desc";
	}else{
		$('#piecev').show();
		$('#piecea').hide();
		piecekey=1;
		parms.skip = 0;
		n=0;
		parms.sort = "price_asc"; 	
	};  
	// console.log(parms);
	sortF(parms);
});

// ajax;
function sortF(parms){
	$.ajax({
		url: '/second/goodsajax',
		type: 'post',
		dataType: 'json',
		data: parms,
		success:function(res){ 
			// console.log(res);
			str=""; 
			$('#sentiment').html(appendStr(res.data.items));
		}
	});
};
//拼接字符串
function appendStr(data){
	var str = '';
	if(data.length==0){
		key = 0;
		return str = '<p style="text-align:center;width: 100%;float: left;">没有更多商品了...</p>';
	};
	for(var i=0;i<data.length;i++){
		var stra = '';
		var strb = '';
		var strc = '<p class="piece">￥'+data[i].items[0].promo.price+'</p>';
		if (data[i].items[0].type==1) {
			stra = '<p class="tag">海外精品</p>';
			strb = '<p class="smalltag"><span>海外精品</span></p>';
		};
		if (data[i].items[0].promo.type!=0) {
			strc = '<p class="piece">￥'+data[i].items[0].promo.price+'+'+data[i].items[0].promo.coin+'星币</p>';
		}; 
		str += '<div class="item bg-white margin-b">'
			+'<div class="img_box float-l">'
				+'<a href="'+itemurl+'/'+data[i].items[0].id+'.html">'
				+'<img src="'+data[i].items[0].logo+'"></a>' 
				+ stra
			+'</div>'
			+'<div class="wen_box float-l">'
				+'<p class="name">'+data[i].items[0].name+'</p>'
				+strb
				+strc
			+'</div>'
		+'</div>';
	};
	return str;
};
//跳转筛选
var nowHref = window.location.href;
$('#filter_lou').click(function(){
	var firstcode  = $('#firstcode').val();
	var twocode    = $('#twocode').val();
	var brand_id   = $('#brand_id').val();
	var shop_id    = $('#shop_id').val();
	var countries  = $('#countries').val();
	var specs      = $('#specs').val();
	var _kai       = $('#_kai').val();
	var _jie       = $('#_jie').val();
	var spandata   = $('#span_str').val();

	var sss = encodeURIComponent(spandata);
	var brand_code = encodeURIComponent(brand_id);

	window.location.href="/second/filter.html?firstcode=" + firstcode + "&twocode=" + twocode + "&brand_id="+brand_code+"&shop_id="+shop_id+"&countries="+countries+"&specs="+specs+"&_kai="+_kai+"&_jie="+_jie +"&_span_str="+spandata;
});
//点击搜索
$('#threecate #head-right').click(function(){ 
	$('#threecate').hide();
	$('#search_box').show();
});
$('#search_box #head-left').click(function(){
	$('#threecate').show();
	$('#search_box').hide();
});
$('#search_box #head-right').click(function(){
	var inputbox = $('#inputbox').val(); 
	if(inputbox) checkCookie(inputbox);  
	var goHref = '/second/secondindex.html?keyword='+inputbox;
	window.location.href=goHref;
});
///////////////////////////////////
$('#nowbtn').click(function(){
	$(this).addClass('active').siblings().removeClass('active');
	$('#next').hide();
	$('#now').show();
});
$('#nextbtn').click(function(){
	$(this).addClass('active').siblings().removeClass('active');
	$('#now').hide();	
	$('#next').show();
});
//下拉刷新////////////////////// 
var n=0; 
window.addEventListener('scroll', function(){ 
	if(key==0) return;
	var all_height = $(document).height();
	var see_height = $(window).height();
	var scroll_height= $(window).scrollTop(); 
	if(scroll_height+see_height >= all_height){ 
		n++;
		parms.skip = 10*n; 
		// console.log(parms);
		$.ajax({
			url: '/second/goodsajax',
			type: 'post',
			dataType: 'json',
			data: parms,
			success:function(res){   
			console.log(res);				 
				$('#sentiment').append(appendStr(res.data.items));
			}
		});
	}; 	
});
//cookie操作
function setCookie(cname,cvalue,path,exdays){
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = encodeURIComponent(cname)+"="+encodeURIComponent(cvalue)+"; expires="+expires+"; path="+path;
};
function getCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return decodeURIComponent(c.substring(name.length,c.length));
	}
	return "";
}
function checkCookie(str){	 
	var text=getCookie("historyword"); 
	var textarr = text.split("*&&*");
	for(var i=0;i<textarr.length;i++){
		if(textarr[i]==str) return;
	}; 
	if(text){
		var newText = text+'*&&*'+str;
		setCookie("historyword",newText,'/',30);
	}else{
		setCookie("historyword",str,'/',30);
	} 
};
function clearCookie(name) {    
    setCookie(name, "","/", -1);    
}
//倒计时

	// var nowtime = parseInt(+new Date()/1000);
	// var endTime1 = +$('#now .time').data('endtime');  
	// var _time1 =  endTime1-nowtime;  
	// var beginTime2 = +$('#next .time').data('begintime');
	// var _time2 =  beginTime2-nowtime; 
	 
	// function makeTime(option,value) {
	//     var m = parseInt(value);
	//     var min = 0;
	//     var h = 0;
	//     if(m > 60) {
	//         min = parseInt(m/60);
	//         m = parseInt(m%60);
	//         if(min > 60) {
	//             h = parseInt(min/60);
	//             min = parseInt(min%60);
	//         };
	//     };
	//     if(h<10){
	//     	h='0'+h;
	//     };
	//     if(min<10){ 
	//     	min='0'+min;
	//     };
	//     if(m<10){
	//     	m='0'+m;
	//     };
	//     var str = '<span>'+h+'</span>&nbsp;:&nbsp;<span>'+min+'</span>&nbsp;:&nbsp;<span>'+m+'</span>';
	//     $(option).html(str);
	// };
	// function startTime(option,n){
	// 	var _timer = setInterval(function(){
	// 			n -= 1;
	// 			makeTime(option,n);
	// 			if(n <= 0){
	// 				var endstr = '<span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>'; 
	// 				$(option).html(endstr);
	// 				clearInterval(_timer);				
	// 			}
	// 	},1000);
	// };
	// startTime('#now .time',_time1);
	// startTime('#next .time',_time2);
 
	var time = ""//倒计时计时器

	$(".stamp").each(function(){
		var _time =parseInt($(this).val())*1000;
		var _index =  $(this).data("index");
		time = setInterval(function(){
	    	countDown(_time,_index);
	    },1000)
	})
	function countDown(obj,_index){
		var startTime = new Date();
		var endTime = new Date(obj);
		var differ = endTime-startTime;
		var differSec= parseInt(differ/1000);
		var countDay = Math.floor(differSec/(24*60*60));
		var countHour = Math.floor((differSec-countDay*24*60*60)/(60*60));
		var countmin = Math.floor((differSec-countDay*24*60*60-countHour*60*60)/60);
	    var countsec = Math.floor(differSec-countDay*24*60*60-countHour*60*60-countmin*60);
	    if(countDay<0){
	        $(".timestamp"+_index+"").html("<span>00</span>"+" : "+"<span>00</span>"+" : "+"<span>00</span>");
	        return;
	    }
	    if(countDay<10){
	        countDay = "0"+countDay;
	    }
	    if(countHour<10){
	        countHour = "0"+countHour;
	    }
	    if(countmin<10){
	        countmin = "0"+countmin;
	    }
	    if(countsec<10){
	        countsec = "0"+countsec;
	    }
	    if(countDay=="00"){
	    	$(".timestamp"+_index+"").html("<span>"+countHour+"</span>"+" : "+"<span>"+countmin+"</span>"+" : "+"<span>"+countsec+"</span>")
	    }else{
	    	$(".timestamp"+_index+"").html("<span>"+countDay+"</span>"+" 天 "+"<span>"+countHour+"</span>"+" : "+"<span>"+countmin+"</span>"+" : "+"<span>"+countsec+"</span>")
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".timestamp"+_index+"").html("<span>00</span>"+" : "+"<span>00</span>"+":"+"<span>00</span>");
	    }     
	}

	var next_time = ""
	$(".next_stamp").each(function(){
		var _time =parseInt($(this).val())*1000;
		var _index =  $(this).data("index");
		next_time = setInterval(function(){
	    	nextCountDown(_time,_index);
	    },1000)
	})
	function nextCountDown(obj,_index){
		var startTime = new Date();
		var endTime = new Date(obj);
		var differ = endTime-startTime;
		var differSec= parseInt(differ/1000);
		var countDay = Math.floor(differSec/(24*60*60));
		var countHour = Math.floor((differSec-countDay*24*60*60)/(60*60));
		var countmin = Math.floor((differSec-countDay*24*60*60-countHour*60*60)/60);
	    var countsec = Math.floor(differSec-countDay*24*60*60-countHour*60*60-countmin*60);
	    if(countDay<0){
	        $(".timestamp"+_index+"").html("<span>00</span>"+" : "+"<span>00</span>"+" : "+"<span>00</span>");
	        return;
	    }
	    if(countDay<10){
	        countDay = "0"+countDay;
	    }
	    if(countHour<10){
	        countHour = "0"+countHour;
	    }
	    if(countmin<10){
	        countmin = "0"+countmin;
	    }
	    if(countsec<10){
	        countsec = "0"+countsec;
	    }
	    if(countDay=="00"){
	    	$(".next_timestamp"+_index+"").html("<span>"+countHour+"</span>"+" : "+"<span>"+countmin+"</span>"+" : "+"<span>"+countsec+"</span>")
	    }else{
	    	$(".next_timestamp"+_index+"").html("<span>"+countDay+"</span>"+" 天 "+"<span>"+countHour+"</span>"+" : "+"<span>"+countmin+"</span>"+" : "+"<span>"+countsec+"</span>")
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".next_timestamp"+_index+"").html("<span>00</span>"+" : "+"<span>00</span>"+":"+"<span>00</span>");
	    }     
	}


	// if(getCookie("historyword")){
	// 	var historySpan='';
	// 	for(var i=0;i<historyWord.length;i++){
	// 		if(historyWord[i]) historySpan+='<a href="/newcategory/threecate.html?firstcode='+firstcode+'&keyword='+historyWord[i]+'&csstag=9"><span>'+historyWord[i]+'</span></a>'
	// 	};
	// 	$('#newbox #box').html(historySpan);
	// }else{
	// 	$('#new').hide();
	// 	$('#newbox').hide();
	// };
	// $('#newbox #remove').click(function(){
	// 	clearCookie('historyword');
	// 	$('#new').hide();
	// 	$('#newbox').hide();
	// });


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
	var goHref = '/newcategory/threecate.html?keyword='+text+'&csstag=9';
	window.location.href=goHref;
});

	// 热门搜索自动补全
	    $("#inputbox").bind("input propertychange",function(event) {
	        var _autoVal = $(this).val();
	        if(_autoVal == ""){
	            $(".search_display").show();
	            $(".search_display_list").hide();
	        }else{
	            $(".search_display").hide();
	            $(".search_display_list").show();
	        }
	        $.ajax({
	            url: '/mindex/searchAutoAjax.html',
	            type: 'POST',
	            dataType    : "json",
	            async       : false,
	            data: {keyword: _autoVal},
	            success:function(res){
	                $(".search_display_list").html("");
	                var data = res.data;
	                // console.log(data);
	                if(data != undefined){

		                for(var i=0; i<data.length; i++){
		                	if(data[i] != undefined ){

			                    var _li = '<li>'
										+	'<a class="set_history" href="/newcategory/threecate.html?keyword='+data[i]['wd']+'&csstag=9">'+data[i]['wd']+'</a>';
			                    		+'</li>'
		                	}
		                    $(".search_display_list").append(_li)
		                } 
	                }
	            }
	        }) 
	    });
	    $("#search_box").on("click",".set_history",function(){
	    	var _html = $(this).html();
	    	if(_html != ""){ checkCookie(_html) };
	    	var goHref = '/newcategory/threecate.html?keyword='+_html+'&csstag=9';
	    	window.location.href=goHref;
	    })