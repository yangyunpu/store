<?php
// +----------------------------------------------------------------------
// | 品牌合作首页服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   PartnerService.php
// |
// | Author:    Elliot
// | Created:   2017-03-07
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;

class PartnerService extends BaseService
{
	//接收信息
	public function Receive($data){
		if($data['field']==1){
			$data['team'] ='';
			$data['teamscale'] ='';
		}elseif($data['field']==2){
			$data['rank'] ='';
			if($data['team']==0){
				$data['teamscale'] ='';
			}
		}else{
			$data['rank'] ='';
			$data['team'] ='';
			$data['teamscale'] ='';
		}
		$sql = "INSERT INTO ER_EnterPurpose (P_Name,P_Region,P_Email,P_Field,P_Rank,P_Team,P_TeamScale,P_Content,P_CreateTime,P_Status,P_Phone) VALUES (:P_Name,:P_Region,:P_Email,:P_Field,:P_Rank,:P_Team,:P_TeamScale,:P_Content,:P_CreateTime,:P_Status,:P_Phone);";
		$this->db->execute($sql,array(
			"P_Name" => $data['name'],
			"P_Region" => $data['region'],
			"P_Phone" => $data['phone'],
			"P_Email" => $data['email'],
			"P_Field" => $data['field'],
			"P_Rank" => $data['rank'],
			"P_Team" => $data['team'],
			"P_TeamScale" => $data['teamscale'],
			"P_Content" => $data['content'],
			"P_CreateTime" => time(),
			"P_Status" => 0
		));
	}
}