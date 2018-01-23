(function(){
	var lcy_lists = {
		b_event:function(){
			this.btn_click();
			this.toggle_btn();
		},
		btn_click:function(){
			var back2 = $('.lcy_lists .head .back2'); 
			var back3 = $('.lcy_lists .head .back3'); 
			var classify_top = $('.lcy_lists .head .back3 .classify_top');
			var back2_mark = $('.lcy_lists .head .back2 .back2_mark');
			var classify_li = $('.lcy_lists .head .back3 .classify_top .classify_list li');
			var lcy_lists = $('.lcy_lists');
			var back2_btn_list= $('.lcy_lists .head .back2 .back2_mark .back2_btn .back2_btn_list li');
			var btn2 = $('.lcy_lists .head .back2 .back2_mark .back2_btn .back2_btn_list li .btn2');
			var updata_hide = $('.lcy_lists .updata .men_img .hide');
			var updata = $('.lcy_lists .updata');
			var li_list = $('.lcy_lists .head_nav ul li');
			// back3点击事件
			back3.click(function(e){
				e.stopPropagation();
				classify_top.show();
			 	back2_mark.hide();
			 });
			lcy_lists.click(function(e){
			    classify_top.hide();
			});
			// back2点击事件	
			back2.click(function(e){
			 	back2_mark.show();
			});
			classify_li.bind("touchmove",function(e){
				e.stopPropagation();
   			});			
			back2_mark.bind("touchmove",function(e){
       			e.preventDefault();
   			});				
			back2_mark.click(function(e){
				e.stopPropagation();
			 	back2_mark.hide();
		    });
		    //点击list变色
		    li_list.click(function(){
		    	$(this).addClass('active');
		    	$(this).siblings().removeClass('active');
		    });
		    //点击更新店铺的叉
		    updata_hide.click(function(){
		    	updata.hide();
		    });

		},
		toggle_btn:function(){
			console.log(11);
			var toggle_btn = $('.lcy_lists .updata .men_img .men');
			var goods_big_box = $('.lcy_lists .updata .word');
			toggle_btn.click(function () {
				goods_big_box.stop().slideToggle(500);
			});			
		}
	}
	lcy_lists.b_event();
})()