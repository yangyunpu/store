$(function(){
	// var Olitie = document.getElementsByClassName("dotey");
 //    console.log(Olitie)
 //    for (var j = 0; j < Olitie.length; j++) {
	//    var oabtn = Olitie[j].getElementsByTagName("li");
 //    	for (var i = 0; i < oabtn.length; i++) {
 //    		 // console.log(oabtn.length);
 //    		 if(oabtn.length>3){
 //    		 	Olitie[j].style.width = oabtn.length*4.53333+'rem';
 //    		 }
 //    	}
 //    };
	$(".lj_rule").click(function(){
		$(".rules").show();
		$(".lj_cha").click(function(){
			$(".rules").hide();
		})
	});

    if(isApp){
        // $(".header").hide();
        $("#download-nav").hide();
    }
});