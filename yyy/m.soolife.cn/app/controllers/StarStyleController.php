<?php
// +----------------------------------------------------------------------
// | �����ļ� ��̬�ʲ��ļ�����
// +----------------------------------------------------------------------
// | Copyright (c) 2016�� �������. All rights reserved.
// +----------------------------------------------------------------------
// | File:  liucunyang  Controller.php
// |
// | Author:
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class StarstyleController extends BaseController
{
	public function starstyleAction()
    {
        //�÷���ȥtoken����ӿ�
        $this->curl->disable_token();
    	$this->curl->get_request('/ads/location/app.star','new_api');
    	$data = $this->curl->getArrayData();
    	if(isset($data))
    	{
    		foreach($data as $key => &$value)
    		{
    			foreach($value['children'] as $key => &$v)
    			{
    				foreach($v['items'] as $key => &$s)
    				{
    					$s['picture'] = Common::get_new_image_url($this -> config, $s['picture']);
    				}
    			}
    		}
    	}
    	$this -> assign('data',$data);

        //����
        $this->display("starstyle/starstyle");
        $this->pages->init('�Ƿ�');
    // echo "<pre>";
    // print_r($data);
    // exit;
    }

}