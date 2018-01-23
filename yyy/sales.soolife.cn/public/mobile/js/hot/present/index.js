$(function(){

    var isApp = /SoolifeApp/i.test(navigator.userAgent);

    //点击判断是否是登录状态
    // $(".add").on('click',function(){
    //     if(!isApp){
    //         var token = getCookie('m_token');
    //         var return_url = window.location.href;
    //         var url_m = $("#url_m").val();
    //         if(token == null || token == ''){
    //             return_url = $.base64.encode(return_url);
    //             window.location.href = url_m + "/logins/login.html?return_url=" + return_url;
    //         }
    //     }
    // });

    //获取cookie
    function getCookie(name)
    {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg))
            return unescape(arr[2]);
        else
            return null;
    }

    // 选中规格
    var sum = 0;
    $('.y_main li').on('click', function() {
        if (sum < 300) {
            alert_mark("金额不满300,不能选择赠品！",2000);
            return;
        }
        $(this).find("span").addClass('choose');
        $(this).siblings().find("span").removeClass("choose");
    });

    //点击数量的加、减
    $('.amount span.add').click(function() {
        $(this).addClass('c_active');
        $('.amount span.jian').removeClass('c_active');
        var v = parseInt($(this).siblings('.amount_int').val());
        var remains = $('.remains').text();
        if (remains != '库存充足' && v >= parseInt(remains)) {
            return;
        }
        v++;
        $(this).siblings('.amount_int').val(v);
        sum = parseInt($(this).parent().siblings("p").find("._price").text()) + sum;
    });

    $('.amount span.jian').click(function() {
        $(this).addClass('c_active');
        $('.amount span.add').removeClass('c_active');
        var v = parseInt($(this).siblings('.amount_int').val());
        if (v <= 0) return;
        v--;
        sum = sum - parseInt($(this).parent().siblings("p").find("._price").text());
        if (sum < 300) {
            $('.y_main span').removeClass("choose");
        }
        $(this).siblings('.amount_int').val(v);
    });
    // alert(111);
    //立即购买
    $(".gobuy").click(function() {
        var thats = $(this);
        if(!isApp){
            var token = getCookie('m_token');
            var return_url = window.location.href;
            var url_m = $("#url_m").val();
            if(token == null || token == ''){
                return_url = $.base64.encode(return_url);
                window.location.href = url_m + "/logins/login.html?return_url=" + return_url;
            }else{
                var present_id =  $(".choose").attr("data-goods-id");
                if (sum < 300) {
                    $("._alert").show();
                    return false;
                }
                if (present_id == undefined) {
                    alert_mark("请选择赠品!",2000);
                    return false;
                }
                if(!isApp){
                    $("#token").val(token);
                    $("[name|='mobile']").val("");
                    $("[name|='address']").val("");
                    $("[name|='name']").val("");
                    $("#region").val("");
                    $("#province").html("省");
                    $("#city").html("市");
                    $("#county").html("县");
                    if(present_id !=''){
                        $(".lj_address").show();
                    }

                }
            }
        }else{
            var present_id =  $(".choose").attr("data-goods-id");
            if (sum < 300) {
                $("._alert").show();
                return false;
            }
            if (!present_id) {
                alert_mark("请选择赠品!",2000);
                $(".lj_address").hide();
                return false;
                // event.stopPropagation();
                // event.preventDefaule();
            }
            thats.addClass("get-token-value1");
            webSdk.b_event().getTokenValue1();
            // if(present_id){
            //     alert(222);
            //      $(".lj_address").show();
            // }

        }
    });

    //关闭弹框
    $("._back").click(function() {
        $(this).parents("._alert").hide();
    })

// 、、、、、、三级联动//////////////////////////////////////////

    // console.log(111);
    $(".lj_delect").click(function(){
        $(this).parents(".lj_address").hide();
    })

    //点击 “省”
    $('#province').on("click",function(){
        $("#site_box").show();
        $("#site_box ul").show();
        getSiteData('cn','#site_box #province_box');
        $('#province_box').show().siblings().hide();
        $('#city').text('市辖区');
        $('#county').text('县');
    });
    //点击 “省”下面的单元
    $('#site_box').on("click","#province_box li",function(){
        $('#province').text($(this).text());
        var regionid = $(this).data('regionid');
        getSiteData(regionid,'#site_box #city_box');
        $('#city_box').show().siblings().hide();
    });
    //点击 “市”下面的单元
    $('#site_box').on("click","#city_box li",function(){
        $('#city').text($(this).text());
        var regionid = $(this).data('regionid');
        getSiteData(regionid,'#site_box #county_box');
        $('#county_box').show().siblings().hide();
    });
    //点击 “县”下面的单元
    $('#site_box').on("click","#county_box li",function(){
        $('#county').text($(this).text());
        var regionno = $(this).data('regionid');
        //setAfterData.regionno = regionno;
        var text = $('#province').text()+$('#city').text()+$('#county').text();
        $("#region").val(regionno);
        $("#site_box ul").hide();
        $('#province_box,#city_box,#county_box').html('');
        $("#site_text").hide();
    });


    //地址联动-ajax
    function getSiteData(regionid,box){
        $.ajax({
            url: '/hot/site.html',
            type: 'GET',
            dataType: 'json',
            data: {
                'regionid': regionid
            },
            success:function(res){
                var str = '';
                length = res.data.length;
                for(var i=0;i<length;i++){
                    str+='<li data-regionid="'+res.data[i].region_id+'">'+res.data[i].name+'</li>'
                };
                $(box).html(str);
            },
            // error:function(res){
            //  alert(res);
            // }
        });
    };

    // 弹出框
    function alert_mark(str,time){
      $('#alert_mark').html(str);
      $('#alert_mark').show();
      setTimeout(function(){
        $('#alert_mark').hide();
      },time);
    };//alert_mark('库存不足');


    $(".lj_submit").click(function(){
        var mobile = $("[name|='mobile']").val();
        var address = $("[name|='address']").val();
        var name = $("[name|='name']").val();
        var region = $("#region").val();
        var url_order = $("#url_order").val();
        var token = $('#token').val();

        // 获取选中的规格
        var skuid =  $(".choose").attr("data-goods-id")
        if(name == ''){
            alert_mark('收货人不能为空',3000);
            return;
        };
        if (mobile == '') {
            alert_mark('手机号不能为空',3000);
            return;
        }
        if(!(/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/.test(mobile))){
            alert_mark('手机号码格式输入不正确',3000);
            return;
        };
        if (address =='') {
            alert_mark('详细地址不能为空',3000);
            return;
        }

        var present_id =  $(".choose").attr("data-goods-id");
        var sku_num = '';
        var skuid = '';
        var sku_price = '';
        $("input[name='amount_int']").each(function () {
            var num = $(this).val();
            sku_num += num + ",";
        });
        $("input[name='sku_id']").each(function () {
            var ids = $(this).val();
            skuid += ids + ",";
        });
        $("._price").each(function () {
            var price = $(this).html();
            sku_price += price + ",";
        });
        sku_num   = sku_num.slice(0,-1);
        skuid     = skuid.slice(0,-1);
        sku_price = sku_price.slice(0,-1);
        $.ajax({
            url: '/hot/present/confirm.html',
            type: 'POST',
            dataType: 'json',
            data: {
                'mobile'     : mobile,
                'address'    : address,
                'name'       : name,
                'region'     : region,
                'skuid'      : skuid,
                'present_id' : present_id,
                'sku_num'    : sku_num,
                'sku_price'  : sku_price,
                'token'      : token,
            },
            success:function(res){
                if (res.success) {
                    window.location.href = url_order + "/m/order/orderpay.html?order_id=" + res.data + "&token=" + token;
                } else {
                    alert(res.msg);
                }
            },
            // error:function(res){
            //  console.log(res);
            //  console.log(res.responseText);
            //  JSON.parse(res.responseText);
            //  console.log(res.responseText);
            //  alert(res.responseText.msg);
            // }
        });

        $(this).parents(".lj_address").hide();
    });


})