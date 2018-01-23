$(function() {
    $(".mask").hide();
    $('.sign').show();
    if($('.led-img').find('input').attr('name')){
    $('.sign').hide();
     }
    $('.sign').click(function(event) {
        if($('#header-center img').attr('name') ==1){
            var is_login = $(this).attr('data-is-login');
            var iscomplete = $(this).attr('data-iscomplete');
            if(iscomplete) {
                return;
            }else if(is_login=='0'){
                go_login();
            }else{
                $.ajax({
                    url      : "/huilife/getcoin.html",
                    type     : "post",
                    dataType : "json",
                    ContentType:"application/x-www-form-urlencoded",
                    success : function(data){
                        $(".mask").show();
                    }
                });
            };
        }else{
            var url_m = $('#header-center img').attr('url');
            $.base64.utf8encode  = true;
            var url              = $.base64.btoa(window.location.href);
            window.location.href = url_m+"/logins/login.html?return_url="+url;
        }
        
    });
    $('.mask').click(function(event) {
        $(".mask").hide();
        $('.sign').hide();
        window.location.href = "/huilife/newcollar";
    });
     $(function() {
        setInterval(function() {
         $('.position').each(function(index, el) {
        var _this = $(this);
        var endData = $(this).find('input').val();
        if (endData && endData.length > 10) {
           var timeHtml = shengyu(endData);
            _this.find('.time').text(timeHtml);
        }else{
         _this.find('.time').text(endData);
        }
    });
            }, 1000);
        });
  
    function toDouble(num) {
            if (num < 10) {
                return '0' + num;
            } else {
                return '' + num;
            }
        }
   function shengyu(endData){
   	        var data = new Date();
   	        var timeHtml = "";
   	        var year = endData.substr(0, 4);
            var month = endData.substr(5, 2);
            var day = endData.substr(8, 2);
            var time = endData.substr(11, 2);
            var second = endData.substr(14, 2);
            var branch = endData.substr(17, 2);
            var dateFinal = new Date(year, month-1, day, time, second, branch);
            var dateSub = dateFinal - data;
            if(dateSub<0){
                timeHtml = "火热进行中";
               return timeHtml;
            }
            var day = hour = minute = second = dayBase = hourBase = minuteBase = secondBase = 0;
            dayBase = 24 * 60 * 60 * 1000; //计算天数的基数，单位毫秒。1天等于24*60*60*1000毫秒
            hourBase = 60 * 60 * 1000; //计算小时的基数，单位毫秒。1小时等于60*60*1000毫秒
            minuteBase = 60 * 1000; //计算分钟的基数，单位毫秒。1分钟等于60*1000毫秒
            secondBase = 1000; //计算秒钟的基数，单位毫秒。1秒钟等于1000毫秒
            day = Math.floor(dateSub / dayBase); //计算天数，并取下限值。如 5.9天 = 5天
            hour = Math.floor(dateSub % dayBase / hourBase); //计算小时，并取下限值。如 20.59小时 = 20小时
            minute = Math.floor(dateSub % dayBase % hourBase / minuteBase); //计算分钟，并取下限值。如 20.59分钟 = 20分钟
            second = Math.floor(dateSub % dayBase % hourBase % minuteBase / secondBase); //计算秒钟，并取下限值。如 20.59秒 = 20秒
            //当天数小于等于0时，就不用显示
            if (day <= 0) {
                timeHtml += toDouble(hour) + '时' + toDouble(minute) + '分' + toDouble(second) + '秒';
            } else {
                 timeHtml += day + '天' + toDouble(hour) + '时' + toDouble(minute) + '分' + toDouble(second) + '秒';
               /* timeHtml += day + '天' + toDouble(hour) + '时' + toDouble(minute) + '分' + toDouble(second) + '秒';*/
            }
            return timeHtml;
   }
    /**
    * 
    * @return 
    * @param  完善资料
    * @author wentao_huang@soolife.com.cn
    * @date 
    */
    $(".go_complete_new1").on("click",function(){
        if($(this).attr('data')){
         return;
        }
        var is_login = $(this).attr('data-is-login');
        var iscomplete = $(this).attr('data-iscomplete');
        var url_m       = $(".lcy_hui").attr("data-url-m");
        if(is_login=='0'){
            go_login();
           }else{
            window.location.href = url_m + "/setting/message.html"
        }
    });
       
    /**
    * 
    * @return 
    * @param  订单评价领星币
    * @author wentao_huang@soolife.com.cn
    * @date 
    */
    $(".go_complete_new0").on("click",function(){
        if($(this).attr('data')){
         return;
        }
        var is_login = $(this).attr('data-is-login');
        var iscomplete = $(this).attr('data-iscomplete');
        var url_m       = $(".lcy_hui").attr("data-url-m");
        if(is_login=='0'){
            go_login();
           }else{
            window.location.href = url_m + "/orders/index.html?status=4"
        }
        
    });

    /**
    * 
    * @return 
    * @param  到体验店签到
    * @author wentao_huang@soolife.com.cn
    * @date 
    */
    $(".go_complete_new2").on("click",function(){
        if($(this).attr('data')){
         return;
        }
        var is_login = $(this).attr('data-is-login');
        var iscomplete = $(this).attr('data-iscomplete');
        var url_m       = $(".lcy_hui").attr("data-url-m");
        if(is_login=='0'){
            go_login();
           }else{
            window.location.href = url_m + "/lifehui/download.html?msg_txt=1"
        }
        
    });
    /**
    * 
    * @return 
    * @param  登录并且调回当前页面
    * @author wentao_huang@soolife.com.cn
    * @date 
    */
    function go_login(){
        var url_m       = $(".login").attr("data-url-m");
        $.base64.utf8encode  = true;
        var url              = $.base64.btoa(window.location.href);
        window.location.href = url_m+"/logins/login.html?return_url="+url;
    }

    // /**
    // * 
    // * @return 
    // * @param  签到领星币
    // * @author zhichao_hu@soolife.com.cn
    // * @date 
    // */
    // $(".go_complete_sign").on("click",function(){
    //     var is_login = $(this).attr('data-is-login');
    //     var iscomplete = $(this).attr('data-iscomplete');
    //     if(iscomplete) {
    //         return;
    //     }else if(is_login=='0'){
    //         go_login();
    //     }else{
    //         $.ajax({
    //             url      : "/huilife/getcoin.html",
    //             type     : "post",
    //             dataType : "json",
    //             ContentType:"application/x-www-form-urlencoded",
    //             success : function(data){
    //                 $(".lcy_getcoin .mark").show();
    //             }
    //         });
    //     };
    // });
})