<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <title>
            <?= (empty($title) ? ('如此生活') : ($title)) ?>
        </title>
        <meta http-equiv="Content-Type"  charset="utf-8" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="generator"      content="soolife.cn">
        <meta name="keywords"       content="<?= $keywords ?>">
        <meta name="description"    content="<?= $description ?>">
        <meta name="viewport" content="width=device-width,minimum-scale=1, maximum-scale=1, initial-scale=1.0,user-scalable=no" />
        <meta name="format-detection" content="telephone=no">
        <meta name="author" content="Tony Wang">
        <?php foreach ($dns as $d) { ?>
        <link rel="dns-prefetch" href="<?= $d ?>" />
          
        <?php } ?>
        <link rel="shortcut icon"                                   href="<?= $url_member ?>/public/icon/favicon.ico">
        <link rel="icon"                                            href="<?= $url_member ?>/public/icon/favicon.gif"  type="image/gif">
        <link rel="apple-touch-icon-precomposed" sizes="144x144"    href="<?= $url_member ?>/public/icon/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114"    href="<?= $url_member ?>/public/icon/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72"      href="<?= $url_member ?>/public/icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="57X57"      href="<?= $url_member ?>/public/icon/apple-touch-icon-57-precomposed.png">
        <?= $this->assets->outputCss('header') ?>
    </head>
    <body>
        <?= $this->getContent() ?>

        <?= $this->assets->outputJs('footer') ?>
    </body>
    
</html>
