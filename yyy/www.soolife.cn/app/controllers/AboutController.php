<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------

/**
	关于我们 /about/index.html
	联系我们 /about/contact.html
	诚聘人才 /about/job.html
	品牌介绍 /about/info.html
	商家入驻 /about/settled.html
	友情链接 /about/link.html
	法律声明 /about/copyright.html
	网站协议 /about/agreement.html
*/
class AboutController extends BaseController
{
	/**
	 * 关于我们
	 * @author tony wang
	 * @return view
	 */
	public function indexAction()
    {
    	$this->page->init('关于我们','about',1);
	}

	/**
	 * 联系我们
	 * @author tony wang
	 * @return view
	 */
	public function contactAction()
    {
    	$this->page->init('联系我们','contact',1);
	}

	/**
	 * 诚聘人才
	 * @author tony wang
	 * @return view
	 */
	public function jobAction()
    {
    	//$this->page->init('诚聘人才','job',0,'pc','','','layout_simple');
	}

	/**
	 * 品牌介绍
	 * @author tony wang
	 * @return view
	 */
	public function brandAction()
    {
    	$this->page->init('品牌介绍','brand',1);
	}


	/**
	 * 商家入驻
	 * @author tony wang
	 * @return view
	 */
	public function settledAction()
    {
    	$this->page->init('商家入驻','settled',1);
	}

	/**
	 * 友情链接
	 * @author tony wang
	 * @return view
	 */
	public function linksAction()
    {
    	$w_service = new WebsiteService();
		$links = $w_service->Links();
		$this -> assign('links',$links);
    	$this->page->init('友情链接','links',1);
	}

	/**
	 * 法律声明
	 * @author tony wang
	 * @return view
	 */
	public function lawAction()
    {
    	$this->page->init('法律声明','law',1);
	}

	/**
	 * 如此生活创始人
	 * @author tony wang
	 * @return view
	 */
	public function founderAction()
    {
    	$this->page->init('如此生活创始人','founder',1);
	}

	/**
	 * 网站协议
	 * @author tony wang
	 * @return view
	 */
	public function agreementAction()
	{
		$this->page->init('网站协议','agreement',1);
	}

	public function guidAction()
	{
		$this->page->init('网站协议','guid',1,'','','','no_layout');
	}

	/**
	 * 自提点
	 * @author dandan_sun
	 * @return view
	 */
	public function homeAction()
    {
    	$this->page->init('自提点','home',1);
	}

}