<?php
// +----------------------------------------------------------------------
// | PC版网页模块配置页面
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Module.php
// |
// | Author:    Elliot
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;

class Module
{
	/**
	 * 注册自动加载类目录
	 * @author Elliot 2017-02-15
	 * @return void
	 */
	public function registerAutoloaders()
	{
		$loader = new Loader();
		$loader->registerNamespaces(array(
			'\Soolife\Member\Pc\Controllers' => '../apps/pc/controllers/',
			'\Soolife\Member\Pc\Models'      => '../apps/pc/models/'
		));
		$loader->register();
	}

	/**
	 * 注册服务类
	 * @author Elliot 2017-02-15
	 * @return void
	 */
	public function registerServices(DiInterface $di)
	{
		$di->set('dispatcher', function() {
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace("\Soolife\Member\Pc\Controllers\\");
			return $dispatcher;
		});

		$config = $di['config'];
		$config_pc = new \Phalcon\Config(require_once(ROOT_PATH . '/configs/inc_pc_config.php'));
		$config->merge($config_pc);

		// 基本路径
		$di -> set('url',function(){
			$url = new \Phalcon\Mvc\Url();
			$url -> setBaseUri("/");
			return $url;
		});
		$di->set('view', function() {
			$view = new \Phalcon\Mvc\View();
			$view->setViewsDir(ROOT_PATH.'/apps/pc/views/');
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
