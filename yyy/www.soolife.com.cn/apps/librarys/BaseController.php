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

	const PATTERN_PHONE = "/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/";
	public $history_id;
	function initialize()
	{
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

	public function referInComing($basc_time){
		$basc_time = time() +25*60;
		$begin_time = strtotime('09:35');
		$end_time = strtotime('21:00');
		$name = ["赵","钱","孙","李","雷","刘","林","方","魏","秦","王","汪","吴","周","郑","张","时","刁","高","韩","陈","任"];
		$sex = ["先生","女士"];
		$address = ['上海','北京','广州','深圳','厦门','苏州','杭州','河北','郑州','南京','义乌','无锡','连云港','金华','大连','青岛','山东','济南','滁州','扬州','徐州','常州','温州'];
		$phone = ['131','133','187','156','155','133','138','171','173','189','150','155'];
		$items = array(
			"name" =>'',
			"time" =>'',
			"addr" =>'',
			"phone"=>''
			);
		$data = array();
		if ($basc_time < $end_time) {
			for ($i=0; $i < 30 ; $i++) {
				$basc_time = $basc_time - rand(25,40)*60;
				if ($basc_time < $begin_time) {
					break;
				}
				$_name = $name[array_rand($name)];
				$_sex = $sex[array_rand($sex)];
				$_address = $address[array_rand($address)];
				$_phone = $phone[array_rand($phone)];
				$items = array(
					"name" =>$_name . $_sex,
					"time" =>date("H:i",$basc_time),
					"addr" =>$_address,
					"phone"=>$_phone.'****'.rand(1000,9999)
				);
				$data[] = $items;
			}
		}
		$this->assign('data',$data);
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
		if (!empty($layout))
			$this -> view -> setTemplateBefore($layout);
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
        $result = array("success" => true,'msg' =>$msg);
        if (!empty($data))
            $result["data"] = $data;
        if (!empty($id))
            $result["id"] = $id;
		die(json_encode($result));
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
		die(json_encode($result));
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
		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if ($data == null || empty($data))
            return;
		$result = json_encode($data);
        return $this -> response
        		-> setHeader("Developer", $this->config->headers->Developer)
        		-> setHeader("X-Powered-By", $this->config->headers->X_Powered_By)
        		-> setHeader("Server", $this->config->headers->Server)
        		-> setHeader("Content-Type", $this->config->headers->Content_Type)
        		-> setStatusCode($status_code, ' ')
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