var str = '';
var itemurl= $('#nextlimit').data('itemurl');
//下拉刷新
var n=1; 
var key = 1;
var parms = {
    "type":"2", 
    "size":"10", 
    "index":n
}
window.addEventListener('scroll', function(){ 
	if(key==0) return;
	var all_height = $(document).height();
	var see_height = $(window).height();
	var scroll_height= $(window).scrollTop(); 
	if(scroll_height+see_height == all_height){ 
		n++;
		parms.index = n;
		$.ajax({
			url: '/second/getmore',
			type: 'post',
			dataType: 'json',
			data: {
				'type':1,
				'param':parms
			},
			success:function(res){   
				console.log(res.data.goods);				 
				$('#imgbox').append(appendStr(res.data.goods)); 
			}
		});
	}; 	
});
//拼接字符串
function appendStr(data){
	if(data.length==0){
		key = 0;
		return str = '<p style="text-align:center;width: 100%;float: left;">没有更多商品了...</p>';
	};
	for(var i=0;i<data.length;i++){ 
		for(var j=0;j<data[i].details.length;j++){
			str +=  '<div class="item bg-white margin-b">'
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
	};
	return str;
}; 
//加入购物车
$('#imgbox').on('click','.car',function(){
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