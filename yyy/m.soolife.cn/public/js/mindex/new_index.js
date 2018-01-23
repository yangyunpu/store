$(function() {
    $('.hunt_for input').focus();
    var mySwiper = new Swiper('.swiper-container', {
        autoplay: 2000, //可选选项，自动滑动
        loop: true, //可选选项，开启循环
        pagination: '.pagination',
    });
    $('body').on('click', '.mask', function() {
        $(".mask").hide();
        location.reload(true);
    });
    $('.c_right .lingxingbi').on('click', function() {
        var url = $(this).attr('url');
        var urlb = $(this).attr('urlb');
        if(!url&&!urlb){
            $.ajax({
            url: "/huilife/getcoin.html",
            type: "post",
            dataType: "json",
            ContentType: "application/x-www-form-urlencoded",
            success: function(data) {
                $(".mask").show();
            }
        });  
        }else{
            window.location.href=url+"/logins/login.html?return_url="+urlb;
        }
      

    });
    var page = "2";
    $('.shuaxin').click(function() {
        $.ajax({
            url: "/guesslike/goods.html?page="+page,
            type: "get",
            dataType: "json",
            ContentType: "application/x-www-form-urlencoded",
            success: function(data) {
                page++;
                if(data>=10){
                $('.shuaxin').hide();
                $('.jintou').show();  
                }
               
                data.left.forEach(function(event) {
                    var _html = "";
                    var type = "";
                    var isContent = ""; //是否显示用户评价
                    var isCoin = "";
                    if (event.promo_list&&event.promo_list.length>0) {
                        for (e in event.promo_list) {
                            type += "<div class='label'>"+event.promo_list[e].type_text+"</div>";
                        }
                    }
                    if (event.content) {
                        isContent ="<div class='reason1' >" +
                            +"<span class='yonghu'>[用户评价]</span><span>"+event.content+"</span>"
                            +"</div>" ;
                    }
                    if (event.coin) {
                        isCoin ="<p style='float: left;'><img src='/public/img/newindex/icon_xingbi@2x.png'></p>"+event.coin;
                    }
                    if (event.id) {
                        _html ="<li><a href="+event.mobile_link+"><img src="+event.picture+"></a></li>";
                    } else {
                        _html ="<li><div class='evaluate open-goods-detail' data-goods-id="+event.sku_id+">"
                            +"<img src="+event.logo+">" 
                            +"<div class='remark padd-20'>" 
                            +"<p class='name1'>"+event.sku_name+"</p>"
                            +"<div class='label_t'>"+ type +""
                            +"</div>"
                            +"<div class='price'>"
                            +"<div class='now_price' style='width: 6.4rem'><p>¥"+event.act_price+"</p>"+isCoin
                            +"</div>"
                            +"<div class='o_price'>¥"+event.market_price+"</div>" 
                            +"</div>"
                            +"</div>"+isContent+""
                            +"</div></li>";
                    }
                    $("#left ul").append(_html);
                });
                data.right.forEach(function(event) {
                    var _html = "";
                    var type = "";
                    var isContent = ""; //是否显示用户评价
                    var isCoin = "";
                    if (event.promo_list&&event.promo_list.length>0) {
                        for (e in event.promo_list) {
                            type += "<div class='label'>"+event.promo_list[e].type_text+"</div>";
                        }
                    }
                    if (event.content) {
                        isContent ="<div class='reason1' >" +
                            +"<span class='yonghu'>[用户评价]</span><span>"+event.content+"</span>"
                            +"</div>" ;
                    }
                    if (event.coin) {
                        isCoin ="<p style='float: left;'><img src='/public/img/newindex/icon_xingbi@2x.png'></p>"+event.coin;
                    }
                    if (event.id) {
                        _html ="<li><a href="+event.mobile_link+"><img src="+event.picture+"></a></li>";
                    } else {
                        _html ="<li><div class='evaluate open-goods-detail' data-goods-id="+event.sku_id+">"
                            +"<img src="+event.logo+">" 
                            +"<div class='remark padd-20'>" 
                            +"<p class='name1'>"+event.sku_name+"</p>"
                            +"<div class='label_t'>"+ type +""
                            +"</div>"
                            +"<div class='price'>"
                            +"<div class='now_price' style='width: 6.4rem'><p >¥"+event.act_price+"</p>"+isCoin
                            +"</div>"
                            +"<div class='o_price'>¥"+event.market_price+"</div>" 
                            +"</div>"
                            +"</div>"+isContent+""
                            +"</div></li>";
                    }
                    $("#rigth ul").append(_html);
                });
            }
        });
    })
    setInterval(function() {
        var _this = $(this);
        var endData = $('.date').val();
        shengyu(endData);
    }, 1000);

    function shengyu(endData) {
        if (!endData) {
            return;
        }
        var data = new Date();
        var timeHtml = "";
        var year = endData.substr(0, 4);
        var month = endData.substr(5, 2);
        var day = endData.substr(8, 2);
        var time = endData.substr(11, 2);
        var second = endData.substr(14, 2);
        var branch = endData.substr(17, 2);
        var dateFinal = new Date(year, month - 1, day, time, second, branch);
        var dateSub = dateFinal - data;
        if (dateSub <= 0) {
            $('.time').html('<span>下次再约~</span>');
            return;
        }
        var day = hour = minute = second = hourBase = minuteBase = secondBase = 0;
        dayBase = 24 * 60 * 60 * 1000; //计算天数的基数，单位毫秒。1天等于24*60*60*1000毫秒
        hourBase = 60 * 60 * 1000; //计算小时的基数，单位毫秒。1小时等于60*60*1000毫秒
        minuteBase = 60 * 1000; //计算分钟的基数，单位毫秒。1分钟等于60*1000毫秒
        secondBase = 1000; //计算秒钟的基数，单位毫秒。1秒钟等于1000毫秒
        day = Math.floor(dateSub / dayBase); //计算天数，并取下限值。如 5.9天 = 5天
        hour = Math.floor(dateSub % dayBase / hourBase); //计算小时，并取下限值。如 20.59小时 = 20小时
        minute = Math.floor(dateSub % dayBase % hourBase / minuteBase); //计算分钟，并取下限值。如 20.59分钟 = 20分钟
        second = Math.floor(dateSub % dayBase % hourBase % minuteBase / secondBase); //计算秒钟，并取下限值。如 20.59秒 = 20秒
        //当天数小于等于0时，就不用显示
        // if (day <= 0) {
        //     timeHtml += toDouble(hour) + '时' + toDouble(minute) + '分' + toDouble(second) + '秒';
        // } else {
        timeHtml += toDouble(hour) + '时' + toDouble(minute) + '分' + toDouble(second) + '秒';
        $('.day').text(toDouble(day));
        $('.hour').text(toDouble(hour));
        $('.minute').text(toDouble(minute))
        $('.second').text(toDouble(second))
        /* timeHtml += day + '天' + toDouble(hour) + '时' + toDouble(minute) + '分' + toDouble(second) + '秒';*/
        // }
        return timeHtml;
    };

    function toDouble(num) {
        if (num < 10) {
            return '0' + num;
        } else {
            return '' + num;
        }
    }


})