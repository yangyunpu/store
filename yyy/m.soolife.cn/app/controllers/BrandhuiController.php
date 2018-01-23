<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: <zhichao_hu>
// | Created:   2017-04-06
// +----------------------------------------------------------------------
class BrandhuiController extends BaseController
{
    public function brandhuiAction()
    {
    	$model = new BrandhuiService();
    	$data = $model->brandHui();
        $this->assign("bigbanner",$data['app.brand_gratia.index.bigbanner']);
        $this->assign("lslide",$data['app.brand_gratia.index.lslide']);
        $this->assign("mslide",$data['app.brand_gratia.index.mslide']);
        $this->assign("rslide",$data['app.brand_gratia.index.rslide']);
        $this->pages->init('首页');
    }
}