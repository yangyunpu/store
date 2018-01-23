<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>现金提现|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <!-- <link rel="stylesheet" href="/public/css/huilife/common.css"> -->
    <!-- <link rel="stylesheet" href="/public/css/huilife/index.css"> -->
	<link rel="stylesheet" href="/public/css/me/index.css">
</head>
<body id="wi_me_cash">
<div class="tax" style="display: none;">
	<div class="bomb_box">
		<p class="ref tax_title">提现申请成功</p>
		<div class=" title tax_content">
			<span class="shuihoutixian">税后提现金额</span>
			<span class="price tax_cont">111</span>
		</div>
		<div class="button1">
		<p class="shortly fl-left">稍后再说</p>
		<p class="setup tax_sublime">确定</p>
		</div>
	</div>
</div>
<!-- 头部 -->
<div id="ba-new-header" class="back_f7">
	<div class="header-left fl-left">
		<a onclick="window.history.go(-1)"> <img src="../public/img/common/shop_back_black@2x.png" alt=""></a>
	</div>
	<!-- <div id="header-center">领星币</div> -->
	<div class="header-center fl-left mar_l_388">提现</div>
	<div class="header-right"></div>
</div>
<div class="link">
	<div class="bar">
		<p class="fl-left money" name="<?= $cash ?>" limit_money = "<?= $moneytimes['money'] ?>" limit_num = "<?= $moneytimes['num'] ?>" is_tax = "<?= $setting['is_tax'] ?>">当前余额:</p>
		<div class="go w-price">
			<?= $cash ?>
		</div>
	</div>
	<div class="bar">
		<p class="fl-left">提现金额:</p>
		<div class="go">
			<input type="text" name="" value="<?= $cash ?>" id="cash_post" placeholder="">
		</div> 
	</div>
	<div class="bar">
		<p class="fl-left">姓名:</p>
		<div class="go">
			<?php if (!empty($res['data'])) {  ?>
				<input  type="text" name="" id="name_post" value="<?= $res['data']['bank_account'] ?>">
			<?php }else{ ?>
				<input  type="text" name="" id="name_post" >
			<?php } ?>
		</div> 
	</div>
	<div class="bar">
		<p class="fl-left">开户行:</p>
		<div class="go">
<!-- 			<input type="text" name="" id="bank_post"> -->
			<?php if (!empty($res['data'])) {  ?>
				<input type="text" name="" id="bank_post" value="<?= $res['data']['bank_name'] ?>" >
			<?php }else{ ?>
				<input type="text" name="" id="bank_post" >
			<?php } ?>
		</div> 
	</div>
	<div class="bar">
		<p class="fl-left">打款账户:</p>
		<div class="go">
			<!-- <input type="text" name="" id="bankno_post"> -->
			<?php if (!empty($res['data'])) {  ?>
			<input type="text" name="" id="bankno_post" value="<?= $res['data']['bank_no'] ?>" >
			<?php }else{ ?>
				<input type="text" name="" id="bankno_post" >
			<?php } ?>
		</div> 
	</div>
</div>
<div class="bill-l">
	<div class="bar">
		<p class="fl-left">短信通知:</p>
		<div class="go">
		   <!-- <p class="fl-left time">可不填</p> -->
		   <input type="text" name="" id="mobile_post" placeholder="可不填">
			<!-- <img src="../public/img/me/tongxunlu@2x.png"> -->
		</div>
	</div>
</div>
<button  type="button" class="button shenqingtixian">申请提现</button>
<div class="mask-w"  style="display: none">
	<div class="bomb_box">
		<p class="title">提现申请成功</p>
		<p class="re">您的提现申请我们会在每周三进行结算转账,请耐心等候!</p>
		<div class="m-button iknow">
		知道啦
		</div>
		
	</div>
</div>

<div class="mask-password"  member_id="<?= $member_id ?>" style="display: none;">
	<div class="bomb_box">
		<div class="title1" >请输入六位支付密码</div>
		<form>
		<div class="pass">
			<input class="password" type="number" name="mi">
			<input class="password" type="number" name="mi" >
			<input class="password" type="number" name="mi" >
			<input class="password" type="number" name="mi">
			<input class="password" type="number" name="mi" >
			<input class="password" type="number" name="mi">
		</div>
		</form>
		<div class="m-button">
		<button type="button" class="queding" >确定</button>
		<button type="button" class="quxiao">取消</button>
		</div>
	</div>
</div>
<script>

</script>

<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/jquery.base64.js"></script>
<!-- <script src="/public/js/huilife/life.index.js"></script> -->
<script src="/public/ext/js/rem.js"></script>
<script src="/public/js/me/index.js"></script>
</body>
</html>