(function(){
	var lcy_edit = {
		b_event:function(){
			this.btn_click();
			this.toggle_btn();
		},
		btn_click:function(){
			var back2 = $('.lcy_edit .head .back2'); 
			var back3 = $('.lcy_edit .head .back3'); 
			var classify_top = $('.lcy_edit .head .back3 .classify_top');
			var back2_mark = $('.lcy_edit .head .back2 .back2_mark');
			var classify_li = $('.lcy_edit .head .back3 .classify_top .classify_list li');
			var lcy_edit = $('.lcy_edit');
			var back2_btn_list= $('.lcy_edit .head .back2 .back2_mark .back2_btn .back2_btn_list li');
			var btn2 = $('.lcy_edit .head .back2 .back2_mark .back2_btn .back2_btn_list li .btn2');
			var goods_mark = $('.lcy_edit .goods_list .goods_box .goods_mark');
			var success = $('.lcy_edit .success');
			var _delete = $('.lcy_edit .goods_list .goods_box .goods_mark .delete');
			var _up = $('.lcy_edit .goods_list .goods_box .goods_mark .up');
			var _down = $('.lcy_edit .goods_list .goods_box .goods_mark .down');
			var head_pic_mark = $('.lcy_edit .head_pic .head_pic_mark');
			var updata_hide = $('.lcy_edit .updata .men_img .hide');
			var updata = $('.lcy_edit .updata');
			var li_list = $('.lcy_edit .head_nav ul li');
			// back3点击事件
			back3.click(function(e){
				e.stopPropagation();
				classify_top.show();
			 	back2_mark.hide();
			 });
			lcy_edit.click(function(e){
			    classify_top.hide();
			 	//back2_mark.hide();
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
		    // 点击编辑
		    btn2.click(function(){
		    	goods_mark.show();
		    	head_pic_mark.show();
		    	success.show();
		    	updata.hide();
		    })
		    //点击删除
		    _delete.click(function(){
		    	console.log($(this));
		    	$(this).parents('.goods_box').remove();
		    });
		    //点击上移
		    _up.click(function(){
		    	var _this = $(this).parents('.goods_box');
		    	_this.insertBefore(_this.prev());
		    });
		    //点击下移
		    _down.click(function(){
		    	var _this = $(this).parents('.goods_box');
		    	_this.next().insertBefore(_this);
		    });
		    //点击完成
		    success.click(function(){
		    	$(this).hide();
		    	goods_mark.hide();
		    	head_pic_mark.hide();
		    });

		    //点击更新店铺的叉
		    updata_hide.click(function(){
		    	updata.hide();
		    });

		},
		toggle_btn:function(){
			var toggle_btn = $('.lcy_edit .updata .men_img .men');
			var goods_big_box = $('.lcy_edit .updata .word');
			toggle_btn.click(function () {
				goods_big_box.stop().slideToggle(500);
			});			
		}
	}
	lcy_edit.b_event();
})()