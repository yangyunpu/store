<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>到店签到</title>
	<link rel="stylesheet" href="/public/css/expstore/expstore.css">
	<!-- <script src="/public/js/rem2.js"></script> -->
</head>
<body>
	<div class="img_box"><img src="/public/img/exp/exp (4).jpg"></div>
	<div class="img_box"><img src="/public/img/exp/exp (1).jpg">
		<div id="box"><img src="<?= $erdata ?>" alt=""></div>
	</div>
	<div class="img_box"><img src="/public/img/exp/exp (2).jpg">
		<p id="word">星币可以兑换商品<br>星币+钱可以兑换饮料</p>
	</div>
	<div class="img_box"><img src="/public/img/exp/exp (3).jpg">
		<div id="goods"> 
			<!-- item -->
			<div class="item">
				<div class="itemimg"><img src="/public/img/exp/12 (1).jpg" alt=""></div>
				<div class="itemword">
					<div class="word_l">
						<p class="name">珍珠花瓣系带露背连衣裙</p>
						<p class="star">0星币</p>
						<p class="plus">+</p>
						<p class="piece">￥595.00</p>
					</div>
					<img src="/public/img/exp/er1.jpg" class="smaller">
				</div>
			</div> 
			<!-- item -->
			<div class="item">
				<div class="itemimg"><img src="/public/img/exp/12 (2).jpg" alt=""></div>
				<div class="itemword">
					<div class="word_l">
						<p class="name">哑铃圈 BYS-A1005A</p>
						<p class="star">0星币</p>
						<p class="plus">+</p>
						<p class="piece">￥250.00</p>
					</div>
					<img src="/public/img/exp/er2.jpg" class="smaller">
				</div>
			</div> 
			<!-- item -->
			<div class="item">
				<div class="itemimg"><img src="/public/img/exp/123.jpg" alt=""></div>
				<div class="itemword">
					<div class="word_l l2">
						<p class="name">西拉橡木 葡萄酒 </p>
						<p class="star">10星币</p>
						<p class="plus">+</p>
						<p class="piece">￥158.00</p>
					</div>
					<img src="/public/img/exp/er3.jpg" class="smaller">
				</div>
			</div> 
			<!-- item -->
			<div class="item">
				<div class="itemimg"><img src="/public/img/exp/1234.jpg" alt=""></div>
				<div class="itemword">
					<div class="word_l l3">
						<p class="name">海尔BCD-268STCU 268L冰箱</p>
						<p class="star">0星币</p>
						<p class="plus">+</p>
						<p class="piece">￥3,379.00</p>
					</div>
					<img src="/public/img/exp/er4.jpg" class="smaller">
				</div>
			</div> 
			<!-- item -->
			<div class="item">
				<div class="itemimg"><img src="/public/img/exp/15.jpg" alt=""></div>
				<div class="itemword">
					<div class="word_l l4">
						<p class="name">carote汤锅ET8124 </p>
						<p class="star">0星币</p>
						<p class="plus">+</p>
						<p class="piece">￥159.00</p>
					</div>
					<img src="/public/img/exp/er5.jpg" class="smaller">
				</div>
			</div> 

		</div>
	</div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script> 
<script>
	function getajax(){ 
		$.ajax({
			url: '/expstore/expstoreajax',
			type: 'GET',
			dataType: 'json',
			success:function(res){
				console.log(res.msg.img_src);
				if(res) $('#box').html('<img src="'+res.msg.img_src+'"/>');  
			}
		});	
	};
	setInterval(function(){
		getajax(); 	
	},2*60*60*1000);//2小时刷新一次 	
</script>	