<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>手机网站设计</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <?= $this->assets->outputCss('header') ?>
</head>
        <?= $this->partial('layouts/inc_header') ?>
		<?= $this->getContent() ?>
</body>
	<?= $this->assets->outputJs('footer') ?>
</html>

