$(function(){
	$('#carousel-index').on('slide.bs.carousel', function (e) { 
		var item = $(e.relatedTarget);
		var bgimage = item.attr('data-bgimage');
		var bgcolor = item.attr('data-bgcolor');
		$("#banner").attr('style',"background: "+ bgcolor +" url('"+ bgimage+"') no-repeat center center;");
		
		var img = item.children('img').eq(0);
		img.css({ "width": "850px", "height": "510px" });
		img.animate({ 
    		"width": "780px",
    		"height": "468px"
  		}, 4000 );
		//console.log(item.children('img').eq(0));
	});
	$('#carousel-index  img').eq(0).animate({ 
    		"width": "780px",
    		"height": "468px"
  	}, 4000 );
});
