
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>领红包|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/css/starfans/newstarfans.css">
    <link rel="stylesheet" href="/public/css/starfans/common.css">
</head>
<body>




<div id="soo-header">
    <div id="header-left" onclick="window.history.go(-1)">
        <!-- <a href="#"> -->
            <img src="../public/img/starfans/icon_back@1x.png" alt=""/>
        <!-- </a> -->
    </div>
    <div id="header-center">领红包</div>
</div>

<!-- 下载框 -->
<div class="download_box" id="download-nav">
	<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
	<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
	<div class="word">下载如此生活客户端</div>
	<div class="sure" id="download-nav-sure"><div>下载</div></div>
</div>
<div class="sharemain">
<div style="display:none;" id="member"><?= $member_id ?></div>
	<div class="banner">
		<img src="../public/img/starfans/bg_ling hpong bao.png" alt="">
		<div class="picuser">
			<img src="<?= $sharepage['avatar'] ?>" alt="">
		</div>
		<div class="giftbag">
		    <?php if ($sharepage) { ?>
			<h2><?= $sharepage['nick_name'] ?></h2>
			<?php } ?>

			<?php
				if ($award) {
					switch ($award['type']) {
						case 'coin':
							$em = '个星币';
							break;

						case 'money':
							$em = '元红包';
							break;

						default:
							$em = '元红包';
							break;
					}
				} else {
					$em = '元红包';
				}
			?>

			<?php if ($sharepage) { ?>
				<p>最高可领<span><?= $sharepage['award_money'] ?></span><?php echo $em ?></p>
			<?php } ?>

			<input type="tel" id="mobile" maxlength="11"  name="" value="" placeholder="请输入你的手机号码" />
			<a class="bounceIn">立即领取</a>
		</div>
	</div>
<?php if ($sharepage) { ?>
	<?php if ($sharepage['hot_goods']) { ?>
    <div class="hotsell_wrap">
		<div class="hotsell">
			<h3>如此生活今日热销</h3>
			<ul class="clearfix">
			<?php foreach ($sharepage['hot_goods'] as $d) { ?>
				<li>
				    <a href="<?= $url_goods ?>/<?= $d['Sku_ID'] ?>.html">
						<img src="<?= $d['S_Logo'] ?>" alt="">
						<p class="hotsell_p"><?= $d['S_Name'] ?></p>
						<p>￥<?= $d['S_ShopPrice'] ?></p>
					</a>
				</li>
			<?php } ?>
			</ul>
		</div>
    </div>
	<?php } ?>
	<?php } ?>
</div>
</div>
<div id="footer">
	<h2>用户须知</h2>
	<div>
		<p>1、活动开始星粉则可以转发活动界面连接，邀请好友参加分享。</p>
		<p>2、星粉转发获得的邀请红包金额可累计使用，但不可提现。</p>
		<p>3、红包使用范围只限如此生活线上线下商城内所有在售产品。</p>
		<p>4、每个星粉最多可推荐100个新人，被推荐人领取红包后推荐人获得推荐红包。</p>
		<p>5、每个新会员仅可获得一次新人红包。</p>
		<p>6、如若恶意注册、作弊领取、恶意批发、恶意刷单、盗用或冒用他人信息参加活动此ID用户则被取消活动资格。</p>
		<?php if($count > 0){ ?>
		<p>7、红包限量<?= $count ?>份，送完即止。</p>
		<?php } else { ?>
		<p>7、红包不限定最大数量。</p>
		<?php } ?>
		<p>8、最终解释权归如此生活所有。</p>
	</div>
</div>
<!-- 遮罩begin -->
<!-- pop-up box -->
<div id="wrapper">
		<div id="dialog" class="animated">
			<div class="dialogTop">
			    <img  class="claseDialogBtn" src="/public/img/starfans/delete2x.png" >
			</div>
			<form action="" method="post" id="editForm" name="form1">
				<ul class="editInfos">
					<li>
						<label class="ipt">
							<input type="text" id="image_vcode" class="code" placeholder="请输入图形验证码">
				   	   	  	<span class="print">
				   	   	  		<img id="image" class="piccode" src="" >
				   	   	  	</span>

						</label>
					</li>
					<li>
						<label class="verification">
						    <input type="hidden"  id="mobile_hidden"  value="" placeholder="手机号码" />
						    <input type="hidden"  id="source_no"  value="<?= $source_no ?>" placeholder="活动编号" />
						    <input type="hidden"  id="member_id"  value="" placeholder="推荐者ID" />
							<input type="text" name="" id="num_code"  value="" placeholder="请输入手机验证码" class="code" />
							<button type="button" id="btn" class="btnSendCode" >获取验证码</button>
						</label>
					</li>
					<li>
						<a class="submitBtn">提交</a>
					</li>
				</ul>
			</form>
		</div>
</div>
<!-- 遮罩end -->
<div class="phone_verify">
	<p>请输入正确的手机号</p>
</div>
<div class="image_verify">
	<p>请输入正确图片验证码</p>
</div>
<div class="send_success">
	<p>验证码已发送</p>
</div>
<div class="send_fail">
	<p>验证码发送失败</p>
</div>
<div class="register_suc">
	<p>注册成功</p>
</div>
<div class="register_fail">
	<p>验证码错误,请重新注册</p>
</div>
<div class="sublimt_null">
	<p>请输入正确的验证码</p>
</div>

<script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "https://hm.baidu.com/hm.js?826cba0598fb59fb393282dd20e7d118";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
</script>
<script src="/public/ext/js/rem.js"></script>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/jquery.base64.js"></script>
<script src="/public/js/starfans/starfans.js"></script>
</body>
</html>