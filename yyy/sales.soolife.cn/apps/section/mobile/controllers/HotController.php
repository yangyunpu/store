<?php
// +----------------------------------------------------------------------
// | h5页面控制层（一元购、满赠、充值卡）
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File: HotContoller.php
// | Author: Dandan_Sun
// | Created: 2017-09-21 13:24:02
// +----------------------------------------------------------------------
namespace Soolife\Sales\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Services\HotService;

class HotController extends BaseController
{

	/**
	* 一元购
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 13:26:00
	*/
	public function onebuyAction()
	{
		$url = $this->config->url;
		$this->assign('url_m',$url->url_m);
		$this->assign('url_order',$url->url_order);
		$this -> page -> init('一元购','','','mobile');
	}

	/**
	* 一元购确认订单
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 15:43:51
	*/
	public function confirmAction()
	{
		$data['mobile']  = $this->request->getPost("mobile");
		$data['address'] = $this->request->getPost("address");
		$data['name']    = $this->request->getPost("name");
		$data['region']  = $this->request->getPost("region");
		try {
			$service = new HotService();
			$order_id = $service->confirm($this -> member,$data);
			return $this->success("",$order_id);
			// $this->redirect($this->config->url->url_order . "/m/order/orderpay.html?order_id=" . $order_id);
		} catch (\Exception $e) {
			// return $this->failure($e->getMessage(),400);
			return $this->failure("您未登录，请至APP登录！",400);
		}
	}

	/**
	* 现金卡
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 15:32:54
	*/
	public function cashcardAction()
	{
		$url = $this->config->url;
		$this->assign('url_m',$url->url_m);
		$this->assign('url_order',$url->url_order);
		$this -> page -> init('十万火急','','','mobile');
	}

	/**
	* 现金卡确认订单
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 15:43:51
	*/
	public function cashConfirmAction()
	{
		$data['mobile']  = $this->request->getPost("mobile");
		$data['address'] = $this->request->getPost("address");
		$data['name']    = $this->request->getPost("name");
		$data['region']  = $this->request->getPost("region");
		$data['unique']  = $this->request->getPost("unique");
		$skuid  = $this->request->getPost("skuid");
		try {
			$service = new HotService();
			$order_id = $service->cashConfirm($this -> member,$data,$skuid);
			return $this->success("",$order_id);
		} catch (\Exception $e) {
			return $this->failure("您未登录，请至APP登录！",400);
		}
	}
		/**
	*大V卡
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 15:32:54
	*/
	public function vcardAction()
	{
		// $url = $this->config->url;
		// $this->assign('url_m',$url->url_m);
		// $this->assign('url_order',$url->url_order);
		$this -> page -> init('大V卡','','','mobile');
	}
	

	/**
	* 地址-三级联动
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 17:55:54
	*/
    public function siteDataAction(){
        $regionid = $_GET['regionid'];
        $service = new HotService();
        $result = $service->siteData($regionid);
        $this->success("返回成功",$result);
    }

    /**
	* 满额送礼
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-25 15:34:17
	*/
	public function presentAction()
	{
		$url = $this->config->url;
		$this->assign('url_m',$url->url_m);
		$this->assign('url_order',$url->url_order);
		$this -> page -> init('重磅好礼','','','mobile');
	}

	/**
	* 满额送礼 立即购买
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-26 09:59:21
	*/
	public function presentConfirmAction()
	{
		$data['mobile']     = $this->request->getPost("mobile");
		$data['address']    = $this->request->getPost("address");
		$data['name']       = $this->request->getPost("name");
		$data['region']     = $this->request->getPost("region");
		$skuid              = $this->request->getPost("skuid");
		$sku_num            = $this->request->getPost("sku_num");
		$sku_price          = $this->request->getPost("sku_price");
		$token          = $this->request->getPost("token");
		$data['present_id'] = $this->request->getPost("present_id");
		if (empty($data['mobile'])) {
			return $this->failure("手机号不能为空!",400);
		}
		if (empty($data['address'])) {
			return $this->failure("收货地址不能为空!",400);
		}
		if (empty($data['name'])) {
			return $this->failure("收货人不能为空!",400);
		}
		if (empty($skuid)) {
			return $this->failure("请选择选择商品!",400);
		}
		if (empty($data['present_id'])) {
			return $this->failure("请选择选择赠品!",400);
		}
		$skuid     = explode(",", $skuid);
		$sku_num   = explode(",", $sku_num);
		$sku_price = explode(",", $sku_price);
		$data['goods'] = array();
		$total = 0;
		foreach ($sku_num as $key => $value) {
			if ($value != 0) {
				$data['goods'][$key]['num']   = $value;
				$data['goods'][$key]['id']    = $skuid[$key];
				$data['goods'][$key]['price'] = $sku_price[$key];
				$total += $value * $sku_price[$key];
			}
		}
		if ($total <= 300) {
			return $this->failure("您选择的商品不满300元,请重新选择!",400);
		}
		$member = $this->redis->read_token($token);
		try {
			$service = new HotService();
			$order_id = $service->presentConfirm($member,$data,$total);
			return $this->success("",$order_id);
		} catch (\Exception $e) {
			// return $this->failure($e->getMessage(),400);
			return $this->failure("您未登录，请至APP登录！",400);
		}
	}

}