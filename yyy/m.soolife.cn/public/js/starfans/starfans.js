$(function () {
    var _ranom_key;
    $("#dialogBg").bind("touchmove", function (event) {
        event.preventDefault();
    });
    // 移动端验证手机号码
    $('.bounceIn').click(function () {
        imageCode();
        var phone = $("#mobile").val();
        var member = $("#member").html();
        if (/^1(3|4|5|7|8)\d{9}$/.test(phone)) {
            $.ajax({
                url : "/Starfans/isRegion",
                type : "post",
                data : {
                    "phone" : phone
                },
                dataType : 'json',
                success : function(d){
                    if(d.success){
                        if(d.msg == true){
                            window.location.href="/starfans/getpacket.html?id="+'1';
                        }else{
                            $("#mobile_hidden").val(phone);
                            $("#member_id").val(member);
                            $("#btn").html("获取验证码");
                            $("#btn").attr("disabled", false);
                            $("#wrapper").show();
                        }
                    }
                }
            });
        }else if(!(/^1(3|4|5|7|8)\d{9}$/.test(phone))||phone == ""){
            $(".phone_verify").show();
            $("#mobile").attr("disabled",true)
            setTimeout(function(){
                $(".phone_verify").hide();
                $("#mobile").attr("disabled",false)
            },1000)
        }
    });

    // 图形验证码
    function imageCode(){
        // /tools/validcode.html
        _ranom_key = Math.random()*10000000000000000+'';
        _ranom_key = _ranom_key.substring(0,15);
        $("#image").attr('src','/tools/validcode.html?'+Math.random()+'&key='+_ranom_key + "&type=1");
    }

    //更换图形验证码
    $("#image").click(function(){
        _ranom_key = Math.random()*10000000000000000+'';
        _ranom_key = _ranom_key.substring(0,15);
        $(this).attr('src','/tools/validcode.html?'+Math.random()+'&key='+_ranom_key + "&type=1");
    });
// 点击倒计时
    var countdown=120;
    var time = null;
    function settime(){
        countdown--;
        if(countdown>0){
            $("#btn").html("重新发送"+countdown);
            $("#btn").attr("disabled", true)
        }else if(countdown == 0){
            clearInterval(time)
            countdown=120;
            $("#btn").html("获取验证码");
            $("#btn").attr("disabled", false);
        }
     }
// 验证图片及验证码
    $("#btn").click(function(){
        var image_val = $("#image_vcode").val();//图片验证码
        var phone = $("#mobile_hidden").val();//手机号码
        $.ajax({
            url : "/Starfans/imageCode",
            type : "post",
            data : {
                "image_val" : image_val,
                "vcode_key" : _ranom_key
            },
            dataType : 'json',
            success : function(d){
                if(d.success){
                    if(d.msg == 1){
                        $.ajax({
                            url : "/Starfans/sendCode",
                            type : "post",
                            data : {
                                "phone" : phone
                            },
                            dataType : 'json',
                            success : function(d){
                                if(d.success){
                                    $(".send_success").show();
                                    $("#num_code").attr("disabled",true);
                                    setTimeout(function(){
                                        $(".send_success").hide();
                                        $("#num_code").attr("disabled",false);
                                    },1000)
                                    time = setInterval(function(){
                                        settime()
                                    },1000);
                                }else{
                                    $(".send_fail").show();
                                    $("#num_code").attr("disabled",true);
                                    setTimeout(function(){
                                        $(".send_fail").hide();
                                        $("#num_code").attr("disabled",false);
                                    },1000)
                                }
                            }
                        });
                    }else{
                        $(".image_verify").show();
                        $("#image_vcode").attr("disabled",true);
                        setTimeout(function(){
                            $(".image_verify").hide();
                            $("#image_vcode").attr("disabled",false);
                        },1000)
                        _ranom_key = Math.random()*10000000000000000+'';
                        _ranom_key = _ranom_key.substring(0,15);
                        $("#image").attr('src','/tools/validcode.html?'+Math.random()+'&key='+_ranom_key + "&type=1");
                    }
                }
            }
        });
    })
// 注册成功
    $('.submitBtn').on('click', function () {
        var member = $('#member_id').val();
        var source_no = $('#source_no').val();
        var num_code = $("#num_code").val();
        var phone = $("#mobile_hidden").val();
        if ($('.code').val() == '') {
            $('.sublimt_null').show();
            setTimeout(function(){
                $('.sublimt_null').hide();
            },1000)
        } else {
            $.ajax({
                url: '/Starfans/register',
                type: 'post',
                dataType: 'json',
                data: {
                    "phone" : phone,
                    "member_id" : member,
                    "num_code" : num_code,
                    "source_no": source_no
                },
                success : function(d){
                    if(d.success){
                        $(".register_suc").show();
                        setTimeout(function(){
                            $(".register_suc").hide();
                        },1000)
                        setTimeout(function(){
                             window.location.href="/starfans/getpacket.html?id="+'0'+"&member_id="+ member;
                        },2000)
                    }else{
                        $(".register_fail").find("p").html(d.msg);
                        $(".register_fail").show();
                        setTimeout(function(){
                            $(".register_fail").hide();
                        },1000)
                    }
                }
            });
        }
    });
// 注册页面消失
    $(".claseDialogBtn").click(function(){
        clearInterval(time)
        $('#image_vcode').val('');
        $('#num_code').val('');
        $("#wrapper").hide();
    })
});