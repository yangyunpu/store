<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>星粉联|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/css/starfans/newstarfans.css">
</head>
<body>



<!-- 头部 -->
<div id="soo-header">
    <div id="header-left" onclick="window.history.go(-1)">
        <!-- <a href="/mindex/index.html" >  -->
            <img src="../public/img/starfans/icon_back@1x.png" alt=""/>
        <!-- </a> -->
    </div>
    <div id="header-center">星粉联</div>
</div>
<!-- 下载框 -->
<div class="download_box" id="download-nav">
	<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
	<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
	<div class="word">下载如此生活客户端</div>
	<div class="sure" id="download-nav-sure"><div>下载</div></div>
</div>
<!-- 内容区 -->
<div id="soo-main">


<!-- banner -->
<?php if ($link) { ?>
	<?php if ($link['app.link.banner']['children']['app.link.banner.001']['items']) { ?>
		<div class="banner">
		   	<a href="<?= $link['app.link.banner']['children']['app.link.banner.001']['items'][0]['mobile_link'] ?>"><img src="<?= $link['app.link.banner']['children']['app.link.banner.001']['items'][0]['picture'] ?>" alt=""></a>
		</div>
	<?php } ?>
<?php } ?>

    
	<!-- 是否有分享数据 -->
	<div style="display:block;">

    <?php if(!empty($award)) { ?>
   	<?php if($award['is_activity']) { ?>
		<!-- 优惠券 -->
		<div class="coupons">

			<div class="item">
				<div class="item_box  clear_f">
					<div class="float_l nums">
						<p class="coin">
						<?php 
							if($award['referrer']['type'] == 'coin') echo $award['referrer']['coin'];
							if($award['referrer']['type'] == 'money') echo $award['referrer']['money'];
							if($award['referrer']['type'] == 'cash') echo $award['referrer']['cash'];
							if($award['referrer']['type'] == 'couponNo') echo $award['referrer']['coupon_money'];
						?>
						</p>

						<p class="wen">
						<?php 
							if($award['referrer']['type'] == 'coin') 
								echo '星币';
							else if($award['referrer']['type'] == 'couponNo') 
								echo '优惠券';
							else
								echo '元';
						?>
						</p>

					</div>
					<div class="float_l mess">
						<p class="ptai"><?= $award['referrer']['ways'] ?></p>
						<p>活动开始：<?= $award['referrer']['S_BeginDate'] ?></p>
						<p>活动结束：<?= $award['referrer']['S_EndDate'] ?></p>
					</div>
					<div class="float_r get">
						自己获得
					</div>
				</div>
			</div>

			<div class="item">
				<div class="item_box clear_f">
					<div class="float_l nums">
						<p class="coin">
						<?php
							if($award['accepter']['type'] == 'coin') echo $award['accepter']['coin'];
							if($award['accepter']['type'] == 'money') echo $award['accepter']['money'];
							if($award['accepter']['type'] == 'cash') echo $award['accepter']['cash'];
							if($award['accepter']['type'] == 'couponNo') echo $award['accepter']['coupon_money'];
						?>
						</p>

						<p class="wen">
						<?php
							if($award['accepter']['type'] == 'coin') 
								echo '星币';
							else if($award['accepter']['type'] == 'couponNo') 
								echo '优惠券';
							else
								echo '元';
						?>
						</p>

					</div>
					<div class="float_l mess">
						<p class="ptai"><?= $award['accepter']['ways'] ?></p>
						<p>活动开始：<?= $award['accepter']['S_BeginDate'] ?></p>
						<p>活动结束：<?= $award['accepter']['S_EndDate'] ?></p>
					</div>
					<div class="float_r get">
						朋友获得
					</div>
				</div>
			</div>
			<div class="quan_button">
				<a id="share_btn">分享</a>
			</div>
		</div>
	<?php }else{ ?>
		<div class="ddd" >
		    <img src="/public/img/starfans/star_fans_no.png">
		</div>
	<?php  } ?>

    <?php  } ?>

	    <!-- 分享记录 -->
	    <?php if ($inviterecode) { ?>
		    <?php if ($link) { ?>
			<div class="sharerecord_wrap">
			    <div class="sharerecord">
					<?php if ($link['app.link.record']['children']['app.link.record.001']['items']) { ?>
						<a href="<?= $link['app.link.record']['children']['app.link.record.001']['items']['0']['mobile_link'] ?>"><img src="<?= $link['app.link.record']['children']['app.link.record.001']['items']['0']['picture'] ?>" alt="" class="picrecord"></a>
					<?php } ?>

						<ul class="record clearfix">
			               <?php foreach ($inviterecode['data'] as $i => $d) { ?>
							<li class="out_li">
								<ul class="news clearfix">
									<li>
										<img src="<?= $d['accepter_avatar'] ?>" class="headportrait">
									</li>
									<li>
										<h2><?= $d['nick_name'] ?></h2>
										<p><?= $d['title'] ?></p>
									</li>
									<li>
										<span>+<?= $d['award'] ?></span>
									</li>
								</ul>
							</li>
							<?php } ?>

						</ul>
						<?php if ($inviterecode['num'] == 1) { ?>
						<a href="/starfans/active.html" class="ac">查看更多</a>
						<?php } ?>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
	    <!-- 前十名 -->
               <?php if ($wealthtop) { ?>
		<div class="ranking_wrap">
            <div class="ranking">
				<?php if ($link['app.link.top10']['children']['app.link.top10.001']['items']) { ?>
					<a href="<?= $link['app.link.top10']['children']['app.link.top10.001']['items']['0']['mobile_link'] ?>"><img src="<?= $link['app.link.top10']['children']['app.link.top10.001']['items']['0']['picture'] ?>" class="picranking"></a>
				<?php } ?>
					<ul class="record clearfix">
		                   <?php foreach ($wealthtop as $i => $d) { ?>
						<li>
							<ul class="news clearfix">
								<li>
									<img src="<?= $d['avatar'] ?>" class="headportrait">
								</li>
								<li>
									<h2>TOP<?= $i + 1 ?></h2>
									<p><?= $d['nick_name'] ?></p>
								</li>
								<li>
									<span><?= $d['total'] ?>元</span>
								</li>
							</ul>
						</li>
							<?php } ?>
					</ul>
			</div>		
		</div>
		<?php } else { ?>
		<div id="activemain">
			<img src="../public/img/starfans/暂无活动.png" alt="">
			<p>暂无活动</p>
		</div>
				<?php } ?>
	</div>
	<!-- 没有活动 -->
	<?php if(empty($award) && empty($inviterecode) && empty($wealthtop)) { ?>
	<div id="activemain">
		<img src="../public/img/starfans/暂无活动.png" alt="">
		<p>暂无活动</p>
	</div>
	<?php  } ?>
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
<script src="/public/js/starfans/download.js"></script>
</body>
</html>