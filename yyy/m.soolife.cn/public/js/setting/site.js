$(function(){
	$(".no_sle").on('click',function(){   
	   	var addressid = $(this).data('value'); 
     	var _src = $(this).attr("src");
     	var _src1 = "/public/img/setting/Rectangle 5 Copy@2x.png";
     	var _src2 = "/public/img/setting/Group 21@2x.png";
     	if(_src == _src1 ){
     	    $(this).attr("src",_src2);
              var v = $(this).attr("data-v");
              $(this).parents(".address").siblings(".address").find('.approve').find("img").attr("src",_src1);
       	}else{
     		$(this).attr("src",_src1);
     	}

        changeAdd(addressid)
     })

    function changeAdd(addressid){
    	$.ajax({
			url: '/setting/default_address',
			type: 'POST',
			dataType: 'json',
			data: {
				"addressid": addressid
			},
			success:function(res){
				if(res.success){
					alert_mark('默认地址设置成功',3000);
				} else {
					// alert('删除失败');
					alert_mark('默认地址设置失败',3000);

				}
			}
		});
    }




	 //删除
	 $(".select").on("click",function(){
	 	var _this = $(this).parents(".address");
	 	var num = $(this).data('value');
	 	delectAjax(num,_this);
	 })  

	 function delectAjax(id,_this){
			$.ajax({
				url: '/setting/delect',
				type: 'POST',
				dataType: 'json',
				data: {
					"id": id
				},
				success:function(res){
					if(res.success){
	 					_this.remove();
						// alert('删除成功');
						alert_mark('删除成功',3000);
					} else {
						// alert('删除失败');
						alert_mark('删除失败',3000);

					}
				}
			});
		};

		// 弹出框
		function alert_mark(str,time){
		  $('#alert_mark').html(str);
		  $('#alert_mark').show();
		  setTimeout(function(){$('#alert_mark').hide();},time);
		};//alert_mark('库存不足');

})