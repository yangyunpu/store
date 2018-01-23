//下拉加载
var itemurl= $('#torrow').data('itemurl');
var stra ='';
var n=1;
var key = 1;
var parms = {
    "type":"2",
    "size":"10",
    "index":n
}
window.addEventListener('scroll', function(){
	console.log(key);
	if(key==0) return;
	var all_height = $(document).height();
	var see_height = $(window).height();
	var scroll_height= $(window).scrollTop();
	var _index = $("#hidden").val();
	var type = 2;
	if(scroll_height+see_height == all_height){
		// n++;
		// parms.index = n;
		// console.log(parms);
		$.ajax({
			url: '/overseagoods/moreajax',
			type: 'post',
			dataType: 'json',
			data:  {
				"index":_index,
				"type":type
			},
			success:function(res){
				// console.log(res);
				$("#hidden").val(res.data.index);
				$('#torrow').append(appendStr(res.data.goods));
				webSdk.b_event();

			}
		});
	};
});
//拼接字符串
function appendStr(data){
	if(data.length==0){
		key = 0;
		console.log('key');
		return stra = '<p style="text-align:center;width: 100%;float: left;">没有更多商品了...</p>';
	};
	for(var i=0;i<data.length;i++){
		for(var j=0;j<data[i].details.length;j++){
			stra +=  '<div class="item bg-white margin-b">'
	 			+'<div class="img_box float-l">'
	 				+'<a class="open-goods-detail" data-goods-id="'+data[i].details[j].sku_id+'">'
	 				+'<img src="'+data[i].details[j].good_logo+'">'
	 				+'</a> '
	 			+'</div>'
	 			+'<div class="wen_box float-l">'
	 				+'<p class="name">'+data[i].details[j].good_name+'</p> '
	 				+'<p class="piece">￥'+data[i].details[j].act_price+'<span class="oldpiece">￥'+data[i].details[j].shop_price+'</span></p>'
	 			+'</div>'
	 		+'</div>';
		};
	};
	return stra;
};



var date  = new Date();
var month = date.getMonth()+1;
var day   = date.getDate();
var _day  = date.getDate()+1;
if(month<10){
    month = "0"+month;
}
if(day<10 ){
	day = "0"+day;
}
if(_day<10 ){
	_day = "0"+_day;
}
// 今日
var str_today = "今日 ("+month+"月"+day+"日)"
// 明日
var str_tomorrow = "明日 ("+month+"月"+_day+"日)"
$(".item_today").html(str_today)
$(".item_tomorrow").html(str_tomorrow)