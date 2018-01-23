var str = '';
var endTime = 60*60; 
var itemurl= $('#nextlimit').data('itemurl');




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





//下拉刷新
var n=1; 
var key = 1;
var parms = {
    "type":"1", 
    "size":"10", 
    "index":n
}
window.addEventListener('scroll', function(){ 
	if(key==0) return;
	var docheight = $(document).height();
	var screenheight = $(window).height();
	var scroll= $(window).scrollTop(); 
	var timekey = $('#timekey').val();

	if(screenheight+scroll >= docheight){ 
		n++;
		parms.index = n;
		$.ajax({
			url: '/second/getmore',
			type: 'post',
			dataType: 'json',
			data: {
				'type':timekey,
				'param':parms
			},
			success:function(res){   
				console.log(res.data.goods);				 
				$('#sentiment').append(appendStr(res.data.goods));

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
var _len = "";//倒计时的长度

//拼接字符串
function appendStr(data){
	var str = '';

    _len = $("#sentiment .alltitle").length;//倒计时的长度
    
	if(data.length==0){
		key = 0;
		return str = '<p style="text-align:center;width: 100%;float: left;">没有更多商品了...</p>';
	};
	for(var i=0;i<data.length;i++){
		var stra ='';

		_len = _len + i;                  //倒计时的长度
		data[i].end_index = _len;         //倒计时的长度

		for(var j=0;j<data[i].details.length;j++){
			stra +=  '<div class="item bg-white margin-b">'
	 			+'<div class="img_box float-l">'
	 				+'<a href="'+itemurl+'/'+data[i].details[j].sku_id+'.html"><img src="'+data[i].details[j].good_logo+'"></a> '
	 			+'</div>'
	 			+'<div class="wen_box float-l">'
	 				+'<p class="name">'+data[i].details[j].good_name+'</p> '
	 				+'<p class="piece">￥'+data[i].details[j].act_price+'<span class="oldpiece">￥'+data[i].details[j].shop_price+'</span></p>'
	 				+'<div class="imgbox car" data-goodid="'+data[i].details[j].sku_id+'"><img src="/public/img/newcategory/gouwu.png"></div>'
	 			+'</div>'
	 		+'</div>';
		};
		str+= '<div class="alltitle">'
			+    '<input type="hidden" class="stamp" value="'+data[i].end_date+'" name="" data-index = "'+data[i].end_index+'"/>'
			+	'<span>距离结束还有  </span>'
			+	'<span class="timestamp'+data[i].end_index+'"></span>'
			+'</div>'
		    +stra;
	};
	return str;
}; 
//加入购物车
$('#sentiment').on('click','.car',function(){
	var goodid = $(this).data('goodid');  
	$.ajax({
		url: '/second/addcar',
		type: 'post',
		dataType: 'json',
		data: {
			'goodid':goodid
		},
		success:function(res){
			var mes = res.data.message||"加入购物车成功";
			alert_mark(mes,3000);
		}
	});
});



















//提示框 实例
function alert_mark(str,time){
  $('#alert_mark').html(str);
  $('#alert_mark').show();
  setTimeout(function(){$('#alert_mark').hide();},time);
};//alert_mark('库存不足');