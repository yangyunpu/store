<?php
// +----------------------------------------------------------------------
// | 配置文件 路由地址配置
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author:    Lorne
// | Created:   2017-02-10
// +----------------------------------------------------------------------
$routers = new Phalcon\Mvc\Router();
// CMS PC端
$routers -> add('/', array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'index'
));
$routers -> add('/index.html', array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'index'
));
$routers -> add('/about/index.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'index'
));

$routers -> add('/about/coreTeam.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'coreTeam'
));
$routers -> add('/about/enterpriseHonor.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'enterpriseHonor'
));
$routers -> add('/about/futureTendency.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'futureTendency'
));


$routers -> add('/about/companyProfile.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'companyProfile'
));
$routers -> add('/about/developmentHistory.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'developmentHistory'
));
$routers -> add('/about/makeSpeech.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'makeSpeech'
));
$routers -> add('/about/culture.html', array(
    'module' => 'pc',
    'controller' => 'about',
    'action' => 'culture'
));


//business
$routers -> add('/business/businessModel.html', array(
    'module' => 'pc',
    'controller' => 'business',
    'action' => 'businessModel'
));
$routers -> add('/business/experienceCenter.html', array(
    'module' => 'pc',
    'controller' => 'business',
    'action' => 'experienceCenter'
));
$routers -> add('/business/platformIntroduction.html', array(
    'module' => 'pc',
    'controller' => 'business',
    'action' => 'platformIntroduction'
));
//partner
$routers -> add('/partner/cityagent.html', array(
    'module' => 'pc',
    'controller' => 'partner',
    'action' => 'cityagent'
));
$routers -> add('/partner/invest.html', array(
    'module' => 'pc',
    'controller' => 'partner',
    'action' => 'invest'
));
$routers -> add('/partner/tenants.html', array(
    'module' => 'pc',
    'controller' => 'partner',
    'action' => 'tenants'
));

$routers -> add('/partner/newcityagent.html', array(
    'module' => 'pc',
    'controller' => 'partner',
    'action' => 'newcityagent'
));
$routers -> add('/partner/brandinvestment.html', array(
    'module' => 'pc',
    'controller' => 'partner',
    'action' => 'brandinvestment'
));
$routers -> add('/partner/experience.html', array(
    'module' => 'pc',
    'controller' => 'partner',
    'action' => 'experience'
));


//report
$routers -> add('/report/brandActivity.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'brandActivity'
));
$routers -> add('/report/mediaInterviews.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'mediaInterviews'
));
$routers -> add('/report/news.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'news'
));
$routers -> add('/report/newsspin.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsspin'
));
$routers -> add('/report/newscar.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newscar'
));
$routers -> add('/report/newsfirst.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsfirst'
));
$routers -> add('/report/newsvisit.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsvisit'
));
$routers -> add('/report/newsthailand.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsthailand'
));
$routers -> add('/report/videoCoverage.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'videoCoverage'
));

$routers -> add('/report/newsIeather.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsIeather'
));
$routers -> add('/report/newsCommerce.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsCommerce'
));
$routers -> add('/report/newsGlory.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'newsGlory'
));
$routers -> add('/report/leadervisit.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'leadervisit'
));

$routers -> add('/report/experience.html', array(
    'module' => 'pc',
    'controller' => 'report',
    'action' => 'experience'
));



//contactUs
$routers -> add('/contactUs/contactInformation.html', array(
    'module' => 'pc',
    'controller' => 'contactus',
    'action' => 'contactInformation'
));
//sop 首页
$routers -> add('/sop/index.html', array(
    'module' => 'pc',
    'controller' => 'sop',
    'action' => 'index'
));
//sop 资料修改页
$routers -> add('/sop/edit.html', array(
    'module' => 'pc',
    'controller' => 'sop',
    'action' => 'dataedit'
));
// sop 登录页
$routers -> add('/sop/login.html', array(
    'module' => 'pc',
    'controller' => 'login',
    'action' => 'login'
));
//协议页(线上渠道)
$routers -> add('/sop/protocols.html', array(
    'module' => 'pc',
    'controller' => 'sop',
    'action' => 'protocols'
));
//协议页(全渠道)
$routers -> add('/sop/protocolsall.html', array(
    'module' => 'pc',
    'controller' => 'sop',
    'action' => 'protocolsall'
));
//商家审核状态
$routers -> add('/sop/shopstatus.html', array(
    'module' => 'pc',
    'controller' => 'sop',
    'action' => 'shopstatus'
));
// sop 注册页
$routers -> add('/sop/register.html', array(
    'module' => 'pc',
    'controller' => 'login',
    'action' => 'register'
));
// sop 注册页协议
$routers -> add('/sop/agreement.html', array(
    'module' => 'pc',
    'controller' => 'login',
    'action' => 'agreement'
));
//第三方登录
$routers->add('/login/thirdlogin/{type}',array(
    'module' => 'pc',
    'controller' => 'login',
    'action' => 'thirdlogin'
));
//退出登录
$routers->add('/logout.html',array(
    'module' => 'pc',
    'controller' => 'login',
    'action' => 'logout'
));

////////////////////////////////////////////////////////////////////////////////
//dynamic
$routers -> add('/dynamic/dynamic.html', array(
    'module' => 'pc',
    'controller' => 'dynamic',
    'action' => 'dynamic'
));

//CMS 手机端/////////////////////////////////////////////////////
$routers->add('/m/index.html',array(
    'module' => 'mobile',
    'controller' => 'index',
    'action' => 'index',
));


//////////////////////////////////////////////////////////////////////////////////

// NOT FOUND 路由器
$routers -> notFound(array(
    'module' => 'pc',
    "controller" => 'index',
    "action" => 'notFound'
));
// 默认路由器
$routers -> setDefaults(array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'index'
));
return $routers;
