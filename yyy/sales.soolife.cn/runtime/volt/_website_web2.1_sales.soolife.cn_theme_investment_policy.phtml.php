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
	<link rel="stylesheet" type="text/css" href="/public/mobile/css/investment/generalize.css">
	<title>体验店加盟</title>
</head>
<body>
<!-- 微信分享 -->
	<input type="hidden" name="appId" value="<?= $signPackage['appId'] ?>" />
	<input type="hidden" name="timestamp" value="<?= $signPackage['timestamp'] ?>" />
	<input type="hidden" name="nonceStr" value="<?= $signPackage['nonceStr'] ?>" />
	<input type="hidden" name="signature" value="<?= $signPackage['signature'] ?>" />
	<div class="wrap">
		<div class="lj_head">
			<img src="/public/mobile/img/policy/one/a.jpg" align="top">
			<img src="/public/mobile/img/policy/one/b.jpg" align="top">
			<img src="/public/mobile/img/policy/one/c.jpg" align="top">
			<img src="/public/mobile/img/policy/one/d.jpg" align="top">
			<img src="/public/mobile/img/policy/one/e.jpg" align="top">

			<img src="/public/mobile/img/policy/one/f.jpg" align="top">
			<img src="/public/mobile/img/policy/one/g.jpg" align="top">
			<img src="/public/mobile/img/policy/one/h.jpg" align="top">
			<img src="/public/mobile/img/policy/one/i.jpg" align="top">
			<img src="/public/mobile/img/policy/one/j.jpg" align="top">

			<img src="/public/mobile/img/policy/one/k.jpg" align="top">
			<img src="/public/mobile/img/policy/one/l.jpg" align="top">
			<img src="/public/mobile/img/policy/one/m.jpg" align="top">
			<img src="/public/mobile/img/policy/one/n.jpg" align="top">
			<img src="/public/mobile/img/policy/one/o.jpg" align="top">

			<img src="/public/mobile/img/policy/one/p.jpg" align="top">
			<img src="/public/mobile/img/policy/one/q.jpg" align="top">
			<img src="/public/mobile/img/policy/one/r.jpg" align="top">
			<img src="/public/mobile/img/policy/one/s.jpg" align="top">
			<img src="/public/mobile/img/policy/one/t.jpg" align="top">
		</div>

		<!-- two -->
        <div class="lj_three_geng">
			<img src="/public/mobile/img/policy/two/a.jpg" align="top">
			<img src="/public/mobile/img/policy/two/b.jpg" align="top">
			<img src="/public/mobile/img/policy/two/c.jpg" align="top">
			<img src="/public/mobile/img/policy/two/d.jpg" align="top">
			<img src="/public/mobile/img/policy/two/e.jpg" align="top">

			<img src="/public/mobile/img/policy/two/f.jpg" align="top">
			<img src="/public/mobile/img/policy/two/g.jpg" align="top">
			<img src="/public/mobile/img/policy/two/h.jpg" align="top">
			<img src="/public/mobile/img/policy/two/i.jpg" align="top">
			<img src="/public/mobile/img/policy/two/j.jpg" align="top">

			<img src="/public/mobile/img/policy/two/k.jpg" align="top">
			<img src="/public/mobile/img/policy/two/l.jpg" align="top">
			<img src="/public/mobile/img/policy/two/m.jpg" align="top">
			<img src="/public/mobile/img/policy/two/n.jpg" align="top">
			<img src="/public/mobile/img/policy/two/o.jpg" align="top">

			<img src="/public/mobile/img/policy/two/p.jpg" align="top">
			<img src="/public/mobile/img/policy/two/q.jpg" align="top">
			<img src="/public/mobile/img/policy/two/r.jpg" align="top">
			<img src="/public/mobile/img/policy/two/s.jpg" align="top">
			<img src="/public/mobile/img/policy/two/t.jpg" align="top">

			<!-- three -->
			<img src="/public/mobile/img/policy/three/a.jpg" align="top">
			<img src="/public/mobile/img/policy/three/b.jpg" align="top">
			<img src="/public/mobile/img/policy/three/c.jpg" align="top">
			<img src="/public/mobile/img/policy/three/d.jpg" align="top">
			<img src="/public/mobile/img/policy/three/e.jpg" align="top">
		</div>


</body>
<script type="text/javascript" src="/public/mobile/js/investment/rem.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/weixin/jssdk.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/brand.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/wxshare.js"></script>
</html>