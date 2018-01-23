	<?php if ($result['data']) { ?>
	<?php foreach ($result['data'] as $vo) { ?>
	<div class="perOrderBox" order-no = "<?= $vo['order_id'] ?>">
		<div class="">
			<div class="orderProduct orderHead <?= ($vo['delivery_type'] == 5 ? '' : 'goods_details') ?>"  order-no = "<?= $vo['order_id'] ?>">
				<div class="orderTip">
					<?= $vo['status_text'] ?>
				</div>
				<span class="shopName"><?= $vo['shop_name'] ?></span>
				<span class="orderNo">订单号：<?= $vo['order_no'] ?></span>  
			</div>
			<?php foreach ($vo['goods'] as $voo) { ?>   <!-- 订单中的商品 -->
			<div class="orderProduct clearfix" order-no = "<?= $vo['order_id'] ?>" >
				<div class="productImage">
				<?php if ($vo['delivery_type'] == 5) { ?>
					<img src="/public/img/qianbao.png"/>
				<?php } ?>
				<?php if ($vo['delivery_type'] != 5) { ?>
					<a href="<?= $url_goods ?>/<?= $voo->sku_id ?>.html"><img src="<?= $voo->logo ?>"/></a>
				<?php } ?>
				</div>
				<div class="productName">
					<?php if ($vo['delivery_type'] == 5) { ?>
						<a href="#"><p>【钱包充值】</p></a>
					<?php } ?>
					<?php if ($vo['delivery_type'] != 5) { ?>
						<a href="<?= $url_goods ?>/<?= $voo->sku_id ?>.html"><p><?= $voo->sku_name ?></p></a>
					<?php } ?>
					<p class="subInfo">
						<?= $voo->speces ?>
					</p>
				</div>
				<div class="productPrice">
					<p>
					 <?php if ($voo->coin == 0) { ?>
					 <img src="/public/img/starIcon_1.png">
					 <?php } else { ?>
					 <img src="/public/img/starIcon.png">
					 <?php } ?>
						<span class="starCount"><?= $voo->coin ?></span> + ¥<?= ($voo->sku_price) / 100 ?>
					</p>
					<p class="subInfo">
						×<?= $voo->qty ?>
					</p>
					<?php if ($vo['status'] == 8) { ?>
				    <p><a href="/orders/customer_service.html?id=<?= $vo['order_id'] ?>&sku_id=<?= $voo->sku_id ?>" class="btnCommon btnOrange " orderno="<?= $vo['order_no'] ?>" data-order-id="<?= $vo['order_no'] ?>"> 售后 </a></p>
					<?php } ?> 
				</div>
			</div>
		<?php } ?>
		</div>
		</a>
		<div class="productsNum">
			<span>共计<?= $vo['count_number'] ?>件商品(邮费:&yen;<?= $vo['count_express'] ?>)</span>
			<span class="productsPrice"> <?php if ($vo['count_coin'] == 0) { ?><img src="/public/img/starIcon_1.png"><?php } else { ?><img src="/public/img/starIcon.png"><?php } ?><span class="starCount"><?= $vo['count_coin'] ?></span> + ¥<?= ($vo['count_pay']) / 100 ?> </span>
		</div>
		
		<?php if ($vo['delivery_type'] != 5) { ?>
		<div class="orderButtons"
			order-no="<?= $vo['order_no'] ?>" data-order-id="<?= $vo['order_no'] ?>" url_order=<?= $url_order ?>
		>
			<?php if ($vo['status'] == 0 || $vo['status'] == 1 || $vo['status'] == 2) { ?>
				<a href="javascript:void(0)" class="btnCommon btnGray cancel" orderno="<?= $vo['order_no'] ?>" data-type="<?= $vo['type'] ?>" data-order-id="<?= $vo['order_id'] ?>"> 取消订单 </a>
			<?php } ?>
			<?php if ($vo['status'] == 7) { ?>
				<a href="/orders/details/deliverinfo/<?= $vo['order_id'] ?>.html" class="btnCommon btnGray " orderno="<?= $vo['order_no'] ?>" data-order-id="<?= $vo['order_id'] ?>"> 查看物流 </a>
			<?php } ?>
			<?php if ($vo['status'] == 0 || $vo['status'] == 1) { ?>
				<a href="javascript:void(0)" class="btnCommon btnOrange pay" sku_id="<?= $vo['order_no'] ?>" qty="<?= $vo['count_number'] ?>" order_id ="<?= $vo['order_id'] ?>"> 去支付 </a>
			<?php } ?>
			<?php if ($vo['status'] == 7) { ?>
				<a href="javascript:void(0)" class="btnCommon btnOrange affirm" orderno="<?= $vo['order_no'] ?>" data-order-id="<?= $vo['order_id'] ?>"> 确认收货 </a>
			<?php } ?>
			<!-- <?php if ($vo['status'] == 8) { ?>
				<a href="/orders/customer_service.html?id=<?= $vo['order_no'] ?>" class="btnCommon btnOrange customer" orderno="<?= $vo['order_no'] ?>" data-order-id="<?= $vo['order_no'] ?>"> 售后 </a>
			<?php } ?>  -->
			<?php if ($vo['status'] == 8 && $vo['comment'] == 'N') { ?>
				<a href="javascript:void(0)" class="btnCommon btnOrange comment" orderno="<?= $vo['order_no'] ?>" data-order-id="<?= $vo['order_id'] ?>"> 评论 </a>
			<?php } ?>
		</div>
		<?php } ?>

	</div>

	<?php } ?>
	<?php } else { ?>
	<div class="searchno" style="width:70%;"><img src="/public/img/orders/sss_03.png" /><br /><br /><b>暂无订单</b></div>
	<?php } ?>

