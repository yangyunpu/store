
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

// 倒计时
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
        $(".timestamp"+_index+"").html("00"+":"+"00"+":"+"00");
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
    	$(".timestamp"+_index+"").html(countHour+":"+countmin+":"+countsec)
    }else{
    	$(".timestamp"+_index+"").html(countDay+"天"+countHour+":"+countmin+":"+countsec)
    }
    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
    	$(".timestamp"+_index+"").html("00"+":"+"00"+":"+"00");
    }     
}
//下拉加载
var itemurl= $('#today').data('itemurl');
var str = '';
var n=1;
var key = 1;
var parms = {
    "type":"1",
    "size":"10",
    "index":n
}

window.addEventListener('scroll', function(){
	if(key==0) return;
	var all_height = $(document).height();
	var see_height = $(window).height();
	var scroll_height= $(window).scrollTop();
	var _index = $("#hidden").val();

	if(scroll_height+see_height == all_height){

		$.ajax({
			url: '/overseagoods/moreajax',
			type: 'post',
			dataType: 'json',
			data:  {
				"index":_index
			},
			success:function(res){
				// console.log(res.data.goods);
 
				$('#today').append(appendStr(res.data.goods));

				webSdk.b_event();

				
				$(".stamp").each(function(){
					var _time =parseInt($(this).val())*1000;
					var _index =  $(this).data("index");
					$("#hidden").val(res.data.index);
					time = setInterval(function(){
				    	countDown(_time,_index);
				    },1000)
				})
			}
		});
	};
});
//拼接字符串
var _len = "";

function appendStr(data){
	var str = '';

    _len = $("#today .alltitle").length;

	if(data.length==0){
		key = 0;
		return str = '<p style="text-align:center;width: 100%;float: left;">没有更多商品了...</p>';
	};

	for(var i=0;i<data.length;i++){
		var stra ='';

		_len = _len + i;
		data[i].end_index = _len;
		// console.log('data[i].end_index'+data[i].end_index)

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
	 				+'<div class="imgbox car" data-goodid="'+data[i].details[j].sku_id+'"><img src="/public/img/newcategory/gouwu.png"></div>'
	 			+'</div>'
	 		+'</div>'
		};

		str+='<div class="alltitle">'
			+	'<input type="hidden" class="stamp" name="" data-index="'+data[i].end_index+'" value="'+data[i].end_date+'"  />'
			+	'<span>距离结束还有  </span>'
			+	'<span class="laststamp timestamp'+data[i].end_index+'" ></span>'
			+'</div>'
			+stra
	};
	return str;
};

var head_num = parseInt($("#head_num").html());
//加入购物车
$('#today').on('click','.car',function(){
	var goodid = $(this).data('goodid');
	$.ajax({
		url: '/overseagoods/addcar',
		type: 'post',
		dataType: 'json',
		data: {
			'goodid':goodid
		},
		success:function(res){
			if(res.success){
				head_num =head_num + 1;
				alert_mark(res.msg,3000);
				$("#head_num").html(head_num)
			}else{
				alert_mark(res.msg,3000);
			}
		}
	});
});
//提示框 实例
function alert_mark(str,time){
  $('#alert_mark').html(str);
  $('#alert_mark').show();
  setTimeout(function(){$('#alert_mark').hide();},time);
};//alert_mark('库存不足');


