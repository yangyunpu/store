<?php
// +----------------------------------------------------------------------
// | 品牌招商服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:
// | Author: Dandan_Sun
// | Created: 2017-07-20 18:54:14
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;

class InvestmentService extends BaseService{

	/**
	* 品牌招商展示提交数量
	* @return $num 添加的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 19:27:38
	*/
	function index(){
		$sql = "SELECT COUNT(1) num FROM ER_EnterPurpose WHERE P_Status IN(0,1) AND P_Compny <> '';";
		$result = $this->db->fetchOne($sql);
		$res = $result['num'] + 8200;
		return ($res > 99999)?'99999+':$res;
	}

	/**
	* 提交表单数据
	* @return 0 失败  1 成功
	* @param name 姓名  iphone  电话  company 公司名称
	* @author Dandan_Sun
	* @date 2017-07-20 19:28:38
	*/
	public function add($type,$name,$iphone,$company,$tid){
		$num = 0;
		$data = array();
		if(empty($name) || empty($iphone) || empty($company) || !in_array($type,array(1,2,3))){
			return $num;
		}
		$time = time();
		$data['time']     = $time;
		$data['name']     = $name;
		$data['tel']      = $iphone;
		$data['company']  = $company;
		$data['inviter']  = '';
		$data['remark']   = '';
		$data['type']     = $type;
		$data['status']   = 1;
		$data['handler']  = '';
                $tid = addslashes(intval($tid));             
		$sql = "SELECT D_Name dname FROM DP_FeedbackData WHERE D_ID = {$tid};";
		$result = $this->db->fetchOne($sql);
                if($result){
                     $data['inviter'] = $result['dname'];
                }       
		$sql = "INSERT INTO ER_InviterFeedback (F_Name,F_Tel,F_Company,F_Inviter,F_Remark,F_Type,F_Status,F_Handler,F_CreateTime,F_Style) VALUES (:F_Name,:F_Tel,:F_Company,:F_Inviter,:F_Remark,:F_Type,:F_Status,:F_Handler,:F_CreateTime,:F_Style);";
		$this->db->execute($sql,array(
			"F_Name"        => $data['name'],
			"F_Tel"         => $data['tel'],
			"F_Company"     => $data['company'],
			"F_Inviter"     => $data['inviter'],
			"F_Remark"      => $data['remark'],
			"F_Type"        => $data['type'],
			"F_Status"      => $data['status'],
			"F_Handler"     => $data['handler'],
			"F_CreateTime"  => $data['time'],
			"F_Style"  => 1
		));		
		// $num = 0;
		// $data = array();
		// if(empty($name) || empty($iphone) || empty($compny)){
		// 	return $num;
		// }
		// $data['name'] = $name;
		// $data['region'] ='';
		// $data['phone'] =$iphone;
		// $data['email'] = '';
		// $data['field'] = 1;
		// $data['rank'] = '';
		// $data['team'] = '';
		// $data['teamscale'] = '';
		// $data['content'] = '';
		// $data['company'] = $compny;
		// $sql = "INSERT INTO ER_EnterPurpose (P_Name,P_Region,P_Email,P_Field,P_Rank,P_Team,P_TeamScale,P_Content,P_CreateTime,P_Status,P_Phone,P_Compny) VALUES (:P_Name,:P_Region,:P_Email,:P_Field,:P_Rank,:P_Team,:P_TeamScale,:P_Content,:P_CreateTime,:P_Status,:P_Phone,:P_Compny);";
		// $this->db->execute($sql,array(
		// 	"P_Name" => $data['name'],
		// 	"P_Region" => $data['region'],
		// 	"P_Phone" => $data['phone'],
		// 	"P_Email" => $data['email'],
		// 	"P_Field" => $data['field'],
		// 	"P_Rank" => $data['rank'],
		// 	"P_Team" => $data['team'],
		// 	"P_TeamScale" => $data['teamscale'],
		// 	"P_Content" => $data['content'],
		// 	"P_Compny" => $data['company'],
		// 	"P_CreateTime" => time(),
		// 	"P_Status" => 0
		// ));
		$a = $this->db->affectedRows();
		return $a;
	}

	/**
	* 获取数量
	* @return $num 添加的数量
	* @param $type 1:体验店加盟  2：品牌招商  3：城市代理
	* @author Dandan_Sun
	* @date 2017-07-26 22:06:38
	*/
	function getNum($type){
		$sql = "SELECT COUNT(1) num FROM ER_InviterFeedback WHERE F_Status = 1 AND F_Type = {$type};";
		$result = $this->db->fetchOne($sql);
		$res = $result['num'] + 8200;
		return ($res > 99999)?'99999+':$res;
	}

	/**
	* 提交表单数据
	* @return 0 失败  1 成功
	* @param name 姓名  iphone  电话  company 公司名称  type 1:体验店加盟  2：品牌招商  3：城市代理
	* @author Dandan_Sun
	* @date 2017-07-20 19:28:38
	*/
	public function insert($type,$name,$iphone,$company,$inviter)
	{
		$num = 0;
		$data = array();
		if(empty($name) || empty($iphone) || empty($company) || empty($inviter) || !in_array($type,array(1,2,3))){
			return $num;
		}
		$time = time();
		$data['time']     = $time;
		$data['name']     = $name;
		$data['tel']      = $iphone;
		$data['company']  = $company;
		$data['inviter']  = $inviter;
		$data['remark']   = '';
		$data['type']     = $type;
		$data['status']   = 1;
		$data['handler']  = '';
		$sql = "INSERT INTO ER_InviterFeedback (F_Name,F_Tel,F_Company,F_Inviter,F_Remark,F_Type,F_Status,F_Handler,F_CreateTime) VALUES (:F_Name,:F_Tel,:F_Company,:F_Inviter,:F_Remark,:F_Type,:F_Status,:F_Handler,:F_CreateTime);";
		$this->db->execute($sql,array(
			"F_Name"        => $data['name'],
			"F_Tel"         => $data['tel'],
			"F_Company"     => $data['company'],
			"F_Inviter"     => $data['inviter'],
			"F_Remark"      => $data['remark'],
			"F_Type"        => $data['type'],
			"F_Status"      => $data['status'],
			"F_Handler"     => $data['handler'],
			"F_CreateTime"  => $data['time']
		));
		$a = $this->db->affectedRows();
		return $a;
	}

}