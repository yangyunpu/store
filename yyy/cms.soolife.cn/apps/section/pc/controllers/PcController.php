<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------

namespace Soolife\Cms\Pc\Controllers;
use Soolife\Cms\Librarys\BaseController;
use Soolife\Cms\Librarys\Common;
use Soolife\Cms\Librarys\WebRedis;

use Soolife\Cms\Services\MobileService;
use Soolife\Cms\Services\PcService;
header('Content-Type: text/html; charset=utf-8');

class PcController extends BaseController
{   
    private $db_identifier = 'other';

	/*
    *初始化cms
    */
	public function indexAction()
    {
        if($this-> request ->isGet()){
            $modulePanelBg = '';

            $modulePanelBg.='<div class="mobiContant">';
            $modulePanelBg.=    '<div class="midContant">';
            $modulePanelBg.=        '<div class="pcContant"></div>';
            $modulePanelBg.=        '<div class="sideContant module module_666" style="display: none"></div>';
            $modulePanelBg.=    '</div>';
            $modulePanelBg.='</div>';

            $S_Code  = $this->request->get('S_Code');
  
                $service = new PcService();
                
                $result  = $service ->IsCms($S_Code);//判断是否有该活动
                //如果有该活动，判断是否存在pc版的cms
                if($result) {
                    $presult = $service ->GetPcms($S_Code);
                    //pc cms存在
                    if(!empty($presult['S_Pcms'])) {
                        $contents = $presult['S_Pcms'];
                        $this->assign('contents',$contents);
                        $this->assign('S_Code',$S_Code);
                        //pc cms不存在
                    }else {
                        $contents = $modulePanelBg;
                        $this->assign('contents',$contents);
                        $this->assign('S_Code',$S_Code);
                    }
                    //活动不存在
                }else {
                        $contents = $modulePanelBg;
                        $this->assign('contents',$contents);
                        $this->assign('S_Code',$S_Code);
                }
           /* }*/
            $this->assign('url_cms', $this->config->url->url_cms);
            $this->page->init('首页','','','pc');
        }
        //上传图片
    	if($this->request->hasFiles()){
            try {
                $files  = $this->request->getUploadedFiles();
                $data = $this->request->getPost();
                // echo "<pre>";print_r($data);exit;
                $upload = $this -> config -> upload;
                $all_pic = array();
                foreach ($files as $file) {
                    if($file -> isUploadedFile()){
                        $type = $file -> getRealType();
                        $size = $file -> getSize();
                        $ext  = $file -> getExtension();
                        $tname = $file -> getTempName();
                        $da   = date('Ymd', time());
                        $path = ROOT_PATH . "{$upload->rootPath}pcImg";

                        Common::create_file_dir($path);
                        $identify = uniqid($upload -> prefix, TRUE) . ".{$ext}";
                        $img_url = $upload->rootPath.'pcImg/'.$identify;
                        $filename = $path . '/' . $identify ;

                        $pic = array();
                        $pic['img_url'] ='http://cms.soolife.loc'.$img_url;
                        $pic['identify'] = $identify;
                        $pic['pic'] = md5_file($tname);
                        $pic['file_type'] = $type;
                        $tf = fopen($tname, 'r');
                        $pic['content'] = fread($tf, filesize($tname));
                        fclose($tf);

                        if (!in_array(strtolower($type), $upload -> mimes -> toArray()))
                            throw new Exception("文件类型[{$type}]不支持上传！");
                        if ($size > $upload -> maxSize)
                            throw new Exception('文件大小超出！');
                        $file -> moveTo($filename);
                        $all_pic[] = $pic; 
                    }else{
                        throw new Exception('请通过正常途径上传图片',100);
                    }
                }
                if ($all_pic) {
                    foreach ($all_pic as $key => &$value) {
                        if(isset($data['sku_id']) && !empty($data['sku_id'])){
                            $value['sku_id'] = $data['sku_id'][$key];
                        }else{
                            $value['sku_id'] = '';
                        }
                        if(isset($data['pic_target']) && !empty($data['pic_target'])){
                            $value['pic_target'] = $data['pic_target'][$key];
                        }else{
                            $value['pic_target'] = '';
                        }
                        if(isset($data['pic_link']) && !empty($data['pic_link'])){
                            $value['pic_link'] = $data['pic_link'][$key];
                        }else{
                            $value['pic_link'] = '';
                        }
                        if(isset($data['floor_id']) && !empty($data['floor_id'])){
                            $value['floor_id'] = $data['floor_id'][$key];
                        }else{
                            $value['floor_id'] = '';
                        }
                    }
                // echo "<pre>";
                // print_r($all_pic);
                // exit;
                    
                    $model = new PcService();
                    $data = $model->index($all_pic);
                    return $this->success('上传成功！',$data);
                }
                $this -> failure("操作失败，原因：{$e->getMessage()} 文件：{$e->getFile()} 行：{$e->getLine()}");
            } catch (Exception $e) {
                $this -> failure("操作失败，原因：{$e->getMessage()} 文件：{$e->getFile()} 行：{$e->getLine()}");
            }
        }
    }
    /*
    *检查商品sku
    */
    public function checkskuAction()
    {
        $sku_id = $this->request->getPost('sku_id');
        $model = new PcService();
        $data = $model->checkSku($sku_id);
        if(!empty($data)){
            return $this->success('success',$data);
        }else{
            return $this->success('skuId输入有误!请核对!',$data);
        }
       // echo "<pre>";print_r($data);die;
    }
    /*
    *检查店铺ID
    */
    public function checkstoreAction()
    {
        $store_id = $this->request->get('store_id');
        $model = new PcService();
        $data = $model->CheckStore($store_id);
        //var_dump($data);exit;
        if(!empty($data)){
            return $this->success('success',$data);
        }else{
            return $this->failure('store Id输入有误!请核对!');
        }
       // echo "<pre>";print_r($data);die;
    }
    /*
    *检查专题活动--活动代码
    */
    public function checkactivityAction()
    {
        $activity_code = $this->request->getPost('activity_code');
        $model = new PcService();
        $data = $model->CheckActivity($activity_code);
        if($data){
            return $this->success('success');
        }else{
            return $this->failure('专题活动代码输入有误!请核对!');
        }
    }
    /*
    *预览
    */
    public function scanAction()
    {
        if(!empty($this->request->get('S_Code'))) {
            //echo 'dsffgfgfdfdgfd';exit;
            $S_Code = $this->request->get('S_Code');
            //var_dump($S_Code);die();
            $service = new PcService();
            $result  = $service ->IsCms($S_Code);
            $presult = '';
            if($result){
              $presult = $service ->GetPcms($S_Code);  
              $this->assign('S_Code',$S_Code);
              $this->assign('presult',$presult['S_Pcms']);
              //var_dump($mresult['S_Mcms']);exit;
            }else {
                //echo '不存在';exit;
                $modulePanelBg = '';
                $modulePanelBg.='<div class="mobiContant">';
                $modulePanelBg.='<div id="module_more" class="module module_1101">';
                $modulePanelBg.='<div class="modulePanelBg">';
                $modulePanelBg.='<button data-toggle="modal"  data-target="#modalEdit" class="edit_module btn btn-primary btn-xs ">编辑模块</button>';
                $modulePanelBg.='<button data-toggle="modal" data-target="#setStyle"  class="set_module btn btn-primary btn-xs ">设置样式</button>';
                $modulePanelBg.='<div class="moduleBtn action-buttons">';
                $modulePanelBg.='<span class="module_del"><a><i class="fa fa-times" aria-hidden="true"></i></a></span>';
                $modulePanelBg.='<span class="module_up"><a><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span>';
                $modulePanelBg.='<span class="module_down"><a><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a></span>';
                $modulePanelBg.='</div>';
                $modulePanelBg.='</div>';
                $modulePanelBg.='<div class="swiper-container modulePanel" data-id="mainIcon-more">';
                $modulePanelBg.='<div class="swiper-wrapper">';
                $modulePanelBg.='</div>';
                $modulePanelBg.='<div class="pagination"></div>';
                $modulePanelBg.='</div>';
                $modulePanelBg.='</div>';
                $modulePanelBg.='<div class="midContant">';
                $modulePanelBg.='<div class="pcContant">';
                $modulePanelBg.='</div>';
                $modulePanelBg.='<div class="sideContant module module_666" style="display: none">';
                $modulePanelBg.='</div>';
                $modulePanelBg.='</div>';
                $modulePanelBg.='</div>';
                $this->assign('S_Code',$S_Code);
                $this->assign('presult',$modulePanelBg);
            }

        }

        $this->page->init('测试活动页','','','pc');
    }

    /**
    * 保存整个页面
    * @return 0 保存成功 1失败
    * @param img
    * @author chaoqun_liu
    * @date 2017-07-03 14:24:45
    */
    public function saveAction()
    {
        $save_AllData = $this->request->getPost("save_AllData");
        $code  = $this->request->get('S_Code');
        $value_cms = $this->request->getPost("value_cms");
        $model = new PcService();
        $result = $model->IsCms($code);
        if($result) {
            $data = $model->UpdateCms($code,$save_AllData);
            //$P_Code  =md5($code);
            $key="cms:p:".$value_cms;
            $redis = new WebRedis();
            $redis->write_simple($key,$save_AllData,$this->db_identifier);
            return $this->success("修改成功！");
        }else {
            $data = $model->SaveCms($code,$save_AllData);
            //$P_Code  =md5($code);
            $key="cms:p:".$value_cms;
            $redis = new WebRedis();
            $redis->write_simple($key,$save_AllData,$this->db_identifier);
            return $this->success("保存成功！");
        }
    }
    /**
    * 获取商品信息
    * @author chaoqun_liu
    * @date 2017-07-03 14:24:45
    */ 
    public function getgoodsAction()
    {
        $data = $this->request->getPost('sku_id');
        $goods= array();
        foreach($data as $k=>$v)
        {
            $model = new PcService();
            $content = $model->checkSku($v['sku_id']);
           if(!empty($content))
            {
                if($v['pic']!=""){
                    $goods[$k] = $content;
                    $goods[$k]['S_Logo'] = $v['pic'];
                }else{
                    $goods[$k] = $content;
                }
                if($v['S_Link']!=""){
                    $goods[$k]['S_Link'] = $v['S_Link'];
                }else{
                    $goods[$k]['S_Link'] = '';
                }
            }
        }
        if(!empty($goods)){
            return $this->success('success',$goods);
        }else{
            return $this->success('skuId输入有误!请核对!',$goods);
        }
    }
   /**
    * 获取店铺信息
    * @return json
    * @author chaoqun_liu
    * @date 2017-07-03 14:24:45
    */
     public function getstoreAction()
     {
        $store_id = $this->request->getPost('store_id');
        $store= array();
        try {
        $model = new PcService();
        $data = $model->CheckStore($store_id);
        if(!empty($data)){
            return $this->success('success',$data);
        }else{
            return $this->failure('store Id输入有误!请核对!',$data);
        }
        } catch (Exception $e) {
            return $this ->failure($e -> getMessage(), $e -> getCode());
        }


     }
    /**
     * 判断sku为商品或者为商店或者为专题活动
     * @return json
     * @author chaoqun_liu
     * @date 2017-07-03 14:24:45
     */
    public function checkcodeAction()
    {
        $code = $this->request->getPost('code');
        $model = new PcService();
        $data = $model->CheckCode($code);
        return $this->success('success',$data);

    }


}