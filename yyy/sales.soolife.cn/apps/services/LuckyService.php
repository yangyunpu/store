<?php
// +----------------------------------------------------------------------
// | 抽奖活动服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:
// | Author: Dandan_Sun
// | Created: 2016-11-07 11:38:15
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;

class LuckyService extends BaseService{

	/**
	* 获取活动详情
	* @author Dandan_Sun
	*/
	function cluster($id){
		$sql = "SELECT * FROM SALE_LuckyDraw WHERE S_Status = 1;";
		$result = $this->db->fetchOne($sql);
		$result = $this->getDetails($result,$id);
		return $result;
	}

	/**
	* 获取广告
	* @author Dandan_Sun
	* @date 2017-03-19 10:44:38
	*/
	function getAdsPic(){
		$url = "/ads/lively/app.assemble.main.banner";
		$data = array();
		$pic = "";
		if($this->curl->post_request($url,$data,'api') == 200){
			$data = $this->curl->getArrayData();
			$pic = Common::get_image_url($data['app.assemble.main.banner'][0]['picture'],'','','img');
		}
		return $pic;
	}

	/**
	* 抽奖活动开始
	* @return array
	* @author Dandan_Sun
	* @date 2016-11-23 14:34:09
	*/
	function getDetails($result,$id=""){
		$time = time();
		$data = array();
		//抽奖详情
		if(empty($result)){
			return $data;
		}
		$this->judgePromo($result['S_LuckyID']);
		$result['S_Package'] = (array)json_decode($result['S_Package']);
		foreach ($result['S_Package'] as &$vvv) {
			$vvv = (array)$vvv;
		}
		$result['schedule'] = round(($result['S_FullNum']-$result['S_Surplus'])/$result['S_FullNum'],2);
		$result['percent'] = $result['schedule']*100;
		$data['lucky'] = $result;

		//奖项详情
		$sql_prize = "SELECT * FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$result['S_LuckyID']};";
		$res = $this->db->fetchAll($sql_prize,\Phalcon\Db::FETCH_ASSOC);
		foreach ($res as $kv => &$vk) {
			$vk['S_PrizePic'] = Common::get_image_url($vk['S_PrizePic'],'','','prize');
		}
		$data['prize'] = $res;

		//套餐详情
		$sql_promo = "SELECT Promotion_ID id,P_Name,P_Status,P_EndTime FROM SALE_Promo WHERE P_PromoNo = '{$result['S_PromoNo']}' AND P_RuleID = 1410;";
		$promo = $this->db->fetchOne($sql_promo,\Phalcon\Db::FETCH_ASSOC);
		if($promo['P_Status'] != 1 || $promo['P_EndTime'] <= $time){
			$sql = "UPDATE SALE_Promo SET P_Status = 3 WHERE P_PromoNo = '{$result['S_PromoNo']}' AND P_RuleID = 1410;";
			$this->db->execute($sql);
			foreach ($data['lucky']['S_Package'] as $key => &$value) {
				$value['surplus'] = 0;
				$value['status'] = 1;
			}
			$sql = "UPDATE SALE_LuckyDraw SET S_LuckyStatus = 3,S_Surplus = 0 WHERE S_LuckyID = {$result['S_LuckyID']};";
			$this->db->execute($sql);
		}
		$sql_name = "SELECT G_SuiteNo no FROM SALE_PromoGoods WHERE G_PromoID = {$promo['id']};";
		$promoName = $this->db->fetchAll($sql_name,\Phalcon\Db::FETCH_ASSOC);
		foreach ($promoName as $kk => $val) {
			$date[$kk] = $val['no'];
		}
		$date = array_values(array_unique($date));
		foreach ($date as $kkk => $vv) {
			$sql_detail = "SELECT a.*,b.S_Barcode,b.S_Name,b.Sku_ID,b.S_Logo,b.S_MarketPrice,b.S_ShopPrice FROM SALE_PromoGoods a LEFT JOIN GM_Sku b ON (a.G_SkuID = b.Sku_ID) WHERE a.G_PromoID = {$promo['id']} AND a.G_SuiteNo='{$vv}';";
			$promo_detail[$kkk]['data'] = $this->db->fetchAll($sql_detail,\Phalcon\Db::FETCH_ASSOC);
			$market_Price = 0;
			$act_price = 0;
			foreach ($promo_detail[$kkk]['data'] as $k => &$v) {
				$v['S_Logo'] = Common::get_image_url($v['S_Logo']);
				$nn = $v['G_SuiteNo'];
				if(array_key_exists("$nn",$result['S_Package'])){
					$v['surplus'] = $result['S_Package'][$nn]['surplus'];
					$v['status'] = $result['S_Package'][$nn]['status'];
					$promo_detail[$kkk]['img'] = Common::get_image_url($result['S_Package'][$nn]['img'],'','','prize');
				}
				$market_Price = $market_Price + $v['S_ShopPrice'];
				$act_price = $act_price + $v['G_ActPrice'];
			}
			$promo_detail[$kkk]['market_Price'] = number_format($market_Price, 2, '.', '');
			$promo_detail[$kkk]['act_price'] = number_format($act_price, 2, '.', '');
		}
		$data['promo_detail'] = $promo_detail;

		//套餐状态
		$no = array();
		foreach ($promo_detail as $keys => $values) {
			$promo_no = $values['data'][0]['G_SuiteNo'];
			$no[$keys]['no'] = $values['data'][0]['G_SuiteNo'];
			$no[$keys]['suiteName'] = $values['data'][0]['G_SuiteName'];
			if(array_key_exists("$promo_no",$result['S_Package'])){
				$no[$keys]['status'] = $result['S_Package'][$promo_no]['status'];
			}
		}
		$data['no'] = $no;

		//套餐出售记录
		$sql_package = "SELECT * FROM SALE_LuckyDrawPackage WHERE S_LuckyID = {$result['S_LuckyID']} ORDER BY S_BuyTime DESC;";
		$package = $this->db->fetchAll($sql_package,\Phalcon\Db::FETCH_ASSOC);
		foreach ($package as $key => &$value){
			$mistiming = ceil(($time-$value['S_BuyTime'])/60);
			if($mistiming <= 60){
				$mis = $mistiming . '分钟';
			}elseif ($mistiming > 60 && $mistiming <= 1440){
				$mis = floor($mistiming/60) . '小时';
			}elseif ($mistiming > 1440) {
				$mis = floor($mistiming/1440) . '天';
			}
			$value['mistiming'] = $mis;
			$value['S_BuyersPhone'] = substr_replace($value['S_BuyersPhone'],'****',3,4);
			foreach ($no as $ke => $va) {
				if($value['S_PackageNo'] == $va['no']){
					$value['S_SuitName'] = $va['suiteName'];
				}
			}
		}
		$data['package_record'] = $package;

		//是否有往期活动
		if(empty($id)){
			$sql = "SELECT S_LuckyID FROM SALE_LuckyDraw WHERE S_Status = 1;";
			$pasts = $this->db->fetchOne($sql);
			if(empty($pasts)){
				$sql = "SELECT S_LuckyID FROM SALE_LuckyDraw WHERE S_Status = 0 AND S_LuckyStatus = 3 ORDER BY S_CreateTime DESC LIMIt 1,1;";
			}else{
				$sql = "SELECT S_LuckyID FROM SALE_LuckyDraw WHERE S_Status = 0 AND S_LuckyStatus = 3 ORDER BY S_CreateTime DESC LIMIt 1;";
			}
			$past = $this->db->fetchOne($sql);
			if(empty($past)){
				$data['lucky']['past'] = 0;
			}else{
				$data['lucky']['past'] = $past['S_LuckyID'];
			}
		}else{
			$sql = "SELECT S_LuckyID FROM SALE_LuckyDraw WHERE S_Status = 1;";
			$pasts = $this->db->fetchOne($sql);
			if(empty($pasts)){
				$sql = "SELECT S_LuckyID FROM SALE_LuckyDraw WHERE S_Status = 0 AND S_LuckyStatus = 3 ORDER BY S_CreateTime DESC LIMIt 1,2;";
				$past = $this->db->fetchOne($sql);
				if(empty($past)){
					$data['lucky']['past'] = 0;
				}else{
					$data['lucky']['past'] = $past['S_LuckyID'];
				}
			}else{
				$data['lucky']['past'] = $id;
			}
		}

		return $data;
	}

	/**
	* 随机产生手机号
	* @return array
	* @param $id(抽奖ID) $prize(奖项内容)
	* @author Dandan_Sun
	* @date 2016-11-24 19:25:39
	*/
	function random($id,$prize){
		if($id != '' && !empty($prize)){
			$sql = "SELECT S_BuyersPhone phone FROM SALE_LuckyDrawPackage WHERE S_LuckyID = {$id} AND S_OrderNo != 0 AND S_Status = 0;";
			$result = $this->db->fetchAll($sql,\Phalcon\Db::FETCH_ASSOC);
			if(!empty($result)){
				foreach ($result as $kk => $vv) {
					$data['phone'][$kk] = $vv['phone'];
				}
				$num = 0;
				foreach ($prize as $key => $value) {
					$value['S_Winners'] = json_decode($value['S_Winners']);
					$num = $num + ($value['S_PrizeNum'] - count($value['S_Winners']));
				}
				// var_dump($num > count($data['phone']));exit;
				if($num == 0){
					return $num;
				}elseif($num > count($data['phone'])){
					$a = array();
					foreach ($prize as $kkkk => $vvvv) {
						$array = array();
						$a[] = array_pad($array, $vvvv['S_PrizeNum'], $kkkk);
					}
					$i = 0;
					foreach ($a as $y => $u) {
						foreach ($u as $ke => $va) {
							$a[$i] = $va;
							$i++;
						}
					}
					$n = count($data['phone']);
					$rand = array();
					$rand = array_rand($a,$n);
					foreach ($rand as $k => $va) {
						$v = $a[$va];
						$prize[$v]['access'][] = $data['phone'][$k];
					}
					foreach ($prize as $kes => $vals) {
						$vals['S_Winners'] = json_decode($vals['S_Winners']);
						if(count($vals['S_Winners']) != 0 && isset($vals['access'])){
							$vals['access'] = array_merge($vals['access'],$vals['S_Winners']);
						}
					}
				}else{
					$list = array_rand($data['phone'],$num);
					if(is_array($list)){
						foreach ($prize as $key => &$val) {
							$val['S_Winners'] = json_decode($val['S_Winners']);
							$y = $val['S_PrizeNum'] - count($val['S_Winners']);
							if($y != 0){
								$val['access_list'] = array_rand($list,$y);
								if(is_array($val['access_list'])){
									foreach ($val['access_list'] as $kkk => $vvv) {
										$a = $list[$vvv];
										if(array_key_exists($a, $data['phone'])){
											$val['access'][$kkk] = $data['phone'][$a];
											unset($list[$vvv]);
										}
									}
								}else{
									$i = $val['access_list'];
									$a = $list[$i];
									if(array_key_exists($a, $data['phone'])){
										$val['access'] = (array)$data['phone'][$a];
									}
									unset($list[$i]);
								}
								if(count($val['S_Winners']) != 0){
									$val['access'] = array_merge($val['access'],$val['S_Winners']);
								}
							}
						}
					}else{
						foreach ($prize as $key => &$val) {
							$val['access'] = (array)$data['phone'][$list];
							if(!empty($val['S_Winners'])){
								$val['S_Winners'] = json_decode($val['S_Winners']);
								$val['access'] = array_merge($val['access'],$val['S_Winners']);
							}
						}
					}
				}
			}else{
				$prize = array();
			}
		}else{
			$prize = array();
		}
		return $prize;
	}

	/**
	* 抽奖中
	* @return array
	* @param $id(抽奖ID) $prize(奖项内容)
	* @author Dandan_Sun
	* @date 2016-11-25 09:40:06
	*/
	function lottery($id,$prize){
		$list = array();
		if($id != '' && !empty($prize)){
			$sql = "SELECT S_Winners,S_PrizeNum,S_IsSend FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$id};";
			$result = $this->db->fetchAll($sql,\Phalcon\Db::FETCH_ASSOC);
			if(!empty($result)){
				foreach ($result as $key => $value) {
					if($value['S_IsSend'] == 0){
						$data = $this->random($id,$prize);
						if(empty($data)){
							foreach ($prize as $key => $val) {
								$sql = "UPDATE SALE_LuckyDrawPrize SET S_IsSend = 2 WHERE S_PrizeID = {$val['S_PrizeID']};";
								$this->db->execute($sql);
							}
						}else{
							foreach ($data as $key => $val) {
								if(isset($val['access'])){
									$json = json_encode($val['access']);
									$sql = "UPDATE SALE_LuckyDrawPrize SET S_Winners = '{$json}',S_IsSend = 2 WHERE S_PrizeID = {$val['S_PrizeID']};";
									$this->db->execute($sql);
								}else{
									$sql = "UPDATE SALE_LuckyDrawPrize SET S_IsSend = 2 WHERE S_PrizeID = {$val['S_PrizeID']};";
									$this->db->execute($sql);
								}
							}
						}
					}
				}
				$sql = "SELECT * FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$id};";
				$res = $this->db->fetchAll($sql,\Phalcon\Db::FETCH_ASSOC);
				$i = 0;
				foreach ($res as $kk => &$vv) {
					$vv['S_Winners'] = json_decode($vv['S_Winners'],TRUE);
					foreach ($vv['S_Winners'] as $kkk => $vvv) {
						$list[$i][0] = substr_replace($vvv,'****',3,4);
						$list[$i][1] = $vv['S_PrizeName'];
						$i++;
					}
				}
			}
		}
		return $list;
	}

	/**
	* 即将开始
	* @return array
	* @param $id(抽奖ID)
	* @author Dandan_Sun
	* @date 2016-11-25 18:39:14
	*/
	function upcoming($id){
		$result = array();
		$time = time();
		if($id != ''){
			$sql = "SELECT * FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$id};";
			$result = $this->db->fetchAll($sql,\Phalcon\Db::FETCH_ASSOC);
			if(!empty($result)){
				foreach ($result as $key => $value) {
					if($value['S_IsSend'] == 0){
						$data = $this->random($id,$result);
						if(empty($data)){
							foreach ($result as $key => $val) {
								$sql = "UPDATE SALE_LuckyDrawPrize SET S_IsSend = 2 WHERE S_PrizeID = {$val['S_PrizeID']};";
								$this->db->execute($sql);
							}
						}else{
							foreach ($data as $key => $val) {
								if(isset($val['access'])){
									$json = json_encode($val['access']);
									$sql = "UPDATE SALE_LuckyDrawPrize SET S_Winners = '{$json}',S_IsSend = 2 WHERE S_PrizeID = {$val['S_PrizeID']};";
									$this->db->execute($sql);
								}else{
									$sql = "UPDATE SALE_LuckyDrawPrize SET S_IsSend = 2 WHERE S_PrizeID = {$val['S_PrizeID']};";
									$this->db->execute($sql);
								}
							}
						}
					}
				}
			}
			$statu = "SELECT S_Status FROM SALE_LuckyDraw WHERE S_LuckyID = {$id};";
			$status = $this->db->fetchOne($statu,\Phalcon\Db::FETCH_ASSOC);
			if($status['S_Status'] == 1){
				$update = "UPDATE SALE_LuckyDraw SET S_Status = 0 WHERE S_LuckyID = {$id};";
				$this->db->execute($update);
				$data = "SELECT S_LuckyID,S_Status FROM SALE_LuckyDraw WHERE S_BeginTime > {$time} AND S_LuckyStatus = 1 ORDER BY S_UpdateTime ASC;";
				$res = $this->db->fetchOne($data,\Phalcon\Db::FETCH_ASSOC);
				if(!empty($res)){
					$update_sql = "UPDATE SALE_LuckyDraw SET S_Status = 1 WHERE S_LuckyID = {$res['S_LuckyID']};";
					$this->db->execute($update_sql);
				}
			}
			$result = $this->cluster($id);
			if(!empty($result)){
				$result['lucky']['S_BeginTime'] = date("Y/m/d H:i:s",$result['lucky']['S_BeginTime']+15);
			}
		}
		return $result;
	}

	/**
	* 奖项详情
	* @return array
	* @param $lucky_id
	* @author Dandan_Sun
	* @date 2016-12-08 09:45:34
	*/
	function panel($lucky_id){
		if(!empty($lucky_id)){
			$sql_prize = "SELECT * FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$lucky_id};";
			$res = $this->db->fetchAll($sql_prize,\Phalcon\Db::FETCH_ASSOC);
			foreach ($res as $kv => &$vk) {
				$vk['S_PrizePic'] = Common::get_image_url($vk['S_PrizePic'],'','','prize');
			}
		}else{
			$res = array();
		}
		return $res;
	}

	/**
	* 获奖名单
	* @return array
	* @param $id(获奖ID)
	* @author Dandan_Sun
	* @date 2016-11-28 16:20:24
	*/
	function listWinners($id){
		$data = array();
		if($id == '' || $id == 0){
			return $data;
		}
		$sql = "SELECT S_PrizeName,S_Winners,S_PrizePic FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$id};";
		$result = $this->db->fetchAll($sql,\Phalcon\Db::FETCH_ASSOC);
		foreach ($result as $key => &$value) {
			$value['S_Winners'] = json_decode($value['S_Winners']);
			$data[$key]['S_PrizeName'] = $value['S_PrizeName'];
			$data[$key]['S_PrizePic'] = Common::get_image_url($value['S_PrizePic'],'','','prize');
			if(!empty($value['S_Winners'])){
				foreach ($value['S_Winners'] as $kk => $val) {
					$sql_name = "SELECT S_BuyersName FROM SALE_LuckyDrawPackage WHERE(S_LuckyID = {$id}) AND S_BuyersPhone = '{$val}';";
					$res = $this->db->fetchOne($sql_name,\Phalcon\Db::FETCH_ASSOC);
					if($res['S_BuyersName'] == $val){
						$res['S_BuyersName'] = substr_replace($res['S_BuyersName'],'****',3,4);
					}
					$data[$key]['S_Winners'][$kk]['phone'] = substr_replace($val,'****',3,4);
					$data[$key]['S_Winners'][$kk]['name'] = $res['S_BuyersName'];
				}
				$data[$key]['count'] = count($value['S_Winners']);
			}else{
				$data[$key]['S_Winners'] = array();
				$data[$key]['count'] = 0;
			}
		}
		return $data;
	}

	/**
	* 更改出售数据
	* @return 0(失败)1(成功)
	* @param $id(套装的套餐的主商品ID) $lucky_id(套餐的ID)
	* @author Dandan_Sun
	* @date 2016-11-29 13:57:52
	*/
	function changeNum($id,$lucky_id){
		$sql = "SELECT b.P_PromoNo,a.G_SuiteNo FROM SALE_PromoGoods a LEFT JOIN SALE_Promo b ON a.G_PromoID = b.Promotion_ID AND P_RuleID = 1410 WHERE Goods_ID = {$id} AND G_IsMain = 1;";
		$result = $this->db->fetchOne($sql,\Phalcon\Db::FETCH_ASSOC);
		$sql_package = "SELECT S_Package,S_Surplus FROM SALE_LuckyDraw WHERE S_LuckyID = {$lucky_id} AND S_PromoNo = {$result['P_PromoNo']};";
		$json = $this->db->fetchOne($sql_package,\Phalcon\Db::FETCH_ASSOC);
		$json['S_Surplus'] = $json['S_Surplus'] - 1;
		$package = (array)json_decode($json['S_Package']);
		foreach ($package as $key => &$value) {
			$value = (array)$value;
		}
		$no = $result['G_SuiteNo'];
		if(array_key_exists($no, $package)){
				$package[$no]['sold'] = $package[$no]['sold'] + 1;
				$package[$no]['surplus'] = $package[$no]['surplus'] - 1;
				if($package[$no]['surplus'] == 0){
					$package[$no]['status'] = 1;
				}
		}
		$json_package = json_encode($package);
		$sql_name = "UPDATE SALE_LuckyDraw SET S_Package = '{$json_package}',S_Surplus = {$json['S_Surplus']} WHERE S_LuckyID = {$lucky_id};";
		$this->db->execute($sql_name,\Phalcon\Db::FETCH_ASSOC);
	}

	/**
	* 查看套餐的状态
	* @author Dandan_Sun
	* @date 2017-01-17 19:33:35
	*/
	function judgePromo($id){
		$data = 0;
		if(empty($id)){
			return $data;
		}
		$sql = "SELECT * FROM SALE_LuckyDraw WHERE S_LuckyID = {$id};";
		$result = $this->db->fetchOne($sql);
		$sql = "SELECT P_Status FROM SALE_Promo WHERE P_PromoNo = {$result['S_PromoNo']} AND P_RuleID = 1410;";
		$status = $this->db->fetchOne($sql);
		if($status['P_Status'] != 1){
			$date = (array)json_decode($result['S_Package']);
			foreach ($date as $key => &$value){
				$value = (array)$value;
				$value['surplus'] = 0;
				$value['status'] = 1;
			}
			$result['S_Surplus'] = 0;
			$date = json_encode($date);
			$sql = "UPDATE SALE_LuckyDraw SET S_LuckyStatus=3,S_Package='{$date}',S_Surplus = 0 WHERE S_LuckyID = {$result['S_LuckyID']};";
			$this->db->execute($sql);
		}
		$data = $status['P_Status'];
		return $data;
	}

	/**
	* 获取往期活动列表
	* @return array
	* @author Dandan_Sun
	* @date 2017-03-15 18:01:52
	*/
	function pastActivitiesList(){
		$sql = "SELECT S_LuckyID,S_BeginTime FROM SALE_LuckyDraw WHERE S_Status = 0 AND S_LuckyStatus = 3 ORDER BY S_BeginTime DESC LIMIt 5;";
		$result = $this->db->fetchAll($sql);
		foreach ($result as $key => &$value) {
			$value['S_BeginTime'] = date("m",$value['S_BeginTime']);
			$sql = "SELECT S_PrizePic FROM SALE_LuckyDrawPrize WHERE S_LuckyID = {$value['S_LuckyID']};";
			$pic = $this->db->fetchOne($sql);
			$value['pic'] = Common::get_image_url($pic['S_PrizePic'],'','','prize');
		}

		return $result;
	}

	/**
	* 获取往期活动详情
	* @return array
	* @param $id 活动ID
	* @author Dandan_Sun
	* @date 2017-03-16 09:23:31
	*/
	function pastActivities($id,$status = 1){
		$sql = "SELECT * FROM SALE_LuckyDraw WHERE S_LuckyID = {$id};";
		$result = $this->db->fetchOne($sql);
		$result = $this->getDetails($result,$id);
		$result['lucky']['month'] = date("m",$result['lucky']['S_BeginTime']);
		$result['lucky']['day'] = date("d",$result['lucky']['S_BeginTime']);
		$result['lucky']['status'] = $status;
		$result['winner'] = $this->listWinners($result['lucky']['S_LuckyID']);
		return $result;
	}

	/**
	* 套餐详情
	* @return array
	* @param $goods_id  套餐ID
	* @author Dandan_Sun
	* @date 2017-03-17 10:53:08
	*/
	function promoDetails($goods_id, $lucky){
		$data = array();
		$time = time();
		$sql = "SELECT G_PromoID,G_SuiteNo,G_SuiteName,Goods_ID FROM SALE_PromoGoods WHERE Goods_ID = {$goods_id};";
		$result = $this->db->fetchOne($sql);
		if(empty($result['G_SuiteNo'])){
			return $data;
		}
		$data['promo']['S_Name'] = $result['G_SuiteName'];
		$data['promo']['Goods_ID'] = $result['Goods_ID'];
		$sql = "SELECT P_PromoNo FROM SALE_Promo WHERE Promotion_ID = {$result['G_PromoID']};";
		$promo = $this->db->fetchOne($sql);
		$sql = "SELECT S_Package,S_BeginTime FROM SALE_LuckyDraw WHERE S_PromoNo = '{$promo['P_PromoNo']}' AND S_LuckyID = {$lucky};";
		$packages = $this->db->fetchOne($sql);
		$package = json_decode($packages['S_Package']);
		$package = (array)$package;
		foreach ($package as $key => &$value) {
			$value = (array)$value;
		}
		$a = $result['G_SuiteNo'];
		if(array_key_exists($a, $package)){
			$data['promo']['num'] = $package[$a]['surplus'];
			if($package[$a]['status'] == 0 && $packages['S_BeginTime'] > $time){
				$data['promo']['status'] = 0;//即将开售
			}elseif($package[$a]['status'] == 0 && $packages['S_BeginTime'] < $time){
				$data['promo']['status'] = 2;//立即购买
			}else{
				$data['promo']['status'] = $package[$a]['status']; //已售罄
			}
			$data['promo']['img'] = Common::get_image_url($package[$a]['img'],'','','prize');
		}
		$sql = "SELECT G_SkuID,G_ActPrice FROM SALE_PromoGoods WHERE G_PromoID = {$result['G_PromoID']} AND G_SuiteNo = '{$result['G_SuiteNo']}';";
		$data['details'] = $this->db->fetchAll($sql);
		$data['promo']['price'] = 0;
		$data['promo']['shop_price'] = 0;
		foreach ($data['details'] as $k => &$val) {
			$sql = "SELECT S_Name,S_Logo,S_ShopPrice FROM GM_Sku WHERE Sku_ID = {$val['G_SkuID']};";
			$sku = $this->db->fetchOne($sql);
			$val['S_Name'] = $sku['S_Name'];
			$val['S_ShopPrice'] = $sku['S_ShopPrice'];
			$val['S_Logo'] = Common::get_image_url($sku['S_Logo']);
			$data['promo']['price'] += $val['G_ActPrice'];
			$data['promo']['shop_price'] += $sku['S_ShopPrice'];
			$sql = "SELECT S_SpuID FROM GM_SkuSpecs WHERE S_SkuID = {$val['G_SkuID']};";
			$specs = $this->db->fetchOne($sql);
			if(empty($specs)){
				$val['specs'] = array();
			}else{
				$sql = "SELECT S_SkuID,S_Name,S_Value,GROUP_CONCAT(`S_SkuID`) sku_id FROM `GM_SkuSpecs` WHERE `S_SpuID` = {$specs['S_SpuID']} GROUP BY `S_Value`;";
				$specs = $this->db->fetchAll($sql);
				$name = array();
				foreach ($specs as $key => $value) {
					$name[] = $value['S_Name'];
				}
				$name = array_unique($name);
				foreach ($name as $kkk => $vvv) {
					$val['specs'][$kkk]['name'] = $vvv;
					foreach ($specs as $kk => $vv) {
						if($vvv == $vv['S_Name']){
							$sku_id = array();
							$val['specs'][$kkk]['value'][$kk]['vv'] = $vv['S_Value'];
							$sku_id = $vv['sku_id'];
							$sku_id = explode(',', $sku_id);
							$val['specs'][$kkk]['value'][$kk]['status'] = 0;
							foreach ($sku_id as $vals) {
								if($val['G_SkuID'] == $vals){
									$val['specs'][$kkk]['value'][$kk]['status'] = 1;
									break;
								}
							}
						}
					}
					$val['specs'][$kkk]['value'] = array_merge($val['specs'][$kkk]['value']);
				}
			}
		}
		$data['promo']['price'] = number_format($data['promo']['price'], 2, '.', '');
		$data['promo']['shop_price'] = number_format($data['promo']['shop_price'], 2, '.', '');
		return $data;
	}

}