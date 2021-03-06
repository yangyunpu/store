<?php
$css = $this -> assets -> get('header');
$css -> addCss("public/v3.0.1/css/pc.index.css");

$js = $this -> assets -> get('footer');
$js -> addJs("public/v3.0.1/js/pc.index.js");

$style = '';
if (!empty($banner)) {
	$item = current($banner);
	$style = "background: {$item['bgcolor']} url('{$this->utility->get_advert_picture($item['bgimage'])}') no-repeat center center;";
}
?>

<div class="banner" style="<?= $style ?>">
	<div class="main-container">
		<div class="content">
			<!-- begin carousel -->
			<div id="carousel-index"  class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php if ($banner) { ?>
						<?php $v145229783306666706931iterator = $banner; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $d) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
							<li data-target="#carousel-index" data-slide-to="<?= $v145229783306666706931loop->index0 ?>" <?php if ($v145229783306666706931loop->first) { ?> class="active" <?php } ?>></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
				</ol>
				<div class="carousel-inner" role="listbox">
					<?php if ($banner) { ?>
						<?php $v145229783306666706931iterator = $banner; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $d) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<div class="item  <?php if ($v145229783306666706931loop->first) { ?> active <?php } ?>" 
							data-bgcolor="<?= $d['bgcolor'] ?>" 
							data-bgimage="<?php echo $this -> utility -> get_advert_picture($d['bgimage']); ?>" 
							data-link="<?= $d['link'] ?>" 
							data-id="<?= $d['id'] ?>">
							<a href="<?= $d['link'] ?>" target="_blank">
								<img class="carousel-images" src="<?php echo $this -> utility -> get_advert_picture($d['picture']); ?>" alt="<?= $d['title'] ?>">
							</a>
							<div class="carousel-caption"></div>
							<div class="carousel-floated">
								<div class="picture frame"><div class="move"><?php echo $this -> utility -> get_advert_html('first', $d['sidebar']['first'], FALSE); ?></div></div>
								<div class="picture frame"><div class="move"><?php echo $this -> utility -> get_advert_html('second', $d['sidebar']['second'], FALSE); ?></div></div>
								<div class="picture frame"><div class="move"><?php echo $this->utility->get_advert_html('third',$d['sidebar']['third'],FALSE); ?></div></div>
								<div class="picture frame"><div class="move"><?php echo $this->utility->get_advert_html('fourth',$d['sidebar']['fourth'],FALSE); ?></div></div>
							</div>
						</div>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
				</div>
			</div>
			<!-- end carousel -->
			
		</div>
	</div>
</div>

<div class="row-container clearfix">
	<div class="subject main-container">
	<?php	
	$subject = array("pc.home.banner.007","pc.home.banner.008","pc.home.banner.009","pc.home.banner.010","pc.home.banner.011");
	foreach ($subject as $val) {
		if ($val==end($subject))
			$css = "right";
		else 
			$css = "left";
	?>	
		<div class="box <?= $css ?>">
			<div class="picture frame">
				<div class="move">
				<?php echo $this -> utility -> get_advert_direct($val, $ads); ?>
				</div>
			</div>
		</div>
	<?php
			}
	?>
	</div>
</div>

<div class="row-container clearfix">
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_direct('pc.home.banner.012', $ads); ?>
	</div>
</div>

<!-- 主题活动 -->
<div id="thematic" class="row-container clearfix">
	<div class="thematic main-container">
		<div class="title">
			<?php echo $this -> utility -> get_advert_direct('pc.home.selection.title', $ads); ?>
		</div>
		<div class="area">
			<?php	
			$subject = array("pc.home.selection.001","pc.home.selection.002","pc.home.selection.003","pc.home.selection.004","pc.home.selection.005","pc.home.selection.006");
			foreach ($subject as $val) {
				$item = $this->utility->get_advert_current($val,$ads);
				?>
				<div class="box left frame">
					<div  class="move">
						<?php echo $this -> utility -> get_advert_direct($val, $ads); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<!-- 品牌推荐 -->
<div id="brand" class="row-container clearfix">
	<div class="brand main-container">
		<div class="title">
			<span>品牌推荐</span>
		</div>
		<div class="content">
			<div class="left frame">
				<div class="move">
					<?php echo $this -> utility -> get_advert_direct('pc.home.brand.001', $ads); ?>
				</div>
			</div>
			<div class="center">
<?php	
if ($ads)
{
	if (array_key_exists('pc.home.brand.002', $ads))
	{
		$empty_image = $this->config->application->empty_image;
		$items = $ads["pc.home.brand.002"];
		foreach ($items as $k=>&$v) {
			$v['picture'] = $this->utility->get_advert_picture($v['picture']);
	?>	
				<div class="box frame">
					<div class="move">
						<a class="logo" href="<?= $v['pc_link'] ?>" target="_blank" title="<?= $v['title'] ?>"><img class="lazy" src="<?= $v['picture'] ?>" title="<?= $v['title'] ?>" alt="<?= $v['title'] ?>" /></a>
					</div>
				</div>
	<?php
		}
	}
}
 ?>
			</div>
			<div class="right">
				<div class="box1 frame">
					<div class="move">
						<?php echo $this -> utility -> get_advert_direct('pc.home.brand.003', $ads); ?>
					</div>
				</div>
				<div class="box2 frame">
					<div class="move">
						<?php echo $this -> utility -> get_advert_direct('pc.home.brand.004', $ads); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_direct('pc.home.brand.column', $ads); ?>
	</div>
</div>

<!-- 1F 服饰鞋帽 -->
<div id="floor1" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>1F 服饰鞋帽</span>
		</div>
		<div class="content">
			<div class="f1 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['1F 服饰鞋帽']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-220x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-440x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods04', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.goods07', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.001.column', $ads); ?>
	</div>
</div>

<!-- 2F 食品酒水 -->
<div id="floor2" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>2F 食品酒水</span>
		</div>
		<div class="content">
			<div class="f2 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['2F 食品酒水']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-440x125 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-440x125 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods04', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.goods07', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.002.column', $ads); ?>
	</div>
</div>

<!-- 3F 母婴玩具 -->
<div id="floor3" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>3F 母婴玩具</span>
		</div>
		<div class="content">
			<div class="f3 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['3F 母婴玩具']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="t-440x250 left">
						<div class="box-440x125 left">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods04', $ads); ?>
						</div>
						<div class="box-440x125 left">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods05', $ads); ?>
						</div>
					</div>
					<div class="t-440x250 right">
						<div class="box-220x250 left frame">
							<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods06', $ads); ?>
							</div>
						</div>
						<div class="box-220x250 left frame">
							<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.goods07', $ads); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.003.column', $ads); ?>
	</div>
</div>

<!-- 4F 日用百货 -->
<div id="floor4" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>4F 日用百货</span>
		</div>
		<div class="content">
			<div class="f4 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['4F 日用百货']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods04', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.goods07', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.004.column', $ads); ?>
	</div>
</div>

<!-- 5F 智能电配 -->
<div id="floor5" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>5F 智能电配</span>
		</div>
		<div class="content">
			<div class="f5 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['5F 智能电配']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods04', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.goods07', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.005.column', $ads); ?>
	</div>
</div>

<!-- 6F 个护化妆 -->
<div id="floor6" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>6F 个护化妆</span>
		</div>
		<div class="content">
			<div class="f6 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['6F 个护化妆']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods04', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.goods07', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.006.column', $ads); ?>
	</div>
</div>

<!-- 7F 箱包饰品 -->
<div id="floor7" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>7F 箱包饰品</span>
		</div>
		<div class="content">
			<div class="f7 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['7F 箱包饰品']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-440x125 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods02', $ads); ?>
						</div>
					</div>
					<div class="t-440x125 left">
						<div class="box-220x125 left frame">
							<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods03', $ads); ?>
							</div>
						</div>
						<div class="box-220x125 left frame">
							<div class="move">
							<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods04', $ads); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods07', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.goods08', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.007.column', $ads); ?>
	</div>
</div>

<!-- 8F 户外运动 -->
<div id="floor8" class="row-container clearfix">
	<div class="floor main-container">
		<div class="title">
			<span>8F 户外运动</span>
		</div>
		<div class="content">
			<div class="f8 left">
				<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.banner', $ads); ?>
				<div class="inside-tags">
					<ul>
					<?php if ($floor_words) { ?>
						<?php $v145229783306666706931iterator = $floor_words['8F 户外运动']; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $m) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
						<li><a href="" <?= ($m['style'] == 1 ? 'class="weight"' : '') ?> target="_blank"><?= $m['name'] ?></a></li>
						<?php $v145229783306666706931incr++; } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="main">
				<div class="upper">
					<div class="box-440x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods01', $ads); ?>
						</div>
					</div>
					<div class="box-440x125 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods02', $ads); ?>
						</div>
					</div>
					<div class="box-440x125 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods03', $ads); ?>
						</div>
					</div>
				</div>
				<div class="lower">
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods04', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods05', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods06', $ads); ?>
						</div>
					</div>
					<div class="box-220x250 left frame">
						<div class="move">
						<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.goods07', $ads); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="full-column main-container">
		<?php echo $this -> utility -> get_advert_html('pc.home.floor.008.column', $ads); ?>
	</div>
</div>

<!-- 猜你喜欢 -->
<div class="row-container clearfix">
	<div class="likely main-container">
		<div class="title">
			<span> 猜你喜欢</span>
		</div>
		<div class="content">
		<script type="text/javascript" src="/assets/goods_hot_5.js"></script>
		</div>
	</div>
</div>
<!-- 楼层导航 -->
<div class="backpanel">
	<div id="backpanel-index" class="backpanel-inner">
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-home" href="#brand">品牌推荐</a><s> </s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-cloths" href="#floor1">服饰鞋帽</a><s> </s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-healthfood" href="#floor2">食品酒水</a><s></s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-kids" href="#floor3">母婴玩具</a><s></s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-dailygoods" href="#floor4">日用百货</a><s></s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-household" href="#floor5">智能电配</a><s></s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-facecare" href="#floor6">个护化妆</a><s></s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-car" href="#floor7">箱包饰品</a><s></s>
		</div>
		<div class="bp-item">
			<a target="_self" class="floor-links floor-index-sports" href="#floor8">户外运动</a><s></s>
		</div>
	</div>
</div>
<div style="display:none;">
<a href="https://m.ickd.cn" target="_blank">快递查询</a>
</div>
