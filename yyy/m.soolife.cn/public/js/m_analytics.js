var isApp = /SoolifeApp/i.test(navigator.userAgent);
if(isApp){
	 $("#soo-header").hide();
	$(".win-banner").css({"margin-top":"0px"})
}else{
	$("#soo-header").show();
	$(".win-banner").css({"margin-top":"44px"})
}
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?c376081797d55701b6a55d8f0bdd6460";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
