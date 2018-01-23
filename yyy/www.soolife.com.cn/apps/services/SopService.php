<?php
// +----------------------------------------------------------------------
// | 商家入驻服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   SopService.php
// |
// | Author:    Elliot
// | Created:   2017-02-16
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;
use Soolife\Member\Librarys\Verify;

class SopService extends BaseService
{
	# 查询用户错误登录次数
	public function error_log_num($ip){
		$error_login_num = $this->redis->read('member:error_login:'.md5($ip),'session');
		return $error_login_num;
	}

	/**
	 * [执行登录]
	 * @author Elliot Shi
	 * @param $data = array(
	 *                [username] => '' 用户名
	 *                [password] => '' 密码
	 *                [remember] => '' 记住用户名
	 * );
	 * @CreatDate 2017-06-26
	 * @link
	 * @param     $type 1  PC端  |2 手机端
	 */
	public function Login($type=1){
		# 获取登录信息
		$data = $this->request->getPost();
		$data['ip'] = $this->context->get_client_address();

		# 记住用户名
		if($data['remember']){
			setcookie('user_name',$data['username']);
		}else{
			setcookie('user_name','');
		}

		if($type == 1){
			//1、检查redis，查看用户错误登录次数 大于三次则检查验证码。
			$error_login_num = $this-> error_log_num($data['ip']);
			if($error_login_num > 3)
			{
				$vcode_key = $this->context->get_post('xcode_key','string','');
				$vcode     = $this->context->get_post('xcode','string','');
				$verify    = new Verify();
				if(!$verify->check(strtolower($vcode),$vcode_key))
				{
					return (object)array('success'=>false,'msg'=>'验证码错误','data'=>'','code'=>103);
				}
			}
		}

		# php接口 -> 登录 POST
		$url = '/v2/account/login';
		$responseCode = $this->curl->post_request($url,$data,'php_api');
		$member = $this-> curl->getJsonData();

		$this->logger->info($responseCode.':'.var_export($data,TRUE));
		$this->logger->info($responseCode.':'.var_export($member,TRUE));
		if ($responseCode == 200) {
			if($member->code==104) {
				$this->loginForm($member->login_info);

				# 判断是否切换用户,当切换用户时,更换history_id
				$local_member_id = $this->user->getId();
				if(($local_member_id != '') && ($local_member_id != $member->login_info->member_id)){
					$val = strtolower(str_replace(array('{','}','-'), '', $this->com_create_guid())) ;
					setcookie('history_id',$val,time() + 365 * 86400,'/',$this->config->application->domain,FALSE);
				}
				$member = (object)array('success'=>true);
			}else{
				$member->success = false;
			}
		}
		return $member;
	}

	//解决  com_create_guid  函数兼容问题
	private function com_create_guid() {
		$microTime = microtime();
		list($a_dec, $a_sec) = explode(" ", $microTime);
		$dec_hex = dechex($a_dec * 1000000);
		$sec_hex = dechex($a_sec);
		$this -> ensure_length($dec_hex, 5);
		$this -> ensure_length($sec_hex, 6);
		$guid = "";
		$guid .= $dec_hex;
		$guid .= $this -> create_guid_section(3);
		$guid .= '-';
		$guid .= $this -> create_guid_section(4);
		$guid .= '-';
		$guid .= $this -> create_guid_section(4);
		$guid .= '-';
		$guid .= $this -> create_guid_section(4);
		$guid .= '-';
		$guid .= $sec_hex;
		$guid .= $this -> create_guid_section(6);
		return $guid;
	}

	private function create_guid_section($characters) {
		$return = "";
		for ($i = 0; $i < $characters; $i++) {
			$return .= dechex(mt_rand(0, 15));
		}
		return $return;
	}

	private function ensure_length(&$string, $length) {
		$strlen = strlen($string);
		if ($strlen < $length) {
			$string = str_pad($string, $length, "0");
		} else if ($strlen > $length) {
			$string = substr($string, 0, $length);
		}
	}

	/**
	 * [会员注册]
	 * @author Elliot Shi
	 * @param
	 * @CreatDate 2017-06-26
	 * @link
	 * @param     [type]     $history_id [description]
	 */
	public function Register($history_id){
		$url  = '/v2/account/register';
		$data = array();
		$data['mobile']   = $this->context->get_post('phone');
		$data['vcode']    = $this->context->get_post('vcode');
		$data['ip']       = $this->context->get_client_address();
		$data['password'] = $this->context->get_post('password');

		$unique = $this->context->get_post('unique','string','');

		if(empty($unique)){
			$unique = md5($data['ip']);
		}

		$data['unique']   = $unique;
		$data['source']   = $this->context->get_post('source','string','');
		$data['referrer'] = $this->context->get_post('referrer','string','');

		$status = $this->curl->post_request($url,$data,'php_api');

		$res = $this->curl->getJsonData();

		if($status == 200){
			$this->loginForm($res->login_info);
		}
		return $res;
	}

	# 将登录信息写入cookie
	public function loginForm($data)
	{
		$data = (array)$data;
		$this->user -> reg_member(
						$data['member_id'],
						$data['login_id'],
						$data['nickName'],
						$data['token']
					);
	}

	/**
	 * [商家入驻数据提交]
	 * @author Elliot Shi
	 * @param
	 * @CreatDate 2017-06-29
	 * @link
	 * @param     $last_data [description]
	 * @return    bool
	 */
	public function formDataSubmit($last_data, $member)
	{
		$last_data['personal_data'] = json_decode($last_data['personal_data'],TRUE);
		$sql = "SELECT 1 FROM ER_ApplySupplier WHERE S_Name='{$last_data['personal_data']['company_name']}' AND S_AuditStatus<>3";
		$res = $this->db->fetchOne($sql);
		if ($res) {
			throw new \Exception('公司名称有重复，请仔细核对',105);
		}
		$last_data['offline_item'] = json_decode($last_data['offline_item'],TRUE);
		$last_data['service_cost'] = json_decode($last_data['service_cost'],TRUE);
		$servicecontent = array(
			'offline_item' => $last_data['offline_item'],
			'online_type' => $last_data['online_type'],
			'service_cost' => $last_data['service_cost'][0]
		);
		// try{
		// 	$this->logger->info(var_export($_FILES,TRUE));
		// 	$is_file = $this->request->hasFiles();
		// 	if ($this->request->hasFiles()) {
		// 		$files = $this->request->getUploadedFiles();
		// 		foreach ($files as $file) {
		// 			$this->logger->info(var_export($file,TRUE));
		// 			$file->moveTo(ROOT_PATH.'/runtime/logs/' . $file->getName());
		// 		}
		// 	}
		// }
		// catch (Exception $e)
		// {
		// 	$this->logger->error($e->getMessage());
		// 	$this->logger->error($e->getTrace());
		// }
		// exit;
		$is_file = $this->request->hasFiles();
		$img_arr = array();
		if ($is_file) {
			$files = $this->request->getUploadedFiles();
			$this->logger->info(var_export($files,TRUE));
			foreach ($files as $file) {
				if ($file->isUploadedFile()) {
					$key = $file->getKey();
					$img_arr[$file->getKey().'_md5'] = $this->WriteImageInto($file);
				} else {

					throw new \Exception('请通过正常途径上传图片',105);
				}
			}
		} else {
			throw new \Exception('请上传相关资格证件',105);
		}
		$sql = "INSERT INTO ER_ApplySupplier
				VALUES
				(
					NULL ,
					:S_Name ,
					:S_LinkmanName ,
					:S_LinkmanPosition ,
					:S_LinkmanPhone ,
					:S_LinkmanEmail ,
					:S_LinkmanFax ,
					:S_ChargemanName ,
					:S_Agent ,
					:S_AgentIDNo ,
					:S_AgentIDPic ,
					:S_GeneralTaxPic ,
					:S_BusinessLicenceNo ,
					:S_BusinessLicenceRegion ,
					:S_BusinessLicenceAddress ,
					:S_BusinessLicencePic ,
					:S_FoundTime ,
					:S_EffectBeginDate ,
					:S_EffectEndDate ,
					:S_RegistMoney ,
					:S_Introduce ,
					:S_AddressRegion ,
					:S_Address ,
					:S_Phone ,
					:S_EmergencyName ,
					:S_EmergencyPhone ,
					:S_OrganizeIDNo ,
					:S_OrganizeIDBeginDate ,
					:S_OrganizeIDEndDate ,
					:S_OrganizeIDPic ,
					:S_PaperTaxPic ,
					:S_PaperBankPic ,
					:S_PaperTrademarkPic ,
					:S_PaperBrandsalesPic ,
					:S_PaperQualityPic,
					'',
					'',
					0,
					0,
					'',
					0,
					0,
					'',
					0,
					0,
					'',
					3 ,
					:S_SupplierIndustry,
					3 ,
					:S_SupplierType ,
					:S_SupplierLevel,
					0 ,
					:S_Creater ,
					:S_CreateTime ,
					:S_CreateType,
					'',
					0,
					0,
					'',
					0,
					'',
					0,
					'' ,
					:S_LineType,
					'',
					'' ,
					:S_ServiceContent ,
					:S_CompanyRemark,
                                        :S_ShopID
				)";
		$this->db->execute($sql,array(
			"S_Name" 				   => $last_data['personal_data']['company_name'],
			"S_LinkmanName" 		   => $last_data['personal_data']['linkman'],
			"S_LinkmanPosition"        => $last_data['personal_data']['duty'],
			"S_LinkmanPhone" 		   => $last_data['personal_data']['phone'],
			"S_LinkmanEmail" 		   => $last_data['personal_data']['email'],
			"S_LinkmanFax" 			   => $last_data['personal_data']['facsimile'],
			"S_ChargemanName" 		   => '',// 无负责人
			"S_Agent" 				   => $last_data['personal_data']['corporation'],
			"S_AgentIDNo" 			   => $last_data['personal_data']['identitycard'],
			"S_AgentIDPic" 			   => $img_arr['agentid_md5'],
			"S_GeneralTaxPic" 		   => $img_arr['generaltax_md5'],
			"S_BusinessLicenceNo" 	   => $last_data['personal_data']['business_card'],
			"S_BusinessLicenceRegion"  => '', //营业执照所在地
			"S_BusinessLicenceAddress" => '', // 营业执照详细地址
			"S_BusinessLicencePic"     => $img_arr['businesslicence_md5'],
			"S_FoundTime" 			   => strtotime($last_data['personal_data']['establish']),
			"S_EffectBeginDate" 	   => strtotime($last_data['personal_data']['begin_date']),
			"S_EffectEndDate" 	       => strtotime($last_data['personal_data']['end_date']),
			"S_RegistMoney"            => $last_data['personal_data']['capital'],
			"S_Introduce" 			   => $last_data['personal_data']['scope'],
			"S_AddressRegion" 	       => $last_data['personal_data']['region_id'],
			"S_Address" 			   => $last_data['personal_data']['address'],
			"S_Phone" 				   => $last_data['personal_data']['company_tel'],
			"S_EmergencyName" 		   => $last_data['personal_data']['urgency_linkman'],
			"S_EmergencyPhone" 		   => $last_data['personal_data']['urgency_phone'],
			"S_OrganizeIDNo" 		   => '', // 组织机构代码证号码
			"S_OrganizeIDBeginDate"    => '', // 组织机构代码证起始时间
			"S_OrganizeIDEndDate"      => '', // 组织机构代码证终止时间
			"S_OrganizeIDPic" 		   => $img_arr['organizeid_md5'],
			"S_PaperTaxPic" 		   => $img_arr['papertax_md5'],
			"S_PaperBankPic" 		   => $img_arr['paperbank_md5'],
			"S_PaperTrademarkPic" 	   => $img_arr['papertrademark_md5'],
			"S_PaperBrandsalesPic"     => $img_arr['paperbrandsales_md5'],
			"S_PaperQualityPic"        => $img_arr['paperquality_md5'],
			"S_SupplierIndustry"       => $last_data['personal_data']['industry'],
			"S_SupplierType"           => '', // 供应商类型
			"S_SupplierLevel"          => '', // 供应商等级
			"S_Creater" 			   => $member->member_id,// 申请人
			"S_CreateTime"             => time(),
			"S_CreateType" 			   => 1,
			"S_LineType" 			   => $last_data['signed'],
			"S_ServiceContent" 	       => json_encode($servicecontent),
			"S_CompanyRemark" 		   => $last_data['personal_data']['company_remark'],
                        "S_ShopID" 		   => 0
		));
		$row = intval($this->db->affectedRows());
		return $row;
	}

	/**
	 * [获取会员签约信息]
	 * @author Elliot Shi
	 * @param
	 * @CreatDate 2017-06-30
	 * @link
	 * @param     $member_id [会员登录信息]
	 * @return    $data      [会员签约信息]
	 */
	public function getSignData($member_id) {
		$data = array();
		if ($member_id <= 0) {
			return $data;
		}
		$sql = "SELECT * FROM ER_ApplySupplier WHERE S_Creater='{$member_id}' AND S_CreateType=1 AND S_Status<>8;";
		$result = $this->db->fetchOne($sql);
		if ($result) {
			$data = array(
				"apply_id"            => $result['ApplySupplier_ID'],
				"company_name"        => $result['S_Name'],
				"linkman"             => $result['S_LinkmanName'],
				"duty"                => $result['S_LinkmanPosition'],
				"phone"               => $result['S_LinkmanPhone'],
				"email"               => $result['S_LinkmanEmail'],
				"facsimile"           => $result['S_LinkmanFax'],
				"corporation"         => $result['S_Agent'],
				"identitycard"        => $result['S_AgentIDNo'],
				"agentid_md5"         => Common::get_image_url($this->config, $result['S_AgentIDPic'], '','','supplier'),
				"generaltax_md5"      => Common::get_image_url($this->config, $result['S_GeneralTaxPic'], '','','supplier'),
				"business_card"       => $result['S_BusinessLicenceNo'],
				"businesslicence_md5" => Common::get_image_url($this->config, $result['S_BusinessLicencePic'], '','','supplier'),
				"establish"           => date("Y-m-d",$result['S_FoundTime']),
				"begin_date"          => date("Y-m-d",$result['S_EffectBeginDate']),
				"end_date"            => date("Y-m-d",$result['S_EffectEndDate']),
				"capital"             => $result['S_RegistMoney'],
				"scope"               => $result['S_Introduce'],
				"region_id"           => $result['S_AddressRegion'],
				"region_arr"  => array(
					"region_id"       => $result['S_AddressRegion'],
					"f_region_id"     => substr($result['S_AddressRegion'],0,strlen($result['S_AddressRegion'])-2),
					"ff_region_id"    => substr($result['S_AddressRegion'],0,strlen($result['S_AddressRegion'])-4)
					),
				"address"             => $result['S_Address'],
				"company_tel"         => $result['S_Phone'],
				"urgency_linkman"     => $result['S_EmergencyName'],
				"urgency_phone"       => $result['S_EmergencyPhone'],
				"organizeid_md5"      => Common::get_image_url($this->config, $result['S_OrganizeIDPic'], '','','supplier'),
				"papertax_md5"        => Common::get_image_url($this->config, $result['S_PaperTaxPic'], '','','supplier'),
				"paperbank_md5"       => Common::get_image_url($this->config, $result['S_PaperBankPic'], '','','supplier'),
				"papertrademark_md5"  => Common::get_image_url($this->config, $result['S_PaperTrademarkPic'], '','','supplier'),
				"paperbrandsales_md5" => Common::get_image_url($this->config, $result['S_PaperBrandsalesPic'], '','','supplier'),
				"paperquality_md5"    => Common::get_image_url($this->config, $result['S_PaperQualityPic'], '','','supplier'),
				"industry"            => $result['S_SupplierIndustry'],
				"company_remark"      => $result['S_CompanyRemark'],
				"signed"              => $result['S_LineType'],
				"servicecontent"      => json_decode($result['S_ServiceContent'],TRUE),
			);
		}
		return $data;
	}

	/**
	 * [会员修改入驻信息]
	 * @author Elliot Shi
	 * @param
	 * @CreatDate 2017-06-30
	 * @link
	 * @param     $last_data [description]
	 * @param     $member    [description]
	 * @return               [description]
	 */
	public function formDataEdit($last_data, $member) {
		$last_data['offline_item'] = json_decode($last_data['offline_item'],TRUE);
		$last_data['service_cost'] = json_decode($last_data['service_cost'],TRUE);
		$last_data['personal_data'] = json_decode($last_data['personal_data'],TRUE);
		$sql = "SELECT 1 FROM ER_ApplySupplier WHERE ApplySupplier_ID<>'{$last_data['apply_id']}' AND S_Name='{$last_data['personal_data']['company_name']}' AND S_AuditStatus<>3";
		$res = $this->db->fetchOne($sql);
		if ($res) {
			throw new \Exception('公司名称有重复，请仔细核对',105);
		}
		$servicecontent = array(
			'online_type' => $last_data['online_type'],
			'offline_item' => $last_data['offline_item'],
			'service_cost' => $last_data['service_cost'][0]
		);
		$sql = "SELECT S_AgentIDPic agentid_md5,S_GeneralTaxPic generaltax_md5,S_BusinessLicencePic businesslicence_md5,S_OrganizeIDPic organizeid_md5,S_PaperTaxPic papertax_md5,S_PaperBankPic paperbank_md5,S_PaperTrademarkPic papertrademark_md5,S_PaperBrandsalesPic paperbrandsales_md5,S_PaperQualityPic paperquality_md5 FROM ER_ApplySupplier WHERE S_Creater='{$member->member_id}';";
		$img_arr = $this->db->fetchOne($sql);
		$is_file = $this->request->hasFiles();
		if ($is_file) {
			$files = $this->request->getUploadedFiles();
			foreach ($files as $file) {
				if ($file->isUploadedFile()) {
					$key = $file->getKey();
					$img_arr[$file->getKey().'_md5'] = $this->WriteImageInto($file);
				}
			}
		} else {
			throw new \Exception('请上传相关资格证件',105);
		}
		$sql = "UPDATE ER_ApplySupplier
				SET
					`S_Name`               = :S_Name,
					`S_LinkmanName`        = :S_LinkmanName,
					`S_LinkmanPosition`    = :S_LinkmanPosition,
					`S_LinkmanPhone`       = :S_LinkmanPhone,
					`S_LinkmanEmail`       = :S_LinkmanEmail,
					`S_LinkmanFax`         = :S_LinkmanFax,
					`S_Agent`              = :S_Agent,
					`S_AgentIDNo`          = :S_AgentIDNo,
					`S_AgentIDPic`         = :S_AgentIDPic,
					`S_GeneralTaxPic`      = :S_GeneralTaxPic,
					`S_BusinessLicenceNo`  = :S_BusinessLicenceNo,
					`S_BusinessLicencePic` = :S_BusinessLicencePic,
					`S_FoundTime`          = :S_FoundTime,
					`S_EffectBeginDate`    = :S_EffectBeginDate,
					`S_EffectEndDate`      = :S_EffectEndDate,
					`S_RegistMoney`        = :S_RegistMoney,
					`S_Introduce`          = :S_Introduce,
					`S_AddressRegion`      = :S_AddressRegion,
					`S_Address`            = :S_Address,
					`S_Phone`              = :S_Phone,
					`S_EmergencyName`      = :S_EmergencyName,
					`S_EmergencyPhone`     = :S_EmergencyPhone,
					`S_OrganizeIDPic`      = :S_OrganizeIDPic,
					`S_PaperTaxPic`        = :S_PaperTaxPic,
					`S_PaperBankPic`       = :S_PaperBankPic,
					`S_PaperTrademarkPic`  = :S_PaperTrademarkPic,
					`S_PaperBrandsalesPic` = :S_PaperBrandsalesPic,
					`S_PaperQualityPic`    = :S_PaperQualityPic,
					`S_SupplierIndustry`   = :S_SupplierIndustry,
					`S_Update`             = :S_Update,
					`S_UpdateTime`         = :S_UpdateTime,
					`S_UpdateType`         = :S_UpdateType,
					`S_Status`             = :S_Status,
					`S_AuditStatus`        = :S_AuditStatus,
					`S_CompanyRemark`      = :S_CompanyRemark,
					`S_LineType`           = :S_LineType,
					`S_ServiceContent`     = :S_ServiceContent
				WHERE
					`ApplySupplier_ID`     = :ApplySupplier_ID";
		$this->db->execute($sql, array(
			"ApplySupplier_ID"         => $last_data['apply_id'],
			"S_Name" 				   => $last_data['personal_data']['company_name'],
			"S_LinkmanName" 		   => $last_data['personal_data']['linkman'],
			"S_LinkmanPosition"        => $last_data['personal_data']['duty'],
			"S_LinkmanPhone" 		   => $last_data['personal_data']['phone'],
			"S_LinkmanEmail" 		   => $last_data['personal_data']['email'],
			"S_LinkmanFax" 			   => $last_data['personal_data']['facsimile'],
			"S_Agent" 				   => $last_data['personal_data']['corporation'],
			"S_AgentIDNo" 			   => $last_data['personal_data']['identitycard'],
			"S_AgentIDPic" 			   => $img_arr['agentid_md5'],
			"S_GeneralTaxPic" 		   => $img_arr['generaltax_md5'],
			"S_BusinessLicenceNo" 	   => $last_data['personal_data']['business_card'],
			"S_BusinessLicencePic"     => $img_arr['businesslicence_md5'],
			"S_FoundTime" 			   => strtotime($last_data['personal_data']['establish']),
			"S_EffectBeginDate" 	   => strtotime($last_data['personal_data']['begin_date']),
			"S_EffectEndDate" 	       => strtotime($last_data['personal_data']['end_date']),
			"S_RegistMoney"            => $last_data['personal_data']['capital'],
			"S_Introduce" 			   => $last_data['personal_data']['scope'],
			"S_AddressRegion" 	       => $last_data['personal_data']['region_id'],
			"S_Address" 			   => $last_data['personal_data']['address'],
			"S_Phone" 				   => $last_data['personal_data']['company_tel'],
			"S_EmergencyName" 		   => $last_data['personal_data']['urgency_linkman'],
			"S_EmergencyPhone" 		   => $last_data['personal_data']['urgency_phone'],
			"S_OrganizeIDPic" 		   => $img_arr['organizeid_md5'],
			"S_PaperTaxPic" 		   => $img_arr['papertax_md5'],
			"S_PaperBankPic" 		   => $img_arr['paperbank_md5'],
			"S_PaperTrademarkPic" 	   => $img_arr['papertrademark_md5'],
			"S_PaperBrandsalesPic"     => $img_arr['paperbrandsales_md5'],
			"S_PaperQualityPic"        => $img_arr['paperquality_md5'],
			"S_SupplierIndustry"       => $last_data['personal_data']['industry'],
			"S_Update" 			       => $member->member_id,// 修改人
			"S_UpdateTime" 			   => time(),
			"S_UpdateType" 			   => 1,
			"S_Status" 			       => 0,
			"S_AuditStatus" 		   => 0,
			"S_CompanyRemark" 		   => $last_data['personal_data']['company_remark'],
			"S_LineType" 			   => $last_data['signed'],
			"S_ServiceContent" 	       => json_encode($servicecontent)
		));
		$row = intval($this->db->affectedRows());
		return $row;
	}

	/**
	 * [获取用户申请审核状态]
	 * @author Elliot Shi
	 * @param
	 * @CreatDate 2017-06-29
	 * @link
	 * @param     $member [会员信息]
	 * @return    $data   [状态信息]
	 */
	public function auditResult($member = array())
	{
		$data = array();
		if (empty($member)) return $data;
		$sql = "SELECT
					S_Status,
					S_AuditStatus,
					S_ServiceContent,
					S_RefuseReason
				FROM
					ER_ApplySupplier
				WHERE
					S_Creater = '{$member->member_id}'
				AND S_CreateType = 1 AND S_Status<>8
				ORDER BY
					S_CreateTime DESC
				LIMIT 1";
		$result = $this->db->fetchOne($sql);
		if ($result) {
			$service_cost = json_decode($result['S_ServiceContent'],TRUE);
			if ($result['S_Status'] == 9) {
				$data['status'] = 9;
				$data['statusText'] = '您提交的入驻申请审核失败';
			} elseif($result['S_Status'] > 4) {
				$data['status'] = 1;
				$data['statusText'] = "恭喜您审核通过";
			} else {
				$data['status'] = $result['S_AuditStatus'];
				$data['statusText'] = $this->getAuditText($result['S_AuditStatus']);
			}
			$data['service_cost'] = $service_cost['service_cost'];
			$data['reason'] = $result['S_RefuseReason'];
			if (!in_array($data['status'],['0','1','2','4','9'])) return array();
		}
		return $data;
	}
	public function getAuditText($status)
	{
		$text = '';
		switch ($status) {
			case '0':
				$text = '您提交的入驻申请正在审核中，请耐心等待';
				break;
			case '1':
				$text = '恭喜您审核通过！';
				break;
			case '2':
				$text = '您提交的入驻申请审核失败';
				break;
		}
		return $text;
	}
	//写入图片
    public function WriteImageInto($file)
    {
		$type = $file -> getType();
		$size = $file -> getSize();
		$ext  = $file -> getExtension();

		//随机声称文件名与创建上传文件夹
		$da       = date('Ymd', time());
		$upload   = $this->config->upload;
		$path     = ROOT_PATH . "{$upload->rootPath}{$da}";
		Common::create_file_dir($path);
		$identify = uniqid() . ".{$ext}";
		$img_url  = $upload->rootPath.$da.'/'.$identify;
		$filename = $path . '/' . $identify ;

		//过滤文件
		if (!in_array(strtolower($type), $upload -> mimes -> toArray())) {
			throw new \Exception("文件类型[{$type}]不支持上传！");
		}
		if ($size > $upload -> maxSize) {
			throw new \Exception('文件大小超出！');
		}

		// 保存文件到上传目录下
		$file -> moveTo($filename);

        $file = $this->GetImageInfo($filename);
        $this->select_db('db_imgs');
        $sql = " SELECT `S_MD5` FROM `FS_Supplier` WHERE `S_MD5` = '{$file['s_md5']}' ";
        $result = $this->sdb->fetchOne($sql);
        if (!$result) {
            $sql = "INSERT INTO `FS_Supplier` (
						`S_MD5`,
						`S_SHA1`,
						`S_Content`,
						`S_Size`,
						`S_FileType`
					)
					VALUES
						(
							'{$file['s_md5']}',
							'{$file['s_sha1']}',
							'{$file['binary']}',
							'{$file['size']}',
							'{$file['mime']}'
						);";
            $res = $this->sdb->execute($sql);
            //写入判断
            if (!$res) {
                throw new \Exception('图片写入失败', 104);
            }
        }
        // exit;
        return $file['s_md5'];
    }
    //获取图片信息
    public function GetImageInfo($file)
    {
        $image = array();
        $size = filesize($file);
        $handle = fopen($file, 'r'); //使用打开模式为r
        //读为二进制
        $image['binary'] = addslashes(fread($handle, $size));
        fclose($handle);
        $image['s_md5'] = md5_file($file);
        $image['s_sha1'] = sha1_file($file);
        $image['size'] = $size;
        $info = getimagesize($file);
        $image['mime'] = $info['mime'];

        return $image;
    }
}