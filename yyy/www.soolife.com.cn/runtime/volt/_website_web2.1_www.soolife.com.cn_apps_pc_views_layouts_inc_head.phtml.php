<div class="header">
	<div class="header_top">
		<img src="/public/img/logo.png" alt="">
		<div class="header_top">
		<?php if ($m_id > 0) { ?>
			<a href="/logout.html" class="logout">退出</a>&nbsp;&nbsp;&nbsp;
		<?php } else { ?>
			<a href="/sop/login.html" class="logout">登录</a>&nbsp;&nbsp;&nbsp;
		<?php } ?>
			<img src="/public/img/tell.png" alt="">
			<span class="tell">400-6699-878</span>
			<span>中文</span>
		</div>
	</div>
</div>
<div class="nav">
	<div class="nav-main">
		<ul>
			<?= $this->partial('layouts/inc_sidebar') ?>
		</ul>
	</div>
</div>