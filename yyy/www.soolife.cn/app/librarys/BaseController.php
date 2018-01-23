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
	/**
	 * 执行路由之前的事件
	 * @access protected
	 * @author Tony Wang
	 * @param $dispatcher 分发器
	 * @return void || bool
	 */
	protected function beforeExecuteRoute(Dispatcher $dispatcher) {

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
}
?>