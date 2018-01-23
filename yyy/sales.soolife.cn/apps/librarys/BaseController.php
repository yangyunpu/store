<?php
// +----------------------------------------------------------------------
// | 不需要验证的基类控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   BaseController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\Controller,
	Phalcon\Mvc\Dispatcher;

/**
 * 不需要验证的基类控制器
 */
class BaseController extends Controller {
	function initialize() {
		$token = $this -> cookies -> get('m_token') -> getValue();
		$this -> member = $this -> redis -> read_token($token);
		//会话
		$history_key = 'history_id';
		//var_dump($this->cookies);exit;
		if ($this -> cookies) {
			$cookie = $this -> cookies -> get($history_key);
			$this -> history_id = $cookie -> getValue();
			if (empty($this -> history_id)) {
				$domain = 'soolife.loc';
				$val = strtolower(str_replace(array('{', '}', '-'), "", $this -> com_create_guid()));
				$expire = time() + (365 * 86400);
				$this -> cookies -> set('history_id', $val, $expire, "/", FALSE, $domain);
			}
		}
	}

	function com_create_guid() {
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

	function ensure_length(&$string, $length) {
		$strlen = strlen($string);
		if ($strlen < $length) {
			$string = str_pad($string, $length, "0");
		} else if ($strlen > $length) {
			$string = substr($string, 0, $length);
		}
	}

	function create_guid_section($characters) {
		$return = "";
		for ($i = 0; $i < $characters; $i++) {
			$return .= dechex(mt_rand(0, 15));
		}
		return $return;
	}

	/**
	 * 设置布局文件
	 * @access protected
	 * @param mixed $name 要显示的布局文件
	 * @return void
	 */
	protected function layout($name) {
		if ($name) {
			$this -> view -> setLayout($name);

		}
	}

	/**
	 * 模板变量赋值
	 * @access protected
	 * @param mixed $name 要显示的模板变量
	 * @param mixed $value 变量的值
	 * @return void
	 */
	public function assign($name, $value = '') {
		$this -> view -> setVar($name, $value);
	}

	/**
	 * 模板显示 调用内置的模板引擎显示方法，
	 * @access protected
	 * @author Tony Wang
	 * @param string $templateFile 	视图
	 * @param string $layout 		布局
	 * @return void
	 */
	protected function display($templateFile, $layout = '') {
		// if (!empty($layout))
		// 	$this -> view -> setTemplateBefore($layout);

  //       else {
  //           $this -> view -> setTemplateBefore('layout_main');

  //       }

		$this -> view -> pick($templateFile);
	}

	/**
	 * 重定向到另一个地址
	 */
	public function redirect($location = '', $externalRedirect = FALSE, $statusCode = 200) {
		$this -> view -> disable();
		if (!empty($location)) {
			return $this -> response -> redirect($location, FALSE) -> send();
		} else {
			return $this -> response -> redirect() -> send();
		}
	}

    /**
     * 返回操作成功的JSON数据
     * @access protected
     * @param string $msg   操作成功提示信息
     * @param array  $data  返回的结果数据
     * @param string $id    返回的相关编号
     * @return
     */
    protected function success($msg, $data = array(), $id = null) {
        $result = array("success" => true);
        if (!empty($data))
            $result["data"] = $data;
        if (!empty($id))
            $result["id"] = $id;

        $this -> json($result,200);
    }

    /**
     * 返回操作失败的JSON数据
     * @access protected
     *
     * @param string    $msg    操作成功提示信息
     * @param array     $data   返回的结果数据
     * @param string    $id     返回的相关编号
     * @param int       $code   HTTP Status Code
	 * 					400 参数错误
	 * 					401 未授权，请求要求进行身份验证
	 * 					403 权限不足(执行访问被禁止)
	 * 					404 资源找不到
	 * 					405 不允许使用请求行中所指定的方法
	 * 					408 请求超时
     * @return void
     */
    protected function failure($msg, $code = 400,$data = array(),$id = null) {
        $result = array("success" => false, "msg" => $msg);
		if (isset($data) && !empty($data))
            $result["data"] = $data;
        if (isset($id) && !empty($id))
            $result["id"] = $id;
        $this -> json($result,$code);
    }

    /**
     * 返回操作失败的JSON数据
     * @access private
     *
     * @param $data 需要格式化的数据
     * @return void
     */
    public function json($data,$status_code=200) {
        $this -> view -> disable();
        if ($data == null || empty($data))
            return;
        $result = json_encode($data);
        return $this -> response
        		// -> setHeader("Developer", $this->config->headers->Developer)
        		// -> setHeader("X-Powered-By", $this->config->headers->X_Powered_By)
        		// -> setHeader("Server", $this->config->headers->Server)
        		// -> setHeader("Content-Type", $this->config->headers->Content_Type)
        		// -> setStatusCode($status_code, ' ')
        		-> setContent($result) -> send();
    }


	/**
	 * 获取POST请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤，如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	function request_post_value($name,$filters=null,$defaultValue=null)
	{
		return $this->request->getPost($name,$filters,$defaultValue);
	}

	/**
	 * 获取GET请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤 如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	function request_get_value($name,$filters=null,$defaultValue=null)
	{
		return $this->request->getQuery($name,$filters,$defaultValue);
	}

		/**
	 * 获取客户端IP地址
	 * @return string 如：192.168.1.245
	 */
	function get_client_address()
	{
		return $this->request->getClientAddress();
	}

	/**
	 * 获取用户代理信息
	 */
	function get_user_agent()
	{
		return $this->request->getUserAgent();
	}

}
?>