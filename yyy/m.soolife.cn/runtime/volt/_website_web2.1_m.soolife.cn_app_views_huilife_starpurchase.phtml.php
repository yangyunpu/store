
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>星换购|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/css/huilife/common.css">
    <link rel="stylesheet" href="/public/css/huilife/starchange.css">
</head>
<body>



<div id="soo-header" data-url="<?= $url_goods ?>">
	<div id="header-left"><a onclick="window.history.go(-1)"><img src="../public/img/common/shop_back_black@2x.png" alt=""></a></div>
	<div id="header-center">星换购</div>
	<div id="header-right"></div>
</div>
<!-- 下载框 -->
<div class="download_box" id="download-nav">
	<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
	<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
	<div class="word">下载如此生活客户端</div>
	<div class="sure" id="download-nav-sure"><div>下载</div></div>
</div>
<!-- start -->
<div class="lcy_starchange lcy_hui">
<!-- banner -->
<?php if ($starexBuyAd_banner) { ?>
<div class="route pur_color">
	<a href="<?= $starexBuyAd_link ?>">
		<img src="<?= $starexBuyAd_banner ?>" class="img-w">
		<div class="content">
			<!-- <p class="title title_color">星换购</p>
			<p class="word pur_color">星币换购享半价</p> -->
			<p class="title getnum">我的星币:<span><?= $coinNum ?>星币</span></p>
		</div>
	</a>
</div>
<?php } ?>
<!-- 分类 -->
<div class="classify">
	<div class="soo-row nav">
		<div class="soo-col-2 btn_item btn_active" data-code="">全部</div>
		<?php foreach ($starexBuyBtn as $d) { ?>
		<div class="soo-col-2 btn_item" data-code="<?= $d['code'] ?>"><?= $d['name'] ?></div>	
		<?php } ?>
		<div class="soo-col-2 select">
			<div class="filter_down">
				<div>筛选</div>
				<div class="img"><img src="../public/img/huilife/star_down@2x.png" alt=""></div>				
			</div>
			<div class="filter_up" style="display:none;">
				<div>筛选</div>
				<div class="img"><img src="../public/img/huilife/star_order@2x.png" alt=""></div>				
			</div>
		</div>	
	</div>
	<div class="interval">
		<p>星币区间</p>
		<div class="box">
			<div class="in_box">
				<input type="number" placeholder="最低价格" id="min_text">
				<span>&minus;</span>
				<input type="number" placeholder="最高价格" id="max_text">
				<img src="../public/img/huilife/getstar_fdj@2x.png" alt="" class="interval_s">	
			</div>
		</div>
		<div class="slide-stage num_node">
			<div data-span="yes" data-coin-min="" data-coin-max="" class="interval_s">&nbsp;全部&nbsp;</div>
			<div data-span="yes" data-coin-min="1" data-coin-max="100" class="interval_s">&nbsp;1~100&nbsp;</div>
			<div data-span="yes" data-coin-min="100" data-coin-max="500" class="interval_s">&nbsp;100~500&nbsp;</div>
			<div data-span="yes" data-coin-min="500" data-coin-max="1000" class="interval_s">&nbsp;500~1000&nbsp;</div>
			<div data-span="yes" data-coin-min="1000" data-coin-max="" class="interval_s">&nbsp;1000以上&nbsp;</div>
		</div>		
	</div>
</div>
<div class="goods">	

<?php  if(!empty($starexBuyM_data)){ ?>
	<?php foreach($starexBuyM_data as $k=>$v):?>
		<?php foreach($v['items'] as $kk=>$_v):?>
	<div class="item clear-f">
		<div class="img float-l"><a href="<?= $url_goods ?>/<?= $_v['id'] ?>.html"><img src="<?php echo $_v['logo']?>" alt=""></a></div>
		<div class="wen float-l">
			<p class="mess"><?php echo $_v['name']?></p>
			<p class="coin">￥<?php echo $_v['promo']['price']?>+<?php echo $_v['promo']['coin']?>星币</p>
			<p class="piece">市场参考价：￥<?php echo $_v['market_price']?></p>
		</div>
	</div>
		<?php endforeach?>
	<?php endforeach?>
<?php  } ?>
</div>
</div><!-- end -->
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
<script src="/public/js/huilife/starpurchase.js"></script>
</body>
</html>