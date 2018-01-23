<?php if ($hot) { ?>
	<?php $v156527160860420418111iterator = $hot; $v156527160860420418111incr = 0; $v156527160860420418111loop = new stdClass(); $v156527160860420418111loop->self = &$v156527160860420418111loop; $v156527160860420418111loop->length = count($v156527160860420418111iterator); $v156527160860420418111loop->index = 1; $v156527160860420418111loop->index0 = 1; $v156527160860420418111loop->revindex = $v156527160860420418111loop->length; $v156527160860420418111loop->revindex0 = $v156527160860420418111loop->length - 1; ?><?php foreach ($v156527160860420418111iterator as $d) { ?><?php $v156527160860420418111loop->first = ($v156527160860420418111incr == 0); $v156527160860420418111loop->index = $v156527160860420418111incr + 1; $v156527160860420418111loop->index0 = $v156527160860420418111incr; $v156527160860420418111loop->revindex = $v156527160860420418111loop->length - $v156527160860420418111incr; $v156527160860420418111loop->revindex0 = $v156527160860420418111loop->length - ($v156527160860420418111incr + 1); $v156527160860420418111loop->last = ($v156527160860420418111incr == ($v156527160860420418111loop->length - 1)); ?>
	<?php $css = ($v156527160860420418111loop->last ? 'right' : ''); ?>
document.write('	<div class="item <?= $css ?>">');
document.write('		<div class="logo frame">');
document.write('			<div class="move">');
document.write('				<a href="<?= $url_goods ?>/<?= $d['sku_id'] ?>.html" target="_blank"><img class="lazy" src="/public/v3.0.1/img/s.gif"  data-original="<?php echo $this -> utility -> get_goods_picture($d['logo']); ?>" title="<?= $d['sku_name'] ?>" alt="<?= $d['sku_name'] ?>"/> </a>');
document.write('			</div>');
document.write('		</div>');
document.write('		<div class="name">');
document.write('			<p class="line-70">');
document.write('				<a href="<?= $url_goods ?>/<?= $d['sku_id'] ?>.html" target="_blank"> <?= $d['sku_name'] ?> </a>');
document.write('			</p>');
document.write('			<p  class="line-40">');
document.write('				<span class="price orange">&yen; <?= $d['act_price'] ?></span>');
document.write('				<span class="price orange"><?php echo $d['coin'] ? " + ".$d['coin']." 星币" : "";?></span>');
document.write('			</p>');
document.write('		</div>');
document.write('		<div class="button">');
document.write('			<a href="<?= $url_goods ?>/<?= $d['sku_id'] ?>.html" target="_blank"> 我要购买 </a>');
document.write('		</div>');
document.write('	</div>');
	<?php $v156527160860420418111incr++; } ?>
<?php } ?>
