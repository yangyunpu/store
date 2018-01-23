<?php
// +----------------------------------------------------------------------
// | Models版 订单的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Luo Qing
// | Created:   2016-05-23
// +----------------------------------------------------------------------
// namespace Soolife\Member\Librarys;
// use Soolife\Member\Librarys\ApproveController;
// use Soolife\Member\Services\OrderService;
// use Soolife\Member\Librarys\Common;
header("Content-Type: text/html; charset=utf-8");
class OrdersController extends BaseController {

	/**
	 * 我的订单列表
	 * @author zhichao_hu 2016-09-06 修改
	 * @return view
	 */
	public function indexAction(){
		//是否是ajax点击
		$act = $this->request->get("act");
		//是否是下拉
		$scroll = $this->request->get("scroll");
		//接收状态
		$status = $this ->request->get("status",'string','');
		//下拉刷新叶数
		$index = $this ->request->getPost("index");  //等同于页码
		$index = @intval($index);
		if (empty($index)){
			$index = 1;
		}


		$a = array("status"=>$status,"type"=>1);
		$query = array("index"=>$index,"size"=>30,"search"=>$a);
		$order  = new OrderService();
		$result = $order -> Lists($query);


		$this -> assign("status",$status);
		$this -> assign("result",$result);

		$this ->page->page_url();   //绑定路径
		if($act==1 && $index==1){
			$this->view->pick("orders/index_middle");
		}else if($scroll==1 && $index>1){
          	$this->view->pick("orders/index_middle");
		}else{
			$this -> page -> init("如此生活-我的订单", "", "","mobile",'','','layout_main');
		}
		// $this->view->pick('orders/index');
		// $this->display('/orders/index');
	}

	/**
	 * 我的订单列表 -->订单详情
	 * @author zhichao_hu 2016-10-09
	 * @return view
	 */
	 public function detailsAction($id){
	 	$order = new OrderService();
		$result = $order -> details($id);
		if(isset($result['items']))
		{
			foreach($result['items'] as $key => &$value)
			{
				$value['logo'] = Common::get_image_url($this -> config,$value['logo']);
			}
			if(!isset($result['shop_name']) || empty($result['shop_name']))
			{
				$result['shop_name'] = "如此生活";
			}

		}
		if(!isset($result['delivery_type_text']) || !isset($result['express_name']) || !isset($result['express_code']) || !isset($result['logs']))
		{
			$result['delivery_type_text']="";
			$result['express_name']="";
			$result['express_code']="";
			$result['logs']="";
		}

		if(isset($result['delivery_type']) && $result['delivery_type'] == 2){
			$order_no  = $result['order_no'];
			$member_id = $this->user->getId();
        	$qrcode    = $order_no.'|'.$member_id;
       	 	$ims       = $this-> config -> images -> toArray();
        	$d         = array_rand($ims);
        	$url_images= $ims[$d];
        	$img_url   = $url_images.'/qrcode/'.Common::base64url_encode($qrcode).'.jpg';
		}
		// echo "<pre>";
		// print_r($result);exit;
		$this -> assign('img_url',$img_url);
		$this -> assign("result",$result);
		$this -> page -> init("如此生活-订单详情", "", "","mobile",'','','layout_main');
	 }

	/**
	 * 我的订单列表 -->订单详情-->物流信息
	 * @return view
	 */
	public function deliverinfoAction($id){
		$order = new OrderService();
		$result = $order -> details($id);
		if(isset($result['logs'])){
			$i=current($result['logs']);
			// echo "<pre>";
			// print_r($i);
			// exit;
			$record = $i['record'];
		}else{
			$result['logs'] = " ";
		}
		// echo "<pre>";print_r($result);exit;
		$this -> assign("record",$record);
		$this -> assign("result",$result);
		$this -> page -> init("如此生活-订单详情", "", "","mobile",'','','layout_main');
	}

	/**
	 * 取消订单
	 * @author zhichao_hu 2016/09/28 v2
	 * @return json
	 */
	public function CancelAction($id,$type){

		$order = new OrderService($this);
		$data = array("type"=>$type,"order_no"=>$id);
		$result = $order -> cancel($data);
		// echo "<pre>";
		// print_r($result);
		// exit;
		if (isset($result)){
		    return $this -> success('取消订单成功', $result, $id);
		}else{
		    return $this -> failure('取消订单失败', $result, $id);
		}
	}

	/**
	 * 确认订单
	 * @return json
	 */
	public function ConfirmAction($id){
		$order = new OrderService();
		$result = $order -> confirm($id);
		if (isset($result)) {
			return $this -> success('确认订单成功', $result, $id);
		}
		return $this -> failure('确认订单失败', $result, $id);
	}

	/**
	 * 订单评论
	 * @return  json
	 */
	 public function commentAction($no)
	 {

	 	if($this -> request -> isPost()){
			try{
				$_POST['content'] = htmlentities($_POST['content'],ENT_QUOTES);
				$data = array();
				$data = $_POST;
				$data['ip'] = $this -> context -> get_client_address();
				$data['member_id'] = $this -> user -> getId();
				$order = new OrderService();
				$result = $order -> comments_review($data);
				if (isset($result)){
					return $this -> success('评论成功', $result, $no);
				}else{
					return $this -> failure('评论失败',"", $result, $no);
				}
			}catch(Exception $e){
				return $this->failure("操作失败!");
			}
	 	}else{
		 	$order = new OrderService();
			//获取该订单的详细信息
			$result = $order -> comments($no);
			foreach($result->items as $key => &$value){
				$value->logo = Common::get_image_url($this -> config,$value->logo);
			}
			$this -> assign("result",$result);
			$this -> page -> init("如此生活-订单评论", "", "","mobile",'','','layout_main');
	 	}
	 }


	 /**
	  * 菜单栏中的全民商探  --->地址
	  * @return view
	  */
	 // function regionAction() {
	 // 	$pid = $this -> context -> get_query("pid");
	 // 	$explore = new ExploreService();
	 // 	$lists = $explore -> address($pid);
	 // 	return $this -> success('', $lists);
	 // }
	 function regionAction() {
	 	$pid = $this -> context -> get_query("pid");
	 	$explore = new OrderService();
	 	$lists = $explore -> address($pid);
	 	return $this -> success('', $lists);
	 }


      /**
	 * 我的售后/申请售后
	 * @return
	 * @param
	 * @author Qing_L 2016.12.05
	 * @date
	 */
	 public function customer_serviceAction()
	 {
	 	if($this -> request -> ispost()){
	 		try{
	 			// print_r($_POST);exit;
	 			$order_no = $_POST['order_no'];
	 			$type = $_POST['entry'];
	 			$sku_id = $_POST['sku_id'];
	 			$description = htmlentities($_POST['description'],ENT_QUOTES);
	 			if (!filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT)){
	 				throw new Exception("提交失败!");
	 			}
	 			$qty = $_POST['qty'];
	 			$consignee = $_POST['consignee'];
	 			$phone = $_POST['phone'];
	 			$region = $_POST['region'];
	 			$phone = $_POST['phone'];
	 			$address = $_POST['address'];
	 			$data = array("consignee"=>$consignee,"phone"=>$phone,"region"=>$region,"address"=>$address,"phone"=>$phone,"order_no"=>$order_no,"type"=>$type,"sku_id"=>$sku_id,"description"=>$description,"qty"=>$qty);
	 			$order = new OrderService();
				$result = $order -> aftermarket($data);
				// print_r($result);exit;
				if (!isset($result)){
			    	return $this -> success('提交成功', $result, "");
				}else{
			    	return $this -> failure($result);
				}

	 		}catch(Exception $e){
	 			return $this->failure("提交失败!",$e->getMessage());
	 		}
	 	}else{
	        $order_id = $this -> request ->get('id');
	        $sku_id = $this -> request -> get("sku_id");
	        $order = new OrderService();
			$result = $order -> details($order_id);
			// print_r($result);exit;
			//装换成数组
			$data = Common::object_to_array($result);
			$a = $data['items'];
			$data = array_filter($a,function($v) use ($sku_id) { return $v['sku_id'] == $sku_id ;});
			foreach($data as &$val){
				$val['logo'] = Common::get_image_url($this -> config, $val['logo']);
			}
			$this->assign('result',$result);
            $this->assign('data',$data);
	        $this -> page -> init("如此生活-我的售后/申请售后", "", "","mobile",'','','layout_main');
	 	}
	}

	 /**
	 * 售后/退款
	 * @return  view
	 */
	 public function aftersaleAction(){
	 	//接收状态
	 	$status = $this -> context -> get_query('status');
		$status = @intval($status);
		if(!empty($status)){
			$search['status'] = $status;
		}else{
			$search['status'] = 0 ;
		}
	 	$page = 1;
		$size = 10000;
		$search=array("type"=>1,"status"=>$status);
		$query = array("index"=>1,"size"=>$size,"query"=>"","search"=>$search);

		$order = new OrderService();
		$result = $order -> austin($query);
		foreach($result -> items as $key => &$value){
			$value -> logo = Common::get_image_url($this -> config ,$value -> logo);
		}
		//print_r($result);exit;
		$this -> assign("status",$status);
		$this -> assign("result",$result);
		$this -> page -> init("如此生活-我的售后/退款", "", "","mobile",'','','layout_main');
	 }


 	/**
	 * 售后/退款 详情
	 * @return  view
	 */
	 public function particularsthAction($id){
	 	// print_r($id);exit;
		$order = new OrderService();
		$result = $order -> austin_detail($id);
		// print_r($result);exit;
		$this -> assign("details",$result['details']);
		$this -> assign("progress",$result['progress']);
		$this -> page -> init("如此生活-我的售后/退款详情", "", "","mobile",'','','layout_main');
	 }

	 /**
	 * 售后/退款 -->取消售后
	 * @return  view
	 */
	 public function editstatusAction(){
	 	$id = $this -> context -> get_query("aftersales_id");
		$order = new OrderService();
		$result = $order -> countersign($id);
		if(isset($result)){
			return $this -> success("确认成功!",$result,"");
		}
		return $this -> failure("申请退款失败", $result, "");
	 }

	 /**
	 * 售后/退款 -->问题解决状态变化
	 * @return  view
	 */
	 public function problemAction(){
	 	$id = $this -> context -> get_query("aftersales_id");
		$status = $this -> context -> get_query("status");
		$order = new OrderService();
		$result = $order -> countersign($id,$status);
		if(isset($result)){
			return $this -> success("确认成功!",$result,"");
		}
		return $this -> failure("申请退款失败", $result, "");
	 }

}


