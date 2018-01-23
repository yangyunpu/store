<?php
// +----------------------------------------------------------------------
// | test
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-03-17
// +----------------------------------------------------------------------


//惠生活
class ShipinController extends BaseController
{
	//领星币
	public function ceshiAction()
    {
		// $url  = "/member/gaincoin";
  //   	$coin = array();
  //   	if($this->curl->get_request($url,'api') == 200){
  //   		$coin = $this->curl->getArrayData();
  //   		return $this -> success("成功!",$coin,"");
  //   	}
      // echo "111111111111";
    	// $this -> page -> init('品牌招商','','','mobile');
      $this->display('shipin/ceshi','');
	}
}