$(function() {
    $(".balance").on("click", ".with", function() {
        var a = parseFloat($(this).attr('name')); //支付密码是否设置
        var money = parseFloat($('.balance .money').html()); //余额
        var times = parseFloat($('.balance .remark').attr('times')); //提现次数
        var limit_money = parseFloat($('.balance .remark').attr('limit_money')); //提现剩余金额
        var limit_num = parseFloat($('.balance .remark').attr('limit_num')); //提现剩余次数
        var is_name = parseFloat($('.balance .remark').attr('is_name')); //提现设置是否开启实名认证
        var is_real = parseFloat($('.balance .remark').attr('is_real')); //是否实名认证
        var max_money = parseFloat($('.balance .remark').attr('max_money')); //最少提现金额
        if (money < max_money || times < 1 || limit_money <= 0 || limit_num <=0 ) {
            return;
        } else {
            if (limit_num > 0 && limit_money > 0) {
                if (is_name == 1 && is_real == 0) {
                    $(".realname").show();
                }else {
                    if (a==1) {
                        window.location.href = "./withdrawals.html";
                    }else{
                        $(".mask").show();
                        $(".realname").hide();
                    }   
                }
            }
        }
    });
    $(".mask").hide();
    $('.mask').click(function(event) {
        $(".mask").hide();
    });

    $(".tax").hide();
    $(".realname").hide();
    $('.realname').click(function(event) {
        $(".realname").hide();
    });
    $('.ramark_xiangqing').click(function(event) {
        $(".mask-prompt").show();
        // document.querySelector('body').addEventListener('touchstart', function(ev) {
        //     ev.preventDefault();
        // });
    });
    $('.mask-prompt').click(function(event) {
        $(".mask-prompt").hide();
    });
     $(".mask-w").hide();
    var isSuccess = false;
    $('.queding').click(function(event) {
        var cash = $('.money').attr('name'); //现金
        var limit_money = $('.money').attr('limit_money'); //剩余提现额度
        var limit_num = $('.money').attr('limit_num'); //剩余提现次数
        var is_tax = $('.money').attr('is_tax'); //是否缴税
        var money = $('#cash_post').val(); //提现金额
        var name = $('#name_post').val(); //用户名
        var bank = $('#bank_post').val(); //银行
        var bankno = $('#bankno_post').val(); //银行账户
        var mobile = $('#mobile_post').val(); //手机号
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        var yue = /^\d+(\.\d{1,2})?$/;
        var shuzi = /^[0-9]*$/;
        var password = '';
        $('.pass input').each(function(index, el) {
            password += $(this).val();
        });
        var member_id = $('.mask-password').attr('member_id');
        if (!money || money <= 0) {
            message('请输入提现金额');
        }
        if (parseFloat(money) < 50) {
            message('提现金额低于最小提现额');
        }
        if (parseFloat(money) > 20000) {
            message('提现金额超限');
            return;
        }
        if (parseFloat(cash) < parseFloat(money)) {
            message('余额不足');
            return;
        }
        if (!yue.test(money)) {
            message('请输入正确的金额');
            return;
        }
        if (!name) {
            message('请输入用户名');
            return;
        }
        if (!bank) {
            message('请输入银行名称');
            return;
        }
        if (!bankno || !shuzi.test(bankno)) {
            message('请输入正确的银行卡号');
            return;
        }
        if (mobile > 0) {
            if (!myreg.test(mobile)) {
                message('请输入有效的手机号码！');
                return;
            }
        } else {
            mobile = 0;
        }
        if (limit_num <= 0) {
            message('本月提现次数已用完！');
            return;
        }
        if (parseFloat(limit_money) <= 0) {
            message('本月提现次数已用完！');
            return;
        }
        if (parseFloat(limit_money) <= parseFloat(money)) {
            message('提现金额超限');
            return;
        }
        $.ajax({
            url: '/Me/withDrawAjax',
            type: 'POST',
            dataType: 'json',
            data: {
                "cash": money,
                "bankno": bankno,
                "bank": bank,
                "name": name,
                "mobile": mobile,
                "password": password,
                "member_id": member_id
            },
            error: function(res) {
                $('.mask-password').hide();
                message('请检查信息后重试', '提现申请失败');
                console.log(res);
            },
            success: function(res) {
                $('.mask-password').hide();
                if (res.success == "true") {
                    isSuccess = true;
                    message('您的提现申请我们会在每周三进行结算转账,请耐心等候!', '提现申请成功');

                } else {
                    message(res.msg, '提现申请失败');
                }
            },

        });
    });
      $('.mask-w').click(function(event) {
        $(".mask-w").hide();
        
    });
    $('.iknow').click(function() {
        if (isSuccess) {
            window.location.href = "./cash.html";
        }

    })

   function message(msg, title) {
        var title = title||"提示";
        $('.bomb_box').find('.title').text(title); //提示头
        $('.bomb_box').find('.re').text(msg); //提示主体
        $(".mask-w").show();
    }
    $('.more').click(function(event) {
        billAjax();
    });
    page = 2;

 function billAjax() {
        $.ajax({
            url: '/Me/billAjax',
            type: 'POST',
            dataType: 'json',
            data: {
                "limit": 10,
                "page": page,
            },
            success: function(res) {
                console.log(res);
                if (res.success == true) {
                    for (r in res.data) {
                        var b = "";
                        var url = "";
                        if (res.data.status && (res.data.status == 1 || res.data.status == 5)) {
                            b = '提现中';
                        } else if (res.data.status && res.data.status == 3) {
                            b = '提现成功';
                        } else if (res.data.status) {
                            b = '提现失败';
                        }
                        if (res.data[r].type == 1) {
                            url = "/billdetails.html?type=" + res.data[r].type + "&id=" + res.data[r].id;
                        } else if (res.data[r].type == 2) {
                            url = "/withdrawalsdetails.html?type=" + res.data[r].type + "&id=" + res.data[r].id;
                        } else if (res.data[r].type == 3) {
                            url = "/billrecharge.html?type=" + res.data[r].type + "&id=" + res.data[r].id;
                        }
                        var _html = '<div class="bar">' +
                            '<a href=".' + url + '">' +
                            '<div class="tit fl-left">' +
                            '<p class="remark">' + res.data[r].msg + ':</p>' +
                            '<p class="time">' + res.data[r].time + '</p>' +
                            '</div>' +
                            '<div class="go">' +
                            '<p  class="w-price">' + res.data[r].money + '</p>' +
                            '<p class="time">' + b + '</p>' +
                            '</div> ' +
                            '</a>' +
                            '</div>';
                        $('.b_link').append(_html);
                    }

                }
                page++;
            }
        });
    }
    $('.shenqingtixian').click(function(event) {
        var cash = $('.money').attr('name'); //现金
        var money = $('#cash_post').val(); //提现金额
        var limit_money = $('.money').attr('limit_money'); //剩余提现额度
        var limit_num = $('.money').attr('limit_num'); //剩余提现次数
        var is_tax = $('.money').attr('is_tax'); //是否缴税
        var name = $('#name_post').val(); //用户名
        var bank = $('#bank_post').val(); //银行
        var bankno = $('#bankno_post').val(); //银行账户
        var mobile = $('#mobile_post').val(); //手机号
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        var yue = /^\d+(\.\d{1,2})?$/;
        var shuzi = /^[0-9]*$/;
        if (!money || money <= 0) {
            message('请输入提现金额');
        }
        if (parseFloat(cash) < parseFloat(money)) {
            message('余额不足');
            return;
        }
        if (parseFloat(money) < 50) {
            message('提现金额低于最小提现额');
            return;
        }
        if (parseFloat(money) > 20000) {
            message('提现金额超限');
            return;
        }
        if (!yue.test(money)) {
            message('请输入正确的金额');
            return;
        }
        if (!name) {
            message('请输入用户名');
            return;
        }
        if (!bank) {
            message('请输入银行名称');
            return;
        }
        if (!bankno || !shuzi.test(bankno)) {
            message('请输入正确的银行卡号');
            return;
        }
        if (mobile > 0) {
            if (!myreg.test(mobile)) {
                message('请输入有效的手机号码！');
                return;
            }
        } else {
            mobile = 0;
        }
        if (limit_num <= 0) {
            message('本月提现次数已用完！');
            return;
        }
        if (parseFloat(limit_money) <= 0) {
            message('本月提现次数已用完！');
            return;
        }
        if (parseFloat(limit_money) <= parseFloat(money)) {
            message('提现金额超限');
            return;
        }
        if (parseFloat(money) < 800) {
            $('.mask-password').show();//密码弹框
            $('.pass input').eq(0).focus();//获取焦点
        }else{
            if(is_tax == 1){
                var tax_num = 0;
                var tax_money = 0;
                if (parseFloat(money) <= 4000) {
                    tax_num = parseFloat((money - 800) * 0.2);
                    tax_money = parseFloat((money - tax_num));
                }else{
                    tax_num = parseFloat(money* 0.2);
                    tax_money = parseFloat((money - tax_num));
                }
                var tax_title = "您的累计提现金额已超过个人所得税起征线，需要缴纳个人所得税"+tax_num.toFixed(2)+"元，如有不便，敬请谅解";
                var tax_content = tax_money.toFixed(2)+"元";
                 $(".tax").show();
                $(".tax_title").html(tax_title);
                $(".price").text(tax_content);
               
            }else{
                $('.mask-password').show();//密码弹框
                $('.pass input').eq(0).focus();//获取焦点
            }
        }
    });
    $('.tax_sublime').click(function(event) {
        $('.mask-password').show();//密码弹框
        $('.pass input').eq(0).focus();//获取焦点
    });
    $('.tax').click(function(event) {
        $(".tax").hide();
    });
    $('.quxiao').click(function(event) {
        $('.mask-password').hide();
    });

    $(".password").bind("input propertychange change", function(event) {
        $(this).val($(this).val().slice(0, 1));
        if ($(this).val() != "") {
            $(this).next('input').focus();
        }
        // $("#input_test2").val($("#input_test1").val());
    });
    $("input").click(function(event) {
        huoqufocus();
    });

    function huoqufocus() {
        var is = false;
        for (var i = 0; i <= 5; i++) {
            if ($('.pass input').eq(i).val() == '' && is == false) {
                is = true;
                $('.pass input').eq(i).focus();
                // b = i;
            }

        }
    }
})