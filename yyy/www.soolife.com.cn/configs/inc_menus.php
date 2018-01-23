<?php
// +----------------------------------------------------------------------
// | 左侧菜单 参数配置
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_menus.php
// |
// | Author: Elliot Shi
// | Created:   2017-02-21
// +----------------------------------------------------------------------
$menus = array(
	array("id"=>110001,"name"=>"cn.soolife.intranet.index","text"=>"首页","target"=>"/index.html","items"=>array()),

	
	array("id"=>210001,"name"=>"cn.soolife.intranet.about","text"=>"关于我们","target"=>"/about/companyProfile.html","items"=>array(
		array("id"=>211001,"name"=>"cn.soolife.intranet.about","text"=>"公司简介","target"=>"/about/companyProfile.html"),
		array("id"=>211002,"name"=>"cn.soolife.intranet.about","text"=>"董事长致辞","target"=>"/about/makeSpeech.html"),
		array("id"=>211003,"name"=>"cn.soolife.intranet.about","text"=>"核心团队","target"=>"/about/coreTeam.html"),
		array("id"=>211004,"name"=>"cn.soolife.intranet.about","text"=>"文化理念","target"=>"/about/culture.html"),
		array("id"=>211005,"name"=>"cn.soolife.intranet.about","text"=>"发展历程","target"=>"/about/developmentHistory.html"),
		array("id"=>211006,"name"=>"cn.soolife.intranet.about","text"=>"企业荣誉","target"=>"/about/enterpriseHonor.html"),
		array("id"=>211007,"name"=>"cn.soolife.intranet.about","text"=>"未来展望","target"=>"/about/futureTendency.html"),
		// array("id"=>211007,"name"=>"cn.soolife.intranet.about","text"=>"公司联系方式","target"=>"/about/contactInformation.html")
	)),
	array("id"=>310001,"name"=>"cn.soolife.intranet.dynamic","text"=>"公司动态","target"=>"/dynamic/dynamic.html","items"=>array(
		// array("id"=>311001,"name"=>"cn.soolife.intranet.dynamic","text"=>"公司动态","target"=>"/dynamic/dynamic.html"),
		// array("id"=>311002,"name"=>"cn.soolife.intranet.xxxx","text"=>"董事长致辞","target"=>""),
		// array("id"=>311003,"name"=>"cn.soolife.intranet.xxxx","text"=>"核心团队","target"=>"")
	)),
	array("id"=>410001,"name"=>"cn.soolife.intranet.business","text"=>"业务模式","target"=>"/business/businessModel.html","items"=>array(
		array("id"=>411001,"name"=>"cn.soolife.intranet.business","text"=>"商业模式介绍","target"=>"/business/businessModel.html"),
		array("id"=>411002,"name"=>"cn.soolife.intranet.business","text"=>"平台介绍","target"=>"/business/platformIntroduction.html"),
		array("id"=>411003,"name"=>"cn.soolife.intranet.business","text"=>"体验店介绍","target"=>"/business/experienceCenter.html")
	)),
	array("id"=>510001,"name"=>"cn.soolife.intranet.partner","text"=>"品牌合作","target"=>"/partner/brandinvestment.html","items"=>array(
		/*array("id"=>511001,"name"=>"cn.soolife.intranet.partner","text"=>"城市代理加盟合作","target"=>"/partner/newcityagent.html"),
		array("id"=>511002,"name"=>"cn.soolife.intranet.partner","text"=>"体验店投资加盟合作","target"=>"/partner/experience.html"),*/
		array("id"=>511003,"name"=>"cn.soolife.intranet.partner","text"=>"品牌商家入驻合作","target"=>"/partner/brandinvestment.html")
	)),
	array("id"=>610001,"name"=>"cn.soolife.intranet.report","text"=>"品牌报道","target"=>"/report/brandActivity.html","items"=>array(
		array("id"=>611001,"name"=>"cn.soolife.intranet.report","text"=>"品牌活动","target"=>"/report/brandActivity.html"),
		array("id"=>611002,"name"=>"cn.soolife.intranet.report","text"=>"媒体专访","target"=>"/report/mediaInterviews.html"),
		array("id"=>611003,"name"=>"cn.soolife.intranet.report","text"=>"视频报道","target"=>"/report/videoCoverage.html")
	)),
	array("id"=>710001,"name"=>"cn.soolife.intranet.contactus","text"=>"联系我们","target"=>"/contactUs/contactInformation.html","items"=>array(
		// array("id"=>711001,"name"=>"cn.soolife.intranet.contactUs","text"=>"公司联系方式","target"=>"/contactUs/contactInformation.html"),
		// array("id"=>711002,"name"=>"cn.soolife.intranet.contactUs","text"=>"人才招募","target"=>""),
		// array("id"=>711003,"name"=>"cn.soolife.intranet.contactUs","text"=>"市场合作","target"=>""),
		// array("id"=>711003,"name"=>"cn.soolife.intranet.contactUs","text"=>"在线咨询","target"=>"")
	)),
	array("id"=>810001,"name"=>"cn.soolife.intranet.sop","text"=>"商家入驻","target"=>"/sop/index.html","items"=>array()),
);

return $menus;