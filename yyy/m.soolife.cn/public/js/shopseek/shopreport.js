$(function(){
     // 信息来源
 		// $(".slect").click(function(){


    // 城市选择器begin
     var area1 = new LArea();
      area1.init({
          'trigger': '#demo1', //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
          'valueTo': '#value1', //选择完毕后id属性输出到该位置
          'keys': {
              id: 'id',
              name: 'name'
          }, //绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
          'type': 1, //数据源类型
          'data': LAreaData //数据源
      }); 


    // 城市选择器end

    $(".slect").on('click',function(){     
     	var _src = $(this).attr("src");
     	var _src1 = "/public/img/shopseek/mine_zhifu_yuan@2x.png";
     	var _src2 = "/public/img/shopseek/mine_zhifu_d_yuan@2x.png";
     	console.log(_src)
     	if(_src == _src1 ){
     	    $(this).attr("src",_src2);
              var v = $(this).attr("data-v");
              $('input[name=fuzhi]').val(v); 
              console.log(v);
              $(this).parent("div").siblings().find("img").attr("src",_src1);
       	}else{
     		$(this).attr("src",_src1);
     	}
    })
     //联系与否
    $(".slects").on('click',function(){     
          var _src = $(this).attr("src");
          var _src1 = "/public/img/shopseek/mine_zhifu_yuan@2x.png";
          var _src2 = "/public/img/shopseek/mine_zhifu_d_yuan@2x.png";
          console.log(_src)
          if(_src == _src1 ){
              $(this).attr("src",_src2); 
              var  s =$(this).attr("data-s");
              $('input[name=lianxi]').val(s);
              console.log(s);
              
              $(this).parent("div").siblings().find("img").attr("src",_src1);
          }else{
               $(this).attr("src",_src1);
          }
    })
 	// 其他渠道
 		$(".other").click(function(){ 
     	if($(".sour").css("display") == "none"){ 
     	    $(".sour").show();
     	}else{ 
     		$(".sour").hide();
     	}
     })
     
     $(".submit").click(function(){ 

          // //////////////////////////////////////////
         var data = $("#addsupplier").serialize();
         console.log(data);
          $.ajax({
               url: '/shopseek/shopreport',
               type: 'POST',
               dataType: 'json',
               data: $("#addsupplier").serialize(),
               success:function(res){
                    console.log(res ); 
                    alert_mark("报备成功",3000);
                    return;
               },
               error:function(res) {
                     alert_mark("信息不全",3000); 
               }
          });
     })
     // 弹出框
     function alert_mark(str,time){
       $('.lj_alert').html(str);
       $('.lj_alert').show();
       setTimeout(function(){$('.lj_alert').hide();},time);
     };//alert_mark('库存不足');
})