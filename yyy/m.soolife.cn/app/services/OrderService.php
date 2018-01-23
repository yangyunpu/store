<?php
// +----------------------------------------------------------------------
// | 订单的服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   OrderService.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-13
// +----------------------------------------------------------------------
// namespace Soolife\Member\Services;

// use Soolife\Member\Librarys\BaseService;
// use Soolife\Member\Librarys\Common;
// use Soolife\Member\Models\OrdersModel;

class OrderService extends BaseService {
	/**
	 * 获取最新的几条订单
	 * @author Tony Wang 2016-04-13
	 * @param $member_id int 会员编号
	 * @param $size int 需要返回的记录条数,默认是5条
	 */
	function Latest($member_id,$key,$size = 5) {
		$url = "/v1/orders/my/$member_id";
		$post = array("index" => 1, "size" => $size, "query" =>$key, "search" => '');
		$curl = $this -> curl;
		if ($curl -> post_request($url, $post) == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 获取会员详细资料
	 * @param $member_id int 会员编号
	 * GET v1/member/{id}
	 */
	function material(){
		$url = '/member';
		$curl = $this -> curl;
		if($curl -> get_request($url,'api') == 200){
			return $curl -> getJsonData();
		}
		return null;
	}


	/**
	 * 三级联动
	 * GET v1/basic/region/child/{id}
	 */	
	// function address($pid){
	// 	$url = "/v1/basic/region/child/{$pid}";
	// 	$curl = $this -> curl;
	// 	if($curl -> get_request($url) ==200){
	// 		return $curl -> getJsonData();
	// 	}
	// 	return null;
	// }
	function address($pid){
		$url = "/member/address/{$pid}";
		$curl = $this -> curl;
		if($curl -> get_request($url,'php_api') ==200){
			return $curl -> getJsonData();
		}
		return null;
	}
	


	/**
	 * 查询订单
	 * @author Tony Wang 2016-02-19
	 * @author Tony 2016-04-20 修改
	 * @author Luoqing 2016_04_20 修改
	 * @author zhichao_hu 2016_09_06 修改
	 * @param $query QueryModel
	 * @return string
	 * POST v1/orders/my/{id}
	 */
	function Lists($query)
	{
		$id = $this -> user -> getId();
		$url = "/indent/lists/{$id}";
		$curl = $this -> curl;
		if ($curl -> post_request($url, $query,'api') == 200)
		{
			$data = $curl -> getJsonData();
			if(!isset($data->code))
			{
				$orders = new OrdersModel();  //list活动列表
				$data = $orders->indent($data);
			    if(!isset($data->msg))
			    {
				    foreach($data['data'] as $key=>&$val)
				    {
				        $val['status_text'] = $this->Orderstatus($val['status']);   //订单状态文本装换
				        foreach($val['goods'] as $g_key=>$g_val)
					    {
						    $g_val->logo = Common::get_image_url($this -> config,$g_val->logo);
					    }
				    }
			    }
			return $data;
			}
		}
		return null;
	}

	/**
	* 获取订单列表
	* @return Array
	* @param 查询参数
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-19 11:22:22
	*/
	public function ListOrder($query){
		$id = $this->user->getId();

		//  拼接SQL
	    $stat = array();
		$sql = "SELECT _VAL_ FROM `ER_Order` WHERE `O_MemberID`=:member_id AND `O_Type` = 1";
		$stat['member_id'] = $id;
		//关键字
		if(isset($query['key'])){
			$key = addslashes(trim($query['key']));
			$sql .= " AND `O_OrderNo` LIKE '%{$key}%'";
		}

		//状态
		if(isset($query['status']) && ($query['status'] != '')){
			$sql .= ' AND `O_Status` = :status';
			$stat['status'] = $query['status'];
		}

		//开始时间
		if(!empty($query['start_time'])){
			$sql .= ' AND `O_CreateTime` > :start_time';
			$stat['start_time'] = strtotime($query['start_time']);
		}

		//结束时间
		if(!empty($query['end_time']) && intval($query['end_time']) > 0){
			$sql .= ' AND `O_CreateTime` < :end_time';
			$stat['end_time'] = strtotime($query['end_time'])+86400;
		}

		//在LIMIT 之前,获取当前条件下的总共条数
		$num_sql = 'COUNT(1) count';
		$num_sql = str_replace('_VAL_',$num_sql,$sql);
		$num_res = $this->db->fetchOne($num_sql,\Phalcon\Db::FETCH_ASSOC,$stat);

		//排序与分页
		$index = ($query['page'] -1) * $query['size'];
		$sql .= " ORDER BY `O_CreateTime` DESC LIMIT {$index},{$query['size']}";

		//ORDER 基本信息
		$data_sql = '`Order_ID`,`O_OrderNo`,`O_MemberName`,`O_PayFee`,`O_DeliveryFee`,`O_Status`,`O_CreateTime`,`O_ShopID`';

		$data_sql = str_replace('_VAL_',$data_sql,$sql);
		$res = $this->db->fetchAll($data_sql,\Phalcon\Db::FETCH_ASSOC,$stat);

		if(empty($res) || !is_array($res)){
			return false;
		}

		//每个ORDER订单编号数组
		$o_orderno = array();
		foreach ($res as $res_no) {
			$o_orderno[] = (string)$res_no['O_OrderNo'];
		}

		//订单中的商品详情
		$orders_detail = $this->get_orders_details($o_orderno);

		// 订单评价状态
		$o_comments_status = $this->get_comment_status($o_orderno);

		//子订单中的每种商品的发货信息
		$orders_delivery = null;
		if(!empty($orders_detail) && is_array($orders_detail)){
			$orders_detail_no = '';
			foreach ($orders_detail as $details_ord) {
				$orders_detail_no .= "'".$details_ord['order_no']."',";
			}
			$orders_detail_no = rtrim($orders_detail_no,',');
			$orders_delivery = $this->get_orders_delivery($orders_detail_no);
		}

		//拼接评论状态
		foreach ($o_comments_status as $ck => $cval) {
			foreach ($res as $k => &$v) {
				if($v['O_OrderNo'] == $cval['C_OrderNo'])
				{
					$v['comment']  = $cval['num'] > 0 ? 'Y' : 'N';
				}else{
					$v['comment'] = 'N';
				}
			}
		}

		//查询店铺信息
		if(!empty($res) && is_array($res))
		{
			$shop = array();
			foreach ($res as $value) {
				$shop[] = $value['O_ShopID'];
			}
			$shop_res = $this->shop_info($shop);
		}

		// 格式化订单信息
		$order_info = array();
		foreach ($res as $key => $val) {
			$order_info[$key]['order_id']     = $val['Order_ID'];
			$order_info[$key]['order_no']     = $val['O_OrderNo'];
			$order_info[$key]['member_name']  = $val['O_MemberName'];
			$order_info[$key]['pay_fee']      = $val['O_PayFee'];
			$order_info[$key]['delivery_fee'] = $val['O_DeliveryFee'];
			$order_info[$key]['status']       = $val['O_Status'];
			$order_info[$key]['status_text']  = $this->Orderstatus($val['O_Status']);
			$order_info[$key]['create_time']  = $val['O_CreateTime'];
			$order_info[$key]['shop_id']      = $val['O_ShopID'];
			$order_info[$key]['comment']      = $val['comment'];

			if(!empty($shop_res) && is_array($shop_res)){
				foreach ($shop_res as $shop_key => $shop_val) {
					if(isset($shop_val['S_ShopNo']) && ($val['O_ShopID'] == $shop_val['S_ShopNo'])){
						$order_info[$key]['shop_name'] = $shop_val['S_Name'];
					}else{
						$order_info[$key]['shop_name'] = '如此生活';
					}
				}
			}else{
				$order_info[$key]['shop_name'] = '如此生活';
			}
		}

		//数组中加入订单的 商品信息  与发货信息
		$join_arr = function($v) use($orders_detail,$orders_delivery){
			//数组中加入该订单的发货信息
			 if(!empty($orders_delivery) && is_array($orders_delivery)){
			 	foreach ($orders_delivery as $d_key => $d_val) {
			 		if($v['order_no'] == $d_val['order_no'])
			 		{
			 			$v['order_delivery'] = $orders_delivery[$d_key];
			 		}
			 	}
			 }

			//订单中商品信息
			$v['items'] = array();
			foreach ($orders_detail as $k => $o_val) {
				if($v['order_no'] == $o_val['order_no'])
				{
					$v['items'][] = $orders_detail[$k];
				}
			}
			return $v;
		};

		$order_result = array();
		$order_result['count']  = $num_res['count'];
		$order_result['orders'] = array_map($join_arr,$order_info);

		return $order_result;
	}

	/**
	* 获取店铺信息
	* @return array
	* @param 店铺ID 数组
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-19 11:58:17
	*/
	private function shop_info($param)
	{
		if(empty($param))
		{
			return null;
		}
		$shop = implode(',',array_unique($param));
		$shop_sql = "SELECT `S_ShopNo`,`S_Name` FROM `ER_Shop` WHERE `Shop_ID` IN ($shop);";
		$shop_res = $this->db->fetchAll($shop_sql);
		return $shop_res ? $shop_res : null;
	}

	/**
	* 获取订单详情
	* @param 订单编号  array
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-19 17:07:05
	*/
	private function get_orders_details($orders){
		if(empty($orders))
		{
			return null;
		}
		$condition = "";
		foreach ($orders as $value)
		{
			$condition .= "'".$value."',";
		}
		$condition = rtrim($condition,',');

		$sql = "SELECT `D_OrderNo` order_no,`D_SkuID` sku_id,`D_SkuName` sku_name,`D_SkuPrice` sku_price,`D_SkuActPrice` sku_actprice,`D_Coin` coin,`D_Qty` qty,`D_GoodsPicture` logo FROM `ER_OrderDetail` WHERE `D_OrderNo` IN ({$condition});";
		$res = $this->db->fetchAll($sql);

		return $res;
	}

	/**
	* 获取订单评论状态
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-20 11:52:16
	*/
	private function get_comment_status($orders){
		if(empty($orders)){
			return null;
		}
		$condition = "";
		foreach ($orders as $value) {
			$condition .= "'".$value."',";
		}
		$condition = rtrim($condition,',');

		$comments_sql = "SELECT C_OrderNo,count(1) num FROM `GM_SpuComments` WHERE `C_OrderNo` IN ({$condition});";
		$comments_res = $this->db->fetchAll($comments_sql);

		return $comments_res;
	}

	/**
	* 获取订单发货信息
	* @return array
	* @param ordersID字符串,用,隔开
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-28 19:53:51
	*/
	private function get_orders_delivery($ids){
		$res = null;
		$sql = "SELECT `D_OrderNo` order_no,`D_ExpressName` express_name,`D_ExpressCode` express_code,`D_Consignee` consignee,`D_Mobile` mobile FROM `ER_OrderDelivery` WHERE `D_OrderNo` IN ({$ids});";
		$res = $this->db->fetchAll($sql);
		return $res;
	}

	/**
	 * 订单状态
	 * @author Luo Qing 2016-06-06
	 *
	 */
	function Orderstatus($status){
		switch($status) {
			case 0 :
				return '代付款';
			case 1 :
				return '待付款';
			case 2 :
				return '已付款';
			case 3 :
				return '已取消';
			case 4 :
				return '已删除';
			case 5 :
				return '待发货';
			case 6 :
				return '打包中';
			case 7 :
				return '已发货';
			case 8 :
				return '已收货';
			case 9 :
				return '交易完成';
			case 10 :
				return '退款成功';
			default :
				return '退款失败';
		}
	}



	/**
	 * 取消订单
	 * @author Luoqing 2016-04-20
	 * @author zhichao_hu 2016-10-12
	 *POST /v2/order/{$id}/action/cancel
	 */
	function cancel($data) {
		$url = "/orders/cancel";
		$curl = $this -> curl;
// echo "<pre>";
// 		print_r($data);
// 		exit;
		$curl -> post_request($url, $data,"api");
		$result = $curl -> getArrayData();
		// echo "<pre>";
		// print_r($result);
		// exit;

		return $result;
	}

	/**
	 * 确定订单
	 * 	POST v1/orders/confirm/{id}
	 */
	function confirm($id) {
		$url = "/orders/finish/{$id}";
		$curl =$this -> curl;
		if ($curl -> post_request($url, array(),'api') == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 根据订单号获取订单详情
	 * @param $id:int 订单号
	 * 	GET v1/orders/orders/{$id}
	 */
	function details($id)
	{
		$url = "/indent/{$id}";
		$curl = $this -> curl;
		if ($curl -> get_request($url,'api') == 200) {
			$data =  $curl -> getArrayData();
			$data['status_text'] = $this -> Orderstatus($data['status']);
			return $data;
		}
		return null;
	}
	/**
	 * 根据订单号进入订单评论页
	 * @param $id:int 订单号
	 * 	POST v1/orders/eval/imgkey
	 */
	function comments($no) {
		$url = "/indent/{$no}";
		$curl = $this -> curl;
		if ($curl -> get_request($url,'api') == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 提交订单评论
	 * POST /v1/orders/eval/imgkey
	 */
	function comments_review($data) {
		$url = "/indent/evaluate";
		$curl = $this -> curl;
		if ($curl -> upload_request($url,array(),$data,'api') == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 售后
	 * 
	 * */
	 public function aftermarket($data)
	 {
	 	$url = "/orders/service/apply";
		$curl = $this -> curl;
		if($curl -> upload_request($url,array(),$data,'api') == 200)
		{
			return  null;
		}
		return  $curl -> getJsonData();
	 }

	/**
	 * 菜单栏中返退换货记录
	 * POST "/v1/orders/after/myafterorder/"$member_id;
	 */
	public function austin($query) {
		$id = $this -> user ->getId();
		$url = "/orders/service";
		$curl = $this -> curl;
		if ($curl -> post_request($url, $query,'api') == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 菜单栏中返退换货记录 --> 修改页面
	 * GET v1/orders/after/{id}
	 */
	 public function revamp($id){
	 	$url = "/v1/orders/after/{$id}";
		$curl = $this -> curl;
		if ($curl -> get_request($url) == 200) {
			return $curl -> getJsonData();
		}
		return null;
	 }

	/**
	 * 菜单栏中返退换货记录--单件查看
	 * POST "/v1/orders/after/"{id};
	 */
	public function austin_detail($id) {
		$url = "/orders/service/details/{$id}";
		$curl = $this -> curl;
		// print_r($id);
		// print_r($curl -> get_request($url, 'api'));
		// print_r($curl -> getJsonData());
		// exit;
		if ($curl -> get_request($url, 'api') == 200) {
			// print_r($curl -> getJsonData());exit;
			return $curl -> getArrayData();
		}
		var_dump($curl -> getResponseText());
		return null;
	}
	/**
	 * 菜单栏中返退换货记录--取消售后
	 * $id 订单ID
	 * 							 
	 */
	public function countersign($id) {
		//print_r($id);exit;
		$url = "/orders/service/cancel/{$id}";
		$curl = $this -> curl;
		if ($curl -> delete_request($url,'','api') == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 菜单栏中返退换货记录--问题确认状态
	 * @param $status 售后解决状态 1:已解决 2:未解决
	 * 		  $id 订单ID
	 * 							 
	 */
	public function problem($id,$status) {
		if($status == 1)
		{
			$url = "/orders/service/solved/{$id}";
		}elseif($status == 2)
		{
			$url = "/orders/service/unsolved/{$id}";
		}
		$curl = $this -> curl;
		if ($curl -> get_request($url,'api') == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}



	/**
	 * 菜单栏中返退换货记录--单件查看-->我要发货
	 * POST v1/orders/after/customer/delivery
	 */
	public function shipments($post) {
		$url = "/v1/orders/after/customer/delivery";
		$curl = $this -> curl;
		if ($curl -> post_request($url, $post) == 200) {
			return $curl -> getJsonData();
		}
		var_dump($curl -> getResponseText());
		return null;
	}

	/**
	 * 菜单栏中返退换货记录--我要退换货
	 * @author zhichao 2016-08-1
	 * POST "v1/orders/after/myorder/"{id};
	 */
	public function need_return($query) {
		$id = $this -> user -> getId();
		$url = "/v1/orders/after/myorder/{$id}";
		$curl = $this -> curl;
		if ($curl -> post_request($url, $query) == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 菜单栏中返退换货记录--我要退换货--售后
	 * @author zhichao 2016-08-1
	 * GET  v1/orders/getorder/{orderno};
	 */
	public function aftersale($id) {
		$url = "/v1/orders/getorder/{$id}";
		$curl = $this -> curl;
		if ($curl -> get_request($url) == 200) {
			return $curl -> getJsonData();
		}
		var_dump($curl -> getResponseText());
		return null;
	}

	/**
	 * 菜单栏中返退换货记录--我要退换货--售后 -- 提交售后
	 * @author zhichao 2016-08-1
	 POST v1/orders/after/add
	 */
	public function aftersubmission($post) {
		$url = "/v1/orders/after/add";
		$curl = $this -> curl;
		if ($curl -> post_request($url,$post) == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}


	/**
	 * 菜单栏中返退换货记录--申请退款
	 * @author Luo Qing 2016-05-11
	 * @author Luo Qing 2016-05-17
	 * POST v1/orders/after/rediretfund
	 */
	 public function drawback($data){
		$url = "/v1/orders/after/rediretfund";
		$curl = $this -> curl;
		if($curl -> post_request($url,$data) == 200){
			return $curl -> getJsonData();
		}
		return null;
	 }

	/**
	 * 菜单栏中退款记录
	 * @author Luoqing 2016-04-22
	 */
	public function refund($query) {

		$id = $this -> user -> getId();
		$url = "/v1/orders/after/myrefund/{$id}";
		$curl = $this -> curl;
		if ($curl -> post_request($url, $query) == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 菜单栏中退款记录--单件查看详情
	 * @author Luoqing 2016-04-23
	 * GET /v1/orders/after/refund/$id
	 */
	public function refund_detail($id) {
		$url = "/v1/orders/after/refund/{$id}";
		$curl = $this -> curl;
		if ($curl -> get_request($url) == 200) {
			return $curl -> getJsonData();
		}
		return null;
	}

	/**
	 * 根据订单状态制定制定的数值
	 * @author Luoqing 2016-04-22
	 * @param $status 订单状态
	 */
	function convert_status($status, $comment) {

		if ($status == 0 || $status == 1) {
			return 2;
			//新订单或系统确认订单
		} else if ($status == 2 || $status == 5 || $status == 6 || $status == 7) {
			return 3;
			//在线支付完成	仓库已接收（商家确认、仓库确认)	商品打包中 	发货中
		} else if ($status == 3 || $status == 4) {
			return 6;
			//已取消订单	已删除订单
		} else if ($status == 8 && $comment == 'Y') {
			return 10;
			//客户已收货,并已经评论
		} else if ($status == 8 && $comment == 'N') {
			return 11;
			//客户已收货,未评论
		} else if ($status == 9) {
			return 7;
			//退正在退款
		} else if ($status == 10) {
			return 8;
			//退款成功
		} else if ($status == 11) {
			return 9;
			//退款失败
		}
	}
	

}
?>