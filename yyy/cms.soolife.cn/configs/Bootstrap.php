<?php
// +----------------------------------------------------------------------
// | 引导类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Bootstrap.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-05-04
// +----------------------------------------------------------------------
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;


class Bootstrap extends BaseApplication {
	/**
	 * 注册服务
	 * @author tony wang
	 */
	protected function registerServices() {
		$di = new FactoryDefault();
		$loader = new Loader();
		$loader->registerNamespaces(array(
			'Soolife\Cms\Services'       => ROOT_PATH.'/apps/services',
			'Soolife\Cms\Librarys'       => ROOT_PATH.'/apps/librarys',
			'Soolife\Cms\Models'         => ROOT_PATH.'/apps/models'
		));
		$loader -> registerDirs(array(
			ROOT_PATH . '/apps/librarys/',
			ROOT_PATH . '/apps/services/',
			ROOT_PATH . '/apps/models/'
		));
		$loader->register();

		$config = new Phalcon\Config(require_once(ROOT_PATH . '/configs/inc_config.php'));

		// 配置文件
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
		// user 对象
		$di -> set('user',function() {
			return new \Soolife\Cms\Librarys\Users();
		});
		// user 对象
		$di -> set('context',function() {
			return new \Soolife\Cms\Librarys\WebContext();
		});
		// page 对象
		$di -> set('page',function() {
			return new \Soolife\Cms\Librarys\WebPages();
		});
		// curl 对象
		$di -> set('curl',function() {
			return new \Soolife\Cms\Librarys\WebCurl();
		});
		// redis 对象
		$di -> set('redis',function() {
			return new \Soolife\Cms\Librarys\WebRedis();
		});
		//common 公共函数库  对象
		$di -> set('common',function(){
			return new \Soolife\Cms\Librarys\Common();
		});
		//database
		$di -> set('db',function() use ($config) {
			return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        		'host' => $config->database->host,
        		'username' => $config->database->username,
        		'password' => $config->database->password,
        		'charset' => 'UTF8',
        		'dbname' => $config->database->dbname
    		));
		});

		$di -> set('logger',function() use ($config) {
			$format =  $config -> get('logger') -> format;
			$filename = trim($config -> get('logger') -> filename, '\\/');
			$path = rtrim($config -> get('logger') -> path, '\\/' ) . DIRECTORY_SEPARATOR;
				$formatter = new \Phalcon\Logger\Formatter\Line($format, $config -> get(
			'logger') -> date);
			$logger = new \Phalcon\Logger\Adapter\File($path . $filename);
			$logger -> setFormatter($formatter);
			$logger -> setLogLevel($config -> get('logger') -> logLevel);
			return $logger;
		});

		$this -> setDI($di);
	}

	/**
	 * 主函数，引导
	 */
	public function main($compress=false) {
		$this -> registerServices();
		$this -> registerModules(array(
			'pc' => array(
				'className' => 'Soolife\Cms\Pc\Module',
				'path' => ROOT_PATH.'/apps/section/pc/Module.php'
			),
			'mobile' => array(
				'className' => 'Soolife\Cms\Mobile\Module',
				'path' => ROOT_PATH.'/apps/section/mobile/Module.php')
			)
		);

		$content =  $this -> handle() -> getContent();

		if ($compress) $content = $this->compress_html($content);

		return $content;
	}

	/**
	 * 压缩输出
	 */
	function compress_html($input) {
		return ltrim(rtrim(preg_replace(array("/> *([^ ]*) *</", "/<!--[^!]*-->/", "'/\*[^*]*\*/'", "/\r\n/", "/\n/", "/\t/", '/>[ ]+</'), array(">\\1<", '', '', '', '', '', '><'), $input)));
	}
}