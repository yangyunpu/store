<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|安全设置</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/css/setting/safeset.css"/>
</head>
<body>
	<?php if ($result) { ?>
	<div class="wrap">
		<div class="header" id="header">
			<span onclick="window.history.go(-1)">
				<img src="/public/img/brandhui/xingxingsha_back@2x.png " class="lefter">
			</span>
			<span class="lj_srt">安全设置</span> 
		</div>
		<div class="void"></div>
		<div class="content">
			<ul>
				<li>
					<span>头像</span>
					<!-- <span class="enter">
						<img src="/public/img/setting/mine_xiayiye@2x.png">
					</span> -->
					<span class="photo">
						<img src="<?= $result['avatar'] ?>">
					</span>
				</li>
				<li>
					<a href="/setting/amendname.html">
						<div class="setting_con">
						    <span>昵称</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span> 
							<?php if ($result['nickname']) { ?> 
								<span class="nickname"><?= $result['nickname'] ?></span>
							<?php } else { ?>
								<span class="nickname"></span>
							<?php } ?>
						</div>
					</a>
				</li>
				<li>
					<a href="/setting/contextiphone.html">
					    <div class="setting_con">
						    <span>手机号</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span> 
							<?php if ($result['phone']) { ?> 
								<span class="iphone"><?= $result['phone'] ?></span>
							<?php } else { ?>
								<span class="iphone"></span>
							<?php } ?> 
					    </div>
					</a> 
				</li>
				<li>
					<a href="/setting/message.html">
						<div class="setting_con">
						    <span>个人信息</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span>
                    <?php if(empty($resmsg['birthday']) or empty($resmsg['region'])  or $resmsg['sex'] == -1){ ?>
					<span class="person">完善此项资料可领取星币哦</span>
                    <?php  }else{ ?>
					<span class="person"></span>
				    <?php } ?>
				   
						</div>
					</a>
				</li>
				<li>
					<div class="ramark_xiangqing setting_con renzheng">
						<span>实名认证</span>
						    <span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
						    </span>
					</div>	
				</li>                             
				<li>
					<a href="/setting/password.html">
						<div class="setting_con">
						    <span>密码</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span>
						</div>
					</a>	
				</li>
				<li>
					<a href="/setting/site.html">
						<div class="setting_con">
						    <span>收货地址</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span>
						</div>	
					</a>
				</li>
				<li>
					<a href="/setting/bindbank.html">
						<div class="setting_con">
						    <span>绑定银行卡</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span>
						</div>
					</a>
				</li>
				<li>
					<a href="/setting/coupon.html">
					    <div class="setting_con">
					        <span>激活礼品卡</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span>
						</div>
					</a>
				</li>
				<!-- <li>
					<span>消息设置</span>
					<span class="enter2">
						<img src="/public/img/setting/mine_xiayiye@2x.png">
					</span>
				</li> -->
				<li>
					<a href="/setting/opinion.html">
						<div class="setting_con">
						    <span>意见与反馈</span>
							<span class="enter2">
								<img src="/public/img/setting/mine_xiayiye@2x.png">
							</span>
						</div>
					</a>
				</li>
				<li>
					<a href="/setting/aboutus.html">
					<div class="setting_con">
					    <span>关于我们</span>
						<span class="enter2">
							<img src="/public/img/setting/mine_xiayiye@2x.png">
						</span>
					</div>
					</a>
				</li>
				<li>
					<a href="/logout.html"><div class="quit">退出账号</div></a> 
				</li>
			</ul>
		</div>
    <div class="mask" style="display: none">
	<div class="bomb_box">
            <p class="re" style="padding-left: 5px;">为了保障您的权益和资金安全，请下载App进行实名认证</p>
		<div class="button">
		<p class="shortly fl-left">待会儿再说</p>
                <a href="/lifehui/download.html?msg_txt=1"><p class="setup">下载App</p></a>
		</div>
		
	</div>
    </div>              
	</div>       
	<?php } ?>
</body>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/js/setting/setting.js"></script>
</html>