<?php
// +----------------------------------------------------------------------
// | �����ļ� ·�ɵ�ַ����
// +----------------------------------------------------------------------
// | Copyright (c) 2016�� �������. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
$router = new Phalcon\Mvc\Router();

// ����JS ///////////////////////////////////////////////////////////////////
$router -> add('/assets/header.js', array(
    'controller' => 'assets',
    'action' => 'header'
));
$router -> add('/assets/footer.js', array(
    'controller' => 'assets',
    'action' => 'footer'
));
$router -> add('/assets/sidebar.js', array(
    'controller' => 'assets',
    'action' => 'sidebar'
));
$router -> add('/assets/carts.js', array(
    'controller' => 'assets',
    'action' => 'carts'
));
$router -> add('/assets/tags.js', array(
    'controller' => 'assets',
    'action' => 'tags'
));
$router -> add('/assets/goods_hot_{size:[0-9]+}.js', array(
    'controller' => 'assets',
    'action' => 'hot'
));
$router -> add('/assets/goods_coin_{size:[0-9]+}.js', array(
    'controller' => 'assets',
    'action' => 'coin'
));
$router -> add('/assets/category.js', array(
    'controller' => 'assets',
    'action' => 'category'
));

// ͳ������� ///////////////////////////////////////////////////////////////////
$router -> add('/tj/analytics.js', array(
    'controller' => 'assets',
    'action' => 'analytics'
));
$router -> add('/m/tj/analytics.js', array(
    'controller' => 'assets',
    'action' => 'm_analytics'
));
// ���
$router -> add('/tj/gg.js', array(
    'controller' => 'assets',
    'action' => 'ads'
));
// ����
$router -> add('/tj/share.js', array(
    'controller' => 'assets',
    'action' => 'share'
));

// �������ǵ�·�� ////////////////////////////////////////////////////////////////////
//	�������� /about/index.html
$router -> add('/about/index.html', array(
    'controller' => 'about',
    'action' => 'index'
));

//	��ϵ���� /about/contact.html
$router -> add('/about/contact.html', array(
    'controller' => 'about',
    'action' => 'contact'
));
//	��Ƹ�˲� /about/job.html
$router -> add('/about/job.html', array(
    'controller' => 'about',
    'action' => 'job'
));
//	Ʒ�ƽ��� /about/info.html
$router -> add('/about/brand.html', array(
    'controller' => 'about',
    'action' => 'brand'
));
//	�̼���פ /about/settled.html
$router -> add('/about/settled.html', array(
    'controller' => 'about',
    'action' => 'settled'
));
//	�������� /about/link.html
$router -> add('/about/links.html', array(
    'controller' => 'about',
    'action' => 'links'
));
//	�������� /about/copyright.html
$router -> add('/about/law.html', array(
    'controller' => 'about',
    'action' => 'law'
));
//  ����� /about/home.html
$router -> add('/about/home.html', array(
    'controller' => 'about',
    'action' => 'home'
));
//	��վЭ�� /about/agreement.html
$router -> add('/about/agreement.html', array(
    'controller' => 'about',
    'action' => 'agreement'
));
//  ��ҵ��ʼ�� /about/founder.html
$router -> add('/about/founder.html', array(
    'controller' => 'about',
    'action' => 'founder'
));
// ��������
$router -> add('/guid.html',array(
    'controller' => 'about',
    'action' => 'guid'
));
// ����Ŀ��·�� ///////////////////////////////////////////////////////////////////
//��վ��ҳ

$router->add('/',array(
    'controller' => 'index',
    'action' => 'index'
));
$router -> add('/index.html',array(
    'controller' => 'index',
    'action' => 'index'
));


// �Զ���������
$router -> add('/index/searchAutoAjax.html',array(
    'controller' => 'index',
    'action' => 'searchAutoAjax'
));


// ���⾫Ʒ
$router -> add('/overseas.html',array(
    'controller' => 'overseas',
    'action' => 'index'
));

// �ǳ���
$router -> add('/market.html',array(
    'controller' => 'market',
    'action' => 'index'
));
// �Ƿ���
$router -> add('/clothes.html',array(
    'controller' => 'clothes',
    'action' => 'index'
));
// �Ƿ�ר��ҳ
$router -> add('/vip.html',array(
    'controller' => 'vip',
    'action' => 'index'
));
// �Ƿ�ר��ҳ,��ȡ�Ǳ�
$router -> add('/vip/gain/coin.html',array(
    'controller' => 'vip',
    'action' => 'gain'
));
// ���ػ�
$router -> add('/discount.html',array(
    'controller' => 'discount',
    'action' => 'index'
));


// Ĭ�� ////////////////////////////////////////////////////////////////////////////
// NOT FOUND ·����
$router -> notFound(array(
    "controller" => 'index',
    "action" => 'index'
));
// Ĭ��·����
$router -> setDefaults(array(
    'controller' => 'index',
    'action' => 'index'
));

// ����
$router -> add('/test/sheet',array(
    'controller' => 'test',
    'action' => 'sheet'
));

return $router;
