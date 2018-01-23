<?php
// +----------------------------------------------------------------------
// | ÅäÖÃÎÄ¼þ Â·ÓÉµØÖ·ÅäÖÃ
// +----------------------------------------------------------------------
// | Copyright (c) 2016Äê Èç´ËÉú»î. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
$router = new Phalcon\Mvc\Router();

$router -> add('/', array(
    'controller' => 'mindex',
    'action' => 'newIndex'
));
$router -> add('/newindex.html', array(
    'controller' => 'mindex',
    'action' => 'newIndex'
));
$router -> add('/search.html', array(
    'controller' => 'mindex',
    'action' => 'search'
));
//Ê×Ò³ÏÂÀ­¼ÓÔØ
$router -> add('/downlading.html', array(
    'controller' => 'index',
    'action' => 'downlading'
));
//Ê×Ò³
$router -> add('/index.html', array(
    'controller' => 'mindex',
    'action' => 'newIndex'
));
//首页猜你喜欢ajax
$router -> add('/guesslike/goods.html', array(
    'controller' => 'mindex',
    'action' => 'guessLikeAjax'
));
//³äÖµ
$router -> add('/recharge.html', array(
    'controller' => 'index',
    'action' => 'recharge'
));
//³äÖµÉú³É¶©µ¥
$router -> add('/order.html', array(
    'controller' => 'index',
    'action' => 'order'
));
//ÐÇ·ÛÁª
$router -> add('/starfans.html', array(
    'controller' => 'index',
    'action' => 'starfans'
));
//ÐÇ·ÛÁªÑûÇë¼ÇÂ¼
$router -> add('/record.html', array(
    'controller' => 'index',
    'action' => 'record'
));
//º£Íâ¾«Æ·
$router -> add('/seagood.html', array(
    'controller' => 'index',
    'action' => 'seagood'
));
//º£Íâ¾«Æ·ÏÂÀ­¼ÓÔØ
$router -> add('/download.html', array(
    'controller' => 'index',
    'action' => 'download'
));
//È«ÃñÐÇÌ½
$router -> add('/business.html', array(
    'controller' => 'index',
    'action' => 'business'
));
//µØÖ·Áª¶¯
$router -> add('/address.html', array(
    'controller' => 'index',
    'action' => 'address'
));
//supplierpply
$router -> add('/supplierpply.html', array(
    'controller' => 'index',
    'action' => 'supplierpply'
));
//È«ÃñÉÌÌ½Ð­ÒéÏÔÊ¾
$router -> add('/isbusiness.html', array(
    'controller' => 'index',
    'action' => 'isbusiness'
));
//È«ÃñÉÌÌ½Ð­ÒéÏÔÊ¾
$router -> add('/isbusiness.html', array(
    'controller' => 'index',
    'action' => 'isbusiness'
));
//È«ÃñÉÌÌ½Ð­ÒéÊÇ·ñÔÄ¶ÁÌá½»
$router -> add('/subbusiness.html', array(
    'controller' => 'index',
    'action' => 'subbusiness'
));
//»ÝÉú»î
$router -> add('/life.html', array(
    'controller' => 'life',
    'action' => 'life'
));
//ÐÇ»»¹º
$router -> add('/sale.html', array(
    'controller' => 'life',
    'action' => 'sale'
));
//ÏêÇé
$router -> add('/show/{id}.html', array(
    'controller' => 'life',
    'action' => 'detail'
));
//µãÔÞajax
$router -> add('/praise.html', array(
    'controller' => 'life',
    'action' => 'praise'
));
//ÆÀÂÛajax
$router -> add('/comment.html', array(
    'controller' => 'life',
    'action' => 'comment'
));
//ÐÇ·¶¶ù
$router -> add('/starstyle.html', array(
    'controller' => 'Starstyle',
    'action' => 'starstyle'
));
//ÐÇ³¬ÊÐ
$router -> add('/starmarket.html', array(
    'controller' => 'starmarket',
    'action' => 'starmarket'
));
//ÐÇ³¬ÊÐÏÂÀ­ajax
$router -> add('/market.html', array(
    'controller' => 'starmarket',
    'action' => 'market'
));
//Áìºì°ü
$router -> add('/getbag.html', array(
    'controller' => 'reward',
    'action' => 'invite'
));
//Î´¿ª·¢
$router -> add('/without.html', array(
    'controller' => 'without',
    'action' => 'without'
));
// ÉÌÆ··ÖÀà
$router -> add('/category.html', array(
    'controller' => 'category',
    'action' => 'category'
));
//
$router -> add('/my.html', array(
    'controller' => 'index',
    'action' => 'my'
));
//ÑûÇëÁìºì°ü
$router -> add('/invite.html', array(
    'controller' => 'reward',
    'action' => 'invite'
));

/////¹ØÓÚÎÒÃÇ
$router -> add('/about.html', array(
    'controller' => 'about',
    'action' => 'about'
));
/////¹ØÓÚÎÒÃÇ
$router -> add('/guid.html', array(
    'controller' => 'about',
    'action' => 'guid'
));
//·¨ÂÉÉùÃ÷
$router -> add('/copyright.html', array(
    'controller' => 'about',
    'action' => 'copyright'
));


/*--------------------------------------------------
*/
//»ÝÉú»î
$router -> add('/huilife/index.html', array(
    'controller' => 'huilife',
    'action' => 'index'
));
//»ÝÉú»îÁìÐÇ±Òjs
$router -> add('/huilife/getcoin.html', array(
    'controller' => 'huilife',
    'action' => 'getcoin'
));
//µ¹¼ÆÊ±
$router -> add('/huilife/timer.html', array(
    'controller' => 'huilife',
    'action' => 'timer'
));

$router -> add('/huilife/getmore.html', array(
    'controller' => 'huilife',
    'action' => 'getmore'
));
$router -> add('/huilife/starchange.html', array(
    'controller' => 'huilife',
    'action' => 'starchange'
));
$router -> add('/huilife/starpurchase.html', array(
    'controller' => 'huilife',
    'action' => 'starpurchase'
));
//ÐÇ±Ò¹æÔò
$router -> add('/huilife/coinrule.html', array(
    'controller' => 'huilife',
    'action' => 'coinrule'
));
//ÐÇ·ÛÁª
$router -> add('/starfans/index.html', array(
    'controller' => 'starfans',
    'action' => 'index'
));
$router -> add('/starfans/getpacket.html', array(
    'controller' => 'starfans',
    'action' => 'getpacket'
));
$router -> add('/starfans/active.html', array(
    'controller' => 'starfans',
    'action' => 'active'
));
$router -> add('/starfans/share.html', array(
    'controller' => 'starfans',
    'action' => 'share'
));
$router -> add('/starfans/end.html', array(
    'controller' => 'starfans',
    'action' => 'end'
));
# Í¼Æ¬ÑéÖ¤Âë
$router -> add('/tools/validcode.html', array(
    'controller' => 'tools',
    'action' => 'validcode'
));






// 引导页
$router -> add('/starkill/index.html', array(
    'controller' => 'starkill',
    'action' => 'index'
));
// 活动开始
$router -> add('/starkill/start.html', array(
    'controller' => 'starkill',
    'action' => 'start'
));
// 活动未开始
$router -> add('/starkill/nostart.html', array(
    'controller' => 'starkill',
    'action' => 'nostart'
));
// 活动结束
$router -> add('/starkill/mystar.html', array(
    'controller' => 'starkill',
    'action' => 'mystar'
));
// 活动结束
$router -> add('/starkill/mystar.html', array(
    'controller' => 'starkill',
    'action' => 'mystar'
));
// 活动状态*******我要杀价*****************杀价/购买
$router -> add('/starkill/state.html', array(
    'controller' => 'starkill',
    'action' => 'state'
));
// 查看详情
$router -> add('/starkill/details.html', array(
    'controller' => 'starkill',
    'action' => 'details'
));
// 星星杀订单
$router -> add('/starkill/order.html', array(
    'controller' => 'starkill',
    'action' => 'order'
));
// 预定成功
$router -> add('/starkill/success.html', array(
    'controller' => 'starkill',
    'action' => 'success'
));
// 确认付款ajax请求
$router -> add('/starkill/join.html', array(
    'controller' => 'starkill',
    'action' => 'join'
));
// 立即购买
$router -> add('/starkill/buy.html', array(
    'controller' => 'starkill',
    'action' => 'buy'
));
// 猜你喜欢
$router -> add('/starkill/guesslike.html', array(
    'controller' => 'starkill',
    'action' => 'guesslike'
));
// 满额抽奖
$router -> add('/lottery/index/{orderId:[0-9]+}.html', array(
    'controller' => 'lottery',
    'action' => 'index'
));
// 满额抽奖敬请期待
$router -> add('/lottery/expect.html', array(
    'controller' => 'lottery',
    'action' => 'expect'
));
// 满额抽奖首页
$router -> add('/lottery/homepage.html', array(
    'controller' => 'lottery',
    'action' => 'homepage'
));
// 满额抽奖商品
$router -> add('/lottery/interface.html', array(
    'controller' => 'lottery',
    'action' => 'interface'
));
// 满额抽奖付款成功
$router -> add('/lottery/win.html', array(
    'controller' => 'lottery',
    'action' => 'win'
));
//满额抽奖引导页
$router -> add('/lottery/regulation.html', array(
    'controller' => 'lottery',
    'action' => 'regulation'
));
$router -> add('/lottery/draw.html', array(
    'controller' => 'lottery',
    'action' => 'draw'
));
//添加购物车
$router -> add('/lottery/addcart.html', array(
    'controller' => 'lottery',
    'action' => 'addcart'
));

//404页面
$router -> add('/page/page.html', array(
    'controller' => 'page',
    'action' => 'page'
));





// 雷俊杰
//星特惠
$router -> add('/starhui/starhui.html', array(
    'controller' => 'starhui',
    'action' => 'starhui'
));
//品牌特惠
$router -> add('/brandhui/brandhui.html', array(
    'controller' => 'brandhui',
    'action' => 'brandhui'
));
//首页
$router -> add('/mindex/index.html', array(
    'controller' => 'mindex',
    'action' => 'newIndex'
));
// 热门搜索自动补全

$router -> add('/mindex/searchAutoAjax.html', array(
    'controller' => 'mindex',
    'action' => 'searchAutoAjax'
));
//星范儿
$router -> add('/starmodel/starmodel.html', array(
    'controller' => 'starmodel',
    'action' => 'starmodel'
));
//星范儿
$router -> add('/starmodel/categories.html', array(
    'controller' => 'starmodel',
    'action' => 'categories'
));
//惠生活
$router -> add('/smartlife/index.html', array(
    'controller' => 'smartlife',
    'action' => 'index'
));
// 猜你喜欢
$router -> add('/mindex/guesslike.html', array(
    'controller' => 'mindex',
    'action' => 'guesslike'
));
// 星主题
$router -> add('/startheme/startheme.html', array(
    'controller' => 'startheme',
    'action' => 'startheme'
));
// 主题子页面
$router -> add('/startheme/themechild/{id:[0-9]+}.html', array(
    'controller' => 'startheme',
    'action' => 'themechild'
));
//推荐
$router -> add('/startheme/guesslike.html', array(
    'controller' => 'startheme',
    'action' => 'guesslike'
));
// 星范儿
$router -> add('/fansstar/index.html', array(
    'controller' => 'fansstar',
    'action' => 'index'
));

//惠生活频道//////////////////////////////////////////////////////////////////////////
$router -> add('/lifehui/index.html', array(
    'controller' => 'lifehui',
    'action' => 'index'
));
//体验店列表
$router -> add('/lifehui/store.html', array(
    'controller' => 'lifehui',
    'action' => 'store'
));
//体验店详情
$router -> add('/lifehui/storedetail.html', array(
    'controller' => 'lifehui',
    'action' => 'storedetail'
));
//星粉秀列表
$router -> add('/lifehui/show.html', array(
    'controller' => 'lifehui',
    'action' => 'show'
));
// 星粉秀列表加载更多
$router -> add('/lifehui/showMore.html', array(
    'controller' => 'lifehui',
    'action' => 'showMore'
));
//星粉秀详情
$router -> add('/lifehui/showdetail.html', array(
    'controller' => 'lifehui',
    'action' => 'showdetail'
));

//星粉秀点赞
$router -> add('/lifehui/praise.html', array(
    'controller' => 'lifehui',
    'action' => 'praise'
));
//下载页面
$router -> add('/lifehui/download.html', array(
    'controller' => 'lifehui',
    'action' => 'download'
));


//我的//////////////////////////////////////////////////////////////////////////
// **********************************index**********************************
$router -> add('/i/index/index.html', array(
    'controller' => 'i',
    'action' => 'index'
));
// **********************************msg**********************************
$router -> add('/i/msg/msgindex.html', array(
    'controller' => 'i',
    'action' => 'msgindex'
));
// 系统消息
$router -> add('/i/msg/msgsystem.html', array(
    'controller' => 'i',
    'action' => 'msgsystem'
));
// 优惠活动
$router -> add('/i/msg/msgactive.html', array(
    'controller' => 'i',
    'action' => 'msgactive'
));
// 订单物流
$router -> add('/i/msg/msgorder.html', array(
    'controller' => 'i',
    'action' => 'msgorder'
));
// 资产消息
$router -> add('/i/msg/msgasset.html', array(
    'controller' => 'i',
    'action' => 'msgasset'
));
// 售后消息
$router -> add('/i/msg/msgservice.html', array(
    'controller' => 'i',
    'action' => 'msgservice'
));
// **********************************money**********************************
// 星币
$router -> add('/i/money/coin.html', array(
    'controller' => 'i',
    'action' => 'coin'
));
// 现金
$router -> add('/i/money/cash.html', array(
    'controller' => 'i',
    'action' => 'cash'
));
// 现金充值钱包
$router -> add('/i/money/cashrecharge.html', array(
    'controller' => 'i',
    'action' => 'cashrecharge'
));
// 钱包
$router -> add('/i/money/wallet.html', array(
    'controller' => 'i',
    'action' => 'wallet'
));
// 钱包充值
$router -> add('/i/money/walletrecharge.html', array(
    'controller' => 'i',
    'action' => 'walletrecharge'
));
// 虚拟商品
$router -> add('/i/money/rechargelist.html', array(
    'controller' => 'i',
    'action' => 'rechargelist'
));
// 支付中心
$router -> add('/i/money/walletpay.html', array(
    'controller' => 'i',
    'action' => 'walletpay'
));
// 支付宝支付
$router -> add('/i/money/alipay.html', array(
    'controller' => 'i',
    'action' => 'alipay'
));
// 微信支付
$router -> add('/i/money/weixinpay.html', array(
    'controller' => 'i',
    'action' => 'weixinpay'
));
// 支付成功
$router -> add('/i/money/paysuccess.html', array(
    'controller' => 'i',
    'action' => 'paysuccess'
));
// **************************订单详情**************************

// 我的订单
$router->add('/orders/index.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'index',
));
//我的订单-->订单详情
$router->add('/orders/details/{no:[0-9]+}.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'details',
));
//我的订单-->订单详情-->物流信息
$router->add('/orders/details/deliverinfo/{id:[0-9]+}.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'deliverinfo',
));

//取消订单
$router->add('/orders/cancel/{id:[0-9]+}/{type:[0-9]}.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'cancel',
));
//确认订单
$router->add('/orders/confirm/{id:[0-9]+}.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'confirm',
));
//订单评论
$router->add('/orders/comment/{no:[0-9a-z]+}.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'comment',
));
//售后/申请售后页面
$router->add('/orders/customer_service.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'customer_service',
));
//售后/退款
$router->add('/orders/aftersale.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'aftersale',
));
//售后/退款 -->售后详情
$router->add('/orders/particularsth/{id:[0-9a-z]+}.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'particularsth',
));
//售后/退款 -->取消售后
$router->add('/orders/editstatus.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders',
    'action' => 'editstatus',
));
//售后/退款 -->解决问题按钮
$router->add('/orders/problem.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders', 
    'action' => 'problem',
));
//区域
$router->add('/orders/region.html', array(
    // 'module' => 'mobile',
    'controller' => 'orders', 
    'action' => 'region',
));

// **************************优惠券**************************
$router -> add('/i/coupon/coupon.html', array(
    'controller' => 'i',
    'action' => 'coupon'
));
// 激活优惠券
$router -> add('/i/coupon/active.html', array(
    'controller' => 'i',
    'action' => 'active'
));
// **************************全民商谈**************************
$router -> add('/i/business/business.html', array(
    'controller' => 'i',
    'action' => 'business'
));
// 我的星粉秀列表
$router -> add('/i/show/show.html', array(
    'controller' => 'i',
    'action' => 'show'
));

// 我的星粉秀加载更多
$router -> add('/i/show/showMore.html', array(
    'controller' => 'i',
    'action' => 'showMore'
));
$router -> add('/i/show/download.html', array(
    'controller' => 'i',
    'action' => 'download'
));
// 惠生活订单（惠生活优惠券）
// 我的邀请
$router -> add('/i/record/invite.html', array(
    'controller' => 'i',
    'action' => 'invite'
));
// 我的邀请更多
$router -> add('/i/record/inviteAjax.html', array(
    'controller' => 'i',
    'action' => 'inviteAjax'
));
// 关注
$router -> add('/i/record/attention.html', array(
    'controller' => 'i',
    'action' => 'attention'
));
// 取消宝贝关注
$router -> add('/i/record/delgoods.html', array(
    'controller' => 'i',
    'action' => 'delgoods'
));
// 取消店铺关注
$router -> add('/i/record/delshop.html', array(
    'controller' => 'i',
    'action' => 'delshop'
));
// 足迹
$router -> add('/i/record/footprint.html', array(
    'controller' => 'i',
    'action' => 'footprint'
));
// 删除足迹
$router -> add('/i/record/delfootprint.html', array(
    'controller' => 'i',
    'action' => 'delfootprint'
));
// 收入记录
$router -> add('/i/record/record.html', array(
    'controller' => 'i',
    'action' => 'record'
));
// 安全设置
// **********************************safe**********************************
// 关于我们
$router -> add('/i/safe/safeabout.html', array(
    'controller' => 'i',
    'action' => 'safeabout'
));
//lei安全设置
$router -> add('/setting/safeset.html', array(
    'controller' => 'setting',
    'action' => 'safeset'
));
//lei安全设置 退出登录
$router -> add('/logout.html', array(
    'controller' => 'setting',
    'action' => 'logout'
));
//修改昵称
$router -> add('/setting/amendname.html', array(
    'controller' => 'setting',
    'action' => 'amendname'
));
//绑定手机号
$router -> add('/setting/contextiphone.html', array(
    'controller' => 'setting',
    'action' => 'contextiphone'
));
//个人信息
$router -> add('/setting/message.html', array(
    'controller' => 'setting',
    'action' => 'message'
));
//修改密码
$router -> add('/setting/password.html', array(
    'controller' => 'setting',
    'action' => 'password'
));
//修改登录密码
$router -> add('/setting/revamp.html', array(
    'controller' => 'setting',
    'action' => 'revamp'
));
//登录密码
$router -> add('/setting/loginpassword.html', array(
    'controller' => 'setting',
    'action' => 'loginpassword'
));
//支付密码
$router -> add('/setting/paypassword.html', array(
    'controller' => 'setting',
    'action' => 'paypassword'
));
//修改支付密码
$router -> add('/setting/paypasswords.html', array(
    'controller' => 'setting',
    'action' => 'paypasswords'
));
//现金账号绑定
$router -> add('/setting/cash.html', array(
    'controller' => 'setting',
    'action' => 'cash'
));
//银行卡绑定
$router -> add('/setting/bindbank.html', array(
    'controller' => 'setting',
    'action' => 'bindbank'
));
//银行卡绑定绑定
$router -> add('/setting/cashAjax.html', array(
    'controller' => 'setting',
    'action' => 'cashAjax'
));

//银行卡绑定发送验证码
$router -> add('/setting/vcodeAjax.html', array(
    'controller' => 'setting',
    'action' => 'vcodeAjax'
));
//激活礼品卡
$router -> add('/setting/coupon.html', array(
    'controller' => 'setting',
    'action' => 'coupon'
));
//激活礼品卡
$router -> add('/setting/couponAjax.html', array(
    'controller' => 'setting',
    'action' => 'couponAjax'
));
//充值钱包
$router -> add('/setting/stockpilewallet.html', array(
    'controller' => 'setting',
    'action' => 'stockpilewallet'
));
//关于我们
$router -> add('/setting/aboutus.html', array(
    'controller' => 'setting',
    'action' => 'aboutus'
));
//意见反馈
$router -> add('/setting/opinion.html', array(
    'controller' => 'setting',
    'action' => 'opinion'
));
//收货地址
$router -> add('/setting/site.html', array(
    'controller' => 'setting',
    'action' => 'site'
));
//新增收货地址
$router -> add('/setting/speaddres.html', array(
    'controller' => 'setting',
    'action' => 'speaddres'
));
//修改收货地址
$router -> add('/setting/remaddres/{id:[0-9]+}.html', array(
    'controller' => 'setting',
    'action' => 'remaddres'
));



//全民商探
$router -> add('/shopseek/shopseek.html', array(
    'controller' => 'shopseek',
    'action' => 'shopseek'
));
//商家报备选择
$router -> add('/shopseek/shopmodel.html', array(
    'controller' => 'shopseek',
    'action' => 'shopmodel'
));
//商家报备
$router -> add('/shopseek/shopreport.html', array(
    'controller' => 'shopseek',
    'action' => 'shopreport'
));
 //商家签约
$router -> add('/shopseek/shopsign.html', array(
    'controller' => 'shopseek',
    'action' => 'shopsign'
));
 //商谈收入
$router -> add('/shopseek/shopincome.html', array(
    'controller' => 'shopseek',
    'action' => 'shopincome'
));
//////////////////junjie_lei////////////////////////////////
//登录
$router -> add('/logins/login.html', array(
    'controller' => 'logins',
    'action' => 'login'
));
//扫码登录
$router -> add('/iphonesure/iphonesure.html', array(
    'controller' => 'iphonesure',
    'action' => 'iphonesure'
));
//忘记密码
$router -> add('/forgets/forget.html', array(
    'controller' => 'forgets',
    'action' => 'forget'
));
//注册
$router -> add('/enroll/enroll.html', array(
    'controller' => 'enroll',
    'action' => 'enroll'
));
//注册协议
$router -> add('/enroll/protocol.html', array(
    'controller' => 'enroll',
    'action' => 'protocol'
));
//绑定注册
$router -> add('/bound/bound.html', array(
    'controller' => 'bound',
    'action' => 'bound'
));
//已有账号绑定注册
$router -> add('/bound/havebound.html', array(
    'controller' => 'bound',
    'action' => 'havebound'
));



//分类--新分类首页
$router -> add('/newcategory.html', array(
    'controller' => 'newcategory',
    'action' => 'newcategory'
));
// 搜索
$router -> add('/newcategory/searchAutoAjax.html', array(
    'controller' => 'newcategory',
    'action' => 'searchAutoAjax'
));
//分类--三级分类
$router -> add('/newcategory/threecate.html', array(
    'controller' => 'newcategory',
    'action' => 'threecate'
));
//分类-删选
$router -> add('/newcategory/filter.html', array(
    'controller' => 'newcategory',
    'action' => 'filter'
));
//分类-二级频道
$router -> add('/second/secondindex.html', array(
    'controller' => 'second',
    'action' => 'secondindex'
));
$router -> add('/second/filter.html', array(
    'controller' => 'second',
    'action' => 'filter'
));
// 二级分类搜索
$router -> add('/second/searchAutoAjax.html', array(
    'controller' => 'second',
    'action' => 'searchAutoAjax'
));

$router -> add('/second/limit/{timekey:[0-9]+}.html', array(
    'controller' => 'second',
    'action' => 'limit'
));
$router -> add('/second/next/{timekey:[0-9]+}.html', array(
    'controller' => 'second',
    'action' => 'next'
));
//、、、、、、、、海外精品
$router -> add('/overseagoods.html', array(
    'controller' => 'overseagoods',
    'action' => 'overseagoods'
));
// 海外精品加载更多
$router -> add('/overseagoods/overSeaAjax.html', array(
    'controller' => 'overseagoods',
    'action' => 'overSeaAjax'
));
$router -> add('/overseagoods/today.html', array(
    'controller' => 'overseagoods',
    'action' => 'today'
));
$router -> add('/overseagoods/tomorrow.html', array(
    'controller' => 'overseagoods',
    'action' => 'tomorrow'
));
//、、、、、、、、注册送星币
$router -> add('/regift.html', array(
    'controller' => 'regift',
    'action' => 'regift'
));
//-----到店领星币
$router -> add('/expstore.html', array(
    'controller' => 'expstore',
    'action' => 'expstore'
));
$router -> add('/expstore/expresult.html', array(
    'controller' => 'expstore',
    'action' => 'expresult'
));










// NOT FOUND Â·ÓÉÆ÷
$router -> notFound(array(
    "controller" => 'index',
    "action" => 'notfound'
));
// Ä¬ÈÏÂ·ÓÉÆ÷
$router -> setDefaults(array(
    'controller' => 'index',
    'action' => 'index'
));

//2.2新增领星币
$router -> add('/huilife/newcollar.html', array(
    'controller' => 'huilife',
    'action' => 'newcollar'
));
//2.2新增星币说明
$router -> add('/huilife/newcoinrule.html', array(
    'controller' => 'huilife',
    'action' => 'newcoinrule'
));
//2.2新增新人专场
$router -> add('/new/people.html', array(
    'controller' => 'new',
    'action' => 'people'
));

//2.2新增我的
//我的现金
$router -> add('/me/cash.html', array(
    'controller' => 'me',
    'action' => 'cash'
));
//我的账单
$router -> add('/me/bill.html', array(
    'controller' => 'me',
    'action' => 'bill'
));
//我的账单详情
$router -> add('/me/billdetails.html', array(
    'controller' => 'me',
    'action' => 'billdetails'
));
//我的账单充值
$router -> add('/me/billrecharge.html', array(
    'controller' => 'me',
    'action' => 'billrecharge'
));
//我的提现
$router -> add('/me/withdrawals.html', array(
    'controller' => 'me',
    'action' => 'withdrawals'
));
//我的提现详情
$router -> add('/me/withdrawalsdetails.html', array(
    'controller' => 'me',
    'action' => 'withdrawalsdetails'
));
//申请售后
$router -> add('/me/customerservice.html', array(
    'controller' => 'me',
    'action' => 'customerservice'
));
//确认订单
$router -> add('/me/confirmorder.html', array(
    'controller' => 'me',
    'action' => 'confirmorder'
));
//确认订单
$router -> add('/setting/paypasswords_code', array(
    'controller' => 'setting',
    'action' => 'paypasswords_code'
));

// 3.0
// 大V卡
$router -> add('/bigVcard/index.html', array(
    'controller' => 'bigVcard',
    'action' => 'index'
));
// 视频测试
$router -> add('/shipin/ceshi.html', array(
    'controller' => 'Shipin',
    'action' => 'ceshi'
));


return $router;
