$('.navbar').find('.catalogmenu li').each(function(index){
    var number=index;
	$(this).on('mouseover',function(){
          if(number=='9'){			
			$('.catalogpannel').find('.pannel:eq(9)').css({width:'1000px',height:'620px'});
			$('.catalogpannel').find('.pannel:eq(9)').find('.tags-bd p').css({width:'250px'});
			$('.catalogpannel').find('.pannel:eq(9)').find('.big-pic').css('right','-20px');
			$('.catalogpannel').find('.another').remove();
			var len=$('.catalogpannel').find('.pannel:eq(9)').find('.tags-bd').length;
			var str='';
			for(var i=8;i<=len-1;i++){
 				var content=$('.catalogpannel').find('.pannel:eq(9)').find('.tags-bd:eq('+i+')').html();
                $('.catalogpannel').find('.pannel:eq(9)').find('.tags-bd:eq('+i+')').hide();
			    content='<div class="tags-bd">'+content+'</div>';
				str+=content;
			}
			$('.catalogpannel').find('.pannel:eq(9)').append('<div class="another" style="padding-top:30px">'+str+'</div>');
		}
		var imglink=$(this).find('i').css('backgroundImage');
		var arr=[];
		arr=imglink.split('.');
		var len=arr.length;
			arr[len-2]=arr[len-2].substring(0,arr[len-2].length-1)+'2';
			var newlink=arr.join('.');	
			$(this).find('i').css('background',newlink);
			$(this).find('a').css('color','#ECA000');
			$(this).find('span').css('color','#ECA000');		
	});
  	$(this).on('mouseout',function(){  
		  var imglink=$(this).find('i').css('backgroundImage');
			var arr=[];
			arr=imglink.split('.');
			var len=arr.length;
			arr[len-2]=arr[len-2].substring(0,arr[len-2].length-1)+'1';
			var newlink=arr.join('.');	
			$(this).find('i').css('background',newlink);
			$(this).find('a').css('color','#fff');
			$(this).find('span').css('color','#fff');
	});
});

$('.catalogpannel').find('.pannel').each(function(index){
    $(this).on('mouseover',function(){
    	var imglink=$('.navbar').find('.catalogmenu li:eq('+index+')').find('i').css('backgroundImage');
   		var arr=[];
   		arr=imglink.split('.');
   		var len=arr.length;
   		arr[len-2]=arr[len-2].substring(0,arr[len-2].length-1)+'2';
   		var newlink=arr.join('.');	
   		$('.navbar').find('.catalogmenu li:eq('+index+')').find('i').css('background',newlink);   
    	$('.navbar').find('.catalogmenu li:eq('+index+')').find('a').css('color','#ECA000');
    	$('.navbar').find('.catalogmenu li:eq('+index+')').find('span').css('color','#ECA000');    
    });
    $(this).on('mouseout',function(){ 
     	var imglink=$('.navbar').find('.catalogmenu li:eq('+index+')').find('i').css('backgroundImage');
   		var arr=[];
   		arr=imglink.split('.');
   		var len=arr.length;
   		arr[len-2]=arr[len-2].substring(0,arr[len-2].length-1)+'1';
   		var newlink=arr.join('.');	
   		$('.navbar').find('.catalogmenu li:eq('+index+')').find('i').css('background',newlink); 
    	$('.navbar').find('.catalogmenu li:eq('+index+')').find('a').css('color','#fff');
    	$('.navbar').find('.catalogmenu li:eq('+index+')').find('span').css('color','#fff');   
    });
	
});

$('.catalogpannel').find('.pannel').each(function(){	
	var len=$(this).find('p').length;
	$(this).find('p:eq('+(len-1)+')').css('borderBottom','none');
});

/*更多导航*/

$('.rightflo .navmore').on('mouseover',function(){	
	$(this).addClass('hover');
});

$('.rightflo .navmore').on('mouseout',function(){
	$(this).removeClass('hover');
});

