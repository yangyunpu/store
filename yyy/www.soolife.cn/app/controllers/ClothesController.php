<?php
// +----------------------------------------------------------------------
// | 星范儿的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   ClothesController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-08-16
// +----------------------------------------------------------------------

/**
 * 星范儿 控制器
 */
class ClothesController extends BaseController {
	
	/**
	 * 星范儿
	 * @access public
	 * @author tony wang 2016-08-10
	 *
	 * @return view
	 */
	public function indexAction() {
		$util =  new Utilitys();
		$a_service = new AdvertService();
		$ads = $a_service->Lively('pc.clothes');
                
        //调websitesrver->keywords数据
        $w_service = new WebsiteService();
        $keywords = $w_service->Keywords('pc.clothes');
		
		$banner = array();
		if (isset($ads) && !empty($ads))
		{	
			$banner001 = array_key_exists('pc.clothes.banner.001', $ads)? $ads["pc.clothes.banner.001"]:array();
			//TODO 需要添加背景图
			$banner002 = array_key_exists('pc.clothes.banner.101', $ads)? $ads["pc.clothes.banner.101"]:array();
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
		$channel_seo = $w_service->ChannelSeo('pc.dress');
		$this -> assign("banner",$banner);
		$this -> assign("ads", $ads);
		$this -> assign('floor_words',$keywords);
		$this -> page -> init('星范儿','clothes','','',$channel_seo['S_Keywords'],$channel_seo['S_Description']);
	}
}
