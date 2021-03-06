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
			<img src="/public/mobile/img/invitation/one/a.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/b.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/c.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/d.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/e.jpg" align="top">

			<img src="/public/mobile/img/invitation/one/f.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/g.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/h.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/i.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/j.jpg" align="top">

			<img src="/public/mobile/img/invitation/one/k.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/l.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/m.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/n.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/o.jpg" align="top">

			<img src="/public/mobile/img/invitation/one/p.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/q.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/r.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/s.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/t.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/u.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/v.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/w.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/x.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/y.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/z.jpg" align="top">

			<img src="/public/mobile/img/invitation/one/aa.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/bb.jpg" align="top">
			<img src="/public/mobile/img/invitation/one/cc.jpg" align="top">
			
		</div>

		<!-- two -->
        <div class="lj_three_geng">
		  <img src="/public/mobile/img/invitation/two/a.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/b.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/c.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/d.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/e.jpg" align="top">

          <img src="/public/mobile/img/invitation/two/f.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/g.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/h.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/i.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/j.jpg" align="top">

          <img src="/public/mobile/img/invitation/two/k.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/l.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/m.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/n.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/o.jpg" align="top">

          <img src="/public/mobile/img/invitation/two/p.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/q.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/r.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/s.jpg" align="top">
          <img src="/public/mobile/img/invitation/two/t.jpg" align="top">

          <!-- three -->
          <img src="/public/mobile/img/invitation/three/a.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/b.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/c.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/d.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/e.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/f.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/g.jpg" align="top">
          <img src="/public/mobile/img/invitation/three/h.jpg" align="top">
		</div>


</body>
<script type="text/javascript" src="/public/mobile/js/investment/rem.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/weixin/jssdk.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/brand.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/wxshare.js"></script>
</html>