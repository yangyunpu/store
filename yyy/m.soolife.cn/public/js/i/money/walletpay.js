$(function  () {

	var _src1 = "/public/img/i/mine_zhifu_yuan@3x.png";
	var _src2 = "/public/img/i/mine_zhifu_d_yuan@3x.png";

     $(".way_check").click(function(){
          var _src = $(this).attr("src");
     	if(_src == _src1 ){
     	     $(this).attr("src",_src2)
               $(this).parents(".pay_pay").siblings(".pay_pay").find(".way_check").attr("src",_src1)
               
          }else{
               $(this).attr("src",_src1)
          }
     })
     // 确认支付
     $(".suc_pay").click(function () {
          var pay_way = ""; //付款方法
          var orderid = $("#order_id").val();
          $(".way_check").each(function  () {
               if($(this).attr("src") == _src2){
                    pay_way = $(this).prev(".way_txt").html();
               }
          })

          if(pay_way != ""){
               if(pay_way=="支付宝支付"){
                    $.ajax({
                         url: '/i/money/alipay.html',
                         type: 'POST',
                         async: false,
                         dataType: 'json',
                         data: {
                              'orderid':orderid
                         },
                         success:function(res){
                              console.log(res)
                              window.location.href = res.msg;
                         
                         }
                    });
               }else if(pay_way=="微信支付"){
                    $.ajax({
                         url: '/i/money/weixinpay.html',
                         type: 'POST',
                         async: false,
                         dataType: 'json',
                         data: {
                              'orderid':orderid
                         },
                         success:function(res){
                              console.log(res);
                              window.location.href = res.msg;
                         
                         }
                    });
               }

          }else{
              $("#mask_pay").show();
              $("#mask_pay").html("请选择支付方式!");
              setTimeout(function  () {
                $("#mask_pay").hide();   
              },2000) 
          }
     })

})