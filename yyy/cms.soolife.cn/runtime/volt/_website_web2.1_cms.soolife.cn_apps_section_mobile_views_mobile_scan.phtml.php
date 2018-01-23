<?php
    $css = $this -> assets -> get('header');
    $css -> addCss("dist/mobile/css/scan.min.css");
    $js = $this -> assets -> get('footer');
    $js -> addJs("dist/mobile/js/scan.min.js");
?>


<div class="header">
    <ul class="header_con">
    	<li>
    		<a href="/mobile/index.html?<?php if(isset($S_Code)) echo "S_Code=".$S_Code;?>">
	    		<span><i class="fa fa-reply-all fa-lg" aria-hidden="true"></i></span>
	            <span>&nbsp;返回</span>
            </a>
    	</li>
    	<!-- <li class="save_all">
    		<a href="javascript:;">
    		    <span><i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i></span>
	    		<span>保存</span>
	    	</a>
    	</li> -->
    </ul>
</div>

<div class="scan">
<?= $mresult ?>
</div>

