$(function() {
	$(".weixin").mouseover(function() {
		$(".hide_weixin").show()
	}), $(".weixin").mouseout(function() {
		$(".hide_weixin").hide()
	}), $(".sina").mouseover(function() {
		$(".hide_sina").show()
	}), $(".sina").mouseout(function() {
		$(".hide_sina").hide()
	}), $("#header .center").mouseenter(function() {
		$(".hide_center").addClass("hover")
	}), $("#header .center").mouseleave(function() {
		$(".hide_center").removeClass("hover")
	}), $("#header .headhelp").mouseenter(function() {
		$(".hide_headhelp").addClass("hover")
	}), $("#header .headhelp").mouseleave(function() {
		$(".hide_headhelp").removeClass("hover")
	}), $("#header .map").mouseenter(function() {
		$(".hide_map").addClass("hover")
	}), $("#header .map").mouseleave(function() {
		$(".hide_map").removeClass("hover")
	})
}), 
$(function() {
	$(".rtbar-top").hide(), $(window).scroll(function() {
		$(window).scrollTop() > 100 ? $(".rtbar-top").fadeIn(1e3) : $(".rtbar-top").fadeOut(1e3), $("div").hasClass("pindiv") && ($(window).scrollTop() > 650 ? $(".pindiv").fadeIn(500) : ($(".pindiv").fadeOut(500), $("#show-ad").size() > 0 && $("#show-ad").is(":visible") && ($("#closeshowad i.icon-double-angle-up").addClass("hide"), $("#closeshowad i.icon-double-angle-down").removeClass("hide"), $("#show-ad").slideUp("fast"))))
	}), $(".rtbar-tab-avatar img").mouseenter(function() {
		$(".rtbar-mbrcenter").show()
	}), $(".rtbar-mbrcenter").mouseleave(function() {
		$(".rtbar-mbrcenter").hide()
	}), $(".rtbar-tab-avatar img").click(function() {
		$(".rtbar-mbrcenter").is(":hidden") ? $(".rtbar-mbrcenter").show() : $(".rtbar-mbrcenter").hide()
	}), $(".rtbar-img").hover(function() {
		if (!$(this).parent().hasClass("rtbar-top")) {
			if ($(".rtbar_cart").is(":visible") && $(this).children().hasClass("icon-shopping-cart")) return !1;
			$(this).parent().next().show(), $(this).parent().next().animate({
				right: "35px",
				opacity: "1"
			}), $(this).parent().next().children(".rtbar-arrow").show(), $(this).parent().next().children(".rtbar-arrow").animate({
				opacity: "1"
			})
		}
	}), $(".rtbar-img").mouseleave(function() {
		$(this).parent().hasClass("rtbar-top") || ($(this).parent().next().animate({
			right: "75px",
			opacity: "0"
		}), $(this).parent().next().children(".rtbar-arrow").animate({
			opacity: "0"
		}), $(this).parent().next().hide(), $(this).parent().next().children(".rtbar-arrow").fadeOut())
	}), $(".rtbar-top .rtbar-img").hover(function() {
		return $(".rtbar_cart").is(":visible") && $(this).children().hasClass("icon-shopping-cart") ? !1 : ($(this).next().show(), $(this).next().animate({
			right: "35px",
			opacity: "1"
		}), $(this).next().children(".rtbar-arrow").show(), void $(this).next().children(".rtbar-arrow").animate({
			opacity: "1"
		}))
	}), $(".rtbar-top .rtbar-img").mouseleave(function() {
		$(this).next().animate({
			right: "75px",
			opacity: "0"
		}), $(this).next().children(".rtbar-arrow").animate({
			opacity: "0"
		}), $(this).next().hide(), $(this).next().children(".rtbar-arrow").fadeOut()
	}), $(".mini-cart-list i.icon-remove").click(function() {
		$(this).parents("li").hide()
	}), $(".rtbar .rtbar-cart").click(function() {
		$(".rtbar_cart").toggle(), $(".rtbar .rtbar-cart .rtbar-arrowbuy").toggle(), $(".rtbar_cart").is(":visible") && ($(this).parent().next().animate({
			right: "75px",
			opacity: "0"
		}), $(this).parent().next().children(".rtbar-arrow").animate({
			opacity: "0"
		}))
	}), $("#removecart").click(function() {
		$(".rtbar_cart").toggle(), $(".rtbar .rtbar-cart .rtbar-arrowbuy").toggle()
	}), $(".rtbar .rtbar-cart .rtbar-arrow").click(function() {
		$("#removecart").trigger("click")
	})
});

$(function(){
	$(".navitems .dl").hover(function(){
		$(this).toggleClass("hover");
	});
	$(".navitems .dl").mouseenter(function(){
		var dropmenu = $(this).find("i");
		$(dropmenu).removeClass("glyphicon-chevron-down");
		$(dropmenu).addClass("glyphicon-chevron-up");
	});
	$(".navitems .dl").mouseleave(function(){
		var dropmenu = $(this).find("i");
		$(dropmenu).removeClass("glyphicon-chevron-up");
		$(dropmenu).addClass("glyphicon-chevron-down");
	});
	
	$(".cw-icon").mouseenter(function(){
		$(".drop-layer").show();
	});
	$(".cw-icon").mouseleave(function(){
		$(".drop-layer").hide();
		
		$(".drop-layer").mouseenter(function(){
			$(".drop-layer").show();	
		});
		$(".drop-layer").mouseleave(function(){
			$(".drop-layer").hide();	
		});
	});
})































