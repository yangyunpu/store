$(function  () {
    // 计算实付款
    var qty = $("#qty").html();
    var rule =Math.ceil($("#order_rule").val());
    var sum = qty*rule;
    $("#sum").html(sum);
    $("#rule").html(rule)
    // 活动id
    var starkillId = $("#starkill_id").val();

    // 确认付款    
	$("#pay").click(function(){
		$.ajax({
            url : "/starkill/join",
            type : "post",
            data : {
					"starkill_id":starkillId,
					"qty":qty
				},
            dataType : 'json',
            success : function(d){
                console.log(d)
                if(d.success) {
                    if(d.data.success==undefined){
                        var starkill_id = d.data.starkill_id;
                        $(".alert_msg").show();
                        if(d.data.state.msg=="ok"){
                            d.data.state.msg = "星星杀预订成功!"
                        }
                        $(".alert_msg").html(d.data.state.msg);
                        setTimeout(function(){
                            $(".alert_msg").hide();
                            window.location.href="/starkill/success.html?starkill_id="+starkill_id+"&qty="+qty;
                        },1000)
                    }else{
                       if(d.data.msg == "当前用户已退出登录,请重新登录"){
                            go_login();
                        }else {
                            var msg = d.data.msg;
                            msg = msg.replace(new RegExp(/(请求失败:)/g),"");
                            $(".alert_msg").show();
                            $(".alert_msg").html(msg);
                            setTimeout(function(){
                                $(".alert_msg").hide();
                            },1000)
                        }

                    }
                }else{
                    $(".alert_msg").show();
                    $(".alert_msg").html("请求失败,请检查网络!");
                    setTimeout(function(){
                        $(".alert_msg").hide();
                    },1000)

                }
            }
        });

	});

    /**
    * 
    * @return 
    * @param  登录并且调回当前页面
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    function go_login(){
        var url_member       = "http://i.soolife.loc/m";
        $.base64.utf8encode  = true;
        var url              = $.base64.btoa(window.location.href);
        window.location.href = url_member+"/login.html?return_url="+url;
    }

})