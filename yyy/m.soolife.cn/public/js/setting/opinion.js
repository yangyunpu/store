$(function(){
	$(".li_suggest").click(function(){
		// alert(11);
		$(".effect").show();
	})
	//功能建议单选切换
	status = 11;
	$(".notyet").on('click',function(){     
          var _src = $(this).attr("src");
          var _src1 = "/public/img/setting/mine_zhifu_yuan@2x.png";
          var _src2 = "/public/img/shopseek/mine_zhifu_d_yuan@2x.png"; 
          if(_src == _src1 ){
              $(this).attr("src",_src2); 
              var  s =$(this).attr("data-s");
              status = $(this).attr("data-value");
              $('input[name=xiaxi]').val(s);
              console.log(s); 
              $(this).parent("li").siblings().find("img").attr("src",_src1);
          }else{
               $(this).attr("src",_src1);
          }

     })
	$(".lj_sure").click(function(){
		var text = $('input[name=xiaxi]').val();
		$(".effects").html(text);
		$(".effect").hide();
	})



// 点击提交功能
	$(".submit").click(function() {

		content = $(".back").val();
		if (content == "") {
			alert_mark("请输入建议",3000); 
			return false;
		}
		var phonereg = /^1[3|4|5|7|8][0-9]\d{8}$/;
		phone = $(".number").find('input').val();
		if (!check(phone).success) {
			alert_mark(check(phone).msg,3000);
			return false;
		}
		$.ajax({
			url : "/setting/opinion.html",
			type : "post",
			data : {
				'type' : status,
				'content' : content,
				'mobile' : phone,
			},
			dataType : "json",
			success : function(d) {
				if (d.success) {
					alert(d.msg);
					window.location.href = '/i/index/index.html';
				} else {
					alert(d.msg);
				}
			}
		});

	});
	// 验证手机号或者邮箱
	function check(value) {
		var res ={};
		res.success =true;
		res.msg = '';
		if (value == "") {
			res.success = true;
		}else if (value.indexOf("@") > 0) {
			var email = /^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i;
			if (!(email.test(value))) {
				res.success =false;
				res.msg = '邮箱输入不正确';
			}
		} else {
			var phone = /^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
			if(!(phone.test(value))){
				res.success =false;
				res.msg = '手机号码输入不正确';
			}
		}
		return res;
	}
	// 弹出框
     function alert_mark(str,time){
       $('#alert_mark').html(str);
       $('#alert_mark').show();
       setTimeout(function(){$('#alert_mark').hide();},time);
     };//alert_mark('库存不足');
})