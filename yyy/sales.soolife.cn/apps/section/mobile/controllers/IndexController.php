<?php

// +----------------------------------------------------------------------
// | PC版 会员中心的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Gao Qi
// | Created:   2016-07-23
// +----------------------------------------------------------------------

namespace Soolife\Sales\Mobile\Controllers;

use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Models\IndexModel;

class IndexController extends BaseController {

    /**
     * 首页
     * @author Gao Qi 2016-07-12
     *
     * @return partial view
     */
    public function indexAction() {
        //$comm = new\Soolife\Member\Librarys\Common();
        $n = new IndexModel();
        $id = 'OTk4MQ==';
        $data = $n->Getname($id);
        //var_dump($data['S_Mcms']);exit;
        $this->assign("S_Mcms",$data['S_Mcms']);
        $this -> page -> init("手机");
        return  $this -> display("cms/mobile/index");
    }

    /**
     *
     * 活动专题夜
     * @link m/activity/{id}.html
     */
    public function activityAction($id)
    {
         /* if (file_exists(ROOT_PATH . "/theme/activity/{$data['path']}/mobile/index.phtml")) */
        $n = new IndexModel();
        //取缓存
        $key="cms:m:".$id;
        $contents = $this->redis->read($key,"other");
        if(!empty($contents)) {
            $this->assign("S_Mcms",$contents);
            $name  = $n->GetcmsName($id);
            $this->page->init("{$name['S_Name']}",'','','mobile');
            return $this->display("cms/mobile/index");
        }
        $data = $n->Getname($id);
        if (isset($data) && $data!="NODATA")
        {
            if (file_exists(ROOT_PATH . "/theme/activity/{$data['path']}/mobile/index.phtml")) {
                $this->page->init("{$data['name']}",'','','mobile');
                // print_r("activity/{$data['path']/mobile/index}");
                return $this->display("activity/{$data['path']}/mobile/index");
            }
            if (!empty($data['S_Mcms'])) {
                $this->assign("S_Mcms",$data['S_Mcms']);
                $this->page->init("{$data['name']}",'','','mobile');
                return $this->display("cms/mobile/index");
            } else {
                $this -> page -> init("活动未找到!");
                return $this -> display('layouts/404');
            }
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
        $data = $n->GetactivityDetails($type = 'mobile', $id);
       // echo '<pre>';
       // print_r($data);
       // exit;
        if (isset($data) && !empty($data) && $data != "NODATA") {
            $this->page->init("{$data['name']}");
            $this->assign("url",$this->config->url->url_goods);
            $this->assign("data",$data);
            return $this->display("subject/mobileactivity");
        }
        $this->page->init("活动未找到!");
        return $this->display('layouts/mnotfound');
    }

    /**
     * http:404
     */
    public function notFindAction() {
        $this->page->init("没有找到资源!");
        return $this->display("layouts/mnotfound");
    }

}
