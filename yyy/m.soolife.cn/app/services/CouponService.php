<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class CouponService extends BaseService {
    /**
    * 
    * @return 点赞
    * @param 
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    function praise($post){
		$url = "/v1/fans/comment";
		$curl = $this -> curl;
		if($curl -> post_request($url,$post) == 200){
			return $curl -> getJsonData();
		}
		return null;

     }

    /**
    * 
    * @return 星粉秀详情
    * @param 
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    function fans($type,$size){
    	try{
    	if(!isset($type) || !isset($size))
    		return null;
    	$type     = intval($type);
    	if($type  == 1){
    		$field = 'P_FanShowID';
    	}else{
    		$field = 'P_PicNo';
    	}
    	$size     = intval($size);
    	$data = array();
    	$sql      = "SELECT `FanShowPic_ID`,`P_FanShowID`,`P_PicNo`,`P_Pic` FROM  `ER_FanShowPic` WHERE `P_PicNo` = '1' ORDER BY {$field} DESC LIMIT {$size}";
    	$starFans = $this-> db ->fetchAll($sql,\Phalcon\Db::FETCH_ASSOC);
    	foreach($starFans as $key => &$s)
                    {
                            $result['id']         = $s['FanShowPic_ID'];
                            $result['fanshow_id'] = $s['P_FanShowID'];
                            $result['orderby']    = $s['P_PicNo'];
                            $result['photo']      = Common::get_image_url($this -> config, $s['P_Pic']);
                            $data[]               = $result;
                    }
        return $data;
        }
         catch(Exception $e)
		{
			$this->failure($e->getMessage());
		}
		 

     }

}