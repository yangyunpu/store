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
class StarhuiController extends BaseController
{
    public function starhuiAction()
    {
    	$model = new StarhuiService();
    	$data = $model->starHui();
    	$this->assign("data",$data);
    	
        $this->pages->init('首页');

    }
}