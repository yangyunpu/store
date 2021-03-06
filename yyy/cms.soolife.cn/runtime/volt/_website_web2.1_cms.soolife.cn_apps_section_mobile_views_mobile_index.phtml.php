<?php
    $css = $this -> assets -> get('header');
    $css -> addCss("dist/mobile/css/index.min.css");
    $css -> addJs("public/ext/css/jquery.mCustomScrollbar.css");
    $js = $this -> assets -> get('footer');
    $js -> addJs("public/ext/jquery/jquery.mousewheel.min.js");
    $js -> addJs("public/ext/jquery/jquery.mCustomScrollbar.min.js");
    $js -> addJs("public/ext/jquery/jquery.base64.js");
    $js -> addJs("dist/mobile/js/index.min.js");
    // $js -> addJs("public/mobile/js/index.js");

?>
<div class="header">
    <ul class="header_con">
    	<li>
    		<a href="/pc/index.html?S_Code=<?= $S_Code ?>">
	    		<span><i class="fa fa-desktop fa-lg" aria-hidden="true"></i></span>
	            <span>电脑版</span>
            </a>
    	</li>
        <li>
            <a href="/mobile/scan.html?S_Code=<?= $S_Code ?>">
                <span><i class="fa fa-eye fa-lg" aria-hidden="true"></i></span>
                <span>预览</span>
            </a>
        </li>
    	<li class="save_all">
    		<a href="javascript:;">
    		    <span><i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i></span>
	    		<span>保存</span>
	    	</a>
    	</li>
    </ul>
</div>
<div class="row m_top">
    <div class="col-sm-4 ">
        <div  class="leftPanel">
            <div class="mobiModColumn">
                <a style="width: 100%;"> 基础</a>
                <!-- <a>产品</a> -->
            </div>
            <div class="panelItemContainer">
                <fieldset>
                    <legend>基础</legend>
                    <ul>
                        <li data-toggle="modal" data-target="#mainIcon-more">
                            <a class="mainIcon mainIcon-more" ></a>
                            <p class="rightIcon" >轮播多图</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-adv">
                            <a class="mainIcon mainIcon-adv"></a>
                            <p class="rightIcon">广告图</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-col">
                            <a class="mainIcon mainIcon-col"></a>
                            <p class="rightIcon">列表多图</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-pro">
                            <a class="mainIcon mainIcon-pro"></a>
                            <p class="rightIcon">产品展示</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-dis">
                            <a class="mainIcon mainIcon-dis"></a>
                            <p class="rightIcon">图文展示</p>
                        </li>
                    </ul>
                </fieldset>
            </div>
        </div>   
    </div>
    <input  id="S_Code" type="hidden" value="<?= $S_Code ?>" />
    <input type="hidden" name="url_sale" value="<?= $url_cms['url_sale'] ?>"/>
    <input type="hidden" name="url_item" value="<?= $url_cms['url_item'] ?>"/>
    <input type="hidden" name="url_store" value="<?= $url_cms['url_store'] ?>"/>
    <input type="hidden" name="url_sale_activity" value="<?= $url_cms['url_sale_activity'] ?>"/>
    <div class="col-sm-8">
       <div class="centerPanel">
           <div class="mobiReview">
               <?= $contents ?>
           </div>
       </div>
    </div>
</div>
    <!-- 新建 -->
    <?= $this->partial('mobile/create') ?>

    <!-- 设置样式 -->
    <?= $this->partial('mobile/setstyle') ?>

    <!-- 编辑模块 -->
    <?= $this->partial('mobile/edit') ?>

<!-- alert -->
<div class="alert">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="alert_close close" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times fa-lg" aria-hidden="true"></i> </span>
                </button>
                <h4 class="modal-title">移除模块</h4>
            </div>
            <div class="modal-body">
                确定要移除此模块吗？
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel_btn alert_close btn btn-default">
                    <i class="fa fa-times" aria-hidden="true"></i>    
                    取消
                </button>
                <button type="button" class="suc_btn alert_close btn btn-primary">
                    <i class="fa fa-check" aria-hidden="true"></i>  
                    确认
                </button>
            </div>
        </div>
    </div>
</div>


<div class="alert_txt">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header" style="padding:10px;">
                <button type="button" class="alert_close close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">信息提示</h4>
            </div>
            <div class="modal-body" style="height: 70px;">
            
            </div>
        </div>
    </div>
</div>

<!-- 存储部分编辑 -->
<div class="edit_part_modal" style="display: none;">

</div>