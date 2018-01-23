<?php
// +----------------------------------------------------------------------
// | test
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-03-17
// +----------------------------------------------------------------------
namespace Soolife\Cms\Mobile\Controllers;
use Soolife\Cms\Librarys\BaseController;
use Soolife\Cms\Services\MobileService;
use Soolife\Cms\Librarys\Common;
use Soolife\Cms\Librarys\WebRedis;

header('Content-Type: text/html; charset=utf-8');

//首页
class MobileController extends BaseController
{   //私有变量指定Redis数据库名
    private $db_identifier = "other";

    /**
     * 获取活动
     * @author liuchaoqun 2016-07-18
     * @link /mobile/index.html
     * @return view
     */
	public function indexAction()
    {
        if($this-> request ->isGet()){
            $modulePanelBg = '';
            $modulePanelBg.='<div class="mobiContant"></div>';
            $modulePanelBg.='';
            //获取标识
            $S_Code  = $this->request->get('S_Code');
            //查询Redis
            /*$M_Code  =md5($S_Code);
            $key="cms:m:".$M_Code;
            $contents = $this->redis->read($key,"other");
            //var_dump($contents);exit;
            if(!empty($contents)) {
                $this->assign('contents',$contents);
                $this->assign('S_Code',$S_Code);
            }else {*/
                $service = new MobileService();
                //判断是否有该活动
                $result  = $service ->IsCms($S_Code);
                //如果有该活动，判断是否存在手机版的cms
                if($result) {
                    $mresult = $service ->GetMcms($S_Code);
                    //手机cms存在
                    if(!empty($mresult['S_Mcms'])) {
                        $contents = $mresult['S_Mcms'];
                        $this->assign('contents',$contents);
                        $this->assign('S_Code',$S_Code);
                        //手机cms不存在
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
            //var_dump($contents);exit;
           $this->assign('url_cms', $this->config->url->url_cms);
           $this->page->init('首页','','','mobile');
        }
        //上传图片
    	if($this->request->hasFiles()){
            try {
                $files  = $this->request->getUploadedFiles();
                $data = $this->request->getPost();

                
                $upload = $this -> config -> upload;
                $all_pic = array();
                foreach ($files as $file) {
                    if($file -> isUploadedFile()){
                        $type = $file -> getRealType();
                        $size = $file -> getSize();
                        $ext  = $file -> getExtension();
                        $tname = $file -> getTempName();
                        $da   = date('Ymd', time());
                        $path = ROOT_PATH . "{$upload->rootPath}mobiImg";

                        Common::create_file_dir($path);
                        $identify = uniqid($upload -> prefix, TRUE) . ".{$ext}";
                        $img_url = $upload->rootPath.'mobiImg/'.$identify;
                        $filename = $path . '/' . $identify ;

                        $pic = array();
                        $pic['img_url'] = 'http://cms.soolife.loc'.$img_url;
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
                    }
                    $model = new MobileService();
                    $data = $model->index($all_pic);
                    return $this->success('上传成功！',$data);
                }
                $this -> failure("操作失败，原因：{$e->getMessage()} 文件：{$e->getFile()} 行：{$e->getLine()}");
            } catch (Exception $e) {
                $this -> failure("操作失败，原因：{$e->getMessage()} 文件：{$e->getFile()} 行：{$e->getLine()}");
            }
        }
	}
    /**
     * 检查商品的sku
     * @author liuchaouqn 2017-07-18
     * @link /mobile/checksku.html
     * @return json
     */
    public function checkskuAction()
    {
        $sku_id = $this->request->getPost('sku_id');
        $model = new MobileService();
        $data = $model->checkSku($sku_id);
        if(!empty($data)){
            return $this->success('success',$data);
        }else{
            return $this->success('skuId输入有误!请核对!',$data);
        }
        //echo "<pre>";print_r($data);die;
    }



    public function scanAction()
    {   
        if(!empty($this->request->get('S_Code'))) {
            //echo 'dsffgfgfdfdgfd';exit;
            $S_Code = $this->request->get('S_Code');
            //var_dump($S_Code);die();
            $service = new MobileService();
            $result  = $service ->IsCms($S_Code);
            $mresult = '';
            if($result){
              $mresult = $service ->GetMcms($S_Code);  
              $this->assign('S_Code',$S_Code);
              $this->assign('mresult',$mresult['S_Mcms']);
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
                $modulePanelBg.='</div>';
                $modulePanelBg.='';
                $this->assign('S_Code',$S_Code);
                $this->assign('mresult',$modulePanelBg);
            }

        }

        $this->page->init('测试活动页','','','mobile');
    }

    /**
    * 保存整个页面
    * @return 0 保存成功 1失败
    * @param img
    * @author Dandan_Sun
    * @date 2017-07-03 14:24:45
    */
/*    public function saveAction(){
        $save_AllData = $this->request->getPost();
        print_r($save_AllData);exit;
        $keys = "cms:20170703";
        $redis = new WebRedis();
        $redis->write($keys,$_POST,$this->db_identifier);
        return $this->success("保存成功！");
    }
*/
    public function saveAction()
    {
    $save_AllData = $this->request->getPost("save_AllData");
    $code  = $this->request->get('S_Code');
    $value_cms = $this->request->getPost("value_cms");
    $model = new MobileService();
    $result = $model->IsCms($code);
    if($result) {
        $data = $model->UpdateCms($code,$save_AllData);
        //$M_Code  =md5($code);
        $key="cms:m:".$value_cms;
        $redis = new WebRedis();
        $redis->write_simple($key,$save_AllData,$this->db_identifier);
        return $this->success("修改成功！");
    }else {
        $data = $model->SaveCms($code,$save_AllData);
        //$M_Code  =md5($code);
        $key="cms:m:".$value_cms;
        $redis = new WebRedis();
        $redis->write_simple($key,$save_AllData,$this->db_identifier);
        return $this->success("保存成功！");
    }
    }
   	public function mobimoduleAction()
    {
       	$this->page->init('首页','','','mobile');

   	}


    public function getgoodsAction()
    {
        $data = $this->request->getPost('sku_id');
        $goods= array();

        foreach($data as $k=>$v)
        {
            $model = new MobileService();
            $content = $model->checkSku($v['sku_id']);
           if(!empty($content))
            {
                if($v['pic']!=""){
                    $goods[$k] = $content;
                    $goods[$k]['S_Logo'] = $v['pic'];
                }else{
                    $goods[$k] = $content;
                }
            }
        }
        if(!empty($goods)){
            return $this->success('success',$goods);
        }else{
            return $this->success('skuId输入有误!请核对!',$goods);
        }
    }



}


