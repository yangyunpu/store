<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title><?= $title ?></title>
		<meta name="keywords" content="<?= $keywords ?>" />
		<meta name="description" content="<?= $description ?>" />
		<meta name="author" content="tony wang" />
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/public/v3.0.1/img/icon/apple-touch-icon-144-precomposed.png">
		
<?php $v145229783306666706931iterator = $dns; $v145229783306666706931incr = 0; $v145229783306666706931loop = new stdClass(); $v145229783306666706931loop->self = &$v145229783306666706931loop; $v145229783306666706931loop->length = count($v145229783306666706931iterator); $v145229783306666706931loop->index = 1; $v145229783306666706931loop->index0 = 1; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - 1; ?><?php foreach ($v145229783306666706931iterator as $d) { ?><?php $v145229783306666706931loop->first = ($v145229783306666706931incr == 0); $v145229783306666706931loop->index = $v145229783306666706931incr + 1; $v145229783306666706931loop->index0 = $v145229783306666706931incr; $v145229783306666706931loop->revindex = $v145229783306666706931loop->length - $v145229783306666706931incr; $v145229783306666706931loop->revindex0 = $v145229783306666706931loop->length - ($v145229783306666706931incr + 1); $v145229783306666706931loop->last = ($v145229783306666706931incr == ($v145229783306666706931loop->length - 1)); ?>
<link rel="dns-prefetch" href="<?= $d ?>" />
<?php $v145229783306666706931incr++; } ?>
		<!-- page css library -->
		<?= $this->assets->outputCss('header') ?>
		
	</head>
	<body>
		<script src="/assets/header.js"></script>
		<?= $this->partial('layouts/inc_search') ?>
		<script src="/assets/category.js?nav=<?= $nav ?>&hide=<?= $hide ?>"></script>
		<?= $this->getContent() ?>
		<script src="/assets/footer.js"></script>
		<script src="/assets/sidebar.js"></script>
		<!-- pages js library -->
		<?= $this->assets->outputJs('footer') ?>
		<script src="/tj/analytics.js"></script>
	</body>
</html>