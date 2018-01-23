<?php
// +----------------------------------------------------------------------
// | 招商服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:
// | Author: Dandan_Sun
// | Created: 2016-11-07 11:38:15
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;

class HotService extends BaseService{
	private $db_identifier = 'goods';

	/**
	* 一元购确认订单
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 16:54:25
	*/
	public function confirm($member,$address)
	{
		try {
			$sku_id = '57984';
			$key = "goods:id:" . $sku_id;
			$data = $this->redis -> read($key,$this->db_identifier);
			if (empty($data) || $data = "NODATA") {
				$sql = "SELECT S_Name name,S_Barcode barcode,S_Spec specs,S_Unit unit,S_Logo logo,S_ShopID shop_id,S_SuppliersID supplier_id,Sku_ID sku_id,S_ShopPrice shop_price FROM gm_sku WHERE Sku_ID =  '{$sku_id}' AND S_OnlineSale = 1;";
				$data = $this->db->fetchOne($sql);
				if (empty($data)) {
					throw new \Exception("该商品不存在,请联系客服",100);
				}
			}
			$organize_no = '5001';
			$time = time();
			//判断用户是否有机会购买 当天注册 同一个ID 收货号码 地址 均视为同一用户
			$sql = "SELECT A_CreateTime FROM er_memberauthorization WHERE A_MemberID = '{$member->member_id}';";
			$create_time = $this->db->fetchOne($sql)['A_CreateTime'];
			$this->logger->info("member_id：");
			$this->logger->info($member->member_id);
			$this->logger->info(var_export($member,TRUE));
			if ($create_time < strtotime(date('Y-m-d'))) {
				throw new \Exception("您不是今天注册的用户,不能享受此优惠！",100);
			}
			$sql = "SELECT COUNT(1) num FROM er_orderdetail d LEFT JOIN er_order o ON (o.O_OrderNo = d.D_OrderNo) WHERE o.O_MemberID = '{$member->member_id}' AND d.D_SkuID = '{$sku_id}' AND o.O_Status <> 3;";
			$count = $this->db->fetchOne($sql)['num'];
			if ($count >= 1) {
				throw new \Exception("您已购买过此商品！",100);
			}

			//事务
			//开始
			$this->db->begin();

			//写入订单表 ER_Order
			$order_sql = "INSERT INTO `er_order` (`O_OrderNo`, `O_OrderOrganizeNo`, `O_MainOrderFlag`, `O_MainOrderNo`, `O_StockOrganizeNo`, `O_MemberID`, `O_MemberName`, `O_DeviceID`, `O_Cashier`, `O_CashierNo`, `O_GoodsFee`, `O_DiscountFee`, `O_DeliveryFee`, `O_PayFee`, `O_PayCoin`, `O_Status`, `O_CreateTime`, `O_PayTime`, `O_FinishTime`, `O_DeliveryType`, `O_Type`, `O_TradeNo`, `O_ShopID`, `O_SupplierNo`, `O_PayStatus`, `O_CancelStatus`) VALUES (:O_OrderNo,:O_OrderOrganizeNo,:O_MainOrderFlag,:O_MainOrderNo,:O_StockOrganizeNo,:O_MemberID,:O_MemberName,:O_DeviceID,:O_Cashier,:O_CashierNo,:O_GoodsFee,:O_DiscountFee,:O_DeliveryFee,:O_PayFee,:O_PayCoin,:O_Status,:O_CreateTime,:O_PayTime,:O_FinishTime,:O_DeliveryType,:O_Type,:O_TradeNo,:O_ShopID,:O_SupplierNo,:O_PayStatus,:O_CancelStatus);";
			//Create OrderNO
			$createOrderNo_sql = "SELECT FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) mainorder_no,FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) order_no;";
			$create_order_res = $this->db->fetchOne($createOrderNo_sql);
			$order_no = $create_order_res['order_no'];
			$this->db->execute($order_sql,array(
				"O_OrderNo" => $order_no,
			    "O_OrderOrganizeNo" => $organize_no,
				"O_MainOrderFlag" => 2,
				"O_MainOrderNo" => $create_order_res['mainorder_no'],
				"O_StockOrganizeNo" => 3101,
				"O_MemberID" => $member->member_id,
				"O_MemberName" => $member->nickName,
				"O_DeviceID" => '0000',
				"O_Cashier" => "系统",
				"O_CashierNo" => 0000,
				"O_GoodsFee" => '1',
				"O_DiscountFee" => '0.00',
				"O_DeliveryFee" => '0.00',
				"O_PayFee" => '1',
				"O_PayCoin" => 0,
				"O_Status" => 0,
				"O_CreateTime" => $time,
				"O_PayTime" => 0,
				"O_FinishTime" => 0,
				"O_DeliveryType" => 1,
				"O_Type" => 1,
				"O_TradeNo" => "",
				"O_ShopID" => 0,
				"O_SupplierNo" => 0,
				"O_PayStatus" => 0,
				"O_CancelStatus" => 0,
			));
			$order_id = $this->db->lastInsertId();

			//写入订单详情表 ER_OrderDetail
			$sql = "INSERT INTO `er_orderdetail` (`D_OrderNo`, `D_SkuID`, `D_SkuName`, `D_SkuBarcode`, `D_SkuSpecs`, `D_SkuUnit`, `D_SkuPrice`, `D_SkuActPrice`, `D_GoodsPicture`, `D_Coin`, `D_Qty`, `D_QtyReturn`, `D_QtyExchange`, `D_ActivityNo`, `D_GoodType`, `D_GoodKind`, `D_ShopNo`, `D_SupplierNo`, `Sync`) VALUES (:D_OrderNo,:D_SkuID,:D_SkuName,:D_SkuBarcode,:D_SkuSpecs,:D_SkuUnit,:D_SkuPrice,1,:D_GoodsPicture,0,1,0,0,'',2,1,:S_ShopID,:S_SuppliersID,'');";
			$this->db->execute($sql,array(
				"D_OrderNo" => $order_no,
				"D_SkuID" => $sku_id,
				"D_SkuName" => $data["name"],
				"D_SkuBarcode" => $data["barcode"],
				"D_SkuSpecs" => $data["specs"],
				"D_SkuUnit" => $data["unit"],
				"D_SkuPrice" => $data["shop_price"],
				"D_GoodsPicture" => $data["logo"],
				'S_ShopID' => $data['shop_id'],
				'S_SuppliersID' => $data['supplier_id']
			));

			//写入订单日志表 ER_OrderLog
			$sql = "INSERT INTO er_orderlog (L_OrderNo, L_CreateTime, L_Handler, L_IP, L_Record ,L_Origin, L_Changed, L_Milestone) VALUES (:L_OrderNo, :L_CreateTime, '', '', :L_Record , '', '', 1);";
			$this->db->execute($sql,array(
				"L_OrderNo"  => $order_no,
				"L_CreateTime"  => $time,
				"L_Record"  => "用户创建订单",
			));

			//写入订单收货人信息表 er_orderdelivery
			$sql = "INSERT INTO er_orderdelivery (D_OrderNo, D_ExpressName, D_ExpressCode, D_Consignee, D_Telphone ,D_Mobile, D_IDCard, D_Email, D_Region, D_Address, D_InvoiceNo, D_InvoiceTitle, D_InvoiceContent, D_Remark) VALUES (:D_OrderNo, '', '', :D_Consignee, :D_Telphone, :D_Mobile, :D_IDCard, :D_Email, :D_Region, :D_Address, :D_InvoiceNo, :D_InvoiceTitle, :D_InvoiceContent, :D_Remark);";
			$this->db->execute($sql,array(
				"D_OrderNo"  => $order_no,
				"D_Consignee"  => $address['name'],
				"D_Telphone"  => '',
				"D_Mobile"  => $address['mobile'],
				"D_IDCard"  => '',
				"D_Email"  => '',
				"D_Region"  => $address['region'],
				"D_Address"  => $address['address'],
				"D_InvoiceNo"  => '',
				"D_InvoiceTitle"  => '',
				"D_InvoiceContent"  => '',
				"D_Remark"  => "一元抢购商品",
			));

			//写入用户地址表 er_memberaddress
			$sql = "SELECT COUNT(1) num FROM er_memberaddress WHERE A_MemberID = '{$member->member_id}' AND A_StatusFlag <> 2;";
			$count = $this->db->fetchOne($sql)['num'];
			$flag = $count > 0 ? 0 : 1;
			$sql = "INSERT INTO er_memberaddress (A_ShortName, A_MemberID, A_RegionNo, A_Address, A_Consignee ,A_Phone, A_Mobile, A_EMail, A_Type, A_DefaultFlag, A_LastUseFlag, A_StatusFlag, Sync) VALUES (:A_ShortName, :A_MemberID, :A_RegionNo, :A_Address, :A_Consignee, :A_Phone, :A_Mobile, :A_EMail, :A_Type, :A_DefaultFlag, :A_LastUseFlag, :A_StatusFlag, :Sync);";
			$this->db->execute($sql,array(
				"A_ShortName"  => '',
				"A_MemberID"  => $member->member_id,
				"A_RegionNo"  => $address['region'],
				"A_Address"  => $address['address'],
				"A_Consignee"  => $address['name'],
				"A_Phone"  => '',
				"A_Mobile"  => $address['mobile'],
				"A_EMail"  => '',
				"A_Type"  => 1,
				"A_DefaultFlag"  => $flag,
				"A_LastUseFlag"  => 1,
				"A_StatusFlag"  => 1,
				"Sync"  => '',
			));

			//提交
			$this->db->commit();
			return $order_id;

		} catch (Exception $e) {
			//回滚
			$this->db->rollback();
			$this->logger->info("失败：");
			$this->logger->info($e->getMessage());
			throw new \Exception($e->getMessage(),400);
		}
	}

	/**
	* 一元购确认订单
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 16:54:25
	*/
	public function cashConfirm($member,$address,$skuid)
	{
		try {
			$address['unique'] = empty($address['unique']) ? 0 : $address['unique'];
			//查询充值卡信息
			$sql = "SELECT * FROM gm_virtualgoods WHERE G_Name =  '1000元' AND G_Status = 1;";
			$sku = $this->db->fetchOne($sql);
			if (empty($sku)) {
				throw new \Exception("该商品不存在或已下架,请联系客服",100);
			}

			//查询赠品信息
			$key = "goods:id:" . $skuid;
			$data = $this->redis -> read($key,$this->db_identifier);
			if (empty($data) || $data = "NODATA") {
				$sql = "SELECT S_Name name,S_Barcode barcode,S_Spec specs,S_Unit unit,S_Logo logo,S_ShopID shop_id,S_SuppliersID supplier_id FROM gm_sku WHERE Sku_ID =  '{$skuid}' AND S_OnlineSale = 1;";
				$data = $this->db->fetchOne($sql);
				if (empty($data)) {
					throw new \Exception("该商品不存在,请联系客服",100);
				}
			}

			$organize_no = '5001';
			$time = time();
			//事务
			//开始
			$this->db->begin();

			//充值卡
			//写入订单表 ER_Order
			$order_sql = "INSERT INTO `er_order` (`O_OrderNo`, `O_OrderOrganizeNo`, `O_MainOrderFlag`, `O_MainOrderNo`, `O_StockOrganizeNo`, `O_MemberID`, `O_MemberName`, `O_DeviceID`, `O_Cashier`, `O_CashierNo`, `O_GoodsFee`, `O_DiscountFee`, `O_DeliveryFee`, `O_PayFee`, `O_PayCoin`, `O_Status`, `O_CreateTime`, `O_PayTime`, `O_FinishTime`, `O_DeliveryType`, `O_Type`, `O_TradeNo`, `O_ShopID`, `O_SupplierNo`, `O_PayStatus`, `O_CancelStatus`) VALUES (:O_OrderNo,:O_OrderOrganizeNo,:O_MainOrderFlag,:O_MainOrderNo,:O_StockOrganizeNo,:O_MemberID,:O_MemberName,:O_DeviceID,:O_Cashier,:O_CashierNo,:O_GoodsFee,:O_DiscountFee,:O_DeliveryFee,:O_PayFee,:O_PayCoin,:O_Status,:O_CreateTime,:O_PayTime,:O_FinishTime,:O_DeliveryType,:O_Type,:O_TradeNo,:O_ShopID,:O_SupplierNo,:O_PayStatus,:O_CancelStatus);";
			//Create OrderNO
			$createOrderNo_sql = "SELECT FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) mainorder_no,FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) order_no;";
			$create_order_res = $this->db->fetchOne($createOrderNo_sql);
			$order_no = $create_order_res['order_no'];
			$this->db->execute($order_sql,array(
				"O_OrderNo" => $order_no,
			    "O_OrderOrganizeNo" => $organize_no,
				"O_MainOrderFlag" => 2,
				"O_MainOrderNo" => $create_order_res['mainorder_no'],
				"O_StockOrganizeNo" => $address['unique'],
				"O_MemberID" => $member->member_id,
				"O_MemberName" => $member->nickName,
				"O_DeviceID" => $organize_no,
				"O_Cashier" => "系统",
				"O_CashierNo" => 0000,
				"O_GoodsFee" => $sku['G_Value'],
				"O_DiscountFee" => '0.00',
				"O_DeliveryFee" => '0.00',
				"O_PayFee" => $sku['G_PayValue'],
				"O_PayCoin" => 0,
				"O_Status" => 0,
				"O_CreateTime" => $time,
				"O_PayTime" => 0,
				"O_FinishTime" => 0,
				"O_DeliveryType" => 5,
				"O_Type" => 1,
				"O_TradeNo" => "",
				"O_ShopID" => 0,
				"O_SupplierNo" => 0,
				"O_PayStatus" => 0,
				"O_CancelStatus" => 0,
			));
			$order_id = $this->db->lastInsertId();

			//写入订单详情表 ER_OrderDetail
			$sql = "INSERT INTO `er_orderdetail` (`D_OrderNo`, `D_SkuID`, `D_SkuName`, `D_SkuBarcode`, `D_SkuSpecs`, `D_SkuUnit`, `D_SkuPrice`, `D_SkuActPrice`, `D_GoodsPicture`, `D_Coin`, `D_Qty`, `D_QtyReturn`, `D_QtyExchange`, `D_ActivityNo`, `D_GoodType`, `D_GoodKind`, `D_ShopNo`, `D_SupplierNo`, `Sync`) VALUES (:D_OrderNo,:D_SkuID,:D_SkuName,'','','',:D_SkuPrice,:D_SkuActPrice,'',0,1,0,0,'',2,2,0,0,'');";
			$this->db->execute($sql,array(
				"D_OrderNo" => $order_no,
				"D_SkuID" => $sku['VirtualGoods_ID'],
				"D_SkuName" => $sku["G_Name"],
				"D_SkuPrice" => $sku['G_Value'],
				"D_SkuActPrice" => $sku['G_PayValue']
			));

			//写入订单收货人信息表 er_orderdelivery
			$sql = "INSERT INTO er_orderdelivery (D_OrderNo, D_ExpressName, D_ExpressCode, D_Consignee, D_Telphone ,D_Mobile, D_IDCard, D_Email, D_Region, D_Address, D_InvoiceNo, D_InvoiceTitle, D_InvoiceContent, D_Remark) VALUES (:D_OrderNo, '', '', :D_Consignee, :D_Telphone, :D_Mobile, :D_IDCard, :D_Email, :D_Region, :D_Address, :D_InvoiceNo, :D_InvoiceTitle, :D_InvoiceContent, :D_Remark);";
			$this->db->execute($sql,array(
				"D_OrderNo"  => $order_no,
				"D_Consignee"  => $address['name'],
				"D_Telphone"  => '',
				"D_Mobile"  => $address['mobile'],
				"D_IDCard"  => '',
				"D_Email"  => '',
				"D_Region"  => $address['region'],
				"D_Address"  => $address['address'],
				"D_InvoiceNo"  => '',
				"D_InvoiceTitle"  => '',
				"D_InvoiceContent"  => '',
				"D_Remark"  => "现金卡赠品",
			));

			//写入订单日志表 ER_OrderLog
			$sql = "INSERT INTO er_orderlog (L_OrderNo, L_CreateTime, L_Handler, L_IP, L_Record ,L_Origin, L_Changed, L_Milestone) VALUES (:L_OrderNo, :L_CreateTime, '', '', :L_Record , '', '', 1);";
			$this->db->execute($sql,array(
				"L_OrderNo"  => $order_no,
				"L_CreateTime"  => $time,
				"L_Record"  => "用户创建订单",
			));


			//赠品
			$createOrderNo_sql = "SELECT FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) mainorder_no,FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) order_no;";
			$order_res = $this->db->fetchOne($createOrderNo_sql);
			$this->db->execute($order_sql,array(
				"O_OrderNo" => $order_res['order_no'],
			    "O_OrderOrganizeNo" => $organize_no,
				"O_MainOrderFlag" => 2,
				"O_MainOrderNo" => $order_res['mainorder_no'],
				"O_StockOrganizeNo" => $address['unique'],
				"O_MemberID" => $member->member_id,
				"O_MemberName" => $member->nickName,
				"O_DeviceID" => '0000',
				"O_Cashier" => "系统",
				"O_CashierNo" => 0000,
				"O_GoodsFee" => '0.00',
				"O_DiscountFee" => '0.00',
				"O_DeliveryFee" => '0.00',
				"O_PayFee" => '0.00',
				"O_PayCoin" => 0,
				"O_Status" => 0,
				"O_CreateTime" => $time,
				"O_PayTime" => 0,
				"O_FinishTime" => 0,
				"O_DeliveryType" => 1,
				"O_Type" => 1,
				"O_TradeNo" => "",
				"O_ShopID" => 0,
				"O_SupplierNo" => 0,
				"O_PayStatus" => 0,
				"O_CancelStatus" => 0,
			));
			$complimentary_id = $this->db->lastInsertId();
			$order_id = $order_id . "," . $complimentary_id;


			//写入订单详情表 ER_OrderDetail
			$sql = "INSERT INTO `er_orderdetail` (`D_OrderNo`, `D_SkuID`, `D_SkuName`, `D_SkuBarcode`, `D_SkuSpecs`, `D_SkuUnit`, `D_SkuPrice`, `D_SkuActPrice`, `D_GoodsPicture`, `D_Coin`, `D_Qty`, `D_QtyReturn`, `D_QtyExchange`, `D_ActivityNo`, `D_GoodType`, `D_GoodKind`, `D_ShopNo`, `D_SupplierNo`, `Sync`) VALUES (:D_OrderNo,:D_SkuID,:D_SkuName,:D_SkuBarcode,:D_SkuSpecs,:D_SkuUnit,0,0,:D_GoodsPicture,0,1,0,0,'',2,1,:S_ShopID,:S_SuppliersID,'');";
			$this->db->execute($sql,array(
				"D_OrderNo" => $order_res['order_no'],
				"D_SkuID" => $skuid,
				"D_SkuName" => $data["name"] . "(现金卡赠品)",
				"D_SkuBarcode" => $data["barcode"],
				"D_SkuSpecs" => $data["specs"],
				"D_SkuUnit" => $data["unit"],
				"D_GoodsPicture" => $data["logo"],
				'S_ShopID' => $data['shop_id'],
				'S_SuppliersID' => $data['supplier_id']
			));

			//写入订单日志表 ER_OrderLog
			$sql = "INSERT INTO er_orderlog (L_OrderNo, L_CreateTime, L_Handler, L_IP, L_Record ,L_Origin, L_Changed, L_Milestone) VALUES (:L_OrderNo, :L_CreateTime, '', '', :L_Record , '', '', 1);";
			$this->db->execute($sql,array(
				"L_OrderNo"  => $order_res['order_no'],
				"L_CreateTime"  => $time,
				"L_Record"  => "用户创建订单",
			));

			//写入订单收货人信息表 er_orderdelivery
			$sql = "INSERT INTO er_orderdelivery (D_OrderNo, D_ExpressName, D_ExpressCode, D_Consignee, D_Telphone ,D_Mobile, D_IDCard, D_Email, D_Region, D_Address, D_InvoiceNo, D_InvoiceTitle, D_InvoiceContent, D_Remark) VALUES (:D_OrderNo, '', '', :D_Consignee, :D_Telphone, :D_Mobile, :D_IDCard, :D_Email, :D_Region, :D_Address, :D_InvoiceNo, :D_InvoiceTitle, :D_InvoiceContent, :D_Remark);";
			$this->db->execute($sql,array(
				"D_OrderNo"  => $order_res['order_no'],
				"D_Consignee"  => $address['name'],
				"D_Telphone"  => '',
				"D_Mobile"  => $address['mobile'],
				"D_IDCard"  => '',
				"D_Email"  => '',
				"D_Region"  => $address['region'],
				"D_Address"  => $address['address'],
				"D_InvoiceNo"  => '',
				"D_InvoiceTitle"  => '',
				"D_InvoiceContent"  => '',
				"D_Remark"  => "现金卡赠品",
			));

			//写入用户地址表 er_memberaddress
			$sql = "SELECT MemberAddress_ID id,A_RegionNo region,A_Address address,A_Mobile mobile,A_Consignee name,A_StatusFlag FROM er_memberaddress WHERE A_MemberID = '{$member->member_id}';";
			$address_list = $this->db->fetchAll($sql);
			$flag = -1;
			$default = 1;
			if (!empty($address_list)) {
				foreach ($address_list as $key => $value) {
					if ($value['region'] == $address['region'] && $value['address'] == $address['address'] && $value['name'] == $address['name'] && $value['mobile'] == $address['mobile']) {
						$flag = $value['id'];
					}
					if ($value['A_StatusFlag'] == 1) {
						$default = 0;
					}
				}
			}
			if ($flag == -1) {
				$sql = "INSERT INTO er_memberaddress (A_ShortName, A_MemberID, A_RegionNo, A_Address, A_Consignee ,A_Phone, A_Mobile, A_EMail, A_Type, A_DefaultFlag, A_LastUseFlag, A_StatusFlag, Sync) VALUES (:A_ShortName, :A_MemberID, :A_RegionNo, :A_Address, :A_Consignee, :A_Phone, :A_Mobile, :A_EMail, :A_Type, :A_DefaultFlag, :A_LastUseFlag, :A_StatusFlag, :Sync);";
				$this->db->execute($sql,array(
					"A_ShortName"  => '',
					"A_MemberID"  => $member->member_id,
					"A_RegionNo"  => $address['region'],
					"A_Address"  => $address['address'],
					"A_Consignee"  => $address['name'],
					"A_Phone"  => '',
					"A_Mobile"  => $address['mobile'],
					"A_EMail"  => '',
					"A_Type"  => 1,
					"A_DefaultFlag"  => $default,
					"A_LastUseFlag"  => 1,
					"A_StatusFlag"  => 1,
					"Sync"  => '',
				));
			} else {
				$sql = "UPDATE er_memberaddress SET A_StatusFlag = 1 WHERE MemberAddress_ID = '{$flag}';";
				$this->db->execute($sql);
			}

			//提交
			$this->db->commit();
			return $order_id;

		} catch (Exception $e) {
			//回滚
			$this->db->rollback();
			$this->logger->info("失败：");
			$this->logger->info($e->getMessage());
			throw new \Exception("您未登录，请至APP登录！",400);
		}
	}

	/**
	* 三级联动
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-21 17:57:06
	*/
	public function siteData($regionid)
	{
		$url = '/member/address/' . $regionid;
		$data = array();

		if($this->curl->get_request($url,'php_api')==200){
			$data = $this->curl->getArrayData();
		}
		return $data;
	}

	/**
	* 满额送礼
	* @return
	* @param
	* @author Dandan_Sun
	* @date 2017-09-26 10:55:29
	*/
	public function presentConfirm($member,$data,$total)
	{
		try {
			//查询购买商品信息
			foreach ($data['goods'] as $key => $value) {
				$keys = "goods:id:" . $value['id'];
				$goods[$key] = $this->redis -> read($keys,$this->db_identifier);
				if (empty($goods[$key]) || $goods[$key] = "NODATA") {
					$sql = "SELECT S_Name name,S_Barcode barcode,S_Spec specs,S_Unit unit,S_Logo logo,S_ShopID shop_id,S_SuppliersID supplier_id,Sku_ID sku_id,S_ShopPrice shop_price  FROM gm_sku WHERE Sku_ID =  '{$value['id']}' AND S_OnlineSale = 1;";
					$goods[$key] = $this->db->fetchOne($sql);
					if (empty($goods[$key])) {
						throw new \Exception("该商品不存在,请联系客服",100);
					}
				}
			}
			//查询赠品的基本信息
			$key = "goods:id:" . $data['present_id'];
			$present = $this->redis -> read($keys,$this->db_identifier);
			if (empty($present) || $present = "NODATA") {
				$sql = "SELECT S_Name name,S_Barcode barcode,S_Spec specs,S_Unit unit,S_Logo logo,S_ShopID shop_id,S_SuppliersID supplier_id,Sku_ID sku_id,S_ShopPrice shop_price FROM gm_sku WHERE Sku_ID =  '{$data['present_id']}' AND S_OnlineSale = 1;";
				$present = $this->db->fetchOne($sql);
				if (empty($present)) {
					throw new \Exception("该商品不存在,请联系客服",100);
				}
			}

			$organize_no = '5001';
			$time = time();
			//事务
			//开始
			$this->db->begin();

			//写入订单表 ER_Order
			$order_sql = "INSERT INTO `er_order` (`O_OrderNo`, `O_OrderOrganizeNo`, `O_MainOrderFlag`, `O_MainOrderNo`, `O_StockOrganizeNo`, `O_MemberID`, `O_MemberName`, `O_DeviceID`, `O_Cashier`, `O_CashierNo`, `O_GoodsFee`, `O_DiscountFee`, `O_DeliveryFee`, `O_PayFee`, `O_PayCoin`, `O_Status`, `O_CreateTime`, `O_PayTime`, `O_FinishTime`, `O_DeliveryType`, `O_Type`, `O_TradeNo`, `O_ShopID`, `O_SupplierNo`, `O_PayStatus`, `O_CancelStatus`) VALUES (:O_OrderNo,:O_OrderOrganizeNo,:O_MainOrderFlag,:O_MainOrderNo,:O_StockOrganizeNo,:O_MemberID,:O_MemberName,:O_DeviceID,:O_Cashier,:O_CashierNo,:O_GoodsFee,:O_DiscountFee,:O_DeliveryFee,:O_PayFee,:O_PayCoin,:O_Status,:O_CreateTime,:O_PayTime,:O_FinishTime,:O_DeliveryType,:O_Type,:O_TradeNo,:O_ShopID,:O_SupplierNo,:O_PayStatus,:O_CancelStatus);";
			//Create OrderNO
			$createOrderNo_sql = "SELECT FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) mainorder_no,FUNC_TradeNo_GENERATE_EX1({$organize_no},99,'',{$time}) order_no;";
			$create_order_res = $this->db->fetchOne($createOrderNo_sql);
			$order_no = $create_order_res['order_no'];
			$this->db->execute($order_sql,array(
				"O_OrderNo" => $order_no,
			    "O_OrderOrganizeNo" => $organize_no,
				"O_MainOrderFlag" => 2,
				"O_MainOrderNo" => $create_order_res['mainorder_no'],
				"O_StockOrganizeNo" => 0,
				"O_MemberID" => $member->member_id,
				"O_MemberName" => $member->nickName,
				"O_DeviceID" => '0000',
				"O_Cashier" => "系统",
				"O_CashierNo" => 0000,
				"O_GoodsFee" => $total,
				"O_DiscountFee" => '0.00',
				"O_DeliveryFee" => '0.00',
				"O_PayFee" => $total,
				"O_PayCoin" => 0,
				"O_Status" => 0,
				"O_CreateTime" => $time,
				"O_PayTime" => 0,
				"O_FinishTime" => 0,
				"O_DeliveryType" => 1,
				"O_Type" => 1,
				"O_TradeNo" => "",
				"O_ShopID" => 0,
				"O_SupplierNo" => 0,
				"O_PayStatus" => 0,
				"O_CancelStatus" => 0,
			));
			$order_id = $this->db->lastInsertId();

			//写入订单详情表 ER_OrderDetail
			$str = "INSERT INTO `er_orderdetail` (`D_OrderNo`, `D_SkuID`, `D_SkuName`, `D_SkuBarcode`, `D_SkuSpecs`, `D_SkuUnit`, `D_SkuPrice`, `D_SkuActPrice`, `D_GoodsPicture`, `D_Coin`, `D_Qty`, `D_QtyReturn`, `D_QtyExchange`, `D_ActivityNo`, `D_GoodType`, `D_GoodKind`, `D_ShopNo`, `D_SupplierNo`, `Sync`) VALUES ";
			foreach ($goods as $key => $value) {
				$str .= "('{$create_order_res['order_no']}','{$value['sku_id']}','{$value['name']}','{$value['barcode']}','{$value['specs']}','{$value['unit']}','{$value['shop_price']}','{$data['goods'][$key]['price']}','{$value['logo']}',0,'{$data['goods'][$key]['num']}',0,0,'',2,1,'{$value['shop_id']}','{$value['supplier_id']}',''),";
			}
			$str .= "('{$create_order_res['order_no']}','{$present['sku_id']}','{$present['name']}','{$present['barcode']}','{$present['specs']}','{$present['unit']}',0,0,'{$present['logo']}',0,1,0,0,'',2,1,'{$present['shop_id']}','{$present['supplier_id']}','满额送礼赠品');";
			$this->db->execute($str);

			//写入订单收货人信息表 er_orderdelivery
			$sql = "INSERT INTO er_orderdelivery (D_OrderNo, D_ExpressName, D_ExpressCode, D_Consignee, D_Telphone ,D_Mobile, D_IDCard, D_Email, D_Region, D_Address, D_InvoiceNo, D_InvoiceTitle, D_InvoiceContent, D_Remark) VALUES (:D_OrderNo, '', '', :D_Consignee, :D_Telphone, :D_Mobile, :D_IDCard, :D_Email, :D_Region, :D_Address, :D_InvoiceNo, :D_InvoiceTitle, :D_InvoiceContent, :D_Remark);";
			$this->db->execute($sql,array(
				"D_OrderNo"  => $order_no,
				"D_Consignee"  => $data['name'],
				"D_Telphone"  => '',
				"D_Mobile"  => $data['mobile'],
				"D_IDCard"  => '',
				"D_Email"  => '',
				"D_Region"  => $data['region'],
				"D_Address"  => $data['address'],
				"D_InvoiceNo"  => '',
				"D_InvoiceTitle"  => '',
				"D_InvoiceContent"  => '',
				"D_Remark"  => "满额送礼",
			));

			//写入订单日志表 ER_OrderLog
			$sql = "INSERT INTO er_orderlog (L_OrderNo, L_CreateTime, L_Handler, L_IP, L_Record ,L_Origin, L_Changed, L_Milestone) VALUES (:L_OrderNo, :L_CreateTime, '', '', :L_Record , '', '', 1);";
			$this->db->execute($sql,array(
				"L_OrderNo"  => $order_no,
				"L_CreateTime"  => $time,
				"L_Record"  => "用户创建订单",
			));


			//写入用户地址表 er_memberaddress
			$sql = "SELECT MemberAddress_ID id,A_RegionNo region,A_Address address,A_Mobile mobile,A_Consignee name,A_StatusFlag FROM er_memberaddress WHERE A_MemberID = '{$member->member_id}';";
			$address_list = $this->db->fetchAll($sql);
			$flag = -1;
			$default = 1;
			if (!empty($address_list)) {
				foreach ($address_list as $key => $value) {
					if ($value['region'] == $data['region'] && $value['address'] == $data['address'] && $value['name'] == $data['name'] && $value['mobile'] == $data['mobile']) {
						$flag = $value['id'];
					}
					if ($value['A_StatusFlag'] == 1) {
						$default = 0;
					}
				}
			}
			if ($flag == -1) {
				$sql = "INSERT INTO er_memberaddress (A_ShortName, A_MemberID, A_RegionNo, A_Address, A_Consignee ,A_Phone, A_Mobile, A_EMail, A_Type, A_DefaultFlag, A_LastUseFlag, A_StatusFlag, Sync) VALUES (:A_ShortName, :A_MemberID, :A_RegionNo, :A_Address, :A_Consignee, :A_Phone, :A_Mobile, :A_EMail, :A_Type, :A_DefaultFlag, :A_LastUseFlag, :A_StatusFlag, :Sync);";
				$this->db->execute($sql,array(
					"A_ShortName"  => '',
					"A_MemberID"  => $member->member_id,
					"A_RegionNo"  => $data['region'],
					"A_Address"  => $data['address'],
					"A_Consignee"  => $data['name'],
					"A_Phone"  => '',
					"A_Mobile"  => $data['mobile'],
					"A_EMail"  => '',
					"A_Type"  => 1,
					"A_DefaultFlag"  => $default,
					"A_LastUseFlag"  => 1,
					"A_StatusFlag"  => 1,
					"Sync"  => '',
				));
			} else {
				$sql = "UPDATE er_memberaddress SET A_StatusFlag = 1 WHERE MemberAddress_ID = '{$flag}';";
				$this->db->execute($sql);
			}

			//提交
			$this->db->commit();
			$this->logger->info($order_id);
			return $order_id;

		} catch (Exception $e) {
			//回滚
			$this->db->rollback();
			$this->logger->info("失败：");
			$this->logger->info($e->getMessage());
			throw new \Exception($e->getMessage(),400);
		}
	}

}