<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的现金|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <!-- <link rel="stylesheet" href="/public/css/huilife/common.css"> -->
    <!-- <link rel="stylesheet" href="/public/css/huilife/index.css"> -->
	<link rel="stylesheet" href="/public/css/me/index.css">
</head>
<body id="new_me_cash">
<div class="realname mask" style="display: none;">
	<div class="bomb_box">
		<p class="re">为了保障您的权益和资金安全，请下载App进行实名认证</p>
		<div class="button">
		<p class="shortly fl-left">待会儿再说</p>
		<a href="/lifehui/download.html?msg_txt=1"><p class="setup">下载APP</p></a>
		</div>
	</div>
</div>
<div class="mask" style="display: none;">
	<div class="bomb_box">
		<p class="re">你还没有设置支付密码，请先设置</p>
		<div class="button">
		<p class="shortly fl-left">待会儿再说</p>
		<a href="/setting/paypassword.html?type=1"><p class="setup">去设置</p></a>
		</div>
		
	</div>
</div>
<div class="mask-prompt" style="display: none;">
	<div class="bomb_box">
		<div class="re">规则</div>
		<?php foreach ($times['rule'] as $num => $rule) { ?>
		<p><?= ($num + 1) ?>）<?= $rule ?></p>
<!-- 		<p>1）现金账户余额满50元以上可提现</p>
        <p>2）合作用户在惠赚钱功能中获取的佣金在如此生活APP“我的”→“现金”中查看；</p>
        <p>3）合作用户需要向红包充值消费方可完成平台消费；</p>
        <p>4）合作用户需在个人资料绑定银行卡，佣金会在商品无理由退换期结束后，计入用户现金</p>
        <p>5）若已成交订单发生退货，取消订单的情况，则不计入佣金；</p> -->
        <?php } ?>
		<div class="button">
		<p class="shortly fl-left">

</p>
		
		</div>
		
	</div>
</div>
<!-- 头部 -->
<div id="ba-new-header">
	<div class="header-left fl-left">
		<a onclick="window.history.go(-1)"> <img src="../public/img/common/shop_back_black@2x.png" alt=""></a>
	</div>
	<!-- <div id="header-center">领星币</div> -->
	<div class="header-center fl-left">我的现金</div>
	<div class="header-right"><img class="ramark_xiangqing" src="../public/img/me/Group3.png"></div>
</div>
<!-- <?php if ($member) { ?> -->
<div class="balance">
	<p class="current">当前余额</p>
	<p class="money"><?= $cash ?></p>
	<p class="remark" times="<?= $times['times'] ?>" max_money="<?= $times['fix_money'] ?>" limit_money = "<?= $moneytimes['money'] ?>" limit_num = "<?= $moneytimes['num'] ?>" is_name = "<?= $setting['is_name'] ?>" is_real = "<?= $times['is_real'] ?>">
	<?php if ($moneytimes['money'] <= 0) { ?>
			已达本月提现上限
	<?php }elseif ($moneytimes['num'] <= 0) { ?>
		已达本月提现上限
	<?php }else{ ?>
	金额超过<?= $times['fix_money'] ?>元可提现，今天还可提现<?= $times['times'] ?>次
	<?php } ?>
	</p>
	<div class="with" id="with"  name="<?= $code ?>">提现</div>
</div>
<!-- <?php } ?> -->
<div class="link">
	<a href="/i/money/cashrecharge.html?cashTotal=<?= $cash ?>&type=1">
		<div class="bar">
			<p class="fl-left">充值钱包</p>
			<div class="go">
				<img src="../public/img/me/Group 22 Copy 7.png">
			</div>
		</div>
	</a>
	<a href="/setting/bindbank.html?type=1">
		<div class="bar">
			<p class="fl-left">绑定银行卡</p>
			<div class="go">
			<?php if ($bank['is_bank']) {?>
			<p class="fl-left">已绑定</p>
			<?php }else{ ?>
			<p class="fl-left">未绑定</p>
			<?php } ?>
				<img src="../public/img/me/Group 22 Copy 7.png">
			</div> 
		</div>
	</a>
</div>
<div class="bill-l">
		<a href="./bill.html">
	<div class="bar">
		<p class="fl-left">账单</p>
		<div class="go">
		   <p class="fl-left time"><?= $times['time'] ?></p>
		   <p class="fl-left price"><?= $times['money'] ?></p>
			<img src="../public/img/me/Group 22 Copy 7.png">
		</div>
		</a>
	</div>
</div>

</div>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<!-- <script src="/public/js/jquery.base64.js"></script> -->
<!-- <script src="/public/ext/js/soo.m.ui.js"></script> -->
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/me/index.js"></script>
<script src="/public/js/setting/bindbank.js"></script>
</body>
</html>