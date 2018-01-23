(function(){
	var lcy_profile = {
		b_event:function(){
			this.btn_input();
			this.success_btn()
		},
		btn_input:function(){
			var that = this;
			var logo_img = $('.lcy_shopdatum .contain .logo img');
			var mark = $('.lcy_shopdatum .mark');
			logo_img.click(function(){
				mark.show();
				that.change_img();
				

			});
		},
		change_img:function(){
				var logo_img = $('.lcy_shopdatum .contain .logo img');
				//document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
				var clipArea = new bjj.PhotoClip("#clipArea", {
					size: [100, 100],
					outputSize: [200, 200],
					file: "#file",
					view: "#view",
					ok: "#clipBtn",
					loadStart: function() {
						console.log("照片读取中");
					},
					loadComplete: function() {
						console.log("照片读取完成");
					},
					clipFinish: function(dataURL) {
					console.log(dataURL); 
  					logo_img.attr('src',dataURL);					
					}
				});
				//clipArea.destroy();
		},

		success_btn:function(){
			$('.success').click(function(){
				$('.lcy_shopdatum .mark').hide()
			});
		}

	}
	lcy_profile.b_event();
})()

