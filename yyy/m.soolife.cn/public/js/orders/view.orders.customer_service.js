/**
* 
* @return 售后申请
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
$(function(){
  // begin 三级联动 //////////////////////////////////////////////////////////////////////////////
  var changeRegion = function(obj, pid, def) {
    var addres = $("#" + obj);
    if (def == null || def == '') {
      def = addres.attr("data-id");
    }
    $.ajax({
      url : "/orders/region.html",
      data : {
        "pid" : pid
      },
      dataType : 'json',
      success : function(d) {
        if (d.data.length > 0) {
          //清空里面的内容
          addres.empty();
          $.each(d.data, function(i, n) {
            var s = "<option value='" + n.region_id + "' " + (n.region_id == def ? "selected='selected'" : "") + ">" + n.name + "</option>";
            addres.append(s);
          });
          addres.change();
        }
      }
    });
  };
  $("#province").change(function() {
    if (this.value == 'CN71' || this.value == 'CN81' || this.value == 'CN82') {
      $("#city").css("display", "none");
      $("#region").css("display", "none");
    } else {
      $("#city").css("display", "");
      $("#region").css("display", "");
      changeRegion('city', this.value, '');
    }
  });
  $("#city").change(function() {
    changeRegion('region', this.value, '');
  });
  changeRegion('province', 'CN', '');
  // end 三级联动 //////////////////////////////////////////////////////////////////////////////
  $("#pcd").click(function(){
    $('.cd-popup').addClass('is-visible');
  });
  $("#addaddress-sure").click(function(){
  var province = $("#province option:selected").text();
  var city = $("#city option:selected").text();
  var region = $("#region option:selected").text();
  $("#pcd").text(province + ' ' + city + ' ' + region);
  $(".cd-popup").removeClass('is-visible');
});

  //jia
  $('.no_border').on("click",function(){
    var ttl_count   =$(this).attr('ttl_count');
    var m_ttl_count =$(".m_ttl_count").text();
    if(m_ttl_count >= ttl_count)
    {
      alert("商品数量不能超出购买数量！");
      return false;
    }
    else
    {
      $(".m_ttl_count").text(++m_ttl_count);
    } 
  })
  //jian
  $('.reduce').on("click",function(){
    var m_ttl_count =$(".m_ttl_count").text();
    if(m_ttl_count <= 1)
    {
      alert("商品数量不能低于1！");
      return false;
    }
    else
    {
      $(".m_ttl_count").text(--m_ttl_count);
    }   
  })


  // begin 表单验证 //////////////////////////////////////////////////////////////////////////////
  $("#singleproduct_form").validate({
    errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
    rules : {
      entry : 'required',   //申请类型
      question : 'required',   //问题描述
    },
    messages : {
      entry : '请选择类型',
      question : '请填写问题描述',
    },
    errorClass : 'has-error',
    errorPlacement: function(error, element)
    {
      if (element.is('input[name=question]'))
      {
        $(".no_border").insertAfter(element);
      } else if(element.is('input[name=beginDate]') || element.is('input[name=endDate]') || element.is('input[name=signDate]'))
      {

      } else
      {
          error.insertAfter(element.parent());
      }
    },


    submitHandler : function(form) {
      var fm = $(form);
      console.log($(form).serialize());
      $.ajax({
        url : "/orders/customer_service.html",
        type : "post",
        data : $(form).serialize(),
        contentType:'application/x-www-form-urlencoded',
        dataType : "json",
        success : function(d) {
          if (d.success) {            
            window.location.href="/orders/aftersale.html";
          } else {
            alert(d.msg.msg);return false;
          }
        }
      });
    }
    
})  
//$('.addressBox').show();
var a = $('input[name=entry]:checked').val();
if(a==1){
   $('.adsstring').hide();   
   $('.addressBox').hide();
}

$('.bug_radio input').click(function(event) {
  var b=$(this).val();
  if(b==2 || b==3){
    $('.adsstring').show();
    $('.addressBox').show();
  }else{
   $('.adsstring').hide();   
   $('.addressBox').hide();
  }
});
});
