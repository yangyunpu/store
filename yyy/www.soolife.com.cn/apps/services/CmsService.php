<?php
// +----------------------------------------------------------------------
// | 意向消息首页服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   CmsService.php
// |
// | Author:    Elliot
// | Created:   2017-02-16
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;

class CmsService extends BaseService
{
	//接收信息
	public function enterApply($data){
		$data = 'aaa';
		var_dump($data);exit;
		$sql = "INSERT INTO ER_Feedback (F_MemberID,F_MemberName,F_ShopID,F_SkuID,F_Title,F_Content,F_Status,F_CreateTime,F_ReplyTime,F_Type,F_Email,F_Mobile) VALUES (:F_MemberID,:F_MemberName,:F_ShopID,:F_SkuID,:F_Title,:F_Content,:F_Status,:F_CreateTime,:F_ReplyTime,:F_Type,:F_Email,:F_Mobile);";
		$this->db->execute($sql,array(
			"F_MemberID" => $data,
			"F_MemberName" => $data,
			"F_ShopID" => 0,
			"F_SkuID" => 0,
			"F_Title" => '客户入驻意向申请、咨询',
			"F_Content" => $data,
			"F_Status" => 0,
			"F_CreateTime" => time(),
			"F_ReplyTime" => 0,
			"F_Type" => 6,
			"F_Email" => $data,
			"F_Mobile" => $data
		));
	}
}