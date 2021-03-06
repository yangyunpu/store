<?php
// +----------------------------------------------------------------------
// | 主页面的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   OverseasController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-08-16
// +----------------------------------------------------------------------
class OverseasController extends BaseController {
	/**
	 * 首页
	 * @access public
	 * @author tony wang 2016-08-10
	 *
	 * @return view
	 */
	public function indexAction() {
		$code = 'pc.overseas';
		$util =  new Utilitys();
		$a_service = new AdvertService();
		$ads = $a_service->Lively($code);
		
		$banner = array();
		if (isset($ads) && !empty($ads))
		{
			$banner001 = array_key_exists('pc.overseas.banner.001', $ads)? $ads["pc.overseas.banner.001"]:array();
			$banner002 = array_key_exists('pc.overseas.banner.002', $ads)? $ads["pc.overseas.banner.002"]:array();
			$banner003 = array_key_exists('pc.overseas.banner.003', $ads)? $ads["pc.overseas.banner.003"]:array();
			$banner004 = array_key_exists('pc.overseas.banner.004', $ads)? $ads["pc.overseas.banner.004"]:array();
			$len = count($banner001);
			for ($i=0; $i < $len; $i++) {
				$v = $banner001[$i];
				$banner[] = array(
					"id"=>$v['id'],
					"bgcolor"=>$v['bgcolor'],
					"picture"=>$v['picture'],
					"link"=>$v['pc_link'],
					"title"=>$v['title'],
					"bgimage"=>($i<count($banner002))?$banner002[$i]['picture']:"",
					"sidebar"=>array(
						"first"=>$util->conver_banner($i,$banner003,$util),
						"second"=>$util->conver_banner($i,$banner004,$util)
					)
				);
			}
		}
		$w_service = new WebsiteService();
		$channel_seo = $w_service->ChannelSeo($code);
		$this -> assign("banner",$banner);
		$this -> assign("ads", $ads);
		$this -> page -> init('海外精品','overseas','','',$channel_seo['S_Keywords'],$channel_seo['S_Description']);
	}
}
