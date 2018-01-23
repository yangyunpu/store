<?php
// +----------------------------------------------------------------------
// | 基类控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   BaseController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-20
// +----------------------------------------------------------------------
use Phalcon\Mvc\Controller, 
	Phalcon\Mvc\Dispatcher;

/**
 * 不需要验证的基类控制器
 */
class BaseController extends Controller {

	const PATTERN_PHONE = "/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/";
	public $history_id;

	/**
	 * 初始化控制器,自动加载
	 * @access public
	 * @author Tony Wang
	 * @return void
	 */
	public function initialize() {

		//$this->default_img = $this -> config -> application -> default_img;
		//$this->assign('default_img',$this->default_img);

		//会话
		$history_key = 'history_id';		
		if ($this -> cookies) {
			$cookie = $this -> cookies -> get($history_key);
			$this -> history_id = $cookie -> getValue();
			if (empty($this -> history_id)) {
				if (!session_id())
					@session_start();
				$this -> history_id = session_id();
				$this -> cookies -> set($history_key, $this -> history_id, time() + 365 * 86400, "/", FALSE, $this->config->application->domain);	// 365天不过期
			}
		}

	}

	/**
	 * 执行路由之前的事件
	 * @access protected
	 * @author Tony Wang
	 * 
	 * @param $dispatcher 分发器
	 * @return void || bool
	 */
	public function beforeExecuteRoute(Dispatcher $dispatcher) {
		
	}

	/**
	 * 模板变量赋值
	 * @access protected
	 * @param mixed $name 要显示的模板变量
	 * @param mixed $value 变量的值
	 * @return void
	 */
	protected function assign($name, $value = '') {
		$this -> view -> setVar($name, $value);
	}

	/**
	 * 模板显示 调用内置的模板引擎显示方法，
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param string $templateFile 	视图
	 * @param string $layout 		布局
	 * @return void
	 */
	protected function display($template, $layout = '') {
		if (empty($layout))
			$layout = $this -> config -> application -> layout;
		$this -> view -> setTemplateBefore($layout);
		$this -> view -> pick($template);
	}


	/**
	 * 重定向到另一个地址
	 * @access protected
	 *
	 * @author Tony Wang
	 * @param $location 重定向的地址
	 */
	protected function redirect($location = '') {
		$this -> view -> disable();
		if (!empty($location)) {
			return $this -> response -> redirect($location, FALSE) -> send();
		}
	}

	/**
	 * 返回操作成功的JSON数据
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param string $msg   操作成功提示信息
	 * @param array  $data  返回的结果数据
	 * @param string $id    返回的相关编号
	 * @return
	 */
	protected function success($msg, $data = array(), $id = null) {
		$result = array("success" => true, "code" => 200, "msg" => $msg);
		if (!empty($data))
			$result["data"] = $data;
		if (!empty($id))
			$result["id"] = $id;

		$this -> json($result);
	}

	/**
	 * 返回操作失败的JSON数据
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param string    $msg    操作成功提示信息
	 * @param array     $data   返回的结果数据
	 * @param string    $id     返回的相关编号
	 * @param int       $code   HTTP Status Code
	 * @return void
	 */
	protected function failure($msg, $data = array(), $id = null, $code = 200) {
		$result = array("success" => false, "code" => $code, "msg" => $msg);
		if (!empty($data))
			$result["data"] = $data;
		if (!empty($id))
			$result["id"] = $id;

		$this -> json($result);
	}

	/**
	 * 返回操作失败的JSON数据
	 * @access private
	 *
	 * @param $data 需要格式化的数据
	 * @return void
	 */
	public function json($data) {
		$this -> view -> disable();
		if ($data == null || empty($data))
			return;
		$status_code = 200;
		if (is_array($data)) {
			if (!empty($data['code']))
				$status_code = $data['code'];
		}
		$result = json_encode($data);
		$this -> response 
		-> setHeader("Developer", $this->config->headers->Developer) 
		-> setHeader("X-Powered-By", $this->config->headers->X_Powered_By) 
		-> setHeader("Server", $this->config->headers->Server) 
		-> setHeader("Content-Type", $this->config->headers->Content_Type) 
		-> setStatusCode($status_code, $this->config->headers->Status_Code) 
		-> setContent($result) -> send();
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

	/**
	 * 正则匹配 手机号码
	 * @author Tony Wang
	 * @param $phone 需要匹配的手机字符串
	 * @return BOOL 匹配成功：true  失败:false
	 */
	public function match_phone($phone)
	{
		return preg_match(self::PATTERN_PHONE, $phone);
	}

}
?>