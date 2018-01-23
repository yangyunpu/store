	var _video = document.getElementsByClassName('lj_video')[0];
	var lj_vopen = document.getElementsByClassName('lj_vopen')[0];
	var lj_vmp4 = document.getElementsByClassName('lj_vmp4')[0];
	var lj_close = document.getElementsByClassName('lj_close')[0];
	var _li = _video.getElementsByTagName('li');
	for(var i=0;i<_li.length;i++){
		_li[i].onclick = function(){
			var videoSrc = this.getAttribute('data-video');
			var	str = '<video src="'+videoSrc+'" autoplay="autoplay" controls="controls" style="width:728px;height:516px;">您的浏览器不支持 video 标签。</video>';
			lj_vopen.innerHTML = str;
			lj_vmp4.style.display = 'block';
		};
	}
	lj_close.onclick = function(){
			lj_vopen.innerHTML = '';
			lj_vmp4.style.display = 'none';
	};

