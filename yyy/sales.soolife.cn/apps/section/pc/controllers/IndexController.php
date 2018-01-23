<?php
// +----------------------------------------------------------------------
// | 会员中心首页控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// |
// | Author: Gao Qi
// | Created:   2016-07-20
// +--------------------------      --------------------------------------------
namespace Soolife\Sales\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Models\IndexModel;


class IndexController extends BaseController {

	/**
	 *
	 */
	public function indexAction()
	{

        $n = new IndexModel();
        $id = 'NTU1NTU=';
        $data = $n->Getname($id);
        $this -> page -> init("电脑");
        $this->assign("S_Pcms",$data['S_Pcms']);
        return $this -> display("cms/pc/index");
	}

	/**
	 * 活动专题页
	 *  @link /activity/{id}.html
	 */
	public function activityAction($id)
	{
        $n = new IndexModel();
        //取缓存
        $key="cms:p:".$id;
        $contents = $this->redis->read($key,"other");
        if(!empty($contents)) {
            $this->assign("S_Pcms",$contents);
            $name  = $n->GetcmsName($id);
            $this->page->init("{$name['S_Name']}");
            return $this->display("cms/pc/index");
        }
        $data = $n->Getname($id);
        if (isset($data) && !empty($data['S_Pcms']) && $data!="NODATA")
        {
            if (file_exists(ROOT_PATH . "/theme/activity/{$data['path']}/pc/index.phtml")) {
                $this->page->init("{$data['name']}");
                // print_r("activity/{$data['path']/mobile/index}");
                return $this->display("activity/{$data['path']}/pc/index");
            }
                $this->assign("S_Pcms",$data['S_Pcms']);
                $this->page->init("{$data['name']}");
                return $this->display("cms/pc/index");
        }

        $this -> page -> init("活动未找到!");
        return $this -> display('layouts/404');
    }

    /**
     * 新的专题活动页面
     * @return 数组
     * @param $id
     * @author Dandan_Sun
     * @date 2017-07-11 11:59:00
     */
    public function newactivityAction($id) {
        $n = new IndexModel();
        $data = $n->GetactivityDetails($type = 'pc', $id);
        if (isset($data) && !empty($data) && $data != "NODATA") {
            $this->page->init("{$data['name']}");
            $this->assign("url",$this->config->url->url_goods);
            $this->assign("data",$data);
            return $this->display("subject/pc_activity");
        }else{
            $this->page->init("活动未找到!");
            return $this->display('layouts/404');
        }
    }

    /**
     * 404
     */

    public function notFoundAction()
    {
        $this -> page -> init("资源没有找到！");
        $this -> display('layouts/404');
    }

}