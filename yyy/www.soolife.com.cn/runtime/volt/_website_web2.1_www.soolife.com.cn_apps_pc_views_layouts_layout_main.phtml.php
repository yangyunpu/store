<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<link rel="shortcut icon" href="http://static.soolife.cn/asset/icon/favicon.ico">
		<title><?= $title ?></title>
		<?= $this->assets->outputCss('header') ?>
	</head>
	<body>
		<?= $this->partial('layouts/inc_head') ?>
		<?php if ($content_title != '') { ?>
		<div class="header_opsition">
			<h5>
			<a href="<?= $url_intranet ?>/index.html">首页</a><i class="ace-icon fa fa-angle-double-right"></i>
				<a href="<?= $url_intranet ?>/<?= $url ?>"><?= $content_title ?></a>
				<?php if ($content_desc != '') { ?>
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					<?= $content_desc ?>
				</small>
				<?php } ?>
			</h5>
		</div>
		<hr>
		<?php } ?>
		<div class="content_body">
			<div class="content">
				<?= $this->getContent() ?>
			</div>
			<?php if ($content_title == '') { ?>
			<div class="footer">
				<div class="footer_main">
					<div class="footer_left float_l">
						<img class="float_l" src="/public/img/b-logo.png" alt="">
					</div>
					<div class="footer_cent float_l">
						<div class="modle">
							<p>关于我们</p>
							<ul>
								<li><a href="<?= $url_intranet ?>/about/companyProfile.html">公司简介</a></li>
								<li><a href="<?= $url_intranet ?>/about/makeSpeech.html">董事长致辞</a></li>
								<li><a href="<?= $url_intranet ?>/about/coreTeam.html">核心团队</a></li>
								<li><a href="<?= $url_intranet ?>/about/culture.html">文化理念</a></li>
								<li><a href="<?= $url_intranet ?>/about/developmentHistory.html">发展历程</a></li>
								<li><a href="<?= $url_intranet ?>/about/enterpriseHonor.html">企业荣誉</a></li>
								<li><a href="<?= $url_intranet ?>/about/futureTendency.html">未来展望</a></li>
							</ul>
						</div>
						<div class="modle">
							<p>公司动态</p>
							<ul>
								<li><a href="<?= $url_intranet ?>/dynamic/dynamic.html">公司动态</a></li>
							</ul>
						</div>
						<div class="modle">
							<p>业务模式</p>
							<ul>
								<li><a href="<?= $url_intranet ?>/business/businessModel.html">商业模式简介</a></li>
								<li><a href="<?= $url_intranet ?>/business/platformIntroduction.html">平台介绍</a></li>
								<li><a href="<?= $url_intranet ?>/business/experienceCenter.html">体验店介绍</a></li>
							</ul>
						</div>
						<div class="modle">
							<p>品牌合作</p>
							<ul>
								<li><a href="<?= $url_intranet ?>/partner/newcityagent.html">城市代理加盟合作</a></li>
								<li><a href="<?= $url_intranet ?>/partner/experience.html">体验店投资加盟合作</a></li>
								<li><a href="<?= $url_intranet ?>/partner/brandinvestment.html">品牌商家入驻合作</a></li>
							</ul>
						</div>
						<div class="modle">
							<p>品牌报道</p>
							<ul>
								<li><a href="<?= $url_intranet ?>/report/brandActivity.html">品牌活动</a></li>
								<li><a href="<?= $url_intranet ?>/report/mediaInterviews.html">媒体专访</a></li>
								<li><a href="<?= $url_intranet ?>/report/videoCoverage.html">视频报道</a></li>
							</ul>
						</div>
						<div class="modle">
							<p>联系我们</p>
							<ul>
								<li><a href="<?= $url_intranet ?>/contactUs/contactInformation.html">公司联系方式</a></li>
							</ul>
						</div>
						<div class="modle">
							<a href="<?= $url_intranet ?>/sop/index.html"><p>商家入驻</p></a>
						</div>
					</div>
					<div class="footer_right float_l">
						<p>微信订阅号：</p>
						<img class="float_l" src="/public/img/ding.jpg" style="width:89px;" alt="">
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?= $this->partial('layouts/inc_footer') ?>
		<?= $this->assets->outputJs('footer') ?>
	</body>
</html>
