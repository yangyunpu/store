<?php
// +----------------------------------------------------------------------
// | 星粉专区 的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   VipController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-08-16
// +----------------------------------------------------------------------
class VipController extends BaseController {
	/**
	 * 首页
	 * @access public
	 * @author tony wang 2016-08-16
	 *
	 * @return view
	 */
	public function indexAction() {
		$code = 'pc.vip';
		$util =  new Utilitys();
		$a_service = new AdvertService();
		$ads = $a_service->Lively($code);
		
		$banner = array();
		if (isset($ads) && !empty($ads))
		{
			$banner001 = array_key_exists('pc.vip.banner.001', $ads)? $ads["pc.vip.banner.001"]:array();
			//TODO 需要添加背景图
			$banner002 = array_key_exists('pc.vip.banner.101', $ads)? $ads["pc.vip.banner.101"]:array();
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
		
		$nickname = $this->user->getNickname();
		$memberid = $this->user->getId();
		$token = $this->user->getToken();
		$service = new MemberService();
		$asset = $service->Asset($token);
		$w_service = new WebsiteService();
		$channel_seo = $w_service->ChannelSeo($code);
		$this -> assign("m_nickname", $nickname);
		$this -> assign("m_id", $memberid);
		$this -> assign("asset", $asset);
		
		$this -> assign("banner",$banner);
		$this -> assign("ads", $ads);
		$this -> page -> init('星粉专区','vip',1,'',$channel_seo['S_Keywords'],$channel_seo['S_Description']);
	}

	/**
	 * 领取星币
	 */
	public function gainAction() {
		$token = $this->user->getToken();
		$service = new MemberService();
		$data = $service->GainCoin($token);
		return $this->json($data);
	}
}
