<?php
// +----------------------------------------------------------------------
// | 海外精品的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   DiscountController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-08-16
// +----------------------------------------------------------------------

/**
 * 星特惠
 */
class DiscountController extends BaseController {
	/**
	 * 首页
	 * @access public
	 * @author tony wang 2016-08-10
	 *
	 * @return view
	 */
	public function indexAction() {
		$util =  new Utilitys();
		$a_service = new AdvertService();
		$ads = $a_service->Lively('pc.discount');
		
		$banner = array();
		if (isset($ads) && !empty($ads))
		{
			$banner001 = array_key_exists('pc.discount.banner.01', $ads)? $ads["pc.discount.banner.01"]:array();
			//TODO 需要添加背景图
			$banner002 = array_key_exists('pc.discount.banner.02', $ads)? $ads["pc.discount.banner.02"]:array();
			$len = count($banner001);
			for ($i=0; $i < $len; $i++) {
				$v = $banner001[$i];
				$banner[] = array(
					"id"=>$v['id'],
					"bgcolor"=>$v['bgcolor'],
					"picture"=>$v['picture'],
					"link"=>$v['pc_link'],
					"title"=>$v['title'],
					"bgimage"=>($i<count($banner002))?$banner002[$i]['picture']:""
				);
			}
		}
		$w_service = new WebsiteService();
		$channel_seo = $w_service->ChannelSeo('pc.favourable');
		$this -> assign("banner",$banner);
		$this -> assign("ads", $ads);
		$this -> page -> init('星特惠','discount','','',$channel_seo['S_Keywords'],$channel_seo['S_Description']);
	}
}
