$(function() {
            $(".num_title").click(function() {
                $(this).parent(".num_wrap").addClass("change");
                $(this).siblings(".num_input").show();
                $(this).siblings(".num_num").hide();
                $(this).siblings(".num_input").val("");
                $(this).siblings(".num_input").focus();

                $(".active_instant").addClass("active_change");
            })
            $(".num_input").blur(function() {
                var _val = $(this).val();

                $(this).hide();
                if (_val != "") {
                    $(this).siblings(".num_num").show();
                    $(this).siblings(".num_num").html(_val);
                } else {
                    $(this).siblings(".num_num").hide();
                    $(this).siblings(".num_input").hide();
                    $(this).siblings(".num_num").html(_val);
                    $(this).parent(".num_wrap").removeClass("change");
                }
                // 判断按钮的颜色
                var who = $(".who").html();
                var bank_name = $(".bank_name").html();
                var bank_number = $(".bank_number").html();
                var vcode = $(".vcode").html();

                if (who == "" && bank_name == "" && bank_number == "" && vcode == "") {
                    $(".active_instant").removeClass("active_change");
                } else {
                    $(".active_instant").addClass("active_change");
                }

            })


            // 点击获取验证码 
            $('#btn').click(function() {
                var mobile = $(".mobile").html();
                var jiaoyan = /^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
                if (!(jiaoyan.test(mobile))) {
                    alert_mark('手机号码输入不正确', 3000);
                    return;
                } else {
                    settime(60);
                }
                messagesAjax(mobile);
            });
            // 点击获取验证码 
            // var user_agent = navigator.userAgent.toLowerCase(); // detect the user agent
            // var ios_devices = user_agent.match(/(iphone|ipod|ipad)/) ? "touchstart" : "click"; //check if the devices are ios devices
            // $("#btn").bind(ios_devices, function() { //bind the ios devices to click event
            // 	alert(2222);
            // 	var mobile = $(".mobile").html();
            // 	 if (!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobile))) {
            //         alert_mark('手机号码输入不正确', 3000);
            //         return;
            //     } else {
            //         settime(60);
            //     }
            // 	messagesAjax(mobile);
            //     console.log("Hack for IOS Devices Click Event");
            //     });
                //发送短信	
                function messagesAjax(mobile) {
                    var mobile = $(".mobile").html();
                    $.ajax({
                        url: '/setting/vcodeAjax.html',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "mobile": mobile
                        },
                        success: function(res) {
                            if (res.data.success == true) {
                                $("#mask_title").show();
                                $("#mask_title").html(res.data.msg);
                                setTimeout(function() {
                                    $("#mask_title").hide();
                                }, 3000)
                            }else{
                                $("#mask_title").show();
                                $("#mask_title").html('请稍后在尝试获取短信');
                                setTimeout(function() {
                                    $("#mask_title").hide();
                                }, 3000)
                            }
                        }
                    });
                };
                //验证码倒计时
                function settime(time) {
                    if (time == 0) {
                        $('#btn').show();
                        $('#s_box').hide();
                        time = time;
                        return;
                    } else {
                        $('#btn').hide();
                        $('#s_box').show();
                        $('#s_box').html(time + "s");
                        time--;
                    };
                    setTimeout(function() {
                        settime(time);
                    }, 1000);
                };

                $("#code").blur(function() {
                    if ($(this).val() != "") {
                        $(".active_instant").addClass("active_change");
                    } else {
                        $(".active_instant").removeClass("active_change");
                    }
                })


                // 绑定银行卡
                $(".active_instant").click(function() {
                    var who = $(".who").html();
                    var bank_name = $(".bank_name").html();
                    var bank_number = $(".bank_number").html();
                    var mobile = $(".mobile").html();
                    var vcode = $("#code").val();
                    var type = $(".active_instant").attr("type");
                    // console.log(who)
                    // console.log(bank_name)
                    // console.log(bank_number)
                    var _len = bank_number.toString().length;
                    if (_len < 16 || _len > 19) {
                        $("#mask_title").show();
                        $("#mask_title").html("请输入正确的银行卡号!");
                        setTimeout(function() {
                            $("#mask_title").hide();
                        }, 2000)
                    } else if (who == "" || bank_name == "" || vcode == "") {
                        $("#mask_title").show();
                        $("#mask_title").html("请填写完整信息!");
                        setTimeout(function() {
                            $("#mask_title").hide();
                        }, 2000)
                    } else {
                        $.ajax({
                            url: '/setting/cashAjax.html',
                            type: 'post',
                            async: false,
                            dataType: 'json',
                            data: {
                                'bank_account': who,
                                'bank_name': bank_name,
                                'bank_no': bank_number,
                                'vcode': vcode,
                                'mobile': mobile
                            },
                            success: function(res) {
                                console.log(res);
                                if (res.data.success == true) {
                                    $("#mask_title").show();
                                    $("#mask_title").html(res.data.msg);
                                    $("#code").val("")
                                    if (type == 1) {
                                        setTimeout(function() {
                                            $("#mask_title").hide();
                                            window.location.href = "/me/cash.html";
                                        }, 2000)
                                    }else{
                                        setTimeout(function() {
                                            $("#mask_title").hide();
                                            window.location.href = "/setting/safeset.html";
                                        }, 2000)
                                    }

                                }else{
                                    $("#mask_title").show();
                                    $("#mask_title").html(res.data.msg);
                                    $("#code").val("")
                                    setTimeout(function() {
                                        $("#mask_title").hide();
                                    }, 3000)
                                }
                            }
                        })
                    }
                });

            })