
var mySwiper = new Swiper('.swiper-container',{
    pagination: '.pagination',
    autoplay : 2000,
	speed:300,
    loop:true,
    autoplayDisableOnInteraction : false
});
$('#tobtn').click(function(){
	$(this).addClass('active').siblings().removeClass('active');
	$('#main2').hide();
	$('#main1').show();
});
$('#tmwbtn').click(function(){
	$(this).addClass('active').siblings().removeClass('active');
	$('#main1').hide();
	$('#main2').show();
});
//倒计时  
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
//     var str = '距离结束还有&nbsp;<span>'+h+'</span>:<span>'+min+'</span>:<span>'+m+'</span>';
//     option.html(str);
// };
// function startTime(option,n){  
// 	makeTime(option,n);
// 	if(n <= 0){
// 		var endstr = '距离结束还有&nbsp;<span>00</span>:<span>00</span>:<span>00</span>'; 
// 		option.html(endstr); 				
// 	};
// };
// var nowtime = parseInt(+new Date()/1000);
// var endtime = +$('#todytime').data('endtime');  
// var _time = endtime-nowtime;  
// startTime($('#todytime'),_time); 

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
var itemurl= $('#oversea').data('itemurl'); 


// 下拉刷新
window.onscroll=function(){
    var _index =$("#hidden").val();
    var docheight = $(document).height();               //整个网页的文档高度
    var screenheight = $(window).height();             //浏览器可视窗口的高度
    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
    console.log(_index);
    if(screenheight+scroll >= docheight){
        $.ajax({
            url: '/overseagoods/overSeaAjax.html',
            type: 'POST',
            dataType: 'json',
            data : {
                "index": _index,
            },
            success:function(res){
                var data = res.data.goods;
                var str = '';
                if(data !=""){
                    $("#hidden").val(res.data.index);
                    for(var i=0;i<data.length;i++){
                            str='<a class="open-goods-detail" data-goods-id="'+data[i].sku_id+'">'
                                    +'<div class="item bg-white margin-b">'
            				 			+'<div class="img_box float-l">'
            				 			+	'<img src="'+data[i].logo+'">'
            				 			+'</div>'
            				 			+'<div class="wen_box float-l">'
            				 			+	'<p class="name">'+data[i].name+'</p> '
            				 			+	'<p class="piece">￥'+data[i].shop_price+'</p>' 
            				 			+'</div>'
        				 		    +'</div>'
                                +'</a> '
                        $('.inlinestyle').append(str);
                        webSdk.b_event();
                    }
                }else{
                    $("#none").show();
                    return;
                }
            }
        });

    }
}