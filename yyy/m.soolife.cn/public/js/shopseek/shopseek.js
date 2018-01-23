$(function(){ 
	//点击我要做商探 
	$('.need').click(function(){
		$('.lj_agreement').show();
	
        // 点击同意
        $(".check").click(function () {
        	if($(this).is(':checked')){
                $('.lj_consent').addClass('color');  
        	}else{
        		 $('.lj_consent').removeClass('color'); 
        	}
        })
        $(".lj_consent").click(function(){
        	if($(this).is('.color')){ 
                $.ajax({
                   url: '/shopseek/shopseek',
                   type: 'get', 
                   success:function( ){  
        		        $('.lj_agreement').hide();
        		        window.location.href ='/shopseek/shopmodel.html'; 
                        return;
                   },
                   error:function() {
                          
                         alert('签约错误'); 
                   }
              });
        	}else{
        		alert("请勾选同意");
        	}
        })
    })
    $(".lj_close").click(function(){ 
        $('.lj_agreement').hide();
    })
})