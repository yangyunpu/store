<?php
    $css = $this -> assets -> get('header');
    $css -> addCss("dist/pc/css/index.min.css");
    $js = $this -> assets -> get('footer');
    $js -> addJs("dist/pc/js/index.min.js");
    // $js -> addJs("public/pc/js/index.js");

?>
<div class="header">
    <ul class="header_con">
    	<li>
    		<a href="/mobile/index.html?S_Code=<?= $S_Code ?>" >
                <span style="position: relative;top: 4px;"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i></span>
                <span>手机版</span>
            </a>
    	</li>
        <li class="scan_all">
            <a href="/pc/scan.html?S_Code=<?= $S_Code ?>">
                <i class="fa fa-eye fa-lg" aria-hidden="true"></i>
                预览
            </a>
        </li>
    	<li class="save_all">
    		<a href="javascript:;">
    		    <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i>
	    		保存
	    	</a>
    	</li>
    </ul>
    <div class="action-buttons header_sidebar">
        <a class="sidebar_modal"><i class="white fa fa-th-large fa-2x" aria-hidden="true"></i></a>
        <a class="sidebar_setting" data-toggle="modal" data-target="#setAllStyle"><i class="white fa fa-cog fa-2x" aria-hidden="true"></i></a>
    </div>
</div>
<div class="m_top">
    <div class="modalPanelSidebar">
        <div  class="leftPanel">
            <div class="action-buttons mobiModColumn">
                <a class="h_icon"><i  class=" white fa fa-th-large fa-2x" aria-hidden="true"></i></a>
                <span class="h_title">基础</span>
                <a class="h_close"><i class="white fa fa-times fa-2x" aria-hidden="true"></i></a>
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
                            <p class="rightIcon">顶部广告</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-adv">
                            <a class="mainIcon mainIcon-adv"></a>
                            <p class="rightIcon">内容广告</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-adv">
                            <a class="mainIcon mainIcon-adv"></a>
                            <p class="rightIcon">底部广告</p>
                        </li>
                        <li data-toggle="modal" data-target="#mainIcon-pro">
                            <a class="mainIcon mainIcon-pro"></a>
                            <p class="rightIcon">产品展示</p>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <div class="panelItemContainer">
                <fieldset>
                    <legend>楼层</legend>
                    <ul>
                        <li data-toggle="modal" data-target="#mainIcon-floor">
                            <a class="mainIcon mainIcon-floor" ></a>
                            <p class="rightIcon" >添加楼层</p>
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
    
    <div class="modalPanelArea">
       <div class="centerPanel">
           <div class="mobiReview">
           <?= $contents ?>
           </div>
       </div>
    </div>
</div>


<!-- ***********************************模态框*********************************** -->


<!-- 新建 -->
<?= $this->partial('pc/create') ?>

<!-- 设置样式 -->
<?= $this->partial('pc/setstyle') ?>

<!-- 编辑模块 -->
<?= $this->partial('pc/edit') ?>


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