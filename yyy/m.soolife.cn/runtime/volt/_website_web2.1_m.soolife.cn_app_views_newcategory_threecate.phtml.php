<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|三级分类</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>  
	<link rel="stylesheet" type="text/css" href="/public/css/newcategory/threecate.css"/>
	<script src="/public/js/rem2.js"></script> 
</head>
<body>
<!-- 搜索框页面 -->
<!-- <div id="search_box" style="display:none;" data-firstcode="<?= $urlcode['firstcode'] ?>">
	<div id="head">
		<div id="head-left"  onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>

		<div id="head-right">搜索</div>
		<div id="head-center"><input type="text" id="inputbox" placeholder="搜索商品"/><img src="/public/img/newcategory/ser.png"></div>
	</div>
	<div id="top_place"></div>
	<div class="search_display">
		<p id="new">最近搜索</p>
		<div id="newbox"> 
			<div id="box"></div>
			<div id="remove">清除</div>
		</div>
		<p id="new">热门搜索</p>
		<div id="newbox">
		<?php if ($hot) { ?>
		<?php foreach ($hot as $d) { ?>
			<a href="/newcategory/threecate.html?firstcode=&keyword=<?= $d['name'] ?>&csstag=9"><span><?= $d['name'] ?></span></a>
		<?php } ?>
		<?php } ?>
		</div>
	</div>
	<ul class="search_display_list">
		
	</ul>
</div> -->
<input type="hidden" id="firstcode" value="<?= $firstcode ?>">
<input type="hidden" id="twocode" value="<?= $twocode ?>">
<input type="hidden" id="threecode" value="<?= $threecode ?>">
<input type="hidden" id="keyword" value="<?= $keyword ?>">
<input type="hidden" id="brand_id" value="<?= $brand_id ?>">
<input type="hidden" id="shop_id" value="<?= $shop_id ?>">
<input type="hidden" id="countries" value="<?= $countries ?>">
<input type="hidden" id="specs" value="<?= $specs ?>">
<input type="hidden" id="_kai" value="<?= $_kai ?>">
<input type="hidden" id="_jie" value="<?= $_jie ?>">
<input type="hidden" id="span_str" value="<?= $span_str ?>">
<div id="threecate" data-csstag="<?= $csstag ?>" data-itemurl="<?= $url_goods ?>">
	 <!-- 头部	 -->
	<div id="head">
		<div id="head-left"  onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<div id="head-right" ><a href="/search.html"><img src="/public/img/newcategory/Group3Copy.png" alt=""></a></div>
		<div id="head-center" class="between">
			<?php foreach ($categoryresult as $item) { ?>
				<?php if ($item['id'] == $urlcode['firstcode']) { ?>
					<?= $item['name'] ?>
					<?php break ?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
	<div id="top_place"></div>
<?php if ($csstag != 9) { ?>
    <?php if($firstcode != ""){ ?> 
	<div id="top_place2"></div> 
 	<div id="nav" class="slide-stage">
		<?php foreach ($categoryresult as $item) { ?>
			<?php if ($item['id'] == $urlcode['firstcode']) { ?>
				<?php if(count($item['items']) > 0) { ?>
			 		<a href="/newcategory/threecate.html?firstcode=<?= $urlcode['firstcode'] ?>&twocode=allcode">
			 			<div class="item <?php if ('allcode' == $urlcode['twocode']) { ?> active <?php } ?>">全部</div>
			 		</a>
					<?php foreach ($item['items'] as $it) { ?> 
						<a href="/newcategory/threecate.html?firstcode=<?= $urlcode['firstcode'] ?>&twocode=<?= $it['id'] ?>"><div class="item <?php if ($it['id'] == $urlcode['twocode']) { ?> active <?php } ?>"><?= $it['name'] ?></div></a>
					<?php } ?>
					
		 		<?php } ?>
				<?php break ?>
			<?php } ?>
		<?php } ?> 
 	</div>
    <?php } ?>
 	<?php if ('allcode' != $urlcode['twocode']) { ?>		 
 	<div id="twostate" class="slide-stage bg-white margin-b">
 		<?php foreach ($categoryresult as $item) { ?>
			<?php if ($item['id'] == $urlcode['firstcode']) { ?>
				<?php foreach ($item['items'] as $it) { ?> 
					 <?php if ($it['id'] == $urlcode['twocode']) { ?>
					 	<?php foreach ($it['items'] as $d) { ?>		
					 		<a href="/newcategory/threecate.html?firstcode=<?= $urlcode['firstcode'] ?>&twocode=<?= $it['id'] ?>&threecode=<?= $d['id'] ?>">
					 		<div class="item">
					 			<div class="imgbox">
					 				<img src="<?= $d['img'] ?>">
					 			</div>
					 			<p class="<?php if ($d['id'] == $urlcode['threecode']) { ?>active<?php } ?>"><?= $d['name'] ?></p>
					 		</div>
					 		</a>
					 	<?php } ?>					 	 
					 <?php } ?>
				<?php } ?>
				<?php break ?>
			<?php } ?>
		<?php } ?> 
 	</div>
 	<?php } ?>
<?php } ?>
 	<div id="catebtn_box" data-categories="<?= $categories ?>">
	 	<div id="catebtn" class="soo-row bg-white margin-b">
	 		<div class="soo-col-2 filter_btn active" data-sort="hot_desc"><span>人气 </span></div>
	 		<div class="soo-col-2 filter_btn" data-sort="sale_desc"><span>销量</span></div>
	 		<div class="soo-col-2 filter_btn" data-sort="new_desc"><span>新品</span></div>
	 		<div class="soo-col-2" id="filter_piece">
		 		<span>价格</span>
		 		<img src="/public/img/newcategory/jiage(1).png" id="piecea">
		 		<img src="/public/img/newcategory/jiage(2).png" style="display:none" id="piecev">
		 	</div>
	 		<div class="soo-col-2" id="filter_view">
	 			<div class="border_l">
		 		<img src="/public/img/newcategory/shanxuk.png" class="inlienb">
		 		<img src="/public/img/newcategory/shanxuh.png" style="display:none;" class="blockb">	
	 			</div>
	 		</div>
	 		<div class="soo-col-2" id="filter_lou"><span>筛选</span><img src="/public/img/newcategory/loudou.png"></div>
	 	</div>	
 	</div>
 	<!-- 删选之后 -->
 	<?php if ($spandata) { ?> 				
 	<div id="filtered" class="slide-stage">
 		<?php foreach ($spandata as $item) { ?>
 		<span><?= $item ?></span>  
 		<?php } ?>	
 	</div>
 	<?php } ?>
	<!-- 人气 -->
	<input type="hidden" id="skip" value="1">
 	<div id="sentiment" class="blockstyle">
 	<?php if ($goodsresult) { ?>
	 	<?php if ($goodsresult['items']) { ?>			
	 		<?php foreach ($goodsresult['items'] as $items) { ?> 
	 		<div class="item bg-white margin-b">
	 			<div class="img_box float-l">
	 				<a href="<?= $url_goods ?>/<?= $items['items'][0]['id'] ?>.html"><img src="<?= $items['items'][0]['logo'] ?>"></a>
	 				<?php if ($items['items'][0]['type'] == 1) { ?>
	 					<p class="tag">海外精品</p> 	
	 				<?php } ?>
	 			</div>
	 			<div class="wen_box float-l">
	 				<p class="name"><?= $items['items'][0]['name'] ?></p>
	 				<?php if ($items['items'][0]['type'] == 1) { ?><p class="smalltag"><span>海外精品</span></p><?php } ?>
	 				<!-- <p class="sales">销量:132</p> -->
	 				<?php if ($items['items'][0]['promo']['type'] == 0) { ?>
	 				<p class="piece"><?php if ($items['items'][0]['promo']['price'] != 0) { ?>￥<?= $items['items'][0]['promo']['price'] ?><?php } ?><?php if ($items['items'][0]['promo']['coin'] != 0) { ?> +<?= $items['items'][0]['promo']['coin'] ?>星币 <?php } ?></p>
	 				<?php } else { ?>

	 				<p class="piece">
						<?php if ($items['items'][0]['promo']['price'] != 0) { ?>
							<span>￥<?= $items['items'][0]['promo']['price'] ?></span>
						<?php } ?>
						<?php if ($items['items'][0]['promo']['coin'] != 0) { ?>
						<?php if ($items['items'][0]['promo']['price'] != 0) { ?>
						<span>+</span>
						<?php } ?> 
						<?php } ?>
						<?php if ($items['items'][0]['promo']['coin'] != 0) { ?>
							<span><?= $items['items'][0]['promo']['coin'] ?>星币</span>
						<?php } ?>
					</p>

	 				<?php } ?>  
	 			</div>
	 		</div>
	 		<?php } ?> 
		<?php } else { ?>
			<img src="/public/img/huilife/no_goods.png" alt="" style="margin:0 auto;width:60%">
	 	<?php } ?>
 	<?php } ?>
 	</div>
</div>
<script>
	var categoryjson = <?= $categoryjson ?>; 
	var parms = <?= $parms ?>; 
	console.log(parms); 
</script>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/newcategory/threecate.js"></script>