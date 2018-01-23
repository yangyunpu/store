(function(){
	$(".draw").on("click",function(){
	var url_member = $(".header").attr("url_member");
	var a = $(".gap").attr('member_id');
	var b = $(".gap").attr('b');
	window.location.href = url_member+"/register.html?referrer="+a+"&source="+b ;
    
    });

})();
