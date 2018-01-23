$(function(){

	$('.grilx240 img').stop().hover(function(){
        $(this).next('p').stop().slideDown(200);
   });

    $('.grilx240').stop().mouseleave(function(){
        $('.grilx240 p').stop().slideUp();
    });

    $('#carousel-index').on('slide.bs.carousel', function (e) {
		var item = $(e.relatedTarget);
		var bgimage = item.attr('data-bgimage');
		var bgcolor = item.attr('data-bgcolor');
		$(".banner").attr('style',"background: "+ bgcolor +" url('"+ bgimage+"') no-repeat center center;");
	});

	$("#btn_gain").on('click',function(){
		$.post('/vip/gain/coin.html',function(result){
			if(result.err_code && result.err_code==403){
				$.base64.utf8encode = true;
				var currenturl = $.base64.btoa(location.href);
				var return_url = $(".url_member").val();
				location.href  = return_url + "/login.html?return_url=" + currenturl;
				return;
			}
			$("#show_gain span").html(result.msg);
			$("#show_gain").show();
			if(result.success){
				$("#btn_gain").html("今日已领取"+ result.gain +"个星币").css({background:"#fff",color:"#333",border:"1px solid #adadad"});
				$(".vip_banner .content p.coin i").attr("title","星币数量："+result.coin+"个");
				$(".vip_banner .content p.coin .coin_num").html(result.coin);
			}
		},'json');
	});
	$("#btn_login").on('click',function(){
		var url = $(this).attr("data-url");
		window.location.href = url;
		return false;
	});
	$("#show_gain img").on('click',function(){
		$("#show_gain").hide();
	});

	//星粉专区遮罩
	$('.h-shade li').stop().mouseenter(function(){
		$(this).find('span').stop().fadeIn(200);
	})
	$('.h-shade li').stop().mouseleave(function(){
		$('.h-shade li span').stop().fadeOut(200);
	})
});
