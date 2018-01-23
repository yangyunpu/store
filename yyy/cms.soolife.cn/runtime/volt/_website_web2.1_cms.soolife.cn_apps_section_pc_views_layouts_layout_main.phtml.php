<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta http-equiv="Content-Type"  charset="utf-8" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="generator"      content="soolife.cn">
		<meta name="keywords"       content="<?= (empty($keywords) ? ('') : ($keywords)) ?>">
		<meta name="description"    content="<?= (empty($description) ? ('') : ($description)) ?>">
		<meta name="viewport"       content="width=1200px, initial-scale=0.8">
		<meta name="author" content="Tony Wang">
		<title>PC端网站设计</title>
		<link rel="dns-prefetch" href="http://img.soolife.cn" />
		<link rel="dns-prefetch" href="http://static.soolife.cn" />
		<link rel="dns-prefetch" href="http://www.soolife.cn" />
		<link rel="shortcut icon" href="http://static.soolife.cn/asset/icon/favicon.ico">
		<link rel="icon" href="http://static.soolife.cn/asset/icon/favicon.gif"  type="image/gif">
		<?= $this->assets->outputCss('header') ?>
	</head>
	<body>
	    <?= $this->partial('layouts/header') ?>

		<?= $this->getContent() ?>

	    <?= $this->partial('layouts/footer') ?>
	</body>
		<?= $this->assets->outputJs('footer') ?>
</html>
