<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|首页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!-- <link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/> -->
	<!-- <link rel="stylesheet" href="/public/ext/css/download.css"> -->
	<link rel="stylesheet" type="text/css" href="/public/css/mindex/new_index.css"/>
	<!-- <link rel="stylesheet" href="/public/ext/css/swiper.css"> -->

</head>
<body>
<div class="search">
	 <div class="heard border-b">
	 	 <div class="input fl_l">
          <div class="img fl_l">
          	 <img src="/public/img/newindex/search.png">
          </div>
          <div class="hunt_for">
          	 <input type="text" id="title_in" name="" value="" placeholder="<?= $search ?>">
          </div>
          </div>
          <div class="news" onclick="history.go(-1)">取消</div> 
          <div style="display: none;" class="hosity_list"></div>
          <div class="search_hi " style="display:none">
          	<ul>
          		<li  class="border-b">
          			大枣
          		</li>
          		<li  class="border-b">
          			大枣
          		</li>
          		<li  class="border-b">
          			大枣
          		</li>
          		<li  class="border-b">
          			大枣
          		</li>
          		<li  class="border-b">
          			大枣
          		</li><li  class="border-b">
          			大枣
          		</li><li  class="border-b">
          			大枣
          		</li>

          	</ul>
          </div>
       </div>
       <div class="hot_search exhibition" >
       	<h5>热搜</h5>
       	<div class="keyword">
       		<ul>
            <?php if ($hot) { ?>
            <?php foreach ($hot as $word) { ?>
            <?php if ($word['name']) { ?>
            <li><?= $word['name'] ?></li>
            <?php } ?>
            <?php } ?>
            <?php } ?>
       		</ul>
       	</div>
       </div> 
        <div class="hot_search scroll" style="display: none">
       	<h5>热搜</h5>
       	<div class="keyword_scroll">
       		<ul>
            <?php if ($hot) { ?>
            <?php foreach ($hot as $word) { ?>
            <?php if ($word['name']) { ?>
       			<li><?= $word['name'] ?></li>
            <?php } ?>
            <?php } ?>
            <?php } ?>
       		</ul>
       	</div>
       </div>
       <div class="below" style="display: none;">
       <div class="lishi border-b">
       	<h5 class="">历史记录</h5>
       </div>
       <div class="history">
          <ul>
          	<li class="border-b">
          		好想你大枣
          	</li>
          	<li class="border-b">
          		话梅
          	</li>
          	<li class="border-b">
          		喵粮
          	</li >
          	<li class="border-b">
          		泰国皇家喵粮
          	</li>
          </ul>
          <div class="empty">
   			<div class="fl_l shanchu"><img src="/public/img/newindex/shanchu.png"></div>
   			<div>清空历史记录</div>
   		</div>
       </div>
   		
       </div>

       <div class="delete" style="display: none">
       	清除完成
       </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<!-- <script type="text/javascript" src="/public/ext/js/swiper.min.js"></script> -->
<script type="text/javascript" src="/public/js/mindex/search.js"></script>