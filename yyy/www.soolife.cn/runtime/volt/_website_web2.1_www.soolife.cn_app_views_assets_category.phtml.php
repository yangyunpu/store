document.write('<div class="navbar">');
document.write('	<div class="nav">');
document.write('		<div class="category left">');
document.write('			<h4>全部商品分类<i class="fa fa-angle-down fa-lg"></i></h4>');
document.write('			<div class="category-dropdown <?php if ($hide == 1) { ?> hidden <?php } ?>">');
document.write('				<div class="category-menus">');
document.write('					<ul>');
						<?php foreach ($category as $d) { ?>
document.write('						<li>');
document.write('							<a href="<?= $url_search ?>/cat/<?= Phalcon\Text::lower($d['id']) ?>.html"><?= $d['name'] ?></a>');
document.write('							<i class="fa fa-angle-right fa-lg"></i>');
document.write('						</li>');
						<?php } ?>
document.write('					</ul>');
document.write('				</div>');
document.write('				<div class="category-pannel">');
<?php 
$i=1; 
?>
					<?php foreach ($category as $d) { ?>
document.write('					<div class="pannel">');
document.write('						<div class="content" <?php if (Phalcon\Text::lower($d['code']) == 'j') { ?> style="height: 840px;" <?php } ?>>');
							<?php foreach ($d['children'] as $d2) { ?>
document.write('							<div class="tags-bd">');
document.write('								<h5><a href="<?= $url_search ?>/cat/<?= Phalcon\Text::lower($d2['id']) ?>.html" target="_blank"><?= $d2['name'] ?></a></h5>');
document.write('								<p>');

<?php if (array_key_exists('children', $d2)) { ?>
									<?php foreach ($d2['children'] as $d3) { ?>
document.write('									<a href="<?= $url_search ?>/cat/<?= Phalcon\Text::lower($d3['id']) ?>.html" target="_blank"><?= $d3['name'] ?></a>');
									<?php } ?>
<?php } ?>
document.write('								</p>');
document.write('							</div>');
							<?php } ?>
document.write('						</div>');
document.write('						<div class="adverts clearfix">');
document.write('							<div class="clearfix">');

<?php
$mm = str_pad($i,3,'0',STR_PAD_LEFT);

$key = "pc.catgoods.floor{$mm}.brands";
if (isset($ads) && array_key_exists($key, $ads))
{
	$brands = $ads[$key];
	foreach ($brands as $k1 => $v1) {
		
		?>
		document.write('								<div class="box-120x50 left">');
		document.write('									<a target="_blank" href="<?php echo $v1['pc_link'];?>">');
		document.write('										<img alt="<?php echo $v1['title'];?>" title="<?php echo $v1['title'];?>" src="<?php echo $this->utility->get_advert_picture($v1['picture']);?>" style="display: inline;"></a>');
		document.write('								</div>');
		<?php
	}
}
?>
document.write('							</div>');
document.write('							<div class="hr-20"></div>');
document.write('							<div class="clearfix">');
<?php
$key = "pc.catgoods.floor{$mm}.column";
if (isset($ads) && array_key_exists($key, $ads))
{
	$brands = $ads[$key];
	foreach ($brands as $k1 => $v1) {
		
		?>
		document.write('								<div class="box-250x120 left" >');
		document.write('									<a target="_blank" href="<?php echo $v1['pc_link'];?>">');
		document.write('										<img alt="<?php echo $v1['title'];?>" title="<?php echo $v1['title'];?>" src="<?php echo $this->utility->get_advert_picture($v1['picture']);?>" style="display: inline;"></a>');
		document.write('								</div>');
		<?php
	}
}
?>
document.write('							</div>');
document.write('						</div>');
document.write('					</div>');
<?php $i++; ?>
					<?php } ?>

document.write('				</div>');
document.write('			</div>');
document.write('		</div>');
document.write('		<div class="lists left">');
document.write('			<ul>');
document.write('				<li>');
document.write('					<a href="<?= $url_website ?>/index.html" <?php if ($nav == 'home') { ?> class="active" <?php } ?> target="_blank">首  页</a>');
document.write('				</li>');
document.write('				<li>');
document.write('					<a href="<?= $url_website ?>/overseas.html" <?php if ($nav == 'overseas') { ?> class="active" <?php } ?>  target="_blank">海外精品</a>');
document.write('				</li>');
document.write('				<!--li-->');
document.write('					<!--a href="/market.html" <?php if ($nav == 'market') { ?> class="active" <?php } ?>  target="_blank">星超市</a-->');
document.write('				<!--/li-->');
document.write('				<li>');
document.write('					<a href="<?= $url_website ?>/clothes.html" <?php if ($nav == 'clothes') { ?> class="active" <?php } ?>  target="_blank">星范儿</a>');
document.write('				</li>');
document.write('				<li>');
document.write('					<a href="<?= $url_website ?>/discount.html" <?php if ($nav == 'discount') { ?> class="active" <?php } ?>  target="_blank">星特惠</a>');
document.write('				</li>');
document.write('				<li>');
document.write('					<a href="<?= $url_website ?>/vip.html" <?php if ($nav == 'vip') { ?> class="active" <?php } ?>  target="_blank">星粉专区</a>');
document.write('				</li>');
document.write('			</ul>');
document.write('		</div>');
document.write('	</div>');
document.write('</div>');