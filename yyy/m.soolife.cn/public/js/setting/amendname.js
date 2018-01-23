$(function(){
	$(".finish").click(function(){
		var nickname = $('input[name=nickname]').val();
		console.log(nickname);
		var len = nickname.length;
		if(nickname == ""){
			//  setTimeout(function(){
			// $("#alert_mark").html('昵称由2-20个字符组成');
			//  	 $("#alert_mark").show();
			//  },3000); 
			 alert_mark("昵称由2-20个字符组成",3000);
			return false;
		}

		if(len<2 || len>20){
			// $("#alert_mark").html('不符合命名规则');
			// setTimeout(function(){
			//  	 $("#alert_mark").show();
			//  },3000); 
			alert_mark("不符合命名规则",3000); 
			return false;
		}
		
		$.ajax({
				url : '/setting/amendname.html',
				type : "post", 
				data : {
					"nickname":nickname
				},
				dataType: "json",		
				success: function(d) {
					if(d.success){
						alert("修改成功!");
						window.location.href = '/setting/safeset.html';
					}else{
						// $("#error").html('昵称已存在,您可以换个试试');
						// $("#error").show();
					}
				}
			});
		 
	});
// 弹出框
     function alert_mark(str,time){
       $('#alert_mark').html(str);
       $('#alert_mark').show();
       setTimeout(function(){$('#alert_mark').hide();},time);
     };//alert_mark('库存不足');
})