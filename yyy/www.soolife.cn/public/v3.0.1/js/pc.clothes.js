$(function(){
    $('#carousel-index').on('slide.bs.carousel', function (e) { 
		var item = $(e.relatedTarget);
		var bgimage = item.attr('data-bgimage');
		var bgcolor = item.attr('data-bgcolor');
		$(".banner").attr('style',"background: "+ bgcolor +" url('"+ bgimage+"') no-repeat top center;");
	});
});
