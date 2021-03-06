<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|会员中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/foot.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/index/view.index.css"/>
</head>
<body>
<div id="vip">
	<!-- 下载框 -->
	<!-- <div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="/public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="/public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="top">
		<?php if ($is_login) { ?>
			<div class="msg">
			<?php if ($member) { ?>
				<a href="/i/msg/msgindex.html">
					<img data-id = "<?= $member['unread_messages'] ?>" src="/public/img/i/wodeshenghuo_xiaoxi@3x.png">
				</a>
			<?php } ?>
			</div>
		<?php } else { ?>
			<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
				<div class="msg">
					<img  src="/public/img/i/wodeshenghuo_xiaoxi@3x.png">
				</div>
		    </a>
		<?php } ?>

		<?php if ($is_login) { ?>
			<div class="avatar">
			<?php if ($member) { ?>
	            <a href="/setting/safeset.html">
					<img src="<?= $member['avatar'] ?>">
					<p><?= $member['nickname'] ?></p>
	            </a>
			<?php } ?>
			</div>
		<?php } else { ?>
			<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
			    <div class="avatar">
			    	<img src="/public/img/i/mine_anquan_image@3x.png">
			    	<p>未登录</p>
			    </div>
		    </a>
		<?php } ?>

		<?php if ($is_login) { ?>
			<div id="wealth">
				<div class="money">
				<?php if ($member) { ?>
					<span><?= $member['coin'] ?> 个</span>
					<span>￥ <?= $member['money'] ?></span>
					<span>￥ <?= $member['cash'] ?></span>
					<span><?= $member['coupons'] ?> 张</span>
				<?php } ?>
				</div>
				<div class="money">
				<?php if ($member) { ?>
					<a href="/i/money/coin.html">
						<span>星币</span>
					</a>
					<a href="/i/money/wallet.html">
						<span>钱包</span>
					</a>
					<a href="/me/cash.html">
						<span>现金</span>
					</a>
					<a href="/i/coupon/coupon.html">
						<span>优惠券</span>
					</a>
				<?php } ?>
				</div>
			</div>
		<?php } else { ?>
			<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
				<div id="wealth">
					<div class="money">
						<span>0 个</span>
						<span>￥ 0.00</span>
						<span>￥ 0.00</span>
						<span>0 张</span>
					</div>
					<div class="money">
						<span>星币</span>
						<span>钱包</span>
						<span>现金</span>
						<span>优惠券</span>
					</div>
				</div>
			</a>
		<?php } ?>
	</div>
	<div id="con">
		<?php if ($is_login) { ?>
			<div class="mine">
				<a href="/i/record/attention.html">
					<div class="two two_line">
					    <img id="concern" src="/public/img/i/mine_follow@3x.png">
					    <p>关注</p>
					</div>
				</a>
				<a href="/i/record/footprint.html">
				<div class="two">
					<img id="footprint" src="/public/img/i/mine_footprint@3x.png">
					<p>足迹</p>
				</div>
				</a>
			</div>
		<?php } else { ?>
			<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
				<div class="mine">
					<div class="two two_line">
					    <img id="concern" src="/public/img/i/mine_follow@3x.png">
					    <p>关注</p>
					</div>
					<div class="two">
						<img id="footprint" src="/public/img/i/mine_footprint@3x.png">
						<p>足迹</p>
					</div>
				</div>
			</a>
		<?php } ?>
		<?php if ($is_login) { ?>
			<div id="order">
				<div id="order_list">
					<div class="five">
						<a href="/orders/index.html?status=1">
							<img src="/public/img/i/mine_payment@3x.png">
							<p>待付款</p>
							<?php if ($member && $member['non_pay'] != 0) { ?>
							<span class="num"><?= $member['non_pay'] ?></span>
							<?php } ?>
						</a>
					</div>
					<div class="five">
						<a href="/orders/index.html?status=3">
							<img src="/public/img/i/mine_goods@3x.png">
							<p>待收货</p>
							<?php if ($member && $member['non_receive'] != 0) { ?>
							<span class="num"><?= $member['non_receive'] ?></span>
							<?php } ?>
						</a>
					</div>
					<div class="five">
						<a href="/orders/index.html?status=4">
							<img src="/public/img/i/mine_evaluate@3x.png">
							<p>待评价</p>
							<?php if ($member && $member['non_comment'] != 0) { ?>
							<span class="num"><?= $member['non_comment'] ?></span>
							<?php } ?>
						</a>
					</div>
					<div class="five">
						<a href="/orders/aftersale.html">
							<img src="/public/img/i/mine_service@3x.png">
							<p>退款/售后</p>
							<!-- <span class="num"><?= $member[''] ?></span> -->
						</a>
					</div>
					<div class="five">
						<a href="/orders/index.html">
							<img src="/public/img/i/mine_order@3x.png">
							<p>我的订单></p>
						</a>
					</div>
				</div>
				<div class="mine line">
					<a href="/lifehui/download.html?msg_txt=2">
						<div class="two two_line" >
						    <img src="/public/img/i/mine_life_order@3x.png">
						    <p>惠生活订单</p>
						</div>
					</a>
					<a href="/setting/coupon.html">
						<div class="two">
							<img src="/public/img/i/page1.png">
							<p>激活礼品卡</p>
						</div>
					</a>
				</div>
			</div>
		<?php } else { ?>
			<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
				<div id="order">
					<div id="order_list">
						<div class="five">
							<img src="/public/img/i/mine_payment@3x.png">
							<p>待付款</p>
						</div>
						<div class="five">
							<img src="/public/img/i/mine_goods@3x.png">
							<p>待收货</p>
						</div>
						<div class="five">
							<img src="/public/img/i/mine_evaluate@3x.png">
							<p>待评价</p>
						</div>
						<div class="five">
							<img src="/public/img/i/mine_service@3x.png">
							<p>退款/售后</p>
						</div>
						<div class="five">
							<img src="/public/img/i/mine_order@3x.png">
							<p>我的订单></p>
						</div>
					</div>
					<div class="mine line">

						<div class="two two_line" >
						    <img src="/public/img/i/mine_life_order@3x.png">
						    <p>惠生活订单</p>
						</div>

						<div class="two">
							<img src="/public/img/i/mine_life_xingxingsha@3x.png">
							<p>我的星星杀</p>
						</div>
					</div>
				</div>
			</a>
		<?php } ?>
		<?php if ($is_login) { ?>
			<div id="set">
				<div class="other">
					<div class="four">
						<a href="/setting/site.html">
							<img id="adress" src="/public/img/i/mine_life_address@3x.png">
							<p>收货地址</p>
						</a>
					</div>
					<div class="four">
						<a href="/setting/safeset.html">
							<img id="safe" src="/public/img/i/mine_securitysetting@3x.png">
							<p>安全设置</p>
						</a>
					</div>
					<div class="four">
						<a href="/setting/opinion.html">
							<img id="opinion" src="/public/img/i/mine_feedback@3x.png">
							<p>意见与反馈</p>
						</a>
					</div>
					<div class="four">
						<a href="/setting/aboutus.html">
							<img id="us" src="/public/img/i/mine_aboutus@3x.png">
							<p>关于我们</p>
						</a>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
				<div id="set">
					<div class="other">
						<div class="four">
							<img id="adress" src="/public/img/i/mine_life_address@3x.png">
							<p>收货地址</p>
						</div>
						<div class="four">
							<img id="safe" src="/public/img/i/mine_securitysetting@3x.png">
							<p>安全设置</p>
						</div>
						<div class="four">
							<img id="opinion" src="/public/img/i/mine_feedback@3x.png">
							<p>意见与反馈</p>
						</div>
						<div class="four">
							<img id="us" src="/public/img/i/mine_aboutus@3x.png">
							<p>关于我们</p>
						</div>
					</div>
				</div>
			</a>
		<?php } ?>
	</div>
	<div id="foot">
	<?php if ($is_login) { ?>
		<div class="biz">
			<div class="business">
				<p class="title">商探收入</p>
				<a href="/shopseek/shopincome.html">
					<div class="txt">
						<p>点击查看</p>
						<p>我的收入详情</p>
					</div>
				</a>
			</div>
			<img id="biz_img" src="/public/img/i/Group 3.png">
			<img id="bg" src="/public/img/i/Combined Shape Copy@3x.png">
			<div class="business">
				<p class="title">全民商探</p>
				<?php if ($member['is_agent'] == 1) { ?>
				<a href="/shopseek/shopmodel.html">
					<div class="txt">
						<p>点击查看</p>
						<p>我的最新动态</p>
					</div>
				</a>
				<?php } else { ?>
				<a href="/shopseek/shopseek.html">
					<div class="txt">
						<p>点击查看</p>
						<p>我的最新动态</p>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	<?php } else { ?>
		<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
			<div class="biz">
				<div class="business">
					<p class="title">商探收入</p>
					<div class="txt">
						<p>点击查看</p>
						<p>我的收入详情</p>
					</div>
				</div>
				<img id="biz_img" src="/public/img/i/Group 3.png">
				<img id="bg" src="/public/img/i/Combined Shape Copy@3x.png">
				<div class="business">
					<p class="title">全民商探</p>
					<div class="txt">
						<p>点击查看</p>
						<p>我的最新动态</p>
					</div>
				</div>
			</div>
		</a>
	<?php } ?>
	<?php if ($is_login) { ?>
		<div class="biz biz_after">
			<div class="my">
                <a href="/i/show/show.html">
					<div class="record">
					    <p id="fantxt">我的星粉秀</p>
						<div id="fancon">
							<p>点击查看</p>
							<p>最新动态</p>
						</div>
						<img id="fanimg" src="/public/img/i/Group 8.png">
					</div>
                </a>
			</div>
			<div class="my">
		        <a href="/i/record/invite.html">
					<div class="record">
						<p id="invittxt">我的邀请</p>
						<div id="invitcon">
							<p>点击查看</p>
							<p>我的邀请记录</p>
						</div>
						<img id="invitimg" src="/public/img/i/Group 5.png">
					</div>
				</a>
			</div>
		</div>
	<?php } else { ?>
		<a href="<?= $url_member ?>/logins/login.html?return_url=<?= $return_url ?>">
			<div class="biz biz_after">
				<div class="my">
					<div class="record">
					    <p id="fantxt">我的星粉秀</p>
						<div id="fancon">
							<p>点击查看</p>
							<p>最新动态</p>
						</div>
						<img id="fanimg" src="/public/img/i/Group 8.png">
					</div>
				</div>
				<div class="my">
					<div class="record">
						<p id="invittxt">我的邀请</p>
						<div id="invitcon">
							<p>点击查看</p>
							<p>我的邀请记录</p>
						</div>
						<img id="invitimg" src="/public/img/i/Group 5.png">
					</div>
				</div>
			</div>
		</a>
	<?php } ?>
	<div id="foot_margin">

	</div>
	</div>
	<!-- 底部导航 -->
	<footer class="navigation">
		<ul>
			<li>
				<a href="/mindex/index.html">
					<img src="/public/img/mindex/Tab_Home@2x.png">
					<p >首页</p>
				</a>
			</li>
			<li>
				<a href="/newcategory.html">
					<img src="/public/img/mindex/Tab_Menu@2x.png">
					<p >分类</p>
				</a>
			</li>
			<li>
				<a href="/lifehui/index.html">
					<img src="/public/img/mindex/Tab_Life@2x.png">
					<p>惠生活</p>
				</a>
			</li>
			<li>
				<a href="<?= $url_order ?>/index.html">
					<img src="/public/img/mindex/Tab_Shop@2x.png">
					<p>购物车</p>
					<span class="shopping_car">1</span>
				</a>
			</li>
			<li>
				<a href="/i/index/index.html">
					<img src="/public/img/mindex/Tab_Me_pre@2x.png">
					<p class="footer_bottom_color">我的</p>
				</a>
			</li>
		</ul>
	</footer>
</div>
<!-- 注册送礼 -->
<?php if ($seed) { ?>
<div class="lj_seed">
	<!-- <div class="lj_gift"> -->
<!-- 		<div class="lj_delect"><img src="/public/img/i/lj_delect.png"></div>
		<p class="cong">恭喜您，成功领取注册领包</p>
		<?php if ($seed['coin']) { ?>
		<p class="give">星币<?= $seed['coin'] ?>个</p>
		<?php } ?>
		<?php if ($seed['cash']) { ?>
		<p class="give">现金<?= $seed['cash'] ?>元</p>
		<?php } ?>
		<?php if ($seed['money']) { ?>
		<p class="give">钱包<?= $seed['money'] ?>元</p>
		<?php } ?>
		<?php if ($seed['couponNo']) { ?>
		<p class="give">优惠券<?= $seed['couponNo'] ?>张</p>
		<?php } ?>
		下载页面弹出框 
		 <div class="lj_load" id="download-nav">
			<div class="remove" id="download-nav-hide"></div>
			<div class="sure" id="download-nav-sure"><div>下载APP</div></div>
		</div> 
 		<div class="lj_load"><a href="/i/show/download.html?msg=4">下载APP</a></div> -->

		<div id="markmain">
			<a href="/i/index/index.html"><img src="/public/img/common/delete@2x.png"></a>
			<div id="mtitle">恭喜您，成功领取注册礼包</div>
			<div id="qianbao">大礼包正在飞往您的钱包</div>
			<div class="dongtai">
			<?php if ($seed['coin']) { ?>
			<p>星币<?= $seed['coin'] ?>个</p>
			<?php } ?>

			<?php if ($seed['money']) { ?>
			<p>钱包<?= $seed['money'] ?>元</p>
			<?php } ?>
			
			<?php if ($seed['cash']) { ?>
			<p>现金<?= $seed['cash'] ?>元</p>
			<?php } ?>
		<!-- 	<p>钱包<span id="qian"></span>元</p> -->
			<?php if ($seed['couponNo']) { ?>
			<p>优惠券<?= $seed['couponNo'] ?>张</p>
			<?php } ?>
			
			</div>
			
			<div class="mengxin"><a href="/new/people.html" style="text-decoration:none;color: #fff;">我是萌新</a></div>
		</div>
	<!-- </div> -->
</div>
<?php } ?>

</body>
</html>
<script src="/public/js/rem.js"></script>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src='/public/js/i/show/index.js'></script>