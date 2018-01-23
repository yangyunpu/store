$(function(){
	// var Olitie = document.getElementsByClassName("dotey");
 //    for (var j = 0; j < Olitie.length; j++) {
	//    var oabtn = Olitie[j].getElementsByTagName("li");
 //    	for (var i = 0; i < oabtn.length; i++) {
 //    		 // console.log(oabtn.length);
 //    		 if(oabtn.length>3){
 //    		 	Olitie[j].style.width = oabtn.length*4.53333+'rem';
 //    		 }
 //    	}
 //    }
	$(".lj_rule").click(function(){
		$(".rules").show();
		$(".lj_cha").click(function(){
			$(".rules").hide();
		})
	})

//弹出中奖
  var phone = new Array();
  var phone = $('#hidden').html();
  var mobile = eval(phone);
  // console.log(phone)

var num= 0;
var pcount = mobile.length;//参加人数电话
// var prawad = jx.length-1;//参加奖项数
var phonetext = $(".lj_iphne");
var t;
//循环获奖号码
function startNum(){
	num = Math.floor(Math.random() * pcount);
	//sub = Math.floor(Math.random() * prawad);
	phonetext.html("恭喜" + mobile[num][0]);

}
// 没隔3秒停一下
var n = 0;
function timer(){
    $(".lj_win").html('');
	clearTimeout(t)
	n++;
	startNum();
	t = window.setTimeout(timer,10);
	if(n >=250 ){
		n = 0;
		clearTimeout(t);
        // $(".lj_slier").html(jx[sub]);
        var htmlstr='<p class="clientw animated pulse">获得'+mobile[num][1]+'</p>';
	 	$(".lj_win").html(htmlstr);
		window.setTimeout(timer,2500);
	}
};
timer();

//定时刷新
    var hideTime = parseInt($('#hide_time').html());
    if(hideTime){
        var timers = setInterval(function(){
            if (hideTime <= 0){
                window.location.reload();
                // console.log(12);
                clearInterval(timers);
            };
            hideTime--;
        }, 1000);
    };

	if(isApp){
        // $(".header").hide();
        $("#download-nav").hide();
    }

})