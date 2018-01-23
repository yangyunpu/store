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
	        title : '十万火急!', // 分享标题
	        desc : '充值立赠好礼，加入如此生活会员，立即开启购物"星"旅程!', // 分享描述
	        link : window.location.href, // 分享链接
	        imgUrl : 'https://sales.soolife.cn/public/mobile/img/hot/cash.png'// 分享图标
	    });
	    //分享到朋友圈
	    wx.onMenuShareTimeline({
	        title: '十万火急!充值立赠好礼，加入如此生活会员，立即开启购物"星"旅程!', // 分享标题
	        link: window.location.href, // 分享链接
	        imgUrl: 'https://sales.soolife.cn/public/mobile/img/hot/cash.png'// 分享图标
	    });
	    // 分享到QQ
	    wx.onMenuShareQQ({
	        title: '十万火急!', // 分享标题
	        desc:  '充值立赠好礼，加入如此生活会员，立即开启购物"星"旅程!', // 分享描述
	        link: window.location.href, // 分享链接
	        imgUrl: 'https://sales.soolife.cn/public/mobile/img/hot/cash.png' // 分享图标
	    });
	    // 分享到微博
	    wx.onMenuShareWeibo({
		    title: '十万火急!', // 分享标题
		    desc: '充值立赠好礼，加入如此生活会员，立即开启购物"星"旅程!', // 分享描述
		    link:  window.location.href, // 分享链接
		    imgUrl: 'https://sales.soolife.cn/public/mobile/img/hot/cash.png' // 分享图标
		});
		// 分享到QQ空间
		wx.onMenuShareQZone({
		    title: '十万火急!', // 分享标题
		    desc:  '充值立赠好礼，加入如此生活会员，立即开启购物"星"旅程!', // 分享描述
		    link:   window.location.href, // 分享链接
		    imgUrl: 'https://sales.soolife.cn/public/mobile/img/hot/cash.png' // 分享图标
		});
	});
})