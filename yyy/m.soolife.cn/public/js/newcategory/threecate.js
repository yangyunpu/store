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
///
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
//滑动屏幕时的效果

// console.log($('#catebtn').offset().top)
var scrollT;
var	catebtnScrollTop = +$('#catebtn').offset().top-95;
var _nav = $("#threecate").find("#nav").html();
var _top = '' ;
if(_nav == undefined){
	_top = "44px";
}else{
	_top = "95px";
}
if($('#threecate').data('csstag')=='9'){
	_top = "44px"
};

function scrollM(){
	scrollT = document.documentElement.scrollTop||document.body.scrollTop;
	if(scrollT>=catebtnScrollTop){
		$('#catebtn').css({
			"position":"fixed",
			"top":_top,
			"z-index":"9"
		});
	}else{
		$('#catebtn').css({
			"position":"static"
		});
	};
};
scrollM();
window.addEventListener('scroll', function(){
	scrollM();
});



//点击人气、销量...
var categories = $('#catebtn_box').data('categories');
$('.filter_btn').click(function(){
	key = 1;
	document.documentElement.scrollTop = document.body.scrollTop = 0;
	$(this).addClass('active').siblings().removeClass('active');
	var sort = $(this).data('sort');
	parms.sort = sort;
	var skip = 0;
	parms.skip = skip;
	$("#skip").val(1);
	// console.log(parms);
	sortF(parms);
});
//点击价格
var piecekey=0;
$('#filter_piece').click(function(){
	key = 1;
	document.documentElement.scrollTop = document.body.scrollTop = 0;
	$(this).addClass('active').siblings().removeClass('active');
	if(piecekey==1){
		$('#piecea').show();
		$('#piecev').hide();
		piecekey=0;
		parms.sort = "price_desc";
	}else{
		$('#piecev').show();
		$('#piecea').hide();
		piecekey=1;
		parms.sort = "price_asc";
	};
	var skip = 0;
	parms.skip = skip;
	$("#skip").val(1);
	// console.log(parms);
	sortF(parms);
});
// ajax;
function sortF(parms){
	$.ajax({
		url: '/newcategory/goodsajax',
		type: 'post',
		dataType: 'json',
		data: parms,
		success:function(res){
			// console.log(res.data.items);
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
			var b = null;
			if(data[i].items[0].promo.price!=0&&data[i].items[0].promo.coin!=0){
              b = "￥"+data[i].items[0].promo.price+"+"+data[i].items[0].promo.coins+"星币";
			}else if(data[i].items[0].promo.price!=0&&data[i].items[0].promo.coin==0){
             b = "￥"+data[i].items[0].promo.price;
			}else if(data[i].items[0].promo.price==0&&data[i].items[0].promo.coin!=0){
             b = data[i].items[0].promo.coin+"星币";
			}
			strc = '<p class="piece">'+b+'</p>'; 
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
	var threecode  = $('#threecode').val();
	var keyword   = $('#keyword').val();
	var brand_id   = $('#brand_id').val();
	var shop_id    = $('#shop_id').val();
	var countries  = $('#countries').val();
	var specs      = $('#specs').val();
	var _kai       = $('#_kai').val();
	var _jie       = $('#_jie').val();
	var spandata   = $('#span_str').val();

	var sss = encodeURIComponent(spandata);
	var brand_code = encodeURIComponent(brand_id);
	window.location.href="/newcategory/filter.html?firstcode=" + firstcode + "&twocode=" + twocode + "&threecode=" + threecode +"&keyword="+keyword+"&brand_id="+brand_code+"&shop_id="+shop_id+"&countries="+countries+"&specs="+specs+"&_kai="+_kai+"&_jie="+_jie +"&_span_str="+sss;
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
	var inputbox = $.trim($('#inputbox').val());
	if(inputbox) checkCookie(inputbox);
	var goHref = '/newcategory/threecate.html?keyword='+inputbox+'&csstag=9';
	window.location.href=goHref;
});
//下拉刷新//////////////////////
window.addEventListener('scroll', function(){
	if(key==0) return;
	var all_height = $(document).height();
	var see_height = $(window).height();
	var scroll_height= $(window).scrollTop();
	if(scroll_height+see_height == all_height){
		var n = +$('#skip').val();
		parms.skip = 20*n;
		n++;
		$('#skip').val(n);
		$.ajax({
			url: '/newcategory/goodsajax',
			type: 'post',
			dataType: 'json',
			data: parms,
			success:function(res){
				// console.log(parms);
				// console.log(res.data.items);
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
            url: '/newcategory/searchAutoAjax.html',
            type: 'POST',
            dataType    : "json",
            async       : false,
            data: {keyword: _autoVal},
            success:function(res){
                $(".search_display_list").html("");
                var data = res.data;
                if(data != undefined){

	                for(var i=0; i<data.length; i++){
	                	if(data[i] != undefined){

	                    var _li = '<li>'
			                    +	'<a class="set_history" href="/newcategory/threecate.html?keyword='+data[i]['wd']+'&csstag=9">'+data[i]['wd']+'</a>'
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
