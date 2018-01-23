<?php
    $css = $this -> assets -> get('header');
    $css -> addCss("dist/pc/css/scan.min.css");
    $js = $this -> assets -> get('footer');
    $js -> addJs("dist/pc/js/scan.min.js");
    // $js -> addJs("public/pc/js/scan.js");

?>
<div class="header">
    <ul class="header_con">
    	<li>
    		<a href="/pc/index.html?<?php if(isset($S_Code)) echo "S_Code=".$S_Code;?>" >
                <span><i class="fa fa-reply-all fa-lg" aria-hidden="true"></i></span>
                <span>&nbsp;返回</span>
            </a>
    	</li>
    </ul>
</div>



<div class="scan">
<?= $presult ?>	
</div>

