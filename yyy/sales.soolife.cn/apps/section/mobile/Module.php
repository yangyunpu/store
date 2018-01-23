<?php
// +----------------------------------------------------------------------
// | 手机版网页模块配置页面
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Module.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-05-04
// +----------------------------------------------------------------------
namespace Soolife\Sales\Mobile;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;

class Module
{
	/**
	 * 注册自动加载类目录
	 * @author tony wang 2016-05-04
	 * @return void
	 */
	public function registerAutoloaders()
	{
		$loader = new Loader();
		$loader->registerNamespaces(array(
			'Soolife\Sales\Mobile\Controllers' => ROOT_PATH.'/apps/section/mobile/controllers/'
		));
		$loader -> registerDirs(array(
			ROOT_PATH.'/apps/section/mobile/controllers/'
		));
		$loader->register();
	}
	
	/**
	 * 注册服务类
	 * @author tony wang  2016-05-04
	 * @return void 
	 */
	public function registerServices(DiInterface $di)
	{
		$di->set('dispatcher', function() {
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace("Soolife\Sales\Mobile\Controllers\\");
			return $dispatcher;
		});
		// 基本路径
		$di -> set('url',function(){
			$url = new \Phalcon\Mvc\Url();
			$url -> setBaseUri("/m/");
			return $url;
		});
		// 视图
		$di->set('view', function() {
			$view = new \Phalcon\Mvc\View();
			//$view->setViewsDir(ROOT_PATH.'/theme/activity/{$id}/m/views/');
			$view->setViewsDir(ROOT_PATH.'/theme/');
           		$view->setLayoutsDir('layouts_mobile/');
			$view->registerEngines(array(
            	'.phtml' => function ($view , $di) {
            		$config = $di->getConfig();
            		$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
            		$voltOptions = array(
            			'compiledPath'      => $config->application->run_volt ,
            			'compiledSeparator' => '_',
					);
					if ('1' == $config->application->debug) {
						$voltOptions['compileAlways'] = true;
					}
					$volt->setOptions($voltOptions);
                        return $volt;
                    })
            );
			return $view;
		});
	}
}
