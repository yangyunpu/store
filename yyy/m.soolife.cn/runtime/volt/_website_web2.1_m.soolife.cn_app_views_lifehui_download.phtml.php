
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|惠生活</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<style type="text/css">
    /*弹框*/
	    #alert{
	    	width: 50%;
	    	display: inline-block;
	    	position: fixed;
	    	top: 20%;
	    	left: 50%;
	    	transform: translateX(-50%);
			-ms-transform:translateX(-50%); 	/* IE 9 */
			-moz-transform:translateX(-50%); 	/* FirefoX */
			-webkit-transform:translateX(-50%); /* Safari 和 Chrome */
			-o-transform:translateX(-50%);  
	    	background:rgba(0,0,0,0.6);
	    	color: #fff;
	    	border-radius: 3px;
	    	overflow: hidden;
	    	padding: 5px;
	    }
	    #alert div{
	    	text-align: center;
	    	line-height: 1.133333rem;
	    	font-size: 0.64rem;
	    }
	</style> 
</head>
<body style="padding:0;margin:0;"> <!-- 头部	 -->
<div id="head" style="width:100%;height:44px;position:fixed;z-index: 9; background-color: #f1f0f0;">
	<div id="head-left" onclick="window.history.go(-1)">
	    <img src="/public/img/common/shop_back_black@2x.png" style="width:12px; margin-top: 10px; margin-left: 15px; ">
	</div>
</div>
<div style="width:100%;position:relative;background-color:#fff;">
	<img src="/public/img/down/do(1).png" style="display:block;width:100%">
	<img src="/public/img/down/logo.png" style="display:block;width:40%;position:absolute;left:50%;margin-left:-20%;bottom: 0;">
</div>
<div style="width:100%;position:relative;background-color:#fff;">
	<img src="/public/img/down/do(2).png" style="display:block;width:100%">
	<div style="width:80%;height:44px;position:absolute;left:50%;margin-left:-40%; bottom: 69px; background-color:#EC6D65;color:#fff;border-radius:3px; text-align:center;line-height:44px;" id="openapp">打开如此生活</div>
	<div style="width:80%;height:44px;position:absolute;left:50%;margin-left:-40%; bottom: 0; background-color:#f1f1f0;color:#EC6D65;border-radius:3px; text-align:center;line-height:44px;" id="downapp">下载如此生活</div>
</div>
<div style="width:100%;background-color:#fff;">
	<img src="/public/img/down/do(3).png" style="display:block;width:100%">
</div>
<?php if ($msg_txt) { ?>
<div id="alert">
    <?php if ($msg_txt == 1) { ?>
	<div>请下载App购买商品</div>
	<?php } elseif ($msg_txt == 2) { ?>
	<div>请下载App,查看惠生活订单</div>
	<?php } elseif ($msg_txt == 4) { ?>
	<div>请下载App</div>
	<?php } else { ?>
	<div>请下载App发布星粉秀</div>
	<?php } ?>
</div>
<?php } ?>
<script> 
function openApp(){
	var nav = navigator.userAgent.toLowerCase();
	var openapp = document.getElementById('openapp'); 
	var downapp = document.getElementById('downapp');  
	if(nav.match(/MicroMessenger/i) == 'micromessenger'){ 
		openapp.style.display="none";
		downapp.style.bottom="40px";
		downapp.innerHTML = '去如此生活';
	};
	if(nav.match(/QQ/i) == "qq" && nav.match(/iphone|mac|iPod|iPad/i)){ 
		openapp.style.display="none";
		downapp.style.bottom="40px";
		downapp.innerHTML = '去如此生活';
	};
	openapp.onclick = function(){ 
		window.location.href = "soolifeshopping://?object=makeMoney_setupShopMessage"; 
	}; 
	downapp.onclick = function(){  
		if(nav.match(/iPhone|mac|iPod|iPad/i)){ 
	        document.location = 'https://itunes.apple.com/us/app/ru-ci-sheng-huo-shi-shang/id1116994060?mt=8';
	    }else if(nav.match(/Android/i)){ 
	        document.location = 'http://app.soolife.cn/downloads.html?source=soolife&site=app.soolife.cn&referrer=0000';
	    };
	};  	
};
openApp();
</script>
<script type="text/javascript" src="/public/js/lifehui/download.js"></script>
</body>
</html>