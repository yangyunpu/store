// $(function(){
//   var speed=50; 
// 	 marquePic2.innerHTML=marquePic1.innerHTML;
// 	  function Marquee(){   
// 	  if(demo.scrollLeft>=marquePic1.scrollWidth)     
// 	  {
// 	       demo.scrollLeft=0;
// 	  }
// 	  else
// 	  {
// 	   demo.scrollLeft++; 
// 	  }
// 	  } 
// 	  var MyMar=setInterval(Marquee,speed) 
// 	  demo.onmouseover=function() { clearInterval(MyMar);  } 
// 	  demo.onmouseout=function() { MyMar=setInterval(Marquee,speed);
// 	 } 
// })
$(function(){

	$('.slides .icons li').not('.ups,.downs').mouseenter(function(){
		$('.slides .infos').addClass('hovers');
		$('.slides .infos li').hide();
		$('.slides .infos li.'+$(this).attr('class')).show();//.slide .info li.qq
	});
	$('.slides').mouseleave(function(){
		$('.slides .infos').removeClass('hovers');
	});
	
	$('#btns').click(function(){
		$('.slides').toggle();
		if($(this).hasClass('index_cy')){
			$(this).removeClass('index_cy');
			$(this).addClass('index_cy2');
		}else{
			$(this).removeClass('index_cy2');
			$(this).addClass('index_cy');
		}
		
	});
	// 左右文字滚动
	var demo = document.getElementById("demo");
	var demo1 = document.getElementById("demo1");
	var demo2 = document.getElementById("demo2");
	demo2.innerHTML=document.getElementById("demo1").innerHTML;
	function Marquee(){
		if(demo.scrollLeft-demo2.offsetWidth>=0){
		   demo.scrollLeft-=demo1.offsetWidth;
		}
		else{
		   demo.scrollLeft++;
		}
	}
	var myvar=setInterval(Marquee,30);
	demo.onmouseout=function (){myvar=setInterval(Marquee,30);}
	demo.onmouseover=function(){clearInterval(myvar);}
});