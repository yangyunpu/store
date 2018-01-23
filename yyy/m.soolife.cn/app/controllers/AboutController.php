<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  huzhichao  Controller.php
// |
// | Author: 
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class AboutController extends BaseController
{
	public function aboutAction()
    {
    	$this->pages->init('关于我们');
	}
	public function copyrightAction()
    {
    	$this->pages->init('法律声明');
	}
	
	public function guidAction()
	{
		$this->pages->init('购物流程','','','','','','no');
	}
}