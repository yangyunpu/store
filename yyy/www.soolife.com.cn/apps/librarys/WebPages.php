<?php
// +----------------------------------------------------------------------
// | 页面类
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Pages.php
// |
// | Author:    Lrone
// | Created:   2017-01-10
// +----------------------------------------------------------------------
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\User\Component;

class WebPages extends Component {
	private $module = 'pc';
	/**
	 * 初始化页面
	 * @author Lrone 2017-02-10
	 * @param $title string 页面的title信息
	 * @param $nav string 页面的导航
	 * @param $section string 页面的选择节点
	 * @param $module string 模块名称
	 * @param $keywords string 页面的关键字
	 * @param $description string 页面的详细内容
	 * @param $layout string 布局文件
	 */
	public function init($title, $nav = '', $section = '', $module = 'pc', $keywords = '', $description = '', $layout = 'layout_main') {
		$this->module = $module;
		// 设置布局文件
		if (empty($layout)) {
			$layout = 'layout_main';
		}
		$this -> view -> setLayout($layout);

		$this -> page_url();
		$this -> page_keywords($keywords);
		$this -> page_description($description);
		$this -> page_title($title);
		$this -> page_nav($nav, $section);
		$this -> page_menus();
		$this -> page_member();
		if ($module == 'pc') {
			$this -> page_assets();
		}
		if($module == 'mobile'){
			$this -> page_assets();
		}
	}
	/**
	 * 设置面板上定位
	 */
	public function setBreadcrumbs($breadcrumbs = array()){
		if (is_array($breadcrumbs))
		{
			$this->breadcrumbs = $breadcrumbs;
		}
	}

	public function setContentTitle($title,$desc,$url)
	{
		$this -> assign("content_title", $title);
		$this -> assign("content_desc", $desc);
		$this -> assign("url", $url);
	}
	/**
	 * 菜单栏
	 */
	private function page_menus() {
		//动态获取
		$menus = include(ROOT_PATH."/configs/inc_menus.php");
		$this -> assign('menus', $menus);
	}

	/**
	 * 页面用户资料
	 * @author Tony Wang 2016-04-13
	 * @return void
	 */
	public function page_member() {
		$memberid = $this -> user -> getId();
		$nickname = $this -> user -> getNickname();
		$this -> assign("m_id", $memberid);
		$this -> assign("nickname", $nickname);
	}

	public function layout($layout) {
		if (empty($layout))
			return false;
		$this -> view -> setLayout($layout);
	}

	private function page_assets() {
		$static =
		require_once (ROOT_PATH . "/configs/inc_assets_{$this->module}.php");

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
	 * @author Lrone 2017-02-10
	 */
	public function page_url() {
		//版本编号
		$version = $this -> get_config('js_css_version');
		$this -> assign("version", base64_encode($version));

		$urls = $this -> config -> url;
		foreach ($urls as $k => $v) {
			$this -> assign("{$k}", $v);
		}
		$this -> assign("dns", $urls);
		// dns 刷新
	}

	/**
	 * 页面上Header的关键词
	 * @author Lrone 2017-02-10
	 * @param $keywords string 关键词
	 */
	private function page_keywords($keywords) {
		if (empty($keywords)) {
			$keywords = $this -> get_config('keywords');
		}
		$this -> assign("keywords", $keywords);
	}

	/**
	 * 页面上Header的页面描述
	 * @author Lrone 2017-02-10
	 * @param $description string 页面描述
	 */
	private function page_description($description) {
		if (empty($description)) {
			$description = $this -> get_config('description');
		}
		$this -> assign("description", $description);
	}

	/**
	 * 页面标题
	 * @author Lrone 2017-02-10
	 * @param $title string 页面标题
	 */
	private function page_title($title) {
		$title = "{$title} | {$this->config->application->suffix}";
		$this -> assign("title", $title);
	}

	/**
	 * 页面导航，定位到具体的页面
	 * @author Lrone 2017-02-10
	 * @param $nav string
	 * @return void
	 */
	public function page_nav($nav = '', $section = '') {
		$this -> assign("nav", $nav);

		if (empty($section))
			$section = '我的生活';

		$this -> assign("section", $section);
	}

	/**
	 * 设置视图变量
	 * @author Lrone 2017-02-10
	 * @param $name string 变量名
	 * @param $value object 变量值
	 * @return void
	 */
	private function assign($name, $value = '') {
		$this -> view -> setVar($name, $value);
	}

	/**
	 * 读取配置
	 * @author Lrone 2017-02-10
	 * @param $name string
	 * @return string
	 */
	private function get_config($name) {
		return $this -> config -> application -> $name;
	}

}
