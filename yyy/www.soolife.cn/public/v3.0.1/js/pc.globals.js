$(function() {
	try {
		if (window.console && window.console.log) {
			console.log("一张网页，要经历怎样的过程，才能抵达用户面前？\n一位新人，要经历怎样的成长，才能站在技术之巅？\n探寻这里的秘密；\n体验这里的挑战；\n成为这里的主人；");
			console.log("加入如此生活，加入真正的O2O电商平台，你，可以影响世界。");
			console.log("请将简历发送至  hr@soolife.com.cn（ 邮件标题请以“姓名-应聘XX职位-来自console”命名）");
		}
	} catch (e) { }

	// 懒加载
	$("img.lazy").lazyload();

	// 图片偏移动画
	$('.frame').on('mouseenter', function() {
		$(this).find('.move').animate({
			left: -6
		}, 100);
	}).on('mouseleave', function() {
		$(this).find('.move').animate({
			left: 0
		}, 100);
	});

	// begin 滚动事件
	/*var thematic_top = $("#thematic").offset().top;
	var scrollFun = function(){
		if ($(window).scrollTop() > thematic_top) {
			$('.backpanel').fadeIn(1000);
			$('.rtbar-rocket').fadeIn(1000);
		} else {
			$('.backpanel').fadeOut(1000);
			$('.rtbar-rocket').fadeOut(1000);
		}
	};
	$(window).scroll(function() {
		scrollFun();
	});
	scrollFun();*/
	// end 滚动事件

	// 分类事件
	// 商品分类事件
	$(".category-menus ul>li").mouseenter(function() {
		var tindex = $(this).index();
		$(this).addClass('selected').siblings().removeClass('selected');
		$(this).prev().addClass('selected-prev').siblings().removeClass('selected-prev');
		var catPtop = (tindex) * 40;
		$('.category-pannel').css('top', catPtop);
		$(".category-pannel .pannel").eq(tindex).show().siblings().hide();
		$(".category-pannel").animate({
			width : '960px'
		}, 500);
	});
	$(".category-dropdown").mouseleave(function() {
		$(".category-pannel").stop(true);
		$(".category-pannel .pannel").hide();
		$(".category-menus ul li").removeClass("selected");
		$(".category-menus ul li").removeClass("selected-prev");
		$(".category-pannel").css('width', '0px');
	});
	$(".category h4").click(function() {
		$(".category-menus").hasClass("hide") && $(".category-menus").removeClass("hide"), $(".category-menus").is(":hidden") ? ($(".category-menus").show(), $(this).children("i").removeClass("fa-angle-down").addClass("fa-angle-up")) : ($(".category-menus").hide(), $(this).children("i").removeClass("fa-angle-up").addClass("fa-angle-down"));
	});

	// 搜索
	$('.search_bar .main-container .control button').click(function(){
		do_search();
	})

	$(".s-combobox-input").on("keyup",function(e){
		if(e.which == 13){
			do_search();
		}
	});

	var do_search = function(name){
		if(name == undefined){
			var name = $.trim($(".s-combobox-input").val());
		}else{
			name = name
		}
		
		// var search_url = "http://search.soolife.loc";
		var search_url = $("#hidden").val();
		/*if(name == ""){
			return false;
		}*/
		$.base64.utf8encode = true;
		name = $.base64.btoa(name);
		name = name.replace(/\+/g, "-");
		window.location.href = search_url+"/search?keyword=" + name;
	};


	// 热门搜索自动补全
	    $(".s-combobox-input").bind("input propertychange",function(event) {
	        var _autoVal = $(this).val();
	        if(_autoVal == ""){
	            $(".search_display").show();
	            $(".search_display_list").hide();
	        }else{
	            $(".search_display").hide();
	            $(".search_display_list").show();
	        }
	        // console.log(_autoVal)
	        $.ajax({
	            url: '/index/searchAutoAjax.html',
	            type: 'POST',
	            dataType    : "json",
	            async       : false,
	            data: {keyword: _autoVal},
	            success:function(res){
	                $(".search_display_list").html("");
	                var data = res.data;
	                if(data != undefined){

		                for(var i=0; i<data.length; i++){
		                	if(data[i] != undefined){

		                    	var _li = '<li class="search_auto"  style="cursor:pointer;">'+data[i]['wd']+'</li>'
		                	}
		                    $(".search_display_list").append(_li)
		                } 
	                }
	            }
	        }) 
	    });
	    $(".search_bar").on("click",".search_auto",function(){
	    	var _name = $(this).html()
	    	do_search(_name);
	    })

	    
	// begin 右边侧栏事件
	$(".rtbar-avatar").mouseenter(function() {
		$(".rtbar-mbrcenter").show();
	});
	$(".rtbar-mbrcenter").mouseleave(function() {
		$(".rtbar-mbrcenter").hide();
	});
	$(".rtbar-mycart").click(function() {
		$(".sidebar-carts").show();
	});

	$(".rtbar-rocket .rtbar-icon").mouseenter(function() {
		if (($(".rtbar_cart").is(":visible")) && ($(this).children().hasClass('icon-shopping-cart'))) {
			return false;
		}
		$(this).next().show();
		$(this).next().animate({
			right : '35px',
			opacity : '1'
		});
		$(this).next().children('.rtbar-arrow').show();
		$(this).next().children('.rtbar-arrow').animate({
			opacity : '1'
		});
	});
	$(".rtbar-rocket .rtbar-icon").mouseleave(function() {
		$(this).next().animate({
			right : '75px',
			opacity : '0'
		});
		$(this).next().children('.rtbar-arrow').animate({
			opacity : '0'
		});
		$(this).next().hide();
		$(this).next().children('.rtbar-arrow').fadeOut();
	});
	$(".rtbar-tab .rtbar-icon").mouseenter(function(){
		$(this).next().show();
		$(this).next().animate({
			right : '35px',
			opacity : '1'
		});
		$(this).next().children('.rtbar-arrow').show();
		$(this).next().children('.rtbar-arrow').animate({
			opacity : '1'
		});
	});
	$(".rtbar-icon").mouseleave(function() {
		$(this).next(".rtbar-hint").animate({
			right: "75px",
			opacity: "0"
		});
	});
	// end 右边侧栏事件

});

