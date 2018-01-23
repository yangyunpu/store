<?php
// +----------------------------------------------------------------------
// |抽奖活动类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   LuckyController.php
// | Author: Dandan_Sun
// | Created: 2016-11-04 13:38:32
// +----------------------------------------------------------------------
namespace Soolife\Sales\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Services\LuckyService;

class LuckyController extends BaseController{

	private $db_identifier = 'promo';

	function indexsAction(){
		$this->page->page_url();
		$this->display("lucky/xin");
		$this -> page -> init('即将开始','','','mobile');
	}

	/**
	* 一等奖
	*/
	function oneAction(){
		$this->page->page_url();
		$this->display("lucky/one");
		$this -> page -> init('即将开始','','','mobile');
	}

	/**
	* 二等奖
	*/
	function twoAction(){
		$this->page->page_url();
		$this->display("lucky/two");
		$this -> page -> init('即将开始','','','mobile');
	}

	/**
	* 三等奖
	*/
	function threeAction(){
		$this->page->page_url();
		$this->display("lucky/three");
		$this -> page -> init('即将开始','','','mobile');
	}

	/**
	* 请求广告位的图片
	* @return 图片地址
	* @author Dandan_Sun
	* @date 2017-03-18 16:22:56
	*/
	function getAdsPic(){
		$model = new LuckyService();
		$pic = $model->getAdsPic();
		return $pic;
	}

	/**
	* 活动开始页
	* @author Dandan_Sun
	* @date 2016-11-23 10:53:31
	*/
	function indexAction(){
		$keys = "{$this->db_identifier}:lucky:id";
		$model = new LuckyService();
		$id = $this->redis->read($keys, $this->db_identifier,1);
		$data = $model->cluster($id);
		$pic = $this->getAdsPic();
		$this->assign('pic',$pic);
		foreach ($data['prize'] as $k => &$v) {
			if($k%3 == 0){
				$v['a'] = "/m/lucky/one.html";
			}elseif($k%3 == 1){
				$v['a'] = "/m/lucky/two.html";
			}elseif($k%3 == 2){
				$v['a'] = "/m/lucky/three.html";
			}
		}
		if(!empty($data)){
			$a = 0;
			foreach ($data['no'] as $key => $value) {
				if($value['status'] != 1){
					$a = 1;
					break;
				}
			}
			$b = 1;
			$this->page->page_url();
			$time = time();
			if(empty($date['package_record'])){
				$b = 0;
			}
			reset($data['package_record']);
			$date = current($data['package_record'])['S_BuyTime'] + ($data['lucky']['S_EndTime'] * 60);
			$times = $data['lucky']['S_BeginTime'];
			if(($a == 1 && $time > $times) || ($a == 0 && $time < $date)){
				if($a == 1){
					$t = -3;
				}else{
					$t = $date - $time;
				}
				$this->assign('t',$t);
				$this->assign('data',$data);
				$this->display("lucky/star_home");
				$this -> page -> init('拼团抽奖','','','mobile');

			}elseif($a == 0 && $time > $date && $time < $date + 500){
				$t = $date + 500 - $time;
				$this->assign('t',$t);
				$this->assign('data',$data);
				$list = $model->lottery($data['lucky']['S_LuckyID'],$data['prize']);
				if(!empty($list)){
					$this->assign('list',json_encode($list));
					$this->display("lucky/star_march");
					$this -> page -> init('抽奖中','','','mobile');
				}else{
					$this->dispatcher->forward(array(
					    "action" => "indexs"
					));
					// $this->indexs();
				}
			}elseif(($a == 1 && $b == 0 && $time < $times) || ($a == 0 && $time > $date + 500)){
				$id = $this->redis->read($keys, $this->db_identifier,1);
				if(empty($id)){
					if($a == 0 && $time > $date + 500){
						$this-> redis->write($keys,$data['lucky']['S_LuckyID'],$this->db_identifier,72000);
						$res = $model->upcoming($data['lucky']['S_LuckyID']);
					}else{
						$res = $data;
						$res['lucky']['S_BeginTime'] = date("Y/m/d H:i:s",$res['lucky']['S_BeginTime']+15);
					}
				}else{
					$res = $model->upcoming($id);
				}
				if(!empty($res)){
					$this->assign("data",$res);
					$this->display("lucky/open_star");
					$this -> page -> init('即将开始','','','mobile');
				}else{
					$id = $this->redis->read($keys, $this->db_identifier,1);
					if(empty($id)){
						$this->dispatcher->forward(array(
						    "action" => "indexs"
						));
						// $this->indexs();
					}else{
						$model = new LuckyService();
						$data = $model->pastActivities($id);
						$this->assign('data',$data);
						$this->display("lucky/over_star");
						$this -> page -> init('活动已经结束','','','mobile');
					}
				}
			}
		}else{
			$id = $this->redis->read($keys, $this->db_identifier,1);
			if(empty($id)){
				$this->dispatcher->forward(array(
				    "action" => "indexs"
				));
				// $this->indexs();
			}else{
				$model = new LuckyService();
				$data = $model->pastActivities($id);
				$this->assign('data',$data);
				$this->display("lucky/over_star");
				$this -> page -> init('活动已经结束','','','mobile');
			}
		}

	}

	/**
	* 抽奖名单
	* @return array
	* @param $id(活动ID)
	* @author Dandan_Sun
	* @date 2016-11-25 17:13:55
	*/
	function listAction(){
		$id = $this->request->get('id');
		$model = new LuckyService();
		$data = $model->listWinners($id);
		if(!empty($data)){
			$this->assign('data',$data);
			$this->display("lucky/list");
			$this -> page -> init('抽奖名单','','','mobile');
		}else{
			$this -> page -> init('活动未找到','','','mobile');
        	return $this -> display('layouts/404');
		}
	}

	/**
	* 更改数量
	* @author Dandan_Sun
	* @date 2016-12-05 11:29:26
	*/
	public function addSuiteCartAction(){
		$id = $this->request->getPost('id');
		$lucky_id = $this->request->getPost('lucky_id');
		$model = new LuckyService();
		$model->changeNum($id,$lucky_id);
	}

	/**
	* 判断套餐数量
	* @param $lucky_id
	* @author Dandan_Sun
	* @date 2017-01-17 19:26:34
	*/
	public function judgePromoAction(){
		$id = $this->request->getPost('lucky_id');
		$model = new LuckyService();
		$data = $model->judgePromo($id);
		$this->success('',$data);
	}

	/**
	* 获取往期活动列表
	* @return 活动列表
	* @author Dandan_Sun
	* @date 2017-03-14 09:52:13
	*/
	function pastActivitiesListAction(){
		$model = new LuckyService();
		$data = $model->pastActivitiesList();
		if(!empty($data)){
			$this->assign('data',$data);
			$this->display("lucky/old_timey");
			$this -> page -> init('往期活动','','','mobile');
		}else{
			$this -> page -> init('活动未找到','','','mobile');
        	return $this -> display('layouts/404');
		}
	}

	/**
	* 获取往期活动详情
	* @return array
	* @param $id
	* @author Dandan_Sun
	* @date 2017-03-15 18:49:42
	*/
	function pastActivitiesAction($id){
		$model = new LuckyService();
		$status = 0;
		$data = $model->pastActivities($id,$status);
		if(!empty($data)){
			$pic = $this->getAdsPic();
			$this->assign('pic',$pic);
			$this->assign('data',$data);
			$this->display("lucky/over_star");
			$this -> page -> init('往期活动','','','mobile');
		}else{
			$this -> page -> init('活动未找到','','','mobile');
        	return $this -> display('layouts/404');
		}
	}

	/**
	* 套餐详情
	* @return array
	* @param $goods_id 套餐id
	* @author Dandan_Sun
	* @date 2017-03-17 10:36:23
	*/
	function promoDetailsAction($goods_id,$lucky){
		$model = new LuckyService();
		$data = $model->promoDetails($goods_id,$lucky);
		if(!empty($data)){
			$this->assign('data',$data);
			$this->display("lucky/child_meal");
			$this -> page -> init('套餐详情','','','mobile');
		}else{
			$this -> page -> init('活动未找到','','','mobile');
        	return $this -> display('layouts/404');
		}
	}
		/**
	* 套餐详情
	* @return array
	* @param $goods_id 套餐id
	* @author junjie_lei
	* @date 2017-06-14 10:36:23
	*/
	function  staroldAction(){
		$this -> page -> init('活动已经结束','mobile');
	}
}