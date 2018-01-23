<?php
	$css = $this->assets->get('header');
	$css -> addCss("public/css/p/view.index2.css");
	$js  = $this->assets->get('footer');
	$js -> addJs("public/js/p/view.indexs.js");
?>
<!-- 轮播 -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	     <!-- <li data-target="#carousel-example-generic" data-slide-to="3"></li> -->
	  </ol> 
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	  	<!-- <div class="item ">
	      <a href="/partner/newcityagent.html"><img src="/public/img/homepage/ones.png"></a> 
	    </div> -->
	    <div class="item active">
	      <a href="/partner/newcityagent.html"><img src="/public/img/homepage/tows.png" style="height: 100%;"></a> 
	    </div>
	    <div class="item">
	      <a href="/partner/brandinvestment.html"><img src="/public/img/homepage/threes.png" style="height:100%;"></a> 
	    </div>
	    <div class="item">
	      <a href="/partner/experience.html"><img src="/public/img/homepage/fours.png" style="height:100%;"></a> 
	    </div> 
	  </div> 
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
</div>
<!-- 轮播end --> 
<div class="lj_roll"> 
	<div id="demo" class="qimo8">
	  <div class="qimo">
	    <div id="demo1">
	      <ul>
	      <?php foreach ($data as $d) { ?>
			<li>
				 <?= $d['time'] ?>   <?= $d['addr'] ?>   <?= $d['name'] ?>来电垂询  <?= $d['phone'] ?>  
			</li> 
			<?php } ?>
	      </ul>
	    </div>
	    <div id="demo2"></div>
	  </div>
	</div>
</div>
<div class="about">
	<p>公司简介</p>
	<p>About Us</p>
</div>
<div class="bottom_line"><img src="/public/img/homepage/lnk.png"></div>
<div class="lj_content">
	<div class="content_left">鸿惠（上海）信息技术服务有限公司是一家拥有独创技术和跨平台发展的创新型企业，总部位于上海，产业涉及互联网电子商务、连锁零售、本地生活服务等多个不同领域。<br><br> 

针对商家的多元化服务，让更多中小企业主受益，提高了品牌知名度和商品的销量，并且帮助他们建立自己的商铺，开拓广袤的消费市场，建立属于自己的商业帝国；相信未来每一个人都将在 “SooLife”平台上绽放出多彩的生活！</div>
	<div class="content_right"><img src="/public/img/homepage/company.png"></div>
</div>
<div class="cost">
	<div class="about about_top">
		<p>公司价值</p>
		<p>Company Value</p>
	</div>
	<div class="bottom_line"><img src="/public/img/homepage/lnk.png"></div>
	<div class="cost_content">
		<div class="cost_left">
			<div class="left_img">
				<img src="/public/img/homepage/person.png">
			</div>
			<div class="left_wen">
				<span class="for">FOR商家</span> 
				<span class="fors">[ 提供一站式管家服务 ]</span><br>
				<span class="center">中间所有成本我们承担为销售结果负责 产生销售共享利润 </span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 免费帮您线上销售，开设网店</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 免费帮您线下销售，开实体店</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 免费帮您拓展全球代理商分销商</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 免费帮您组建专业的团队</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 免费帮您建立仓储物流系统</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 免费帮您发展微商、微营销</span> 
			</div>
		</div>
		<div class="cost_right"> 
			<div class="left_img">
				<img src="/public/img/homepage/lou.png">
			</div>
			<div class="left_wen">
				<span class="for">FOR消费者</span> 
				<span class="fors">[ 打造购物共赢生态圈 ]</span><br>
				<span class="center">在如此生活，买到的不只是便宜 </span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 便利购物</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 快乐购物</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 互动购物</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 产品价格够便宜</span>
				<span class="superiority"><i class="fa fa-square-o" aria-hidden="true"></i> 轻松赚钱</span> 
			</div>
		</div>
	</div>
</div>
<div class="collaborate">
	<div class="about about_top">
		<p>合作品牌</p>
		<p>Partners</p>
	</div>
	<div class="bottom_line"><img src="/public/img/homepage/lnk.png"></div>
	<div class="shopline"><img src="/public/img/homepage/shopline.png"></div>
</div>
<div class="status">
	<div class="status_top">
		<div class="about about_top">
			<p>公司现状</p>
			<p>Partners</p>
		</div>
		<div class="bottom_line"><img src="/public/img/homepage/lnk.png"></div>
	</div>
	<p class="men">已有5家大型连锁实体门店,未来三年将达到500家</p>
	<p class="mens">如此生活区域代理商已超过30个地区,未来三年将覆盖全国</p>
	<ul class="photo2">
		<li><img src="/public/img/homepage/songjiang.png"></li>
		<li><img src="/public/img/homepage/wanda.png"></li>
		<li><img src="/public/img/homepage/square.png"></li>
	</ul>
</div>
<div><img src="/public/img/homepage/inlet.png"></div>
<div class="project">
	<div class="about about_top">
		<p>公司计划</p>
		<p>Company planning</p>
	</div>
	<div class="bottom_line"><img src="/public/img/homepage/lnk.png"></div>
	<div class="project_left"><img src="/public/img/homepage/sky.png"></div>
	<div class="project_right"><img src="/public/img/homepage/icon.png"></div>
</div>
<div class="item">
	<div class="about about_top">
		<p>公司计划</p>
		<p>Company planning</p>
	</div>
	<div class="bottom_line"><img src="/public/img/homepage/lnk.png"></div>
	<ul class="agency">
		<li><a href="/partner/newcityagent.html"><img src="/public/img/homepage/city.jpg"></a></li> 
		<li class="lister"><a href="/partner/brandinvestment.html"><img src="/public/img/homepage/shoper.jpg"></a></li> 
		<li><a href="/partner/experience.html"><img src="/public/img/homepage/store.jpg"></a> </li>
	</ul>
</div>
<div class="viocd"></div>
<div class="new">
	<div class="new_left">
		<div class="new_head">
			<span class="newrt">公司动态</span>
			<span class="moref"><a href="/dynamic/dynamic.html"><img src="/public/img/homepage/more.png"></a></span>
		</div>
		<div class="status_img"><a href="/report/newsGlory.html"><img src="../public/img/company/company(3).png"></a></div>
		<div class="year">"赢战鸡年 共创辉煌" 年会</div>
		<div class="lj_line"></div>
		<br>
		<a href="/report/newsIeather.html"><div><span>2016年12月7日，协会秘书长俞万丰赴上海走访了上海</span>  <span class="right">2016-12-07</span></div></a><br>
		<a href="/report/newsvisit.html"><div><span>箱包行业协会负责人参观交流上海电商平台</span> <span class="right">2016-12-21</span></div></a>
	</div>
	<div class="new_right">
		<div class="new_head">
			<span class="newrt">新闻报道</span>
			<span class="moref"><a href="/report/videoCoverage.html"><img src="/public/img/homepage/more.png"></a></span>
		</div>
		<div class="status_img"><a href="/report/videoCoverage.html"><img src="../public/img/video/video(5).png"></a></div>
		<div class="year">华交会第一财经采访</div>
		<div class="lj_line"></div>
		<br>
		<a href="/report/videoCoverage.html"><div><span>新零售高峰论坛</span> <span class="right">2017-05-05</span></div></a><br>
		<a href="/report/videoCoverage.html"><div><span>品牌商大会第一财经报道</span><span class="right">2017-05-14</span></div></a>
	</div>
</div>
<!--右侧悬浮菜单-->
<div class="slides">
	<ul class="icons">
		<li class="ups" title="上一页" align="center"><img src="/public/img/city/up.png"></li>
		<li class="qqs" align="center"><img src="/public/img/city/qq.png"></li>
		<li class="tels" align="center"><img src="/public/img/city/iphoneer.png"></li>
		<li class="wxs" align="center"><img src="/public/img/city/app.png"></li>
		<li class="downs" title="下一页" align="center"><img src="/public/img/city/down.png"></li>
	</ul>
	<ul class="infos">
		<li class="qqs" align="center">
			<p align="center">城市代理<a href="http://wpa.qq.com/msgrd?v=3&uin=3329706260&site=qq&menu=yes" target="_blank">在线咨询</a>
			品牌入驻<a href="http://wpa.qq.com/msgrd?v=3&uin=2531296377&site=qq&menu=yes" target="_blank">在线咨询</a>
			体验店加盟<a href="http://wpa.qq.com/msgrd?v=3&uin=2205967867&site=qq&menu=yes" target="_blank">在线咨询</a> 
			</p>
		</li>
		<li class="tels">
			<p>
				<div class="blues">城市代理热线：</div> 
				<div class="lj_shus">15221641902</div> 
				<div class="blues">品牌入驻热线：</div> 
				<div class="lj_shus">15221700246</div>  
				<div class="blues">体验店加盟热线:</div> 
				<div class="lj_shus">15221711405</div>	
			</p>
		</li>
		<li class="wxs">
			<div class="imgs">
			<img src="/public/img/city/loadapp.png">
			</div>
			<p class="apps">扫描二维码，下载APP</p>
		</li>
	</ul>
</div> 

