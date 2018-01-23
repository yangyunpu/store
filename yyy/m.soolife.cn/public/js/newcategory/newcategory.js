var historyWord = getCookie("historyword").split('*&&*');
console.log(historyWord);
if(getCookie("historyword")){
	var historySpan='';
	for(var i=0;i<historyWord.length;i++){
		if(historyWord[i]) historySpan+='<a href="/newcategory/threecate.html?firstcode=&keyword='+historyWord[i]+'&csstag=9"><span>'+historyWord[i]+'</span></a>'
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
$('#newcategory #head-right').click(function(){ 
	$('#newcategory').hide();
	$('#search_box').show();
});
$('#search_box #head-left').click(function(){
	$('#newcategory').show();
	$('#search_box').hide();
});
var firstcode='';
$('#search_box #head-right').click(function(){
	var inputbox = $('#inputbox').val();  
	if(inputbox) checkCookie(inputbox); 
	var goHref = '/newcategory/threecate.html?firstcode='+firstcode+'&keyword='+inputbox+'&csstag=9';
	window.location.href=goHref;
});
$('#nav .soo-slice-5').click(function(){
	var btncode = $(this).data('btncode');
	$(this).addClass('active').siblings().removeClass('active');

	var datanum = $(this).index();
	$('#mian .mianbody').hide();
	$('#mian .mianbody').eq(datanum).show(); 
});
function cateMore(data){
	var stra = '<div class="banner margin-b">'+
				'<div class="box"><img src="'+data.img+'"></div>'+
				'<img src="/public/img/newcategory/yi.png" alt="" class="classify_btn">'+
			'</div>';
	var strb = "";	 	
	for(var i=0;i<data.items.length;i++){
		var strc = "";
		for(var j=0;j<data.items[i].items.length;j++){
			strc+='<div class="soo-col-4 goods">'+
					'<a href="/newcategory/threecate.html?firstcode='+data.id+'&twocode='+data.items[i].id+'&threecode=B'+data.items[i].items[j].code+'">'+
					'<div class="imgbox"><img src="'+data.items[i].items[j].img+'" alt=""></div></a>'+
					'<p>'+data.items[i].items[j].name+'</p>'+
				'</div>';
		};
		strb+='<div class="mian soo-row"> '+
			'<a href="/newcategory/threecate.html?firstcode='+data.id+'&twocode='+data.items[i].id+'"><div class="box2"><img src="'+data.items[i].img+'" ></div></a>'+
			'<div class="goods_box clear-f margin-b">'+
				  strc
			'</div>	'+
		'</div>';
	};
	var str = stra+strb;
	$('#mian').html(str);	
};
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

// 搜索自动匹配
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
	            	if(data[i] != undefined ){
		                var _li ='<li>'
					            +    '<a class="set_history" href="/newcategory/threecate.html?firstcode=&amp;keyword='+data[i]['wd']+'&amp;csstag=9">'+data[i]['wd']+'</a>'
					            +    '</li>'
	            	}
	                $(".search_display_list").append(_li)
	            } 
			}
        }
    }) 

    $("#search_box").on("click",".set_history",function(){
    	var _html = $(this).html();
    	if(_html != ""){ checkCookie(_html) };
    	var goHref = '/newcategory/threecate.html?firstcode='+firstcode+'&keyword='+_html+'&csstag=9';
    	window.location.href=goHref;
    })
});