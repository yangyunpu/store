$(function(){
	console.log(111);
	var mySwiper = new Swiper('.swiper-container',{
        pagination: '.pagination',
        autoplay : 2000,
    	speed:300,
        loop:true,
        autoplayDisableOnInteraction : false
  	})
  	// 点击购物车弹框
  	$(".lj_goods").click(function(){
  		$('.goods_delt_mark').show(); 
  	})
  	$('.goods_delt_mark').on('click',function(e){
		$(this).hide();
		return false;
	});
	$('.goods_delt_box').on('click',function(e){
		return false;
	});
	// 选中规格
	$('.main span').on('click',function(){
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
	});
	//点击数量的加、减
	$('.amount span.add').click(function(){ 
		$(this).addClass('c_active');
		$('.amount span.jian').removeClass('c_active');
		var v = parseInt($('#amount_int').val());
	    var remains = $('.remains').text();
	    if(remains != '库存充足' && v >= parseInt(remains)){
	    	return;
	    }
		v++;
		$('#amount_int').val(v);
	});
	$('.amount span.jian').click(function(){
		$(this).addClass('c_active');
		$('.amount span.add').removeClass('c_active');
		var v = parseInt($('#amount_int').val());
		if(v <= 1) return;
		v--;
		$('#amount_int').val(v);
	});
	function alert_mark(str){
		$('#alert_mark').html(str);
		$('#alert_mark').show();
		setTimeout(function(){$('#alert_mark').hide();},1000);
	};//alert_mark('库存不足');
})