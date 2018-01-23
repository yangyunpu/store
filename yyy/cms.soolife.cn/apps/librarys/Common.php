<?php
// +----------------------------------------------------------------------
// | 公共函数类库
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Pages.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
namespace Soolife\Cms\Librarys;
use Phalcon\Http\Request;

class Common {
	public static $_request = null;	
	/**
	 * Base64编码加密，可用于地址栏中传递
	 * @param $data string 需要加密的字符串
	 */
	static function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	/**
	 * Base64编码解密，可用于地址栏中传递
	 * @param $data string 需要解密的字符串
	 */
	static function base64url_decode($data) {
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

	/**
	 * 判断字符串是否Base64编码
	 * @param $str 需要判断的字符串
	 */
	static function is_base64($str) {
		return ($str == Common::base64url_encode(Common::base64url_decode($str)));
	}
	
	
	/**
	 * 获取POST请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤，如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	static function get_post($name,$filters=null,$defaultValue=null)
	{		
		if (self::$_request == null)	
			self::$_request = new Request();
		
		return self::$_request->getPost($name,$filters,$defaultValue);
	}
	
	/**
	 * 获取GET请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤 如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	static function get_query($name,$filters=null,$defaultValue=null)
	{		
		if (self::$_request==null)	
			self::$_request = new Request();
		
		return self::$_request->getQuery($name,$filters,$defaultValue);
	}
	
	/**
	* @Todo--判断结果  不为空 并且 只能为数组或对象
	* @author--Xie <soosim@qq.com>
	*/
	public function valid_result($result=null){
		if(is_null($result)) return false;
		if(!empty($result) && (is_object($result) || is_array($result))){
			return true;
		}
	}
	/**
	 * 判断路径是否存在，不存在，将循环创建目录，并且权限是0766，有读写无执行权限，Window中无效
	 * @param $path string 路径
	 */
	static function create_file_dir($path) {
		if (!file_exists($path)) {
			Common::create_file_dir(dirname($path));
			mkdir($path);
			//chmod($path, 0644);	// 正式使用这个
			chmod($path, 0777);  // 测试用这个
		}
	}

	/**
	 * 获取客户端IP地址
	 * @return string 如：192.168.1.245 
	 */
	static function get_client_address()
	{
		if (self::$_request==null)	
			self::$_request = new Request();
		return self::$_request->getClientAddress();
	} 
	
	/**
	 * 获取用户代理信息
	 */
	static function get_user_agent()
	{
		if (self::$_request==null)	
			self::$_request = new Request();
		return self::$_request->getUserAgent();
	}


	static function object_to_array($obj){
		$_arr = is_object($obj)? get_object_vars($obj) : $obj;
		$arr = array();
		foreach ($_arr as $key => $val) {
			$val = (is_array($val) || is_object($val))? self::object_to_array($val):$val;
			$arr[$key] = $val;
		}
		return $arr;
	}



	static function get_image_url($config, $id, $w = 0, $h = 0,$type='images') {
		if (empty($id))
			return $config->application->default_picture;
		if (strlen($id)!==32){
			return "http://img.soolife.cn/{$id}";
		}
			$ims = $config -> images -> toArray();
			$d = array_rand($ims);
			$url_images = $ims[$d];
			if ($w>0 && $h>0){
				return "{$url_images}/{$type}/{$w}x{$h}/{$id}.jpg";
			}else{
				return "{$url_images}/{$type}/{$id}.jpg";
			}
	}

    /**
    * 
    * @return 
    * @param 
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
	static function get_new_image_url($config, $id) {
		if (empty($id))
			return $config->application->default_picture;
			$ims = $config -> new_images -> toArray();
			$d = array_rand($ims);
			$url_images = $ims[$d];		
			return "{$url_images}/img/{$id}.jpg";
	}

	/**
	* 
	* @return 
	* @param 
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
    static function get_fans_url($config, $id,$type='avatar') {
		if (empty($id))
			return $config->application->default_picture;
		if($type == "avatar")
		{
			$ims = $config -> avatar -> toArray();
			$d = array_rand($ims);
			$url_images = $ims[$d];		
			return "{$url_images}/{$id}.jpg";
		}if($type == "fans"){
			$ims = $config -> fans -> toArray();
			$d = array_rand($ims);
			$url_images = $ims[$d];		
			return "{$url_images}/{$id}.jpg";
		}		
	}
	
	/**
	* @Todo--隐藏用户名等字符截取拼接方法
	* @author--Xie <soosim@qq.com>
	*/
	public function hidecard($cardnum, $type = 1, $default = "")
	{
	    if (empty($cardnum)) return $default;
	    if ($type == 1) $cardnum = substr($cardnum, 0, 3) . str_repeat("*", 12) . substr($cardnum, strlen($cardnum) - 4);   //身份证
	    elseif ($type == 2) $cardnum = substr($cardnum, 0, 3) . str_repeat("*", 5) . substr($cardnum, strlen($cardnum) - 4);    //手机号
	    elseif ($type == 3) $cardnum = str_repeat("*", strlen($cardnum) - 4) . substr($cardnum, strlen($cardnum) - 4);    //银行卡
	    elseif ($type == 4) {
	        $cardnum = mb_substr($cardnum, 0, 3, 'UTF-8') . str_repeat("*", strlen($cardnum) - 3);   //用户名
	    } elseif ($type == 5) {
	        $mb_str = mb_strlen($cardnum, 'UTF-8');
	        if ($mb_str <= 7) {
	            $suffix = mb_substr($cardnum, $mb_str - 1, 1, 'UTF-8');
	            $cardnum = mb_substr($cardnum, 0, 1, 'UTF-8') . str_repeat("*", 3) . $suffix;    //新用户名,无乱码截取
	        } else {
	            $suffix = mb_substr($cardnum, $mb_str - 3, 3, 'UTF-8');
	            $cardnum = mb_substr($cardnum, 0, 3, 'UTF-8') . str_repeat("*", 3) . $suffix;    //新用户名,无乱码截取
	        }
	    } elseif ($type == 6) {
	        $str = explode("@", $cardnum);
	        $cardnum = substr($str[0], 0, 2) . str_repeat("*", strlen($str[0]) - 2) . "@" . $str[1];  //邮箱
	    } elseif ($type == 7) $cardnum = mb_substr($cardnum, 0, 1, 'utf-8') . str_repeat("*", 3);    //真实姓名
	    elseif ($type == 8) $cardnum = substr($cardnum, 6, 4) . "-" . substr($cardnum, 10, 2) . "-" . substr($cardnum, 12, 2);    //出生日期
	    elseif ($type == 9) {
	        if (empty($cardnum)) {
	            $cardnum = "";
	        } else $cardnum = date('Y', time()) - substr($cardnum, 6, 4) . "岁";    //年龄
	    } elseif ($type == 10) $cardnum = str_repeat("*", (strlen($cardnum) - 1) / 3) . mb_substr($cardnum, -1, 1, 'utf-8');    //紧急联系人姓名
	    elseif ($type == 11) {
	        $num = substr($cardnum, -2, 1);
	        if ($num % 2 == 0) {
	            $cardnum = "女";
	        } else {
	            $cardnum = "男";
	        }
	    }elseif ($type == 12) $cardnum = mb_substr($cardnum, 0, 1, 'utf-8') . str_repeat("", 3);    //真实姓名

	    return $cardnum;
	}


}
?>