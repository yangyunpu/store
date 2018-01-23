<?php
	require_once ROOT_PATH . "/apps/librarys/weixinshare/jssdk.php";
	$jssdk = new JSSDK("wx6fe7550ec5625a23", "57bdd0bbe290a22b6844673509db0b61");
	$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta content="black" name=" apple-mobile-web-app-status-bar-style"   />
	<link rel="stylesheet" type="text/css" href="/public/mobile/css/investment/view.ads.css">
	<link rel="stylesheet" type="text/css" href="/public/mobile/css/investment/brand.css">
	<title>品牌招商</title>
</head>
<body>
<!-- 微信分享 -->
	<input type="hidden" name="appId" value="<?= $signPackage['appId'] ?>" />
	<input type="hidden" name="timestamp" value="<?= $signPackage['timestamp'] ?>" />
	<input type="hidden" name="nonceStr" value="<?= $signPackage['nonceStr'] ?>" />
	<input type="hidden" name="signature" value="<?= $signPackage['signature'] ?>" />
	<div class="wrap">
		<div class="lj_head"><img src="/public/mobile/img/investment/head.jpg"></div>
		<div class="model">如此生活  全新OAO模式</div>
		<div class="scheme">全渠道一站式解决方案</div>
		<div class="ways"><img src="/public/mobile/img/investment/app.png"></div>
		<div class="lj_ipad"><img src="/public/mobile/img/investment/ipad.png"></div>
		<div class="lj_good">
			<p class="lj_shop">让商家盈利&nbsp;&nbsp;&nbsp;让消费者受益</p>
			<p>打通线上线下&nbsp;&nbsp;&nbsp;实现商品互通</p>
			<p>打通左右渠道&nbsp;&nbsp;&nbsp;实现人群互联</p>
		</div>
		<div class="lj_pin">
			<img src="/public/mobile/img/investment/pinone.jpg">
			<img src="/public/mobile/img/investment/pintwo.jpg">
			<img src="/public/mobile/img/investment/pinthree.jpg">
			<img src="/public/mobile/img/investment/pinfour.jpg">
			<img src="/public/mobile/img/investment/pinfive.jpg">
			<img src="/public/mobile/img/investment/pinsix.jpg">
		</div>
		<div class="exper">
			<p class="exp_shop">·&nbsp;&nbsp;体验店端&nbsp;&nbsp;·</p>
			<p>免费线下体验店品牌展示</p>
			<p>去除中间环节</p>
			<p>商家商品直达消费者</p>
		</div>
		<div class="iphone">
			<img src="/public/mobile/img/investment/ip_one.jpg">
			<img src="/public/mobile/img/investment/ip_two.jpg">
			<img src="/public/mobile/img/investment/ip_three.jpg">
			<img src="/public/mobile/img/investment/ip_four.jpg">
			<img src="/public/mobile/img/investment/ip_five.jpg">
			<img src="/public/mobile/img/investment/ip_six.jpg">
		</div>
		<div class="exper app">
			<p class="exp_shop">·&nbsp;&nbsp;APP端&nbsp;&nbsp;·</p>
			<p>免费APP运营推广服务</p>
			<p>多种营销工具</p>
			<p>全网会员分销</p>
		</div>
		<div class="mac">
			<img src="/public/mobile/img/investment/ma_one.jpg">
			<img src="/public/mobile/img/investment/ma_two.jpg">
			<img src="/public/mobile/img/investment/ma_three.jpg">
			<img src="/public/mobile/img/investment/ma_four.jpg">
			<img src="/public/mobile/img/investment/ma_five.jpg">
			<img src="/public/mobile/img/investment/ma_six.jpg">
		</div>
		<div class="exper app">
			<p class="exp_shop">·&nbsp;&nbsp;仓储端&nbsp;&nbsp;·</p>
			<p>免费仓储&nbsp;&nbsp;管家式服务</p>
			<p>代存&nbsp;&nbsp;代管&nbsp;&nbsp;代发</p>
		</div>
		<div class="lj_three_geng">
			<img  src="/public/mobile/img/investment/pinzhangengxin.jpg">
			<!-- <img class="band_one" src="/public/mobile/img/investment/cost.png">
			<img class="band_three" src="/public/mobile/img/investment/net.png"> -->
		</div>
		<div class="invitation">
	     <div class="bg"><img src="/public/mobile/img/investment/bg-xinfeng.jpg"></div>
	     <div class="i-content">
	     	<img src="/public/mobile/img/investment/title.png">
             <div class="inv-font"><p>共享丰盛</p>&nbsp;&nbsp;&nbsp;<p>共创未来</p></div>
             <div class="inv-name"><p>“如此生活”</p>&nbsp;<p>品牌合作商家洽谈会</p></div>
             <div class="guessr">
			<div class="liker">
			<p>09.15 SHANGHAI</p>
			</div>
		</div>
             <div class="tech-process">
             	<img  src="/public/mobile/img/investment/liucheng.png">
             </div>
             <div class="address">
             	<p>会议时间：2017年9月15日(星期五) 14:00</p>
                <p>会议地点：上海市长宁区淞虹路207号明基商务广场C栋5层</p>
             </div>
	     </div>
		</div>
		
		<div class="lj_input tops">
			<input type="text" name="name" placeholder="如何称呼您" class="place_input"/>
			<input type="hidden" name="type" value="3" />
		</div>
		<div class="lj_input top">
			<input type="text" name="iphone" placeholder="如何联系您" class="place_input"/>
		</div>
		<div class="lj_input top">
			<input type="text" name="compny" placeholder="贵公司名称" class="place_input"/>
		</div>
        <div class="lj_input top">
			<input type="text" name="inviter" placeholder="邀请人" class="place_input"/>
		</div>
		<div class="open">点击开启属于你的时代</div>
		<div class="guess">
			<div class="like">
			<p>在您之前,已有<span class="num"><?= $num ?></span>位提交咨询</p>
			<!-- <p>在您之前,已有<span class="num">565</span>位提交咨询</p> -->
			</div>
		</div>
		<div class="datum lj_data">您的资料我们会给予保密，敬请放心！</div>
		<div class="datum data_bottom">稍后会有客服人员回电，给您提供优质的服务！</div>
	</div>
	<div id="alert_mark"> </div>
	<div class="success">
		<div id="alert_success">
			<h4>提交成功</h4>
			<p>属于你的时代即将开启</p>
			<div class="gondss">好的</div>
		</div>
	</div>
	<div class="lj_iphones"><a href="tel:15221641902"><img src="/public/mobile/img/investment/iphones.png"></a></div>
</body>
<script type="text/javascript" src="/public/mobile/js/investment/rem.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/weixin/jssdk.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/brand.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/wxshare.js"></script>
</html>