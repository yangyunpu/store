$(function(){
	$(".lj_head").on("click",".reds",function(){
		$(this).addClass("lj_red").siblings().removeClass("lj_red");
		$(".big_content").find(".child").eq($(this).index()).addClass("show").siblings().removeClass('show');
		var text = $(this).text();
		// console.log(text);

	}) 
	 var type ;
    var  size = 2;
    var  index = 1 ;

    /**
    * 
    * @return 
    * @param  登录并且调回当前页面
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    function go_login(){
        var url_member       = $(".login").attr("data-url-member");
        $.base64.utf8encode  = true;
        var url              = $.base64.btoa(window.location.href);
        window.location.href = url_member+"/login.html?return_url="+url;
    }
   /**
    * 
    * @return 
    * @param  下拉加载更多
    * @author junjie_lei@soolife.com.cn
    * @date 
    */
    //下拉刷新////////////////////////////////////////////////////////////////////////////
    var door = 0;
    window.onscroll=function(){
        var a = $(window).height(); 
        var c = document.body.clientHeight;
        var e = $(document).scrollTop();
        if(door == 1) return;

        if(c+e == a){
            index++;
            // size = index*20;
            $.ajax({
                url: '/Startheme/starTheme',
                type: 'GET',
                dataType: 'json',
                data : {
                    "type":type,
                    "index": index,
                    "size" : size
                },
                success:function(res){
                    append_data(res);
                },
                error:function(){
                }
            });
            return;
        };
    };
    // 下拉刷新 处理ajax
    function append_data(res){
        var data = res.msg;
        var str = '';
        if(res.msg){
            for(var i=0;i<data.length;i++){
                     str+='<li class="items">'
                        +'<a href="'+data[i].url+'/'+ data[i].sku_id +'.html">'
                        +'<div class="imgs">'
                        +'<img src="'+data[i].logo +'">'
                        +'</div>'
                        +'<div class="words">'
                        +'<p>'+data[i].sku_name+'</p>'
                        +'<p>￥'+ data[i].act_price +'</p>'
                        +'</div>'
                        +'</a>'
                        +'</li>';                                           
            };                  
        }else{
            door = 1;
            str = '<p style="text-align:center;">没有更多商品了...</p>';
        };
        // $('.lj_like ul').append(str);
    };

})