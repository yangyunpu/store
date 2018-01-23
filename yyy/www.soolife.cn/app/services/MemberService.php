<?php
// +----------------------------------------------------------------------
// | ��������
// +----------------------------------------------------------------------
// | Copyright (c) 2016�� �������. All rights reserved.
// +----------------------------------------------------------------------
// | File:   MemberService.php
// |
// | Author: Tony Wang
// | Created:   2016-05-25
// +----------------------------------------------------------------------
use Phalcon\Mvc\User\Component;
class MemberService extends BaseService {

	/**
	 * ��Ա�ʲ���Ϣ
	 * @author tony wang
	 * @param $size int
	 * @return array
	 */
	public function Asset($token) {
		$data = null;
		$url = "/member/asset";
		$this->curl->set_token($token);
		if ($this -> curl -> get_request($url) == 200) {
			$data = $this -> curl -> getArrayData();
		}
		if (!isset($data) || empty($data))
		{
			$data = array(
				"gain"=>"5",
			  	"is_gain"=>"1",
			  	"coin"=>"0",
			  	"frozen_coin"=>"0",
			  	"money"=>"0.00",
			  	"frozen_money"=>"0.00",
			  	"cash"=>"0.00",
			  	"frozen_cash"=>"0.00",
			  	"avatar"=>""
			);
		}
		$common = new Common();
		$data['avatar'] = $common->get_image_url($this->config,$data['avatar'],'','','avatar');
		return $data;
	}

	public function GainCoin($token)
	{
		$data = null;
		$url = "/member/assets/coin";
		$this->curl->set_token($token);
		$resCode = $this->curl->get_request($url);
		if ($resCode == 200) {
			$data = $this -> curl -> getArrayData();
		}elseif($resCode == 403){
			$data = array('success'=>false,'err_code'=>403,'msg'=>'�û����˳�,�����µ�¼!');
		}
		return $data;
	}

	/**
	* �û�ͷ��
	* @param �û�ID
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-22 14:57:27
	*/
	public function GetAvater($id){
		$data = null;
		if(!intval($id)){
			return $data;
		}

		$url = "/account/getavatar/{$id}";
		if($this->curl->get_request($url) == 200){
			$res = $this->curl->getArrayData();
			$data = $res['data'];
		}
		return $data;
	}

	/**
	* �û����ﳵ����
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-22 17:57:03
	*/
	public function GetCartNum($token,$sessionId){
		$num = 0;
		$url = "/v2/cart/{$sessionId}/summary";
		$this->curl->set_token($token);
		if($this->curl->get_request($url,'v2_api') == 200)
		{
			$res = $this->curl->getArrayData();
			$num = isset($res['total_qty']) ? intval($res['total_qty']) : 0;
		}
		return $num;
	}

}
