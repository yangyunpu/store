(function(){
	function _statis(){
		var in_time = Date.parse(new Date());
		in_time = (in_time) ? in_time.toString() : '';

		// 获取上个页面地址
		var prev_url = document.referrer;
		prev_url = (prev_url != 'undefined') ? prev_url.toString() : '';

		// 当前页面url
		var currect_url = encodeURIComponent(location.href);
		currect_url = (currect_url != 'undefined') ? currect_url.toString() : '';

		var userAgent = navigator.userAgent;
		userAgent = (userAgent != 'undefined') ? userAgent.toString() : '';

		// 终端
		var platform = platform();
		platform = (platform != 'undefined') ? platform.toString() : '';

		var member_identifier = '';
		var history_id = '';

        //cookie
		cookie_arr = document.cookie.split(";")
		if (cookie_arr) {
			for (i in cookie_arr) {
				//history_id
				if (cookie_arr[i].match(/(\S*)=/)[1] == 'history_id') {
						var history_id = cookie_arr[i].match(/=(\S*)/)[1];
						history_id = (history_id != 'undefined') ? history_id.toString() : '';
				}
				//member_identifier
				if (cookie_arr[i].match(/(\S*)=/)[1] == 'member_identifier') {
						member_identifier = cookie_arr[i].match(/=(\S*)/)[1];
						member_identifier = member_identifier ? member_identifier.toString() : '';
				}
			}
		}

		function platform() {
			var ua = navigator.userAgent,
			isAndroid = /(?:Android)/.test(ua),
			isFireFox = /(?:Firefox)/.test(ua),
			isSymbian = /(?:SymbianOS)/.test(ua) || isWindowsPhone,
			isWindowsPhone = /(?:Windows Phone)/.test(ua),
			// isChrome = /(?:Chrome|CriOS)/.test(ua),
			isTablet = /(?:iPad|PlayBook)/.test(ua) || (isAndroid && !/(?:Mobile)/.test(ua)) || (isFireFox && /(?:Tablet)/.test(ua)),
			isiPhone = /(?:iPhone)/.test(ua) && !isTablet,
			isPc = !isiPhone && !isAndroid && !isSymbian;
			return (isTablet ? 'Tablet' : (isiPhone ? 'iphone' : (isAndroid ? 'android' : (isPc ? 'pc' : 'unknow'))))
		};

		window.onload=function(){
	     	var loaded_time = Date.parse(new Date())
	        var url  = 'http://statis.soolife.loc/index/collect?';
	     	var _url =  'in_time='+in_time+'&prev_url='+prev_url+'&currect_url='+currect_url+'&userAgent='+userAgent+'&platform='+platform+'&history_id='+history_id+'&member_identifier='+member_identifier+'&loaded_time='+loaded_time;

	     	var full = url + _url;

			var script = document.createElement( "script" );
			script.src = full;
			document.head.appendChild(script);
			//console.log(full);
		}
	}

	_statis();

})()