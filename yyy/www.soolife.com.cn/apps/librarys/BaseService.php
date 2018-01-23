<?php
// +----------------------------------------------------------------------
// | 基础服务模型，不能实例化
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   CompanyModel.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-13
// +----------------------------------------------------------------------
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\User\Component;

class BaseService extends Component {
	const PATTERN_EMAIL = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	const ERROR_EMAIL = "邮箱格式不正确，格式应该如：service@soolife.com.cn";

	const PATTERN_PHONE = "/^((13[0-9])|147|(15[0-9])|18[0-9]))[0-9]{8}$/A";
	const ERROR_PHONE = "手机号码格式不正确，格式应该如：13811112222";

	const PATTERN_URL = '/^(([a-zA-Z]+)(:\/\/))?([a-zA-Z]+)\.(\w+)\.([\w.]+)(\/([\w]+)\/?)*(\/[a-zA-Z0-9]+\.(\w+))*(\/([\w]+)\/?)*(\?(\w+=?[\w]*))*((&?\w+=?[\w]*))*$/';
	const ERROR_URL = "网页地址不正确，格式应该如：http://www.soolife.cn";


	/**
	 * 正则匹配 电子邮箱
	 * @author Tony Wang
	 * @param $phone 需要匹配的电子邮箱字符串
	 * @return BOOL 匹配成功：true  失败:false
	 */
	protected function match_email($email)
	{
		return (preg_match($this::PATTERN_EMAIL, $email));
	}

	/**
	 * 正则匹配 手机号码
	 * @author Tony Wang
	 * @param $phone 需要匹配的手机字符串
	 * @return BOOL 匹配成功：true  失败:false
	 */
	protected function match_phone($phone)
	{
		return (preg_match($this::PATTERN_PHONE, $phone));
	}

	/**
	 * 正则匹配 网页地址
	 * @author Tony Wang
	 * @param $url 需要匹配的网址字符串
	 * @return BOOL 匹配成功：true  失败:false
	 */
	protected function match_url($url)
	{
		return (preg_match($this::PATTERN_URL, $url));
	}

	/**
	* 切换数据库
	* @author Jinlong_Xie <soosim@qq.com>
	* @date 2016-09-21 11:17:59
	*/
	protected function select_db($name)
	{
		if (empty($name))
			$name = 'database';
		$db = $this->config->$name;

		$config = array(
        		'host' => $db->host,
        		'username' => $db->username,
        		'password' => $db->password,
        		'charset' => 'UTF8',
        		'dbname' => $db->dbname
    	);
		$this->sdb = new \Phalcon\Db\Adapter\Pdo\Mysql($config);
		$this->sdb->connect();
	}
}

?>