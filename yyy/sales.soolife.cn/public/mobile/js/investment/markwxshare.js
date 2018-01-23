$(function () {
	var _appId = $("input[name='appId']").val();
	var _timestamp = $("input[name='timestamp']").val();
	var _nonceStr = $("input[name='nonceStr']").val();
	var _signature = $("input[name='signature']").val();
	// console.log(_appId)
	// console.log(_timestamp)
	// console.log(_nonceStr)
	// console.log(_signature)
	wx.config({
	    // debug: true,
	    appId: _appId,
	    timestamp: _timestamp,
	    nonceStr: _nonceStr,
	    signature: _signature,
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	      'onMenuShareAppMessage',
	      'onMenuShareTimeline',
	      'onMenuShareQQ',
	      'onMenuShareWeibo',
	      'onMenuShareQZone'
	    ],
	  });
	  wx.ready(function () {
	    // 在这里调用 API
	    //分享给朋友
	    wx.onMenuShareAppMessage({
	        title : '拿来属于你的势!', // 分享标题
	        desc : '互联网+产业野蛮生长，卖货难问题已成为众多商家的困扰，如此生活创立专业快速渠道，省时省心，与您携手同创共赢之势', // 分享描述
	        link : window.location.href, // 分享链接
	        imgUrl : 'https://sales.soolife.cn/public/mobile/img/shi.jpg'// 分享图标
	    });
	    //分享到朋友圈
	    wx.onMenuShareTimeline({
	        title: '拿来属于你的势!互联网+产业野蛮生长，卖货难问题已成为众多商家的困扰，如此生活创立专业快速渠道，省时省心，与您携手同创共赢之势', // 分享标题
	        link: window.location.href, // 分享链接
	        imgUrl: 'https://sales.soolife.cn/public/mobile/img/shi.jpg'// 分享图标
	    });
	    // 分享到QQ
	    wx.onMenuShareQQ({
	        title: '拿来属于你的势!', // 分享标题
	        desc:  '互联网+产业野蛮生长，卖货难问题已成为众多商家的困扰，如此生活创立专业快速渠道，省时省心，与您携手同创共赢之势', // 分享描述
	        link: window.location.href, // 分享链接
	        imgUrl: 'https://sales.soolife.cn/public/mobile/img/shi.jpg' // 分享图标
	    });
	    // 分享到微博
	    wx.onMenuShareWeibo({
		    title: '拿来属于你的势!', // 分享标题
		    desc: '互联网+产业野蛮生长，卖货难问题已成为众多商家的困扰，如此生活创立专业快速渠道，省时省心，与您携手同创共赢之势', // 分享描述
		    link:  window.location.href, // 分享链接
		    imgUrl: 'https://sales.soolife.cn/public/mobile/img/shi.jpg' // 分享图标
		});
		// 分享到QQ空间
		wx.onMenuShareQZone({
		    title: '拿来属于你的势!', // 分享标题
		    desc:  '互联网+产业野蛮生长，卖货难问题已成为众多商家的困扰，如此生活创立专业快速渠道，省时省心，与您携手同创共赢之势', // 分享描述
		    link:   window.location.href, // 分享链接
		    imgUrl: 'https://sales.soolife.cn/public/mobile/img/shi.jpg' // 分享图标
		});
	});
})