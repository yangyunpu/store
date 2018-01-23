<?php
// +----------------------------------------------------------------------
// | 配置文件 路由地址配置
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-06-21
// +----------------------------------------------------------------------
$routers = new Phalcon\Mvc\Router();

// 电脑版路由 ////////////////////////////////////////////////////////////////////////////////
$routers -> add('/receive.html', array(
    'module' => 'pc',
    'controller' => 'receive',
    'action' => 'receive'
));

$routers -> add('/activity/{id}.html', array(
	'module' => 'pc',
    'controller' => 'index',
    'action' => 'activity'
));
//************测试的路由
$routers -> add('/activity/123.html', array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'test'
));
$routers -> add('/activity/mcms.html', array(
		'module' => 'mobile',
		'controller' => 'index',
		'action' => 'index'
));
$routers -> add('/activity/pcms.html', array(
		'module' => 'pc',
		'controller' => 'index',
		'action' => 'index'
));
//************测试的路由结束

$routers -> add('/notFind.html', array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'notFind'
));
$routers -> add('/theme/activity/{id}.html', array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'receive'
));

// 手机版路由 ////////////////////////////////////////////////////////////////////////////////
$routers -> add('/receive.html', array(
    'module' => 'mobile',
    'controller' => 'receive',
    'action' => 'receive'
));

$routers -> add('/m/activity/{id}.html', array(
	'module' => 'mobile',
    'controller' => 'index',
    'action' => 'activity'
));
$routers -> add('/theme/activity/notFind.html', array(
    'module' => 'mobile',
    'controller' => 'index',
    'action' => 'notFind'
));
//招商
$routers -> add('/m/business/index.html', array(
    'module' => 'mobile',
    'controller' => 'business',
    'action' => 'index'
));
$routers -> add('/m/business/region.html', array(
    'module' => 'mobile',
    'controller' => 'business',
    'action' => 'region'
));
$routers -> add('/m/business/submite/content.html', array(
    'module' => 'mobile',
    'controller' => 'business',
    'action' => 'submiteContent'
));
// ///////////////////////////专题活动页前台页面////////////////
$routers -> add('/m/subject/mobileactivity.html', array(
    'module' => 'mobile',
    'controller' => 'subject',
    'action' => 'mobileactivity'
));
$routers -> add('/m/subject/pc_activity.html', array(
    'module' => 'mobile',
    'controller' => 'subject',
    'action' => 'pc_activity'
));

//新增活动页////////////////////////////////////////////////////////////////////////////////////////////////////
//新增专题活动页面 m web端
$routers -> add('/m/newactivity/{id}.html', array(
    'module' => 'mobile',
    'controller' => 'index',
    'action' => 'newactivity'
));
//新增专题活动页面 PC web端
$routers -> add('/newactivity/{id}.html', array(
    'module' => 'pc',
    'controller' => 'index',
    'action' => 'newactivity'
));

//星集结//////////////////////////////////////////////////////////////////////////////
//星集结
// $routers -> add('/m/lucky/indexs.html', array(
//     'module' => 'mobile',
//     'controller' => 'lucky',
//     'action' => 'indexs'
// ));
$routers -> add('/m/lucky/one.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'one'
));
$routers -> add('/m/lucky/two.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'two'
));
$routers -> add('/m/lucky/three.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'three'
));
$routers -> add('/m/lucky/index.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'index'
));
//抽奖名单
$routers -> add('/m/lucky/list.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'list'
));
//加入购物车
$routers -> add('/m/lucky/addSuiteCart.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'addSuiteCart'
));
//判断套餐状态
$routers -> add('/m/lucky/judgePromo.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'judgePromo'
));
//往期活动列表
$routers -> add('/m/lucky/past.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'pastActivitiesList'
));
//往期活动详情
$routers -> add('/m/lucky/past/{id:[0-9]+}.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'pastActivities'
));
//静态获奖页面列表
$routers -> add('/m/lucky/starold.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'starold'
));
//套餐详情
$routers -> add('/m/lucky/promo/{id:[0-9]+}/{lucky:[0-9]+}.html', array(
    'module' => 'mobile',
    'controller' => 'lucky',
    'action' => 'promoDetails'
));

/////品牌招商广告页///////////////////////////////////////////////////////////////////////////////////////////////////////

//招商广告页面
$routers -> add('/investment/index.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'index'
));
//体验店加盟
$routers -> add('/investment/brand.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'brand'
));
//品牌招商
$routers -> add('/investment/league.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'league'
));

//加盟推广
$routers -> add('/investment/generalize.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'generalize'
));

//城市代理政策
$routers -> add('/investment/policy.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'policy'
));

//邀您共谋大事
$routers -> add('/investment/invitation.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'invitation'
));

//城市代理
$routers -> add('/investment/agency.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'agency'
));
//品牌招商，拿下属于你的势
$routers -> add('/investment/trademark.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'trademark'
));
//体验店加盟,拿下属于你的名
$routers -> add('/investment/feelshop.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'feelshop'
));
//提交数据
$routers -> add('/investment/submite.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'add'
));

//提交反馈数据
$routers -> add('/investment/insert.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'insert'
));
//品牌招商
$routers -> add('/investment/brandinvestment.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'brandInvestment'
));
//品牌招商
$routers -> add('/investment/promotion.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'promotion'
));
//城市招商城市代理
$routers -> add('/investment/cityagent.html', array(
    'module' => 'mobile',
    'controller' => 'investment',
    'action' => 'cityagent'
));

//////////////////////////////h5页面/////////////////////////////////////////////////////////////////////////////////////
//一元购
$routers -> add('/hot/onebuy.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'onebuy'
));

//一元购立即购买页面
$routers -> add('/hot/confirm.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'confirm'
));

//三级联动
$routers -> add('/hot/site.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'siteData'
));

//现金卡
$routers -> add('/hot/cashcard.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'cashcard'
));
//现金卡
$routers -> add('/hot/vcard.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'vcard'
));

//现金卡立即购买
$routers -> add('/hot/cash/confirm.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'cashConfirm'
));

//满额送礼
$routers -> add('/hot/present.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'present'
));

//满额送礼立即购买
$routers -> add('/hot/present/confirm.html', array(
    'module' => 'mobile',
    'controller' => 'hot',
    'action' => 'presentConfirm'
));

return $routers;
