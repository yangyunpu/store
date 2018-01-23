$(function  () {
	$(".num").click(function  () {
		$(this).hide();
		$(this).prev("input").show();
		$(this).prev("input").val("");
		$(this).prev("input").focus();
	})
	$(".cash_input").blur(function  () {
		$(this).hide();
		$(this).next("p").show();
		$(this).next("p").html($(this).val());

        if($(this).val() == "" && $(".pw").html() == ""){
            $(".cash_pay").removeClass("cash_pay_change");
        }else{
            $(".cash_pay").addClass("cash_pay_change");
        }
	})
    $(".cash_pw").blur(function  () {
        $(this).hide();
        $(this).next("p").show();
        $(this).next("p").attr("data-item",$(this).val());

        var _len = $(this).val().length;
        var str = "";
        for(var i=0 ; i<_len ; i++){
            str += "*"
        }
        $(this).next("p").html(str);

        if($(this).val() == "" && $(".cash").html() == ""){
            $(".cash_pay").removeClass("cash_pay_change");
        }else{
            $(".cash_pay").addClass("cash_pay_change");
        }
    })
    // 充值
    $(".cash_pay").click(function  () {
    	var tramount  = Number($(".cash").html());
        var paypsd = $(".pw").attr("data-item");
        var cashSum = Number($(".cash_total").html());
    	var type = $(".cash_pay").attr("type");

        if(tramount !="" || paypsd !=""){
            if(tramount != 0){
                if(tramount <= cashSum){

                	$.ajax({
                	    url: '/i/cashrechargeAjax',
                	    type: 'POST',
                	    async: false,
                	    dataType: 'json',
                	    data: {
                	    	'tramount':tramount,
                	    	'paypsd'  :paypsd
                	    },
                	    success:function(res){
                	    	// console.log(res)
                	    	if(res.data.success == false){


                                $("#cash_mask").show();
                                $("#cash_mask").html(res.data.msg);
                                setTimeout(function () {
                                	$("#cash_mask").hide();
                                },2000)

                            }else{
                                $("#cash_mask").show();
                                $("#cash_mask").html("充值成功!");
                                setTimeout(function () {
                                    $("#cash_mask").hide();
                                    $(".pw").attr("data-item","");
                                    $(".pw").html("");
                                    if (type == 1) {
                                        window.location.href="/me/cash.html";
                                    }else{
                                        window.location.href="/i/index/index.html";
                                    }
                                },2000)

                	    	}
                	    }
                	});

                }else{
                    $("#cash_mask").show();
                    $("#cash_mask").html("充值余额不能大于现金余额!");
                    setTimeout(function () {
                        $("#cash_mask").hide();
                    },2000)
                }

            }else{
                $("#cash_mask").show();
                $("#cash_mask").html("充值余额要大于0!");
                setTimeout(function () {
                    $("#cash_mask").hide();
                },2000)
            }
        }else{
            $("#cash_mask").show();
            $("#cash_mask").html("亲,请输入金额哦!");
            setTimeout(function () {
                $("#cash_mask").hide();
            },2000)
        }


    })
})