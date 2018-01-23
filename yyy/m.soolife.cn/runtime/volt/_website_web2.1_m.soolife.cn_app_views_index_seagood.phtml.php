<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>海外精品|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
   <link rel="stylesheet" type="text/css" href="/public/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/public/css/seagood/seagood.css"/>
</head>
<body>
<div class="lcy_seagood">
	<!-- 头部 -->
	<header class="header_top" style="background: #666;" >
        <div class="back back_btn" onclick="javascript:history.go(-1)"></div>
        <div class="title">海外精品</div>
        <div class="back2 back2_btn"></div>
	</header>
	<!-- 热搜 -->
	<div class="search_page">
		<div class="search_page_top">
				<div class="none">
				</div>
				<div class="search_box_big">			
					<input type="text" placeholder="搜索您喜欢的店铺和商品" class="search_box" id="text"/>
					<img src="/public/img/index/search_box.png" alt="" class="search" url_search=<?= $url_search ?>>
				</div>
				<div class="header_top_box hide_x">
				</div>
		</div>
		<div class="hot_main">
			<p>历史记录：<img src="/public/img/shopping_clear.png" alt="" class="clear_img"></p>
			<ul class="history">
			
			</ul>
		</div>
	</div>
	<div class="main_box">
		<!-- 轮播 -->
		<div id="slider" class="mui-slider" >
			<div class="mui-slider-group mui-slider-loop">
				<!-- 额外增加的一个节点(循环轮播是最后一张轮播) -->
				<?php if(!empty($data['app.overseas.main']['children']['app.overseas.main.banner']['items'])) { ?>
				<?php  $k = count($data['app.overseas.main']['children']['app.overseas.main.banner']['items']);$k--  ?>
				<div class="mui-slider-item mui-slider-item-duplicate">
					<a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.banner']['items'][$k]['mobile_link'] ?>">
						<img src="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.banner']['items'][$k]['picture'] ?>">
					</a>
				</div>
				<?php  } ?>

				<?php if(!empty($data['app.overseas.main']['children']['app.overseas.main.banner']['items'])) { ?>
				<?php foreach ($data['app.overseas.main']['children']['app.overseas.main.banner']['items'] as $d) { ?>
				<!-- 循环 -->
				<div class="mui-slider-item">
					<a href="<?= $d['mobile_link'] ?>">
						<img src="<?= $d['picture'] ?>">
					</a>
				</div>
				<?php } ?>
				<?php  } ?>
				<!-- 额外增加的一个节点(循环轮播是第一张轮播) -->
				<?php if(!empty($data['app.overseas.main']['children']['app.overseas.main.banner']['items'])) { ?>
				<div class="mui-slider-item mui-slider-item-duplicate">
					<a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.banner']['items'][0]['mobile_link'] ?>">
						<img src="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.banner']['items'][0]['picture'] ?>">
					</a>
				</div>
				<?php  } ?>
			</div>
			<div class="mui-slider-indicator">
				 <?php foreach ($data['app.overseas.main']['children']['app.overseas.main.banner']['items'] as $i => $d) { ?>
				 <div class="<?= ($i == 0 ? 'mui-indicator mui-active' : 'mui-indicator') ?>"></div>
				 <?php } ?>
			</div>
		</div>
		<!-- 国家小图标 -->
		<div class="country_icon">
			<ul>
			<?php if(!empty($mata['items'])) { ?>
			<?php foreach ($mata['items'] as $i) { ?>
				<li><a href="<?= $url_search ?>/seas/<?= $i['code'] ?>.html">
					<img src="http://static.soolife.cn<?= $i['icon'] ?>" alt="">
					<p><?= $i['name'] ?></p>
				</a></li>
			<?php } ?>
			<?php } ?>
			</ul>
		</div>
		<!-- 快速小nav -->
		<div class="nav w">
			<ul>
			    <?php if ($data['app.overseas.main']['children']['app.overseas.main.category01']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category01']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category01']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category01']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category02']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category02']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category02']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category02']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>

				<?php if ($data['app.overseas.main']['children']['app.overseas.main.category03']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category03']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category03']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category03']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category04']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category04']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category04']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category04']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category05']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category05']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category05']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category05']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category06']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category06']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category06']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category06']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category07']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category07']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category07']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category07']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category08']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category08']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category08']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category08']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category09']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category09']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category09']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category09']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>
                
                <?php if ($data['app.overseas.main']['children']['app.overseas.main.category10']['items']) { ?>
				<li><a href="<?php  echo $data['app.overseas.main']['children']['app.overseas.main.category10']['items'][0]['mobile_link'] ?>">
					<img src="<?php echo $data['app.overseas.main']['children']['app.overseas.main.category10']['items'][0]['picture'] ?>" alt="">
					<p><?php echo $data['app.overseas.main']['children']['app.overseas.main.category10']['items'][0]['title'] ?></p>
				</a></li>
				<?php } ?>

			</ul>
		</div>
		<!-- 限量快抢 -->
		<!-- <p class="fast_title">限量快抢</p> -->
		<div class="fast">
			<!-- 循环
			<div class="fast_good">
				<div class="img_box"><img src="/public/img/seagood/fast_good.png" alt=""></div>
				<p class="deatil w">Stiler glert</p>
				<p class="piece_box w">
					<span>￥<span class="piece">123.33</span></span>
					<span class="red_bg">仅剩9件</span>
				</p>
			</div>
			循环结束
			循环
			<div class="fast_good">
				<div class="img_box"><img src="/public/img/seagood/fast_good.png" alt=""></div>
				<p class="deatil w">Stiler glert</p>
				<p class="piece_box w">
					<span>￥<span class="piece">123.33</span></span>
					<span class="red_bg">仅剩9件</span>
				</p>
			</div>
			循环结束
			循环
			<div class="fast_good">
				<div class="img_box"><img src="/public/img/seagood/fast_good.png" alt=""></div>
				<p class="deatil w">Stiler glert</p>
				<p class="piece_box w">
					<span>￥<span class="piece">123.33</span></span>
					<span class="red_bg">仅剩9件</span>
				</p>
			</div>
			循环结束
			循环
			<div class="fast_good">
				<div class="img_box"><img src="/public/img/seagood/fast_good.png" alt=""></div>
				<p class="deatil w">Stiler glert</p>
				<p class="piece_box w">
					<span>￥<span class="piece">123.33</span></span>
					<span class="red_bg">仅剩9件</span>
				</p>
			</div>
			循环结束
			循环
			<div class="fast_good">
				<div class="img_box"><img src="/public/img/seagood/fast_good.png" alt=""></div>
				<p class="deatil w">Stiler glert</p>
				<p class="piece_box w">
					<span>￥<span class="piece">123.33</span></span>
					<span class="red_bg">仅剩9件</span>
				</p>
			</div>
			循环结束 -->
		</div>
		<!-- 品牌馆 -->
		<p class="m_title">|&nbsp;&nbsp;品牌馆</p>
		<div class="brand w">
			<div class="good_box_t w">
			    
				<div class="box_1">
				<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.01']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.01']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.01']['items'][0]['picture'] ?>" alt=""></a>
				<?php } ?>
				</div>
				
				<div class="box_2">
				<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.02']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.02']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.02']['items'][0]['picture'] ?>" alt=""></a>
				<?php } ?>
				</div>

				<div class="box_2">
				<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.03']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.03']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.03']['items'][0]['picture'] ?>" alt=""></a>
				<?php } ?>
				</div>

				<div class="box_2">
				<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.04']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.04']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.04']['items'][0]['picture'] ?>" alt=""></a>
				<?php } ?>
				</div>

				<div class="box_2">
				<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.05']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.05']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.05']['items'][0]['picture'] ?>" alt=""></a>
				<?php } ?>
				</div>
			</div>
			<div class="good_box_c w">
				<div class="box_l">				
					<div class="box_2">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.06']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.06']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.06']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
					<div class="box_2">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.07']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.07']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.07']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
					<div class="box_2">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.08']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.08']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.08']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
					<div class="box_2">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.09']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.09']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.09']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
				</div>
				<div class="box_r">
					<div class="box_1">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.10']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.10']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.10']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
				</div>
			</div>
			<div class="good_box_b w">			
					<div class="box_1"><a href="">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.11']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.11']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.11']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
					<div class="box_1">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.12']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.12']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.12']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
					<div class="box_1">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.13']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.13']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.13']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
					<div class="box_1">
					<?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.14']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.14']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.14']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
					</div>
			</div>
		</div>
		<!-- 小banner -->
	    <div class="banner_top w">
	    	        <?php if(!empty($data['app.overseas.brand']['children']['app.overseas.brand.column']['items'])) { ?>
					<a href="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.column']['items'][0]['mobile_link'] ?>">
					<img src="<?php  echo $data['app.overseas.brand']['children']['app.overseas.brand.column']['items'][0]['picture'] ?>" alt=""></a>
				    <?php } ?>
	    </div>	
		<!-- 全球优品 -->
		<p class="m_title">|&nbsp;&nbsp;全球优品</p>
		<div class="best w">
	       <div class="goodslist" url_goods=<?= $url_goods ?>>
	        	<!-- 循环
	        	<?php foreach ($boutique['items'] as $k) { ?>
	        		            <a href="<?= $url_goods ?>/<?= $k['id'] ?>.html"><div class="goodsbox">
	        		                <div class="goods_img">
	        		                    <img src="<?= $k['logo'] ?>" alt=""></a>
	        		                </div>
	        		                <div class="goods_content">
	        		                    <p class="word">
	        		                        <span class="color">海外精品</span>
	        		                        <?= $k['name'] ?>
	        		                    </p>
	        		                    <div class="content_l">
	        		                        <p class="piece">
	        		                            ￥<span><?= $k['price'] ?></span>
	        		                            <span class="discount"></span>
	        		                        </p>
	        		                        <p class="date"><del>￥<?= $k['market_price'] ?></del></p>
	        		                    </div>
	        		                    <div class="content_r">
	        		                        <p class="country">
	        		                        	<img src="/public/img/seagood/country_i.png" alt="">
	        		                        	<span></span>
	        		                        </p>
	        		                    </div>                   
	        		                </div>               
	        		            </div>
	        		            </a>
	        		            <?php } ?>
	        	循环结束 -->
	        	
	        </div>
		</div>	
	</div>
		
</div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/rem.js"></script>
<script src="/public/js/seagood/seagood.js"></script>
<script src="/public/js/m_analytics.js"></script>
<script src="/public/js/sdk.2.2.js"></script>
