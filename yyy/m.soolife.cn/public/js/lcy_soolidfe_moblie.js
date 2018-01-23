(function(){	
	mui.init({
		swipeBack:true //启用右滑关闭功能
	});
	var slider = mui("#slider");

	slider.slider({//轮播
		interval: 2000
	});

	(function($) {//懒加载...
		$(document).imageLazyload({
			placeholder: '/public/img/index/loading.gif'
		});  
	})(mui);
//点击热门搜索遮罩出现

	var y_search_box = $('#search_box');
	var y_search_page = $('.search_page');
	var y_content = $('.mui-content');
	var y_header = $('.header_top');
	var y_hide_x = $('.hide_x');
	y_search_box.click(function(){
		y_search_page.show();
		y_content.hide();
		y_header.hide();
	})
	y_hide_x.click(function(){
		y_search_page.hide();
		y_header.show();
		y_content.show();
	})

	 //zhichao_hu 
    //缓动返回顶部
	function myEvent(obj,ev,fn){
		if(obj.attachEvent){
			obj.attachEvent('on'+ev,fn);
		}else{
			obj.addEventListener(ev,fn,false);
		}
	}
	myEvent(window,'load',function(){
		var oRTT=document.getElementById('to_head');
		var pH=document.documentElement.clientHeight;
		var timer=null;
		var scrollTop;
		window.onscroll=function(){
			scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
			if(scrollTop>=pH){
				oRTT.style.display='block';
			}else{
				oRTT.style.display='none';
			}
			return scrollTop;
		};
		oRTT.onclick=function(){
			clearInterval(timer);
			timer=setInterval(function(){
				var now=scrollTop;
				var speed=(0-now)/10;
				speed=speed>0?Math.ceil(speed):Math.floor(speed);
				if(scrollTop==0){
					clearInterval(timer);
				}
				document.documentElement.scrollTop=scrollTop+speed;
				document.body.scrollTop=scrollTop+speed;
			}, 30);
		}
	});

})();


