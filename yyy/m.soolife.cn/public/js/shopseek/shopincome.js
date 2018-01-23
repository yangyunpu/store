$(function(){
	// 点击商家签约
	$(".rightshop").click(function(){
		$(this).find(".shopyue").css("color","#EC6D65");
		$(".shopbao").css("color","#333")
		console.log(111);
		 $(".red2").show();
		 $(".red").hide();
		 $(".leftcontent").hide();
		 $(".rightcontent").show();
	})
	// 点击商家报备
	$(".leftshop").click(function(){
		$(this).find(".shopbao").css("color","#EC6D65");
		$(".shopyue").css("color","#333")
		console.log(111);
		 $(".red2").hide();
		 $(".red").show();
		 $(".leftcontent").show();
		 $(".rightcontent").hide();
	})
})