isApp = /SoolifeApp/i.test(navigator.userAgent);
if(isApp) {
	$("#head").hide();
	$("#top_place").hide();
}else{
    $("#head").show();
    $("#top_place").show();
}