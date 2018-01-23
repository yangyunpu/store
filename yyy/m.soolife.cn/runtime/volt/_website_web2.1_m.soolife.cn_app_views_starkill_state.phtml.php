<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|星星杀</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" href="/public/ext/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="/public/css/starkill/common.css"/>
</head>
<body>
<div class="state_wrap">
	<div class="header">
		<a href="/starkill/start.html"><img class="arrow"  src="/public/img/starkill/icon/Group 36.png " ></a>
		<span class="head_title">星星杀</span> 
	</div>
	<!-- 下载框 -->
	<!-- <div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
    <?php if ($state['data']) { ?>
    <div class="state_con">
        <!-- 轮播 -->
        <?php if ($state['data']['sku_album']) { ?>

		<div class="swiper-container details-container">
			<div class="swiper-wrapper">
				<?php foreach ($state['data']['sku_album'] as $d) { ?>
				<div class="swiper-slide"> 
					<img class="state_img" src="<?= $d ?>">
				</div>
				<?php } ?>		
			</div>
			<!-- 分页效果 -->
			<div class="pagination"></div>
		</div>

        <?php } ?>
        <div>
        	<p class="active_title"><?= $state['data']['name'] ?></p>
			<div class="active_txt">
			    <input type="hidden" class="stamp" value="<?= $state['data']['pre_end_date'] ?>" name=""  />
				<span class="differ_txt">距杀价结束还有:</span>
				<span class="timestamp differ_time"></span>
			</div>
			<div class="active_progress" id="state_progress">
			    <input type="hidden" id="rule" value="<?= $state['data']['rule'] ?>" name="" />
			    <input type="hidden" id="pre" value="<?= $state['data']['percentage'] ?>" name="" />
				<div class="progress"></div>
			</div>
			<ul class="active_num state_num">
				<li>
					<p><span>￥</span><span id="life_price"><?= $state['data']['life_price'] ?></span></p>
				</li>
				<li class="price_sec">
					<p id="price_now">￥<?= $state['data']['now_price'] ?></p>
				</li>
				<li>
					<p><span>￥</span><span id="floor_price"><?= $state['data']['floor_price'] ?></span></p>
				</li>
			</ul>
			<ul class="active_price">
				<li>
					<p>原价</p>
				</li>
				<li>
					<p>现价</p>
				</li>
				<li>
					<p>最低</p>
				</li>
			</ul>
			<p class="active_limit">
				<span>(每人限购</span>
				<span><?= $state['data']['limit_ation'] ?></span>
				<span>件)</span>
			</p>
			<div class="active_btn state_target">
				<div class="active_target ">
                    <?php if ($state['data']['qty']) { ?>
					<p>已参加<span id="qtyCount"><?= $state['data']['qty'] ?></span>人</p>
					<?php } else { ?>
					<p>已参加<span id="qtyCount">0</span>人</p>
					<?php } ?>
					<p class="target_go">再杀<?= $state['data']['surplus_qty'] ?>次即可到达低价</p>
					<p class="target_suc hide"><a href="/starkill/state.html?starkill_id=<?= $state['data']['starkill_id'] ?>">已杀到底价,继续抢!</a></p>
				</div>
			</div>
        </div>
        <div class="details_img">
    	    <?= $state['data']['spu_pictures'] ?>
        </div>
    </div>
    <?php } ?>
    <div class="state_botm">
    	<a href="<?= $state['data']['url'] ?>/<?= $state['data']['sku_id'] ?>.html">原价购买</a>
    	<?php if ($state['data']['is_frist'] == 1) { ?>
	    	<?php if ($is_login) { ?>
	    	<a id="start_kill">我要杀价</a>
	    	<?php } else { ?>
	    	<a href="<?= $url_member ?>/login.html?return_url=<?= $return_url ?>" id="start_kill">我要杀价</a>
	    	<?php } ?>
    	<?php } else { ?>
	    	<?php if ($is_login) { ?>
	    	<a id="start_kill">继续杀价</a>
	    	<?php } else { ?>
	    	<a href="<?= $url_member ?>/login.html?return_url=<?= $return_url ?>" id="start_kill">继续杀价</a>
	    	<?php } ?>
    	<?php } ?>
    </div>
    <!-- 弹框  -->
    <?php if ($is_login) { ?>
    <div class="alert_wrap hide">
        <input type="hidden"  name="" value="<?= $state['data']['starkill_id'] ?>" class="starkill_id" />
        <input type="hidden"  name="" value="<?= $state['data']['pre_qty'] ?>" id="pre_qty" />
        <input type="hidden"  name="" value="<?= $state['data']['limit_ation'] ?>" id="limit_ation" />
	    <div class="alert_bg"></div>
    	<div class="alert_box">
	    	<div class="alert_title">每杀一次价格，您可以杀低价格，同时你有权拥有相等杀价次数的购买机会</div>
	    	<p class="alert_coin">
	    	    <input type="hidden" class="rule" value=" <?= $state['data']['pre_price'] ?>" name="" />
		    	<span class="coin_sum"></span>
		    	<span>星币</span>
	    	</p>
	    	<div class="alert_change">
		    	<div id="minus" class="change_wrap">
		    		<img   src="/public/img/starkill/icon/icon_jianhao.png"> 
		    	</div>
	    		<input id="result" type="number" name="" value="1"  readonly="readonly" disabled="disabled" />
	    		<div id="plus" class="change_wrap">
	    			<img  src="/public/img/starkill/icon/Group.png">
	    		</div>
	    	</div>
            <?php if ($coin) { ?>
	    	<p class="alert_total">我的星币:<span><?= $coin['coin'] ?></span>星币</p>
            <?php } ?>
	    	<a  id="suc_buy" class="alert_suc">确认</a>
	    </div>
	    <div id="alert_coin" class="hide">
	    	
	    </div>
    </div>
    <?php } ?>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/starkill/state.js"></script>