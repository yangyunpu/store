<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: <zhichao_hu>
// | Created:   2017-04-06
// +----------------------------------------------------------------------
header("Content-Type: text/html; charset=utf-8");

class StarmodelController extends BaseController
{
    public function starmodelAction()
    {

        $model = new StarmodelService();
        $data = $model->starModel();
        $this->assign("data",$data);

        $star = $model -> themeModel();

        $this->assign("star",$star);

        $clothcode = $model -> clothCode();
        $this->assign("clothcode",$clothcode);


        if(!empty($clothcode)){
            $arr = array(
                  "categories"=> $clothcode[0]['code'],
                  "skip"=> 0,
                  "take"=> 10
            );
            $cloth = $model -> clothModel($arr);
        }else{
            $cloth = array();
        }
        $this->assign("cloth",$cloth);


        $this->pages->init('星范儿');

    }
    public function clothAction(){
        $code = $this->request->getPost('code');
        $arr = array(
              "categories"=> $code,
              "skip"=> 0,
              "take"=> 10
        );

        $model = new StarmodelService();
        $clothitem = $model -> clothModel($arr);
        $this->success("success",$clothitem);

    }

    /**
    * 加载数据
    * @return array
    * @param
    * @author Dandan_Sun
    * @date 2017-06-15 12:55:51
    */
    public function categoriesAction(){
        $categories = $this->request->getPost();
        $categories['hidden'] = intval($categories['hidden']);
        $arr = array(
              "categories"=> $categories['code'],
              "skip"=> $categories['hidden']+10,
              "take"=> 10
        );

        $model = new StarmodelService();
        $clothitem = $model -> clothModel($arr);
        if(empty($clothitem['categories'])){
            $this->failure("false");
        }else{
            $this->success("success",$clothitem);
        }
    }

}