var _href = window.location.href; 
function dealHref(){
	var arr = [];
	var _href_opsition = window.location.href.indexOf('secondindex');
	var _hreflength = window.location.href.length;
	var href_p = _href.substring(_href_opsition+17,_hreflength) ;//截取参数（开始时间--结束时间）
	return href_p;
};

var returnHref = dealHref();
var urlb= returnHref.split('&'); 
var yesUrl=''; 
for(var i=0;i<urlb.length;i++){ 
	if(urlb[i].indexOf('firstcode')==0||urlb[i].indexOf('twocode')==0||urlb[i].indexOf('keyword')==0){
		yesUrl+= urlb[i]+"&";
	};
}; 
var str = "";
var strall ="";
var btnkey=0;
var specs = [];
var countries ='';
var brand_id ='';
var shop_id ='';
$('#main_left li').click(function(){
	$(this).addClass('active').siblings().removeClass('active');
	var datanum = $(this).index();
	$('#main_right .item').hide();
	$('#main_right .item').eq(datanum).show();  
}); 
$('#main').on("click","#main_right li",function(){ 
	if($(this).hasClass('active')){
		$(this).removeClass('active').siblings().removeClass('active');
	}else{
		$(this).addClass('active').siblings().removeClass('active');
	}
	var lival = $(this).data('lival')||null;
	var licode = $(this).data('licode')||null;
	var parentText = $(this).parents('.item').data('text')||null; 
	if(parentText=="国家"){
		countries = licode;
	}else if(parentText=="店铺"){
		brand_id = licode;

	}else if(parentText=="品牌"){ 
		shop_id = licode;
	}
});
var pmin = '';
var pmax = '';
$('.piecearea').click(function(){
	pmin = $(this).data('min');
	pmax = $(this).data('max'); 
});
$('.surebtn').click(function(){
	var _li = $('#main_right ').find('li.active p')
	var _l = $('#main_right ').find('li.active p').length;
	var firstcode = $('#firstcode').val();
	var twocode = $('#twocode').val();
	var _span = [];
	var _specparam = [];
	var _shop = [];
	var _brand = [];
	var _countries = [];
	for(var i=0; i<_l;i++){
		_span.push(_li[i].innerHTML);  
		console.log(_li[i].parentNode.dataset.lival);
		if(_li[i].parentNode.dataset.lival){
			_specparam.push(_li[i].parentNode.dataset.lival);
		};
		if(_li[i].parentNode.dataset.lishop){
			_shop.push(_li[i].parentNode.dataset.lishop);
		};
		if(_li[i].parentNode.dataset.librand){
			_brand.push(_li[i].parentNode.dataset.librand);
		};
		if(_li[i].parentNode.dataset.licode){
			_countries.push(_li[i].parentNode.dataset.licode);
		};
	};
	_kai = $('#kai').val()||pmin;
	_jie = $('#jie').val()||pmax; 
	var jiage ="";
	if(_kai==''&&_jie==''){
		jiage=""; 
	};
	if(_kai==''&&_jie!=''){
		jiage = "0-"+_jie;
		_span.push(jiage); 
	};
	if(_kai!=''&&_jie==''){
		jiage = _kai+"以上";
		_span.push(jiage); 
	};
	if(_kai!=''&&_jie!=''){
		jiage = _kai+'-'+_jie; 
		_span.push(jiage);
	};
	_span_str=_span.join(',');

	var sss = encodeURIComponent(_span_str);
	var brand_code = encodeURIComponent(_brand);

	_specparam_str=_specparam.join(','); 
	var backHref = "/second/secondindex.html?firstcode=" + firstcode + "&twocode=" + twocode + "&brand_id="+brand_code+"&shop_id="+_shop+"&countries="+_countries+"&specs="+_specparam+"&_kai="+_kai+"&_jie="+_jie+"&_span_str="+sss;
	window.location.href = backHref;
});
//点击重置
$('#remove').click(function(){ 
	var _href_opsition = window.location.href.indexOf('brand_id');
	var _hreflength = window.location.href.length;
	var href_p = _href.substring(0,_href_opsition-1);
	window.location.href = href_p;
});
//价格返回默认选中

function GetQueryString(name)
{
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if(r!=null)return  unescape(r[2]); return null;
}
 var lj_pricedi =(GetQueryString("_kai"));
 // var lj_pricegao =(GetQueryString("_jie"));
console.log(lj_pricedi);
// console.log(lj_pricegao);
$("#piecebox ul li div").each(function(){
	// var lj_num = $(this).html();
	var lj_minnum = $(this).parent("li").attr("data-min");
	var that = $(this);
	// console.log(lj_num);
	console.log(lj_minnum);
	if(lj_pricedi == lj_minnum){
		that.parent("li").addClass('active');
	}
})