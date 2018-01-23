(function(){
    //category
    mui.init({
        swipeBack: true //启用右滑关闭功能
    });
    var controls = document.getElementById("segmentedControls");
    var contents = document.getElementById("segmentedControlContents");
    controls.querySelector('.mui-control-item').classList.add('mui-active');
    contents.querySelector('.mui-control-content').classList.add('mui-active');

})();


// 点击商品跳转
(function(){
    //单件商品
    $(".aa").on("click",function(){
        var url_search = $(".lcy_category").attr("url_search");
        var code = $.trim($(this).attr("code"));
        if(code == '')
        {
            return false;
        }
         window.location.href=url_search+"/cat/"+code+".html";
    });


    //按enter键按搜索键统一的效果
    document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];    
             if(e && e.keyCode==13){ // enter 键
                //按enter键执行
                 var url_search = $(".header_top").attr("url_search");
                 var $text = $("#text").val();
                if($text == '')
                {
                    return false;
                }
                //加密
                 $.base64.utf8encode = true;
                 var url =$.base64.btoa($text);
                 url = url.replace(/\+/g, "-");
                 window.location.href=url_search+"/search?keyword="+url;
            }
        }; 

     //input框失去焦点收索
     $('#text').on('blur',function(){
        var url_search = $(".header_top").attr("url_search");
                 var $text = $("#text").val();
                if($text == '')
                {
                    return false;
                }
                //加密
                 $.base64.utf8encode = true;
                 var url =$.base64.btoa($text);
                 url = url.replace(/\+/g, "-");
                 window.location.href=url_search+"/search?keyword="+url;
       
       });


})();