/*
 * sdk.2.2.1.js ;
 * 基于原生js实现ios、android于html的交互;
 * by cunyang_liu 2016-11-29;
 * update 2017-1-6;
 *
 */
//连接App 和web之间的关系

var body = document.getElementsByTagName('body')[0],
	isApp = /SoolifeApp/i.test(navigator.userAgent),
	isiOS = /SoolifeApp Shopping iOS/i.test(navigator.userAgent),
	isSafariBrowser = navigator.userAgent.match(/iPhone|mac|iPod|iPad/)&&navigator.userAgent.match(/Safari/),
	setupWebViewJavascriptBridge = function(callback) {
		if(window.WebViewJavascriptBridge) {
			return callback(WebViewJavascriptBridge);
		};
		if(window.WVJBCallbacks) {
			return window.WVJBCallbacks.push(callback);
		};
		window.WVJBCallbacks = [callback];
		var WVJBIframe = document.createElement('iframe');
		WVJBIframe.style.display = 'none';
		WVJBIframe.src = 'wvjbscheme://__BRIDGE_LOADED__';
		document.documentElement.appendChild(WVJBIframe);
		setTimeout(function() {
			document.documentElement.removeChild(WVJBIframe);
		}, 0);
	};
window.openSoolifeApp = (function(portKey) {
    if (navigator.userAgent.match(/iPhone|mac|iPod|iPad/)){
		window.location.href = "soolifeshopping://"+portKey;
        setTimeout(function() {
            document.location = 'http://itunes.apple.com/us/app/ru-ci-sheng-huo-shi-shang/id1116994060?mt=8';
        }, 2000);
    }else if(navigator.userAgent.match(/Android/)){
        window.location.href = "soolifeshopping://"+portKey;
        setTimeout(function() {
            document.location = 'http://app.soolife.cn/downloads.html?source=soolife&site=app.soolife.cn&referrer=0000';
        }, 1000);
    };
});
//调用app特定功能接口
window.browserOperate = function(url){
	var portKey = [
					{
					 portName:"扫一扫",
					 urlTest:"scancode",
					 goKey:"object=scan"
					}
				];
	for(i in portKey){
		if(url == portKey[i].urlTest){
			openSoolifeApp(portKey[i].goKey);
			break;
		}else if(i == (portKey.length-1)){
			url ? window.location.href = url:alert('该页面正在开发中...');
		};
	};
};
//app下载提示Nav
window.downloadNav = (function(){
	if(isApp) return;
	var downloadNavDiv = document.createElement("div");
	var sureAlertDiv = document.createElement("div");
	var downloadNavStr = '<div id="download-nav" style="position: fixed;top:0px;z-index:9;width:100%;height:44px;background-color:#333;color:#fff;font-family:Microsoft YaHei;line-height: 44px;font-size: 12px;">'+
					    	'<div id="download-nav-hide" style="float:left;width:8%;padding-left: 2%;font-size: 22px;">&times;</div>'+
					    	'<div style="float:left;width:70%;font-size:15px;">下载如此生活客户端！！！</div>'+
					    	'<div id="download-nav-sure" style="float:right;width:18%;padding-right:2%;"><span style="border-radius: 2px;background-color:#FF5A85;border:none;color:#fff;padding: 4px 22%;">下载</span></div>'+
					      '</div>';
	var sureAlertStr = '<div style="font-family:Microsoft YaHei;font-size:14px;position:fixed;top:0;bottom:0;left:0;right:0;background-color:rgba(49,47,47,0.4);z-index:11;">'+
							'<div style="margin:40% auto 0 auto; width:60%;height:100px; text-align: center;background-color: #fff;border-radius:10px;">'+
								'<div style="float:left;width:100%;height:70px;border-bottom: 1px #ccc solid;line-height: 70px;">在“如此生活”中打开？</div>'+
								'<div class="alert-hide" style="float:left;width:50%;height:30px;border-right: 1px #ccc solid;box-sizing: border-box;line-height: 30px;">取消</div>'+
								'<div class="alert-sure" style="float:left;width:50%;height:30px;line-height: 30px;">确定</div>'+
							'</div>'+
						'</div>';
	body.style.marginTop = '44px';
	downloadNavDiv.innerHTML = downloadNavStr;
	body.appendChild(downloadNavDiv);
	var downloadNav = document.getElementById('download-nav');
	var navHide = document.getElementById('download-nav-hide');
	var navSure = document.getElementById('download-nav-sure');
	navHide.onclick = function(){
		downloadNav.style.display = "none";
		body.style.marginTop = '0px';
	};
	navSure.onclick = function(){
		if(isSafariBrowser){
            window.location.href = "SoolifeShopping://";
            setTimeout(function() {
                document.location = 'http://itunes.apple.com/us/app/ru-ci-sheng-huo-shi-shang/id1116994060?mt=8';
            }, 2000);
		}else{
			sureAlertDiv.innerHTML = sureAlertStr;
			body.appendChild(sureAlertDiv);
		}
	};
	sureAlertDiv.addEventListener('click',function(e){
		var e = e || window.event;
        var target = e.target || e.srcElement;
        if(target.className == 'alert-hide'){
        	body.removeChild(sureAlertDiv);
        };
        if(target.className == 'alert-sure'){
            window.location.href = "SoolifeShopping://";
            setTimeout(function() {
                document.location = 'http://app.soolife.cn/downloads.html?source=soolife&site=app.soolife.cn&referrer=0000';
            }, 2000);
        };
	});
});
//跳转App特定页面的定位按钮
window.createGoAppBtn = (function(){
	if(isApp) return;
	var _url = window.location.href;
	var sku = parseInt(_url.match(/\d+/g)) || '';
	var portKeyDoor = [
						{
						 htmlName:"详情页",
						 testHref:/^http:\/\/item.test.soolife.cn\/m\/$/i,
						 portKey:"?object=goods&skuid=",
						 portSku:sku
						},{
						 htmlName:"店铺页",
						 testHref:/^http:\/\/store.test.soolife.cn\/m$/i,
						 portKey:"?object=shop&shop_id=",
						 portSku:sku
						},{
						 htmlName:"购物车页",
						 testHref:/^http:\/\/orders.test.soolife.cn\/m\/index.html$/i,
						 portKey:"?object=carts",
						 portSku:""
						},{
						 htmlName:"测试页(购物车)",
						 testHref:/^http:\/\/172.16.4.76:8020\/sdk\/App\/shopApp\/openapp.html$/i,
						 portKey:"?object=carts",
						 portSku:""
						}
					];
	for(i in portKeyDoor){
		if(new RegExp(portKeyDoor[i].testHref).test(_url)){
			console.log('当前为'+portKeyDoor[i].htmlName+'...');
			var portKey = portKeyDoor[i].portKey+portKeyDoor[i].portSku;
			break;
		};
		if(i == (portKeyDoor.length-1)) return;
	};
	var goAppDiv = document.createElement("div");
	var btnStr ='<div style="width:100%;position: fixed;bottom: 30%;" id="go_app_btn">'
			   +	'<div style="width:172px;height:34px;margin:0 auto;color:#ef8201;font-weight:bold;text-align: center;line-height:34px;font-size:15px;font-family:'+"'Microsoft YaHei'"+';">'
			   +		'<div style="width:140px;border-radius:6px;border:2px solid #0068B6;background:rgba(255,255,255,0.8);float:left;" id="go_app_yes">打开如此生活APP</div>'
			   +		'<div style="float:left;margin-left:10px;font-size:23px;" id="go_app_hide">×</div>'
		       +	'</div>'
			   +'</div>';
	//body.innerHTML += btnStr;
	goAppDiv.innerHTML = btnStr;
	body.appendChild(goAppDiv);
	var goAppHide = document.getElementById('go_app_hide');
	goAppHide.onclick = function(){
		var goAppBtn = document.getElementById('go_app_btn');
		goAppBtn.style.display = "none";
	};
	var goAppYes = document.getElementById('go_app_yes');
	goAppYes.onclick = function(){
		openSoolifeApp(portKey);
	};
});
//调用接口的函数
window.appSDK = (function(){
	var invoke = function(bodyDict) {
		if(isiOS) {
			setupWebViewJavascriptBridge(function(bridge) {
				bridge.callHandler('iOS Echo', bodyDict, function responseCallback(responseData) {
					if(typeof bodyDict.param.success === "function") {
						bodyDict.param.success(responseData);
					};
				});
			});
		} else {//调用本地java方法
			window.WebViewJavascriptBridge.callHandler(
				'android Echo', bodyDict,
				function(responseData) {
					if(typeof bodyDict.param.success === "function") {
						bodyDict.param.success(responseData);
					};
				}
			);
		};
	};
	var toolFunc = function(bodyDict, url) {
		isApp ? invoke(bodyDict) : browserOperate(url);
	};
	return {
		//show hud
		showHUD: function(callback, url) {
			toolFunc({
				"action": "show",
				"object": "hud",
				"param": callback
			}, url);
		},
		//hide hud
		hideHUD: function(callback, url) {
			toolFunc({
				"action": "hide",
				"object": "hud",
				"param": callback
			}, url);
		},
		//open new web
		openNewWeb: function(url) {
			//showMessage(url);
			toolFunc({
				"action": "open",
				"object": "new_web",
				"param": {
					"link": url
				}
			}, url);
		},
		//open shop detail
		openShop: function(shopID, url) {
			toolFunc({
				"action": "open",
				"object": "shop_detail",
				"param": shopID
			}, url);
		},
		//open goods detail
		openGoodsDetail: function(skuID, url) {
			toolFunc({
				"action": "open",
				"object": "good_detail",
				"param": skuID
			}, url);
		},
		//instant_buy
		openInstantBuy: function(instantBuyBody, url) {
			toolFunc({
				"action": "open",
				"object": "instant_buy",
				"param": instantBuyBody
			}, url);
		},
		//open barcode
		openBarCode: function(url) {
			toolFunc({
				"action": "open",
				"object": "barcode",
				"param": {}
			}, url);
		},
		//open share
		openShare: function(shareBody, url) {
			toolFunc({
				"action": "open",
				"object": "share",
				"param": shareBody
			}, url);
		},
		//open carts
		openCarts: function(url) {
			toolFunc({
				"action": "open",
				"object": "carts",
				"param": {}
			}, url);
		},
		//add carts
		addCarts: function(cartsBody, url) {
			toolFunc({
				"action": "add",
				"object": "carts",
				"param": cartsBody
			}, url);
		},
		//open star powder
		openStarPowder: function(url) {
			toolFunc({
				"action": "open",
				"object": "star_powder",
				"param": {}
			}, url);
		},
		//open pay purse
		openPayPurse: function(url) {
			toolFunc({
				"action": "open",
				"object": "pay_purse",
				"param": {}
			}, url);
		},
		//open ingitation
		openIngitation: function(url) {
			toolFunc({
				"action": "open",
				"object": "ingitation",
				"param": {}
			}, url);
		},
		//open overseas buy
		openOverseasBuy: function(url) {
			toolFunc({
				"action": "open",
				"object": "overseas_buy",
				"param": {}
			}, url);
		},
		//open my life
		openMylife: function(url) {
			toolFunc({
				"action": "open",
				"object": "my_life",
				"param": {}
			}, url);
		},
		//open luxury life
		openLuxuryLife: function(url) {
			toolFunc({
				"action": "open",
				"object": "luxury_life",
				"param": {}
			}, url);
		},
		//open my fans show
		openMyFansShow: function(url) {
			toolFunc({
				"action": "open",
				"object": "my_fans_show",
				"param": {}
			}, url);
		},
		//open my coupon
		openMyCoupon: function(url) {
			toolFunc({
				"action": "open",
				"object": "my_coupon",
				"param": {}
			}, url);
		},
		//open my income
		openMyIncome: function(url) {
			toolFunc({
				"action": "open",
				"object": "my_income",
				"param": {}
			}, url);
		},
		//open my invited record
		openMyInvitedRecord: function(url) {
			toolFunc({
				"action": "open",
				"object": "my_invited_record",
				"param": {}
			}, url);
		},
		//open issue fans show
		openIssueFansShow: function(url) {
			toolFunc({
				"action": "open",
				"object": "issue_fans_show",
				"param": {}
			}, url);
		},
		//change nav Scan color
		changeNavScanColor: function(color, url) {
			toolFunc({
				"action": "change",
				"object": "nav_Scan_color",
				"param": color
			}, url);
		},
		//rock rock
		rockGet: function(callback, url) {
			toolFunc({
				"action": "rock",
				"object": "get",
				"param": callback
			}, url);
		},
		//rock rock
		rockOut: function(callback, url) {
			toolFunc({
				"action": "rock",
				"object": "out",
				"param": callback
			}, url);
		},
		//get ibeacon
		getIbeacon: function(callback, url) {
			toolFunc({
				"action": "get",
				"object": "ibeacon",
				"param": callback
			}, url);
		},
		//pop befor controller
		popBeforController: function(url) {
			toolFunc({
				"action": "pop",
				"object": "beforController",
				"param": {}
			}, url);
		},
		//send shareData
		sendShareData: function(callback, url) {
			toolFunc({
				"action": "send",
				"object": "shareData",
				"param": callback
			}, url);
		},
		//get token
		getToken: function(callback,url) {
			toolFunc({
				"action": "get",
				"object": "token",
				"param": callback
			}, url);
		},
		//openAdvs//link
		openAdvs: function(callback,url) {
			toolFunc({
				"action": "open",
				"object": "advs",
				"param": callback
			}, url);
		},
		// allProbe  //全民商探
		allProbe: function(url) {
			toolFunc({
				"action": "open",
				"object": "binding_bank",
				"param": {}
			}, url);
		}

	};
})();

//data属性模式
var webSdk = {
		goodsDetailObj     : "open-goods-detail",
		goodsDetailUrl     : ['http://item.test.soolife.cn/m/','.html'],
		instantBuyObj      : "open-instant-buy",
		instantBuyUrl      : ['http://orders.test.soolife.cn/m/order/index.html?skuid=','&qty=','&type=','&order_type=true'],
		instantBuyType     : 1,
		instantBuyNumber   : null,
		shopObj            : "open-shop",
		shopUrl            : ['http://store.test.soolife.cn/m/','.html'],
		newWebObj          : "open-new-web",
		scanCodeObj 	   : "open-scan-code",
		scanCodeKey 	   : "scancode",
		cartsObj           : "open-carts",
		cartsUrl           : ['http://orders.test.soolife.cn/m/index.html'],
		starPowderObj      : "open-star-powder",
		starPowderUrl      : ['http://m.test.soolife.cn/business.html'],
		payPurseObj        : "open-pay-purse",
		payPurseUrl        : [null],
		ingitationObj      : "open-ingitation",
		ingitationUrl      : ['http://m.test.soolife.cn/starfans.html'],
		overseasBuyObj     : "open-overseas-buy",
		overseasBuyUrl     : ['http://m.test.soolife.cn/seagood.html'],
		luxuryLifeObj      : "open-luxury-life",
		luxuryLifeUrl      : ['http://m.test.soolife.cn/life.html'],
		myFansShowObj      : "open-my-fans-show",
		myFansShowUrl      : ['http://i.test.soolife.cn/m/exist/mystarshow.html'],
		myCouponObj        : "open-my-coupon",
		myCouponUrl        : ['http://i.test.soolife.cn/m/exist/mycoupons.html'],
		myIncomeObj        : "open-my-income",
		myIncomeUrl        : ['http://i.test.soolife.cn/m/exist/income.html'],
		myInvitedRecordObj : "open-my-invited-record",
		myInvitedRecordUrl : ['http://i.test.soolife.cn/m/exist/questrecord.html'],
		addCartsObj 	   : "add-carts",
		addCartsUrl		   : ['http://item.test.soolife.cn/m/','.html'],
		addCartsNumber     : null,
		backHomeObj        : "back-home",
		backHomeUrl        : ['http://m.test.soolife.cn'],
		currentShareObj    : 'current-share',
		currentShareUrl    : [null],
		currentSharePara   : null,
		getTokenObj		   :"get-token-value",
		getTokenUrl		   :[null],
		shareObj 	       : "open-share",
		shareUrl 	       : [null],
		//下面功能正在开发中...没有调用....
		issueFansShowObj   : "open-issue-fans-show",
		issueFansShowUrl   : ['？？？'],
		rockGetObj         : "rock-get",
		rockGetUrl         : null,
		rockOutObj         : "rock-out",
		rockOutUrl         : null,
		getPlaceObj 	   : "get-place",
		getPlaceUrl 	   : null,
		getIbeaconObj	   : "get-ibacon",
		getIbeaconUrl	   : null,
		openAdvsObj 	   : "open-advs",
		allProbeObj        : "open-all-probe",
		allProbeUrl        : 'http://m.test.soolife.cn/setting/cash.html',
		b_event:function(){//绑定事件并调用；
			 this.openGoodsDetail();
			 this.openInstantBuy();
			 this.openShop();
			 this.openNewWeb();
			 this.openScanCode();
			 this.openCarts();
			 this.openStarPowder();
			 this.openPayPurse();
			 this.openIngitation();
			 this.openOverseasBuy();
			 this.openLuxuryLife();
			 this.openMyFansShow();
			 this.openMyCoupon();
			 this.openMyIncome();
			 this.openMyInvitedRecord();
			 this.addCarts();
			 this.backHome();
			 this.currentShare();
			 this.getTokenValue();
			 this.openShare();
			 this.openAdvs();
			 this.allProbe();
			 // this.openIssueFansShow();
			 // this.rockGet();
			 // this.rockOut();
			 // this.getPlace();
			 // this.getIbeacon();
		},
		getTokenValue:function(){//获得token值；
			if(!isApp) return;
			var that = this;
			var btn = document.getElementsByClassName(this.getTokenObj);//分享当前页web
			for(var i = 0;i < btn.length;i++){
				btn[i].addEventListener('click',function(){
					var _href = that.getTokenUrl[0];
					appSDK.getToken({
						success:function(argument){
							alert(argument);
						}
					},_href);
				});
			};
		},
		currentShare:function(){//分享当前页；
			var that = this;
			if(isApp){//分享当前页app
				setTimeout(function(){
					appSDK.sendShareData(that.currentSharePara,null);
					appSDK.hideHUD();
				},500);
				return;
			};
			var btn = document.getElementsByClassName(this.currentShareObj);//分享当前页web
			for(var i = 0;i < btn.length;i++){
				btn[i].onclick = function(){
					var _href = that.currentShareUrl[0];
					appSDK.sendShareData(null,_href);//正在开发...
				};
			};
		},
		backHome:function(){//回到首页；
			var that = this;
			var openbackHomeBtn = document.getElementsByClassName(this.backHomeObj);
			for(var i = 0;i < openbackHomeBtn.length;i++){
				openbackHomeBtn[i].onclick = function(){
					var _href = that.backHomeUrl[0];
					appSDK.popBeforController(_href);
				};
			};
		},
		openGoodsDetail:function(){//打开商品详情页；
			var that = this;
			var openGoodsDetailBtn = document.getElementsByClassName(this.goodsDetailObj);
			for(var i = 0;i < openGoodsDetailBtn.length;i++){
				openGoodsDetailBtn[i].onclick = function(){
					var _id = this.dataset.goodsId;
					var _href = that.goodsDetailUrl[0] +_id +that.goodsDetailUrl[1];
					appSDK.openGoodsDetail({sku_id:_id}, _href);
				};
			};
		},
		openInstantBuy:function(){//立即购买；
			var that = this;
			var openInstantBuyBtn = document.getElementsByClassName(this.instantBuyObj);
			for(var i = 0;i < openInstantBuyBtn.length;i++){
				openInstantBuyBtn[i].onclick = function(){
					var _id = this.dataset.goodsId;
					var BuyN = that.instantBuyNumber || 1;
					var BuyT = that.instantBuyType || 1;
					var _href = that.instantBuyUrl[0] +_id+ that.instantBuyUrl[1] +BuyN+ that.instantBuyUrl[2] +BuyT+ that.instantBuyUrl[3];
					 
					appSDK.openInstantBuy({instant_item_type:BuyT, instant_item_id:_id, instant_item_qty:BuyN}, _href);
				};
			};
		},
		openShop:function(){//打开店铺；
			var that = this;
			var openShopBtn = document.getElementsByClassName(this.shopObj);
			for(var i = 0;i < openShopBtn.length;i++){
				openShopBtn[i].onclick = function(){
					var _id = this.dataset.shopId;
					var _href = that.shopUrl[0] +_id +that.shopUrl[1];
					appSDK.openShop({shop_id:_id}, _href);
				};
			};
		},
		openNewWeb:function(){
			var that = this;
			var newWebBtn = document.getElementsByClassName(this.newWebObj);
			for(var i = 0;i < newWebBtn.length;i++){
				newWebBtn[i].onclick = function(){
					var _href = this.dataset.newWebUrl;
					appSDK.openNewWeb(_href);
				};
			};
		},
		openScanCode:function(){//扫一扫
			var that = this;
			var openScanCodeBtn = document.getElementsByClassName(this.scanCodeObj);
			for(var i = 0;i < openScanCodeBtn.length;i++){
				openScanCodeBtn[i].onclick = function(){
					var _href = that.scanCodeKey;
					appSDK.openBarCode(_href);
				};
			};
		},
		openShare:function(){//分享；
			var that = this;
			var openShareBtn = document.getElementsByClassName(this.shareObj);
			for(var i = 0;i < openShareBtn.length;i++){
				openShareBtn[i].addEventListener('click',function(){
					var _href = that.shareUrl[0];
					var _imageUrl =this.dataset.shareImageUrl;
					var _title = this.dataset.shareTitle;
					var _desc = this.dataset.shareDescTitle;
					var _link = this.dataset.shareLink;
					appSDK.openShare({
										imageURL:_imageUrl,
										title:_title,
										desc:_desc,
										link:_link
					}, _href);
				});
			};
		},
		openCarts:function(){//打开购物车
			var that = this;
			var openCartsBtn = document.getElementsByClassName(this.cartsObj);
			for(var i = 0;i < openCartsBtn.length;i++){
				openCartsBtn[i].onclick = function(){
					var _href = that.cartsUrl[0];
					appSDK.openCarts(_href);
				};
			};
		},
		openStarPowder:function(){//全民商探
			var that = this;
			var openStarPowderBtn = document.getElementsByClassName(this.starPowderObj);
			for(var i = 0;i < openStarPowderBtn.length;i++){
				openStarPowderBtn[i].onclick = function(){
					var _href = that.starPowderUrl[0];
					appSDK.openStarPowder(_href);
				};
			};
		},
		openPayPurse:function(){//钱包充值
			var that = this;
			var openPayPurseBtn = document.getElementsByClassName(this.payPurseObj);
			for(var i = 0;i < openPayPurseBtn.length;i++){
				openPayPurseBtn[i].onclick = function(){
					var _href = that.payPurseUrl[0];
					appSDK.openPayPurse(_href);
				};
			};
		},
		openIngitation:function(){//星粉联
			var that = this;
			var openIngitationBtn = document.getElementsByClassName(this.ingitationObj);
			for(var i = 0;i < openIngitationBtn.length;i++){
				openIngitationBtn[i].onclick = function(){
					var _href = that.ingitationUrl[0];
					appSDK.openIngitation(_href);
				};
			};
		},
		openOverseasBuy:function(){//海外购
			var that = this;
			var openOverseasBuyBtn = document.getElementsByClassName(this.overseasBuyObj);
			for(var i = 0;i < openOverseasBuyBtn.length;i++){
				openOverseasBuyBtn[i].onclick = function(){
					var _href = that.overseasBuyUrl[0] ;
					appSDK.openOverseasBuy(_href);
				};
			};
		},
		openLuxuryLife:function(){//领星币
			var that = this;
			var openLuxuryLifeBtn = document.getElementsByClassName(this.luxuryLifeObj);
			for(var i = 0;i < openLuxuryLifeBtn.length;i++){
				openLuxuryLifeBtn[i].onclick = function(){
					var _href = that.luxuryLifeUrl[0];
					appSDK.openLuxuryLife(_href);
				};
			};
		},
		openMyFansShow:function(){//会员星粉秀列表
			var that = this;
			var openMyFansShowBtn = document.getElementsByClassName(this.myFansShowObj);
			for(var i = 0;i < openMyFansShowBtn.length;i++){
				openMyFansShowBtn[i].onclick = function(){
					var _href = that.myFansShowUrl[0];
					appSDK.openMyFansShow(_href);
				};
			};
		},
		openMyCoupon:function(){//会员优惠券列表
			var that = this;
			var openMyCouponBtn = document.getElementsByClassName(this.myCouponObj);
			for(var i = 0;i < openMyCouponBtn.length;i++){
				openMyCouponBtn[i].onclick = function(){
					var _href = that.myCouponUrl[0] ;
					appSDK.openMyCoupon(_href);
				};
			};
		},
		openMyIncome:function(){//我的收入
			var that = this;
			var openMyIncomeBtn = document.getElementsByClassName(this.myIncomeObj);
			for(var i = 0;i < openMyIncomeBtn.length;i++){
				openMyIncomeBtn[i].onclick = function(){
					var _href = that.myIncomeUrl[0];
					appSDK.openMyIncome(_href);
				};
			};
		},
		openMyInvitedRecord:function(){//邀请纪录
			var that = this;
			var openMyInvitedRecordBtn = document.getElementsByClassName(this.myInvitedRecordObj);
			for(var i = 0;i < openMyInvitedRecordBtn.length;i++){
				openMyInvitedRecordBtn[i].onclick = function(){
					var _href = that.myInvitedRecordUrl[0] ;
					appSDK.openMyInvitedRecord(_href);
				};
			};
		},
		addCarts:function(){//添加购物车
			var that = this;
			var addCartsBtn = document.getElementsByClassName(this.addCartsObj);
			for(var i = 0;i < addCartsBtn.length;i++){
				addCartsBtn[i].onclick = function(){
					var _id = this.dataset.goodsId;
					var _href = that.addCartsUrl[0]+_id+that.addCartsUrl[1] ;
					var n = that.addCartsN ||1;
					appSDK.addCarts({
									sku_id: _id,
	  	 							   qty: n,
	  	 	 					    success: function(argument) {//添加成功的回调
	 	      									// alert(argument);
	  	  							},
	  								error: function(argument) {
	  	      									alert(argument);
	  	  							}
					},_href);
				};
			};
		},
		openIssueFansShow:function(){//发布星粉秀
			var that = this;
			var openIssueFansShowBtn = document.getElementsByClassName(this.issueFansShowObj);
			for(var i = 0;i < openIssueFansShowBtn.length;i++){
				openIssueFansShowBtn[i].onclick = function(){
					var _id = this.dataset.id;
					var _href = that.issueFansShowUrl[0];
					appSDK.openIssueFansShow(_href);
				};
			};
		},
		rockGet:function(){//订阅摇一摇
			var that = this;
			var rockGetBtn = document.getElementsByClassName(this.rockGetObj);
			for(var i = 0;i < rockGetBtn.length;i++){
				rockGetBtn[i].onclick = function(){
					var _href = that.rockGetUrl;
					appSDK.rockGet({
									success: function(argument) {//收到摇一摇动作完成的回调
	    								alert(argument);
									},
									error: function(argument) {
	   									alert(argument);
									}
					},_href);
				};
			};
		},
		rockOut:function(){//取消订阅摇一摇
			var that = this;
			var rockOutBtn = document.getElementsByClassName(this.rockOutObj);
			for(var i = 0;i < rockOutBtn.length;i++){
				rockOutBtn[i].onclick = function(){
					var _href = that.rockOutUrl;
					appSDK.rockOut(_href);
				};
			};
		},
		getPlace:function(){//得到经纬度
			var that = this;
			var getPlaceBtn = document.getElementsByClassName(this.getPlaceObj);
			for(var i = 0;i < getPlaceBtn.length;i++){
				getPlaceBtn[i].onclick = function(){
					var _href = that.getPlaceUrl;
					appSDK.getPlace({
									success: function(argument) {//收到经纬度的回调
    										alert(argument);
									},
									error: function(argument) {
    										alert(argument);
									}
					},_href);
				};
			};
		},
		getIbeacon:function(){//获取ibeacon
			var that = this;
			var getIbeaconBtn = document.getElementsByClassName(this.getIbeaconObj);
			for(var i = 0;i < getIbeaconBtn.length;i++){
				getIbeaconBtn[i].onclick = function(){
					var _href = that.getIbeaconUrl;
					appSDK.getIbeacon({
									success: function(argument) {//收到ibeacon设备列表的回调
					            			alert(argument);
					        		},
									error: function(argument) {
					            			alert(argument);
					      }
					},_href);
				};
			};
		},
		openAdvs:function(){//获取ibeacon 
			var objBtn = document.getElementsByClassName(this.openAdvsObj);
			for(var i = 0;i < objBtn.length;i++){
				// console.log(objBtn[i])
				objBtn[i].onclick = function(){
					var _href = this.dataset.advHref;
					appSDK.openAdvs({link: _href},_href);
				};
			};
		},
		allProbe:function(){//全民商探 
			var that = this;
			var objBtn = document.getElementsByClassName(this.allProbeObj);
			for(var i = 0;i < objBtn.length;i++){
				objBtn[i].onclick = function(){
					 var _href = that.allProbeUrl ;
					appSDK.allProbe(_href);
				};
			};
		}
};//<webSdk--end>
webSdk.b_event();
//Js模式
function BaseSdk(){};
	BaseSdk.prototype.backHome = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href  =href ||'http://m.test.soolife.cn';
				appSDK.popBeforController(_href);
			};
		};
	};
	BaseSdk.prototype.openGoodsDetail = function(obj,id,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://item.test.soolife.cn/m/'+ id +'.html';
				appSDK.openGoodsDetail({sku_id:id}, _href);
			};
		};
	};
	BaseSdk.prototype.openInstantBuy = function(obj,id,objPara){
		var obj = document.querySelectorAll(obj);
		var objFPara = objPara || {};
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var buyT = objFPara.buyType || 1;
				var buyN = objFPara.buyNumber || 1;
				var _href = objFPara.href || 'http://orders.test.soolife.cn/m/order/index.html?skuid='+id+'&qty='+buyN+'&type='+buyT+'&order_type=true';
				appSDK.openInstantBuy({instant_item_type:buyT, instant_item_id:id, instant_item_qty:buyN}, _href);
			};
		};
	};
	BaseSdk.prototype.openShop = function(obj,id,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://store.test.soolife.cn/m/'+ id +'.html';
				appSDK.openShop({shop_id:id}, _href);
			};
		};
	};
	BaseSdk.prototype.openNewWeb = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href;
                if(!_href) return;
				appSDK.openNewWeb(_href);
			};
		};
	};
	BaseSdk.prototype.openScanCode = function(obj){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = 'scancode';
				appSDK.openBarCode(_href);
			};
		};
	};
	BaseSdk.prototype.openCarts = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://orders.test.soolife.cn/m/index.html';
				appSDK.openCarts(_href);
			};
		};
	};
	BaseSdk.prototype.openStarPowder = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://m.test.soolife.cn/business.html';
				appSDK.openStarPowder(_href);
			};
		};
	};
	BaseSdk.prototype.openPayPurse = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || null;
				appSDK.openPayPurse(_href);
			};
		};
	};
	BaseSdk.prototype.openIngitation = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://m.test.soolife.cn/starfans.html';
				appSDK.openIngitation(_href);
			};
		};
	};
	BaseSdk.prototype.openOverseasBuy = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href|| 'http://m.test.soolife.cn/seagood.html';
				appSDK.openOverseasBuy(_href);
			};
		};
	};
	BaseSdk.prototype.openLuxuryLife = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://m.test.soolife.cn/life.html';
				appSDK.openLuxuryLife(_href);
			};
		};
	};
	BaseSdk.prototype.openMyFansShow = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://i.test.soolife.cn/m/exist/mystarshow.html';
				appSDK.openMyFansShow(_href);
			};
		};
	};
	BaseSdk.prototype.openMyCoupon = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://i.test.soolife.cn/m/exist/mycoupons.html';
				appSDK.openMyCoupon(_href);
			};
		};
	};
	BaseSdk.prototype.openMyIncome = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://i.test.soolife.cn/m/exist/income.html';
				appSDK.openMyIncome(_href);
			};
		};
	};
	BaseSdk.prototype.openMyInvitedRecord = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || 'http://i.test.soolife.cn/m/exist/questrecord.html';
				appSDK.openMyInvitedRecord(_href);
			};
		};
	};
	BaseSdk.prototype.addCarts = function(obj,id,objPara){
		var obj = document.querySelectorAll(obj);
		var objFPara = objPara || {};
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = objFPara.href || 'http://item.test.soolife.cn/m/'+id+'.html';
				var addN = objFPara.addNumber || 1;
				appSDK.addCarts({
								sku_id: id,
	   							   qty: addN,
	   	 					   success: function(argument) {//添加成功的回调
	      									alert(argument);
									   },
								 error: function(argument) {
	      									alert(argument);
									   }
				}, _href);
			};
		};
	};
	BaseSdk.prototype.openShare = function(obj,objPara){
		var objs = document.querySelectorAll(obj);
		var objFPara = objPara || {};
		for(var i = 0;i < objs.length;i++){
			objs[i].onclick = function(){
				var _href = objFPara.href || null;
				var _imageURL =objFPara.imgurl ||null;
				var _title = objFPara.title||null;
				var _desc = objFPara.descTitle||null;
				var _link = objFPara.link||null;
				appSDK.openShare({
									imageURL:_imageURL,
									title:_title,
									desc:_desc,
									link:_link
				}, _href);
			};
		};
	};
	//功能正在开发中...
	BaseSdk.prototype.openMylife = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || '???';
				appSDK.openMylife(_href);
			};
		};
	};
	BaseSdk.prototype.openIssueFansShow = function(obj,href){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = href || '???';
				appSDK.openIssueFansShow(_href);
			};
		};
	};

	BaseSdk.prototype.rockGet = function(obj){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				appSDK.rockGet({
								success: function(argument) {
									//showMessage(argument);
								},
								error: function(argument) {
									//showMessage(argument);
								}
				});
			};
		};
	};
	BaseSdk.prototype.rockOut = function(obj){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				appSDK.rockOut();
			};
		};
	};
	BaseSdk.prototype.getPlace = function(obj){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				appSDK.getPlace({
								success: function(argument) {
										//showMessage(argument);
								},
								error: function(argument) {
										//showMessage(argument);
								}
				});
			};
		};
	};
	BaseSdk.prototype.getIbeacon = function(obj){
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				appSDK.getIbeacon({
								success: function(argument) {
				            			//showMessage(argument);
				        		},
								error: function(argument) {
				            			//showMessage(argument);
				        	    }
				});
			};
		};
	};
	BaseSdk.prototype.getTokenValue = function(obj){
		if(!isApp) return;
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
				obj[i].addEventListener('click',function(){
					var _href = null;
					appSDK.getToken({
						success:function(argument){
							alert(argument);
						}
					},_href);
				});
			};
	};
	BaseSdk.prototype.currentShare = function(obj,objPara){//分享当前页web
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = null;
				appSDK.sendShareData(null,_href);
			};
		};
	};
	BaseSdk.prototype.allProbe = function(obj,objPara){//全民商探
		var obj = document.querySelectorAll(obj);
		for(var i = 0;i < obj.length;i++){
			obj[i].onclick = function(){
				var _href = null;
				appSDK.allProbe(null,_href);
			};
		};
	};

