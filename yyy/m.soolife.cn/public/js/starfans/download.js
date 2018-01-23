var body = document.getElementsByTagName('body')[0],
	isApp = /SoolifeApp/i.test(navigator.userAgent),
 	isSafariBrowser = navigator.userAgent.match(/iPhone|mac|iPod|iPad/)&&navigator.userAgent.match(/Safari/),
 	isSafariBrowser = navigator.userAgent.match(/iPhone|mac|iPod|iPad/)&&navigator.userAgent.match(/Safari/);
window.downloadNav = (function(){
	var sureAlertDiv = document.createElement("div");	
	var sureAlertStr = '<div style="font-family:Microsoft YaHei;font-size:14px;position:fixed;top:0;bottom:0;left:0;right:0;background-color:rgba(49,47,47,0.4);z-index:11;">'+
							'<div style="margin:40% auto 0 auto; width:60%;height:100px; text-align: center;background-color: #fff;border-radius:10px;">'+
								'<div style="float:left;width:100%;height:70px;border-bottom: 1px #ccc solid;line-height: 70px;">在“如此生活”中打开？</div>'+
								'<div class="alert-hide" style="float:left;width:50%;height:30px;border-right: 1px #ccc solid;box-sizing: border-box;line-height: 30px;">取消</div>'+
								'<div class="alert-sure" style="float:left;width:50%;height:30px;line-height: 30px;">确定</div>'+
							'</div>'+
						'</div>';
	var navSure = document.getElementById('share_btn');
	if(!navSure) return;
	navSure.onclick = function(){
		if(isSafariBrowser){
            window.location.href = "SoolifeShopping://";
            setTimeout(function() {
                document.location = 'https://itunes.apple.com/us/app/ru-ci-sheng-huo-shi-shang/id1116994060?mt=8';
            }, 2000);			
		}else{	
			sureAlertDiv.innerHTML = sureAlertStr;	
			body.appendChild(sureAlertDiv);
		};
	};
	sureAlertDiv.addEventListener('click',function(e){	
		var e = e || window.event;
        var target = e.target || e.srcElement;
        if(target.className == 'alert-hide'){
        	body.removeChild(sureAlertDiv);
        };
        if(target.className == 'alert-sure'){
            window.location.href = "SoolifeShopping://";
            setTimeout(function() {
                document.location = 'http://app.soolife.cn/downloads.html?source=soolife&site=app.soolife.cn&referrer=0000';
            }, 2000);
        };	
	});
})();