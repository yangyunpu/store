<?php
// +----------------------------------------------------------------------
// | 引导类
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Bootstrap.php
// |
// | Author:    Lorne
// | Created:   2017-02-10
// +----------------------------------------------------------------------
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;


class Bootstrap extends BaseApplication {
	/**
	 * 注册服务
	 * @author Lorne
	 */
	protected function registerServices() {
		$di = new FactoryDefault();   // Phalcon\DI 的一个变体。它已注册了Phalcon的大多数组件。工厂服务。
		$loader = new Loader();       //启用命名空间
		$loader->registerNamespaces(array(   // 根据命名空间前缀加载
			'Soolife\Member\Services'    => ROOT_PATH."/apps/services",
			'Soolife\Member\Librarys'    => ROOT_PATH."/apps/librarys",
			'Soolife\Member\Models'    => ROOT_PATH."/apps/models",
        	'Soolife\Member\Pc\Controllers'=> ROOT_PATH."/apps/pc/controllers",
        	'Soolife\Member\Mobile\Controllers'=> ROOT_PATH."/apps/mobile/controllers",
        	'Soolife\Member\Api\Controllers'=> ROOT_PATH."/apps/api/controllers"
		));
		$loader -> registerDirs(array(    //注册一些目录，在这些目录中放置的是我们应用程序需要用到的类文件
			ROOT_PATH . '/apps/librarys/',
			ROOT_PATH . '/apps/plugins/',
			ROOT_PATH . '/apps/services/'
		)) -> register();

		$config = new Phalcon\Config(require_once(ROOT_PATH . '/configs/inc_config.php'));

		// 设置配置文件
		$di -> set('config', $config);

		// 路由表
		$di -> set('router', function() {
			return require_once(ROOT_PATH . '/configs/inc_routes.php');
		});
		// cookies
		$di -> set('cookies',function () {
            $cookies = new \Phalcon\Http\Response\Cookies();
            $cookies->useEncryption(false);//禁用加密
            return $cookies;
        });
		// page 对象
		$di -> set('page',function() {
			return new \Soolife\Member\Librarys\WebPages();
		});
		// curl 对象
		$di -> set('curl',function() {
			return new \Soolife\Member\Librarys\WebCurl();
		});
		// db 对象
		$di -> set('db',function() use($config){
			return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        		'host' => $config->database->host,
        		'username' => $config->database->username,
        		'password' => $config->database->password,
        		'charset' => 'UTF8',
        		'dbname' => $config->database->dbname
    		));
		});

		//redis 对象
		$di -> set('redis',function() {
			return new \Soolife\Member\Librarys\WebRedis();
		});

		//context 对象
		$di -> set('context',function() {
			return new \Soolife\Member\Librarys\WebContext();
		});

		//user 对象
		$di -> set('user',function() {
			return new \Soolife\Member\Librarys\Users();
		});

		$di -> set('logger',function() use ($config) {      //设置日志文件
			$format =  $config -> get('logger') -> format;    //获得版本
			$filename = trim($config -> get('logger') -> filename, '\\/');   //获得时间
			$path = rtrim($config -> get('logger') -> path, '\\/' ) . DIRECTORY_SEPARATOR;
				$formatter = new \Phalcon\Logger\Formatter\Line($format, $config -> get(
			'logger') -> date);
			$logger = new \Phalcon\Logger\Adapter\File($path . $filename);//扩展抽象类Phalcon \记录器\适配器,适配器将日志存储在纯文本文件
			$logger -> setFormatter($formatter);
			$logger -> setLogLevel($config -> get('logger') -> logLevel);
			return $logger;
		});

		$this -> setDI($di);
	}

	public function main() {
		$this -> registerServices();
		$this -> registerModules(array (
			'pc' => array(
				'className' => 'Soolife\Member\Pc\Module',
				'path' => ROOT_PATH.'/apps/pc/Module.php'
			),
			'mobile' => array (
				'className' => 'Soolife\Member\Mobile\Module',
				'path' => ROOT_PATH.'/apps/mobile/Module.php'
			)
			)
		);
		echo $this -> handle() -> getContent();
	}

	function compress_html($string) {   //压缩html网页代码
		return ltrim(rtrim(preg_replace(array("/> *([^ ]*) *</", "/<!--[^!]*-->/", "'/\*[^*]*\*/'", "/\r\n/", "/\n/", "/\t/", '/>[ ]+</'), array(">\\1<", '', '', '', '', '', '><'), $string)));
	}
}