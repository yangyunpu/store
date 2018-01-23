$(function() {
  	$('[data-toggle="tooltip"]').tooltip();
  	
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
        $(".category-menus").hasClass("hide") && $(".category-menus").removeClass("hide"),
        $(".category-menus").is(":hidden") ? ($(".category-menus").show(), $(this).children("i").removeClass("fa-angle-down").addClass("fa-angle-up")) : ($(".category-menus").hide(), $(this).children("i").removeClass("fa-angle-up").addClass("fa-angle-down"));
   });
}); 