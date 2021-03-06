<?php
// +----------------------------------------------------------------------
// | 系统启动引导程序
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   bootstrap.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
use Phalcon\Config as PhConfig;
use Phalcon\Http\Response\Cookies as PhCookies;
use Phalcon\Loader as PhLoader;
use Phalcon\Mvc\Url as PhUrl;
use Phalcon\Mvc\View as PhView;
use Phalcon\Mvc\View\Engine\Volt as PhVolt;
use Phalcon\Mvc\Application as PhApplication;
use Phalcon\Logger\Adapter\File as PhFileLogger;
use Phalcon\Logger\Formatter\Line as PhFormatterLine;

class Bootstrap {
	private $di;
	/**
	 * 实例化类
	 * @author Tony Wang
	 * @param $di
	 */
	public function __construct() {
		$this -> di = new \Phalcon\DI\FactoryDefault();
	}

	/**
	 * 运行
	 * @access public
	 * @author Tony Wang
	 * @param string $options
	 * @return string
	 */
	public function run($options) {
		$loaders = array(
			'Config', // 配置文件
			'Cookie', // 初始化Cookie 服务
			'Url', // 初始化BASE URL
			'Loader', // 设置自动加载路径
			'Router', // 加载路由
			'View', // 初始化视图服务
			'WebCurl', // 初始化远程请求服务
			'WebPages', // 初始化页面服务
			'WebRedis', // 初始化Redis 服务
			'Utilitys',  // 初始化Utilitys服务
			'Profiles', // 初始化个人资料
			'Logger'	// 初始化写日志服务
		);
		foreach ($loaders as $service) {
			$function = 'init' . $service;
			$this -> $function();
		}
		$application = new PhApplication();
		//启动application下的服务
		$application -> setDI($this -> di);
		return $application -> handle() -> getContent();
	}

	/**
	 * 初始化配置文件
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options
	 * @return void
	 */
	protected function initConfig($options = array()) {
		$data = require_once (ROOT_PATH . '/configs/inc_config.php');
		$config = new PhConfig($data);
		$this -> di['config'] = $config;
	}

	/**
	 * 初始化Session对像
	 * @access protected
	 * @author Tony Wang
	 * @param array $options
	 * @return void
	 */
	protected function initSession($options = array()) {
		$this -> di['session'] = function() {
			$session = new PhSession();
			$session -> start();
			return $session;
		};
	}

	/**
	 * 初始化Cookie对像
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options
	 * @return void
	 */
	protected function initCookie($options = array()) {
		$this -> di['cookies'] = function() {
			$cookies = new PhCookies();
			$cookies -> useEncryption(false);
			//禁用加密
			return $cookies;
		};
	}

	/**
	 * 初始化加载器
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options
	 * @return void
	 */
	protected function initLoader($options = array()) {
		$config = $this -> di['config'];
		$loader = new PhLoader();
		$reg = array();
		foreach ($config->autoload as $key => $value) {
			$reg[] = $value;
		}
		$loader -> registerDirs($reg);
		$loader -> register();
		$this -> di['loader'] = $loader;
	}

	/**
	 *  用于生成应用程序中所有的URL
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options
	 * @return void
	 */
	protected function initUrl($options = array()) {
		$config = $this -> di['config'];
		$this -> di['url'] = function() use ($config) {
			$url = new PhUrl();
			$url -> setBaseUri($config -> application -> base_uri);
			return $url;
		};
	}

	/**
	 * 注册路由表
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options
	 * @return void
	 */
	protected function initRouter($options = array()) {
		$config = $this -> di['config'];
		$this -> di['router'] = function() use ($config) {
			$router = require_once (ROOT_PATH . '/configs/inc_routes.php');
			return $router;
		};
	}

	/**
	 * 注册视图服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options
	 * @return void
	 */
	protected function initView($options = array()) {
		$di = $this -> di;
		$config = $di['config'];
		$this -> di['view'] = function() use ($config, $di) {
			$view = new PhView();
			$view -> setViewsDir($config -> application -> path_views);
			$view -> registerEngines(array(
				'.phtml' => function($view, $di) use ($config) {
					$volt = new PhVolt($view, $di);
					$voltOptions = array(
						'compiledPath' => $config -> application -> path_volt, 
						'compiledSeparator' => '_', );
					if ('1' == $config -> application -> debug) {
						$voltOptions['compileAlways'] = true;
					}
					$volt -> setOptions($voltOptions);
					return $volt;
				}
			));
			return $view;
		};
	}

	/**
	 *  初始化WebCurl 服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options 需要传值的数组对象
	 * @return void
	 */
	protected function initWebCurl($options = array()) {
		$di = $this->di;
		$this -> di['curl'] = function() use ($di) {
			return new WebCurl();
		};
	}
	
	/**
	 *  初始化 Utilitys 服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options 需要传值的数组对象
	 * @return void
	 */
	protected function initUtilitys($options = array()) {
		$di = $this->di;
		$this -> di['utility'] = function() use ($di) {
			return new Utilitys();
		};
	}
	
	
	/**
	 *  初始化Redis 服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options 需要传值的数组对象
	 * @return void
	 */
	protected function initWebRedis($options = array()) {
		$di = $this->di;
		$this -> di['redis'] = function() use ($di) {
			return new WebRedis();
		};
	}
	
	/**
	 *  初始化Pages 服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options 需要传值的数组对象
	 * @return void
	 */
	protected function initWebPages($options = array()) {
		$di = $this->di;
		$this -> di['page'] = function() use ($di) {
			return new WebPages();
		};
	}

	/**
	 *  初始化Profiles 个人资料服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options 需要传值的数组对象
	 * @return void
	 */
	protected function initProfiles($options = array()) {
		$di = $this->di;
		$this -> di['user'] = function() use ($di) {
			return new Users();
		};
	}

	/**
	 *  配置写日志服务
	 * @access protected
	 * @author Tony Wang
	 *
	 * @param array $options 需要传值的数组对象
	 * @return void
	 */
	protected function initLogger($options = array()) {
		$config = $this->di['config'];
		$this -> di -> set('logger', 
				function($filename = null, $format = null) use ($config) {
						$format = $format ? : $config -> get('logger') -> format;
						$filename = trim($filename ? : $config -> get('logger') -> filename, '\\/');
						$path = rtrim($config -> get('logger') -> path, '\\/') . DIRECTORY_SEPARATOR;

						$formatter = new PhFormatterLine($format, $config -> get('logger') -> date);
						$logger = new PhFileLogger($path . $filename);

						$logger -> setFormatter($formatter);
						$logger -> setLogLevel($config -> get('logger') -> logLevel);

						return $logger;
				});
	}
}
