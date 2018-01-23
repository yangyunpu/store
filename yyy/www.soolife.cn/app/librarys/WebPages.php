<?php
// +----------------------------------------------------------------------
// | 页面类
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Pages.php
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
use Phalcon\Mvc\User\Component;

class WebPages extends Component {
	private $module = 'pc';
	/**
	 * 初始化页面
	 * @author Tony Wang 2016-05-09
	 * @param $title string 页面的title信息
	 * @param $nav string 页面的导航
	 * @param $section string 页面的选择节点
	 * @param $module string 模块名称
	 * @param $keywords string 页面的关键字
	 * @param $description string 页面的详细内容
	 * @param $layout string 布局文件
	 */
	public function init($title,$nav='',$hide=0,$module='pc',$keywords='',$description='',$layout='layout_main')
	{
		// 设置布局文件
		if (empty($layout))
		{
			$layout = 'layout_main';
		}
		$this -> view -> setLayout($layout);
		$this->page_url();
		$this->page_keywords($keywords);
		$this->page_description($description);
		$this->page_title($title);
		$this->page_assets();
		$this->assign('hide',$hide);
		$this->assign("nav",$nav);
	}
	private function page_assets()
	{
		$static = require_once(ROOT_PATH."/configs/inc_assets.php");
		$header = new \Phalcon\Assets\Collection();
		$footer = new \Phalcon\Assets\Collection();
		// 全局资源
		$g = $static['global'];
		if ($g) {
			$css = $g['css'];
			foreach ($css as $k => $v) {
				$header -> addCss($v['path']);
			}
			$js = $g['js'];
			foreach ($js as $k => $v) {
				$footer -> addJs($v['path']);
			}
		}
		$this -> assets -> set('header', $header);
		$this -> assets -> set('footer', $footer);
	}

	/**
	 * 定义页面上URL
	 * @author Tony Wang 2016-04-13
	 */
	public function page_url()
	{
		$this -> assign('debug',$this->get_config('debug'));
		$this -> assign("version", $this->get_config('js_css_version'));
		$urls = $this->config->url;
		foreach ($urls as $k=>$v)
		{
			$this -> assign("{$k}",$v);
		}
		$this -> assign("dns",$urls);   // dns 刷新
	}

	/**
	 * 页面上Header的关键词
	 * @author Tony Wang 2016-04-13
	 * @param $keywords string 关键词
	 */
	private function page_keywords($keywords)
	{
		if (empty($keywords))
		{
			$keywords = $this->get_config('keywords');
		}
		$this-> assign("keywords", $keywords);
	}

	/**
	 * 页面上Header的页面描述
	 * @author Tony Wang 2016-04-13
	 * @param $description string 页面描述
	 */
	private  function page_description($description)
	{
		if (empty($description))
		{
			$description = $this->get_config('description');
		}
		$this -> assign("description", $description);
	}

	/**
	 * 页面标题
	 * @author Tony Wang 2016-04-13
	 * @param $title string 页面标题
	 */
	private  function page_title($title)
	{
		$title = "{$title} | {$this->config->application->suffix}";
		$this -> assign("title", $title);
	}

	/**
	 * 设置视图变量
	 * @author Tony Wang
	 * @param $name string 变量名
	 * @param $value object 变量值
	 * @return void
	 */
	private function assign($name, $value = '')
	{
		$this-> view -> setVar($name, $value);
	}

	/**
	 * 读取配置
	 * @author Tony Wang
	 * @param $name string
	 * @return string
	 */
	public function get_config($name)
	{
		return $this->config->application->$name;
	}
}
