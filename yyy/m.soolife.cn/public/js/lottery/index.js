$(function(){
    // 在前面显示的元素，隐藏在后面的元素
    var eleBack = null, eleFront = null,
        // 纸牌元素们
        eleList = $(".list");

    $("#box .hkl-block").bind("click", function() {
        $('.mask').css('display','block');
        $('.hl-img').addClass("out");
        setTimeout(function() {
            $('.mask').addClass("in").removeClass("out");
        }, 225);
        $('.hl-img').css('display','none');
        $('.hkl-none').css('display','block');
    });




    $(".list").bind("click", function() {
        var main_order = $('.main_order').data("val");
        var  action ="正在抽奖,请耐心等待....";
        var url_m = $('.url_m').val();
        $("#alert_img").show();
        $("#alert_img").html(action);
        $.ajax({
            url : "/lottery/draw.html",
            contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
            dataType : 'json',
            type : 'post',
            data :{"main_order":main_order},
            success : function(d) {
                if (d.success) {
                    if(d.data.code==100){
                    var str = "";
                    var alert = "";
                        str += '<div class="neri-shop">';
                        str += '<img src="'+d.data.award.S_Logo+'" alt="">';
                        str += '</div>';
                        str += '<p class="neir-name">'+d.data.award.S_Name+'</p>';
                        str += '<span class="neir-red">￥'+d.data.award.S_ShopPrice+'</span>';
                        str += '<div class="neir-btn">';
                        str += '<a class="btn-gray" href= "' + url_m + '/orders/index.html?status=3" type="" data-skuid="'+d.data.award.Sku_ID+'">查看奖品</button>';
                        str += '<a href="/lottery/homepage.html" class="btn-pink" type="">去逛逛</a>';
                        str += '</div>';





                        $(".neir-backimg").html(str);
                        $(this).addClass("out").removeClass("in");
                        setTimeout(function() {
                            $('.hl-img').addClass("in").removeClass("out");
                        }, 225);
                        setTimeout(function() {
                        $(".hkl-fex").show();
                        $(".hkl-neir").show();
                        $("#alert_img").hide();
                        }, 600);

                    }else if(d.data.code==101){
                        alert ="您已抽过奖";
                        $('.hkl-block').hide();
                        $('.hkl-none').hide();
                        $("#alert_img").show();
                        $('.hkl-block').hide();
                        $('.hkl-none').show();
                        $("#alert_img").html(alert);
                        setTimeout(function() {
                            $("#alert_img").hide();
                        }, 1000);

                    }else if(d.data.code==102){
                        alert ="活动未开始或活动已结束！";
                        $('.hkl-block').hide();
                        $('.hkl-none').hide();
                        $("#alert_img").show();
                        $('.hkl-block').hide();
                        $('.hkl-none').show();
                        $("#alert_img").html(alert);
                        setTimeout(function() {
                            $("#alert_img").hide();
                        }, 1000);

                    }else if(d.data.code==103){
                        alert ="所有奖品已被抽完";
                        $('.hkl-block').hide();
                        $('.hkl-none').hide();
                        $('.hkl-block').hide();
                        $('.hkl-none').show();
                        $("#alert_img").show();
                        $("#alert_img").html(alert);
                        setTimeout(function() {
                            $("#alert_img").hide();
                        }, 1000);

                    }else if(d.data.code==104){
                        alert ="未查到订单";
                        $('.hkl-block').hide();
                        $('.hkl-none').hide();
                        $("#alert_img").show();
                        $('.hkl-block').hide();
                        $('.hkl-none').show();
                        $("#alert_img").html(alert);
                        setTimeout(function() {
                            $("#alert_img").hide();
                        }, 1000);

                    }else if(d.data.code==105){
                        alert ="不能抽奖了，您的订单已经打包";
                        $('.hkl-block').hide();
                        $('.hkl-none').hide();
                        $("#alert_img").show();
                        $('.hkl-block').hide();
                        $('.hkl-none').show();
                        $("#alert_img").html(alert);
                        setTimeout(function() {
                            $("#alert_img").hide();
                        }, 1000);
                    }
                } else {
                    window.location.href = "/logins/login.html?return_url="+d.data;
                    // alert(d.msg);
                }
            },
            error:function(d){
                // console.log(d);return;
                // data = d.responseText;
                // window.location.href = "/logins/login.html?return_url="+data['data'];
            }
        });

        $(".list").unbind('click');
        return false;
    });

    $('.neir-img').bind("click",function(){
            $(".hkl-fex").hide();
            $(".hkl-neir").hide();
    })

})