<?php
// +----------------------------------------------------------------------
// | 主页面的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
class IndexController extends BaseController {
	/**
	 * 首页
	 * @access public
	 * @author tony wang 2016-08-10
	 *
			// [pc.home.banner.001] PC首页 大Banner-主图
			// [pc.home.banner.002] PC首页 大banner-背景图
			// [pc.home.banner.003] PC首页 大banner 浮层 右侧上
			// [pc.home.banner.004] PC首页 大banner 浮层 右侧中上
			// [pc.home.banner.005] PC首页 大banner 浮层 右侧中下
			// [pc.home.banner.006] PC首页 大banner 浮层 右侧下
	 * @return view
	 */
	public function indexAction() {
		$code = 'pc.home';
		$util =  new Utilitys();
		$a_service = new AdvertService();
		$ads = $a_service->Lively($code);
		$banner = array();
		if (isset($ads) && !empty($ads))
		{
			$banner001 = array_key_exists('pc.home.banner.001', $ads)? $ads["pc.home.banner.001"]:array();
			$banner002 = array_key_exists('pc.home.banner.002', $ads)? $ads["pc.home.banner.002"]:array();
			$banner003 = array_key_exists('pc.home.banner.003', $ads)? $ads["pc.home.banner.003"]:array();
			$banner004 = array_key_exists('pc.home.banner.004', $ads)? $ads["pc.home.banner.004"]:array();
			$banner005 = array_key_exists('pc.home.banner.005', $ads)? $ads["pc.home.banner.005"]:array();
			$banner006 = array_key_exists('pc.home.banner.006', $ads)? $ads["pc.home.banner.006"]:array();
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
						"second"=>$util->conver_banner($i,$banner004,$util),
						"third"=>$util->conver_banner($i,$banner005,$util),
						"fourth"=>$util->conver_banner($i,$banner006,$util),
					)
				);
			}
		}
		$w_service = new WebsiteService();
		$keywords = $w_service->Keywords($code);
		$channel_seo = $w_service->ChannelSeo($code);
		$this -> assign("banner",$banner);
		$this -> assign("ads", $ads);
		$this -> assign('floor_words',$keywords);

		$this -> page -> init('首页','home','','',$channel_seo['S_Keywords'],$channel_seo['S_Description']);
	}

	 // 热门搜索自动补全
	 
	public function searchAutoAjaxAction(){
	    $autoVal['keyword'] = $this ->request ->getPost("keyword");

	    $search_url = "/v2/goods/searchword";

	    $searchAutoVal = array();
	    $code = $this->curl->post_request($search_url,$autoVal,'java_api');
	    if($this->curl->post_request($search_url,$autoVal,'java_api') == 200){
	        $searchAutoVal = $this->curl->getArrayData();
	    }
	    if($code != 200){
	        $this->failure('false',$searchAutoVal);
	    }else{
	    	$data = array(
               "success"=>true,
               "code"=>200,
               "msg"=>"success",
               "data"=>$searchAutoVal
	    		);
	    	return json_encode($data);
	    }


	}



	public function notFoundAction() {
		echo "404";
	}
}
