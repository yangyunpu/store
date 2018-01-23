$(function(){
    var apply_id = $('input[name=apply_id]').val();
	// 线上服务单选
    var _src2 = "/public/img/sop/Group19.png";
    $(".choose").on('click',function(){
        var _src = $(this).attr("src");
        var _src1 = "/public/img/sop/Group21.png";
        if(_src == _src1 ){
            $(this).attr("src",_src2);
            $(this).parents("tr").siblings().find(".choose").attr("src",_src1);
        }else{
            $(this).attr("src",_src1);
        }
    })
    //线下服务(多选框)
    $(".choice").on('click',function(){
        var _src = $(this).attr("src");
        var _src1 = "/public/img/sop/Rectangle5Copy.png";
        var _src3 = "/public/img/sop/Group20.png";
        if(_src == _src1 ){
            $(this).attr("src",_src3);
        }else{
            $(this).attr("src",_src1);
            $(this).parents("li").siblings().find(".chooses").attr('src','/public/img/sop/Group21.png');
            $(this).parents("li").siblings().find(".chooses").siblings().hide();
        }
    })
    //线下服务(单选框)
    $(".chooses").on('click',function(){
        var f_src = $(this).parents("ul").find('.choice').attr("src");
        var f_src2 = "/public/img/sop/Group20.png";
        if (f_src == f_src2) {
            var _src = $(this).attr("src");
            var _src1 = "/public/img/sop/Group21.png";
            if(_src == _src1 ){
                $(this).attr("src",_src2);
                $(this).parents("li").siblings().find(".chooses").attr("src",_src1);
                $(this).parents("li").siblings().find('input').hide();
                $(this).siblings().show();
            }else{
                $(this).attr("src",_src1);
                $(this).siblings().hide();
            }
        } else {
            bootbox.alert('请选择体验店后重新操作');
        }
    })
     //线上签约
     var signed = $('input[name=signed]').val();
    $(".on_grees").on('click',function(){
        var _src = $(this).attr("src");
        var off_src = $('.off_grees').attr("src");
        if (off_src == _src2) {
            $('.off_grees').attr("src",_src);
            $('.lj_grees').css("color","");
        }
        var _src1 = "/public/img/sop/Group21.png";
        if(_src == _src1 ){
            $(this).attr("src",_src2);
            $('.lj_gree').css("color","#EC6D65");
            signed = 1;
        }else{
            $(this).attr("src",_src1);
            $('.lj_gree').css("color","#333");
            signed = '';
        }
    })
     //线下签约
    $(".off_grees").on('click',function(){
        var _src = $(this).attr("src");
        var on_src = $(".on_grees").attr("src");
        if (on_src == _src2) {
            $('.on_grees').attr("src",_src);
            $('.lj_gree').css("color","");
        }
        var _src1 = "/public/img/sop/Group21.png";
        if(_src == _src1 ){
            $(this).attr("src",_src2);
            $('.lj_grees').css("color","#EC6D65");
            signed = 0;
        }else{
            $(this).attr("src",_src1);
            $('.lj_grees').css("color","#333");
            signed = '';
        }
    })
    var online_val;
    var offline_item;
    var total_money=0;
    var total_coin=0;
    var offline_money = 0;
    var offline_coin = 0;
    var online_money = 0;
    var online_coin = 0;
    function fisrt_data(){
        // 线上服务套餐
        online_val = '';
        offline_item = [];
        total_money=0;
        total_coin=0;
        offline_money = 0;
        offline_coin = 0;
        online_money = 0;
        online_coin = 0;
        var online_td = $('.choose');
        for (var i = 0; i < online_td.length; i++) {
            var src_val = $(online_td[i]).attr("src");
            if (src_val.indexOf("Group19") > 0) {
                online_val = $(online_td[i]).attr("value");
                online_money = $(online_td[i]).parents("td").next().attr('value');
                online_coin = $(online_td[i]).parents("tr").find('td:last').attr('value');
                if (online_val != '') {
                    break;
                }
            }
        }
        if (online_val == '') {
            bootbox.alert('线上服务内容必选');
            return false;
        }
        // 线下服务套餐
        var offline_ul = $('.serviceitem').find('ul');
        var f_src2 = "/public/img/sop/Group20.png";
        var f_src  = "/public/img/sop/Group19.png";
        for (var j = 0; j < offline_ul.length; j++) {
            var choose_offline = $(offline_ul[j]).find('li:first').find('.choice').attr("src");
            var type_offline = $(offline_ul[j]).find('li:first').siblings().find('.chooses');
            var obj = {};
            obj.store_id = '';
            obj.type = '';
            obj.num = 0;
            if (choose_offline == f_src2) {
                obj.store_id = $(offline_ul[j]).find('li:first').find('.choice').attr("value");
                for (var k = 0; k < type_offline.length; k++) {
                    if ($(type_offline[k]).attr("src") == f_src) {
                        obj.type = $(type_offline[k]).attr("value");
                        if (obj.type == 1) {
                            obj.num = $(type_offline[k]).siblings().val();
                            obj.num = obj.num.replace(".",'');
                            if (obj.num == '' || obj.num==0) {
                                bootbox.alert("请填写商品数量");return false;
                            }
                            if (obj.num > 30) {
                                bootbox.alert("商品数量不能超过30");return false;
                            }
                        }
                    }
                }
                offline_item.push(obj);
            }
        }
        // 计算总价和返还星币
        var _money = 0;
        if (offline_item) {
            for (var x = 0; x < offline_item.length; x++) {
                if(offline_item[x].type == 1) {
                    _money = offline_item[x].num * 1000;
                }
                if(offline_item[x].type == 2) {
                    _money = 30000;
                }
                if(offline_item[x].type == 3) {
                    _money = 100000;
                }
                offline_money += _money;
                offline_coin += _money;
            }
        }
        total_money = 10000 + parseInt(online_money) + parseInt(offline_money);
        total_coin  = parseInt(online_coin) + parseInt(offline_coin);
        // 赋值最终页的选择服务
        $('.last_online_money').html(online_money/10000);
        $('.last_online_coin').html(online_coin/10000);
        $('.last_offline_money').html(offline_money/10000);
        $('.last_offline_coin').html(offline_coin/10000);
        $('.last_total_money').html(total_money/10000);
        $('.last_total_coin').html(total_coin/10000);
        return true;
    }
    // 点击填写资料页下一步
    var basic_information;
    function person_info(){
        basic_information = {};
        basic_information.company_name = $('input[name=company_name]').val().trim();
        if (basic_information.company_name == ''){bootbox.alert('公司名称必填');return false;}
        basic_information.region_id = $('.county').find('option:selected').val().trim();
        basic_information.address = $('input[name=address]').val().trim();
        if (basic_information.address == ''){bootbox.alert('公司地址必填');return false;}
        basic_information.industry = $('input[name=industry]').val().trim();
        if (basic_information.industry == ''){bootbox.alert('所属行业必填');return false;}
        basic_information.scope = $('input[name=scope]').val().trim();
        if (basic_information.scope == ''){bootbox.alert('经营范围必填');return false;}
        basic_information.capital = $('input[name=capital]').val().trim();
        if (basic_information.capital == ''){bootbox.alert('注册资本必填');return false;}
        basic_information.corporation = $('input[name=corporation]').val().trim();
        if (basic_information.corporation == ''){bootbox.alert('法人姓名必填');return false;}
        basic_information.identitycard = $('input[name=identitycard]').val().trim();
        if (basic_information.identitycard == ''){bootbox.alert('身份证号必填');return false;}
        if (!isIdCardNo(basic_information.identitycard)){bootbox.alert('身份证号不正确');return false;}
        basic_information.business_card = $('input[name=business_card]').val().trim();
        if (basic_information.business_card == ''){bootbox.alert('营业执照号必填');return false;}
        basic_information.establish = $('input[name=establish]').val().trim();
        if (basic_information.establish == ''){bootbox.alert('公司成立日期必填');return false;}
        basic_information.begin_date = $('input[name=begin_date]').val().trim();
        if (basic_information.begin_date == ''){bootbox.alert('营业开始时间必填');return false;}
        basic_information.end_date = $('input[name=end_date]').val().trim();
        if (basic_information.end_date == ''){bootbox.alert('营业终止时间必填');return false;}
        basic_information.company_tel = $('input[name=company_tel]').val().trim();
        if (basic_information.company_tel == ''){bootbox.alert('公司联系电话必填');return false;}
        if (!isPhone(basic_information.company_tel)){bootbox.alert('公司联系电话不正确');return false;}
        basic_information.company_remark = $('input[name=company_remark]').val().trim();
        if (basic_information.company_remark == ''){bootbox.alert('备注内容必填');return false;}
        basic_information.linkman = $('input[name=linkman]').val().trim();
        if (basic_information.linkman == ''){bootbox.alert('联系人姓名必填');return false;}
        basic_information.phone = $('input[name=phone]').val().trim();
        if (basic_information.phone == ''){bootbox.alert('联系人电话必填');return false;}
        if (!isPhone(basic_information.phone)){bootbox.alert('联系人电话不正确');return false;}
        basic_information.email = $('input[name=email]').val().trim();
        if (basic_information.email == ''){bootbox.alert('联系人邮箱必填');return false;}
        if (!mail(basic_information.email)){bootbox.alert('联系人邮箱不正确');return false;}
        basic_information.duty = $('input[name=duty]').val().trim();
        if (basic_information.duty == ''){bootbox.alert('联系人职务必填');return false;}
        basic_information.facsimile = $('input[name=facsimile]').val().trim();
        if (basic_information.facsimile == ''){bootbox.alert('传真必填');return false;}
        if (!isFax(basic_information.facsimile)){bootbox.alert('传真号码不正确');return false;}
        basic_information.urgency_linkman = $('input[name=urgency_linkman]').val().trim();
        if (basic_information.urgency_linkman == ''){bootbox.alert('紧急联系人姓名必填');return false;}
        basic_information.urgency_phone = $('input[name=urgency_phone]').val().trim();
        if (basic_information.urgency_phone == ''){bootbox.alert('紧急联系人电话必填');return false;}
        if (!isPhone(basic_information.urgency_phone)){bootbox.alert('紧急联系人电话不正确');return false;}
        return basic_information;
    }
    // 点击上传图片页下一步
     pic_data=1;
    function validateForm(){
        return $('#form_all_data').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                businesslicence: {
                    checkPicSize:true,
                    checkPicType:true
                },
                papertax: {
                    checkPicSize:true,
                    checkPicType:true
                },
                organizeid: {
                    checkPicSize:true,
                    checkPicType:true
                },
                paperbank: {
                    checkPicSize:true,
                    checkPicType:true
                },
                generaltax: {
                    checkPicSize:true,
                    checkPicType:true
                },
                agentid: {
                    checkPicSize:true,
                    checkPicType:true
                },
                papertrademark: {
                    checkPicSize:true,
                    checkPicType:true
                },
                paperbrandsales: {
                    checkPicSize:true,
                    checkPicType:true
                },
                paperquality: {
                    checkPicSize:true,
                    checkPicType:true
                }
            },
            messages: {
                businesslicence: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                papertax: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                organizeid: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                paperbank: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                generaltax: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                agentid: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                papertrademark: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                paperbrandsales: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
                paperquality: {
                    checkPicSize: "请上传大小在150k以下的图片",
                    checkPicType:"仅支持JPG、GIF、PNG格式的图片"
                },
            },
            highlight: function(e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },
            success: function(e) {
                $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
                $(e).remove();
            },
            submitHandler: function(form){

            }
        })
    }
    jQuery.validator.addMethod("checkPicSize", function(value, element) {
        if (value != '') {
            var fileSize = element.files[0].size;
            var maxSize = 153600;
            if (fileSize > maxSize) {
                return false;
            }
        }
        return true;
    }, "请上传大小在150k以下的图片");
    jQuery.validator.addMethod("checkPicType", function(value, element) {
        if (value != '') {
            var fileType = element.files[0].type;
            var type = ['image/png','image/jpeg','image/gif'];
            if (type.indexOf(fileType) > -1) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }, "请上传大小在150k以下的图片");
    // 身份证号码验证
    function isIdCardNo(value) {
        return idCardNoUtil.checkIdCardNo(value);
    }
    //传真
    function isFax(value) {
        var fax = /^(\d{3,4})?[-]?\d{7,8}$/;
        if (fax.test(value)) {
            return true;
        }
        return false;
    }
    function isPhone(value) {
        var phone = /^0\d{2,3}-\d{7,8}$/;
        var mobile = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(17([0-9]))|(18[0,5-9]))\d{8}$/;
        var length = value.length;
        if (phone.test(value) || (length == 11 && mobile.test(value))) {
            return true;
        }
        return false;
    }
    function mail(value) {
        var strin = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;
        if (strin.test(value)) {
            return true;
        }
        return false;
    }
    var idCardNoUtil = {
        provinceAndCitys: {11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江",
            31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东",
            45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏",
            65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外"},
        powers: ["7", "9", "10", "5", "8", "4", "2", "1", "6", "3", "7", "9", "10", "5", "8", "4", "2"],
        parityBit: ["1", "0", "X", "9", "8", "7", "6", "5", "4", "3", "2"],
        genders: {male: "男", female: "女"},
        checkAddressCode: function(addressCode) {
            var check = /^[1-9]\d{5}$/.test(addressCode);
            if (!check)
                return false;
            if (idCardNoUtil.provinceAndCitys[parseInt(addressCode.substring(0, 2))]) {
                return true;
            } else {
                return false;
            }
        },
        checkBirthDayCode: function(birDayCode) {
            var check = /^[1-9]\d{3}((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))$/.test(birDayCode);
            if (!check)
                return false;
            var yyyy = parseInt(birDayCode.substring(0, 4), 10);
            var mm = parseInt(birDayCode.substring(4, 6), 10);
            var dd = parseInt(birDayCode.substring(6), 10);
            var xdata = new Date(yyyy, mm - 1, dd);
            if (xdata > new Date()) {
                return false;//生日不能大于当前日期
            } else if ((xdata.getFullYear() == yyyy) && (xdata.getMonth() == mm - 1) && (xdata.getDate() == dd)) {
                return true;
            } else {
                return false;
            }
        },
        getParityBit: function(idCardNo) {
            var id17 = idCardNo.substring(0, 17);
            var power = 0;
            for (var i = 0; i < 17; i++) {
                power += parseInt(id17.charAt(i), 10) * parseInt(idCardNoUtil.powers[i]);
            }
            var mod = power % 11;
            return idCardNoUtil.parityBit[mod];
        },
        checkParityBit: function(idCardNo) {
            var parityBit = idCardNo.charAt(17).toUpperCase();
            if (idCardNoUtil.getParityBit(idCardNo) == parityBit) {
                return true;
            } else {
                return false;
            }
        },
        checkIdCardNo: function(idCardNo) {
            //15位和18位身份证号码的基本校验
            var check = /^\d{15}|(\d{17}(\d|x|X))$/.test(idCardNo);
            if (!check)
                return false;

            //判断长度为15位或18位
            if (idCardNo.length == 15) {
                return idCardNoUtil.check15IdCardNo(idCardNo);
            } else if (idCardNo.length == 18) {
                return idCardNoUtil.check18IdCardNo(idCardNo);
            } else {
                return false;
            }
        },
        //校验15位的身份证号码
        check15IdCardNo: function(idCardNo) {
            //15位身份证号码的基本校验
            var check = /^[1-9]\d{7}((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))\d{3}$/.test(idCardNo);
            if (!check)
                return false;
            //校验地址码
            var addressCode = idCardNo.substring(0, 6);
            check = idCardNoUtil.checkAddressCode(addressCode);
            if (!check)
                return false;
            var birDayCode = '19' + idCardNo.substring(6, 12);
            //校验日期码
            return idCardNoUtil.checkBirthDayCode(birDayCode);
        },
        //校验18位的身份证号码
        check18IdCardNo: function(idCardNo) {
            //18位身份证号码的基本格式校验
            var check = /^[1-9]\d{5}[1-9]\d{3}((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))\d{3}(\d|x|X)$/.test(idCardNo);
            if (!check)
                return false;

            //校验地址码
            var addressCode = idCardNo.substring(0, 6);
            check = idCardNoUtil.checkAddressCode(addressCode);
            if (!check)
                return false;

            //校验日期码
            var birDayCode = idCardNo.substring(6, 14);
            check = idCardNoUtil.checkBirthDayCode(birDayCode);
            if (!check)
                return false;

            //验证校检码
            return idCardNoUtil.checkParityBit(idCardNo);
        },
        formateDateCN: function(day) {
            var yyyy = day.substring(0, 4);
            var mm = day.substring(4, 6);
            var dd = day.substring(6);
            return yyyy + '-' + mm + '-' + dd;
        },
        //获取信息
        getIdCardInfo: function(idCardNo) {
            var idCardInfo = {
                gender: "", //性别
                birthday: "" // 出生日期(yyyy-mm-dd)
            };
            if (idCardNo.length == 15) {
                var aday = '19' + idCardNo.substring(6, 12);

                idCardInfo.birthday = idCardNoUtil.formateDateCN(aday);

                if (parseInt(idCardNo.charAt(14)) % 2 == 0) {
                    idCardInfo.gender = idCardNoUtil.genders.female;
                } else {
                    idCardInfo.gender = idCardNoUtil.genders.male;
                }
            } else if (idCardNo.length == 18) {
                var aday = idCardNo.substring(6, 14);

                idCardInfo.birthday = idCardNoUtil.formateDateCN(aday);

                if (parseInt(idCardNo.charAt(16)) % 2 == 0) {
                    idCardInfo.gender = idCardNoUtil.genders.female;
                } else {
                    idCardInfo.gender = idCardNoUtil.genders.male;
                }
            }
            return idCardInfo;
        },
        getId15: function(idCardNo) {
            if (idCardNo.length == 15) {
                return idCardNo;
            } else if (idCardNo.length == 18) {
                return idCardNo.substring(0, 6) + idCardNo.substring(8, 17);
            } else {
                return null;
            }
        },
        getId18: function(idCardNo) {
            if (idCardNo.length == 15) {
                var id17 = idCardNo.substring(0, 6) + '19' + idCardNo.substring(6);
                var parityBit = idCardNoUtil.getParityBit(id17);
                return id17 + parityBit;
            } else if (idCardNo.length == 18) {
                return idCardNo;
            } else {
                return null;
            }
        }
    };
    // 提交审核
    $('.lj_sub').on('click',function(){
        if (fisrt_data()) {
            if (person_info()) {
                if(validateForm().form()) {
                    var service_obj = new Object();
                    service_obj.total_money = total_money;
                    service_obj.total_coin = total_coin;
                    service_obj.offline_money = offline_money;
                    service_obj.offline_coin = offline_coin;
                    service_obj.online_money = online_money;
                    service_obj.online_coin = online_coin;
                    var service_cost = [];
                    service_cost.push(service_obj);
                    var form_all_data = $('#form_all_data')[0];
                    all_data = new FormData(form_all_data);
                    all_data.append('apply_id', apply_id);
                    all_data.append('online_type', online_val);
                    all_data.append('offline_item', JSON.stringify(offline_item));
                    all_data.append('service_cost', JSON.stringify(service_cost));
                    all_data.append('personal_data', JSON.stringify(basic_information));
                    all_data.append('signed', signed);
                    if (signed === '') {
                        bootbox.alert('请选择签约方式');return;
                    }
                    $.ajax({
                        url: '/sop/edit.html',
                        type: "POST",
                        dataType:"JSON",
                        cache:false,
                        contentType: false,
                        processData:false,
                        data:all_data,
                        success: function(e){
                            if (e.success){
                                bootbox.alert(e.msg,function(){
                                    window.location.href = "/sop/shopstatus.html";
                                });
                            }else{
                                bootbox.alert(e.msg);
                            }
                        }
                    });
                }
                return false;
            }
        }
    });
})