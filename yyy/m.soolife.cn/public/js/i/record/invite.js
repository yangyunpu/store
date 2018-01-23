
// 下拉刷新
window.onscroll=function(){
    var skip =$("#hidden").val();
    var docheight = $(document).height();               //整个网页的文档高度
    var screenheight = $(window).height();             //浏览器可视窗口的高度
    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
    if(screenheight+scroll >= docheight){
        $.ajax({
            url: '/i/record/inviteAjax.html',
            type: 'POST',
            dataType: 'json',
            data : {
                "skip": skip,
            },
            success:function(res){
                // console.log(res)
                var data = res.data.data;
                var str = '';
                if(data !=""){
                    $("#hidden").val(res.data.skip);
                    for(var i=0;i<data.length;i++){
                        str= '<li>'
                            +    '<img src="'+data[i].accepter_avatar+'">'
                            +    '<div class="invite_txt">'
                            +       ' <p>'+data[i].nick_name+'</p>'
                            +        '<p>'+data[i].title+'</p>'
                            +    '</div>'
                            +    '<p class="invite_coin">＋'+data[i].award+'</p>'
                            +'</li>'
                        $("#invite_list").append(str)
                    }
                }else{
                    $("#none").show();
                    return;
                }
            }
        });

    }
}