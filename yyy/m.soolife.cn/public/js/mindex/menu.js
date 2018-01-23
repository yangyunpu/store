$(function() {
    function bottom(d) {
        var url = window.location.pathname;
        var m1 = "tab_home@2x.png";
        var m2 = "tab_menu@2x.png";
        var m3 = "tab_tiyandian@2x.png";
        var m4 = "tab_shop@2x.png";
        var m5 = "tab_mine@2x.png";
        var c1 = "";
        var c2 = "";
        var c3 = "";
        var c4 = "";
        var c5 = "";
        var i1 = "";
        var i2 = "";
        var i3 = "";
        var i4 = "";
        var i5 = "";
        var orders = $('.addmenu').attr('url');
        switch (url) {
            case "/mindex/index.html":
                m1 = "icon_1_r.png";
                c1 = "footer_bottom_color";
                i1 = "..";
                break;
            case "/newcategory.html":
                m2 = "tab_menu_pre@2x.png";
                c2 = "footer_bottom_color";
                i1 = "..";
                break;
            case "/lifehui/index.html":
                m3 = "tab_tiyandian_pre@2x.png";
                c3 = "footer_bottom_color";
                i1 = "..";
                 break;
            case "/m/index.html":
                m4 = "tab_shop_pre.png";
                c4 = "footer_bottom_color";
                i1 = "..";
                 break;
            case "/i/index/index.html":
                m5 = "tab_mine_pre@2x.png";
                c5 = "footer_bottom_color";
                i1 = "";
                 break;
            default:
                m1 = "icon_1_r.png";
                c1 = "footer_bottom_color";
                 break;
        }
        var _html = "<footer style='padding-top: 5px;position: fixed;bottom: 0px;background: white;z-index: 99;width: 100%;height: 2.090667rem;border-top:1px solid #DDDDDD;padding:0.213333rem 1.066667rem;'>" +
            "<ul>" +
            "	<li index='m1' style='list-style: none;float: left; width: 20%;height:1.066667rem;padding-top: 6px;position: relative;'>" +
            "		<a href='/mindex/index.html'>" +
            "			<img style='width:1.066667rem' src='"+i1+"/public/img/newindex/" + m1 + "'>" +
            "			<p class='"+c1+"' style='color:#666666;'>首页</p>" +
            "		</a>" +
            "	</li>" +
            "	<li index='m2' style='list-style: none;float: left; width: 20%;height: 1.066667rem;padding-top: 6px;position: relative;'>" +
            "		<a href='/newcategory.html'>" +
            "			<img style='width:1.066667rem'src='"+i2+"/public/img/newindex/" + m2 + "'>" +
            "			<p class='"+c2+"' style='color:#666666;'>分类</p>" +
            "		</a>" +
            "	</li>" +
            "	<li index='m3' style='list-style: none;float: left; width: 20%;height: 1.066667rem;padding-top: 6px;position: relative;'>" +
            "		<a href='/lifehui/index.html'>" +
            "			<img style='width:1.066667rem;margin-left:0.2rem' src='"+i3+"/public/img/newindex/" + m3 + "'>" +
            "			<p class='"+c3+"' style='color:#666666;'>体验店</p>" +
            "		</a>" +
            "	</li>" +
            "	<li index='m4' style='list-style: none;float: left; width: 20%;height: 1.066667rem;padding-top: 6px;position: relative;'>" +
            "		<a href='"+orders+"/index.html'>" +
            "			<img style='width:1.066667rem' src='"+i4+"/public/img/newindex/" + m4 + "'>" +
            "			<p class='"+c4+"' style='color:#666666;'>购物车</p>" +
            "			<span class='shopping_car'>1</span>" +
            "		</a>" +
            "	</li>" +
            "	<li index='m5' style='list-style: none;float: left; width: 20%;height: 1.066667rem;padding-top: 6px;position: relative;'>" +
            "		<a href='/i/index/index.html'>" +
            "			<img style='width:1.066667rem' src='"+i5+"/public/img/newindex/" + m5 + "'>" +
            "			<p class='"+c5+"' style='color:#666666;'>我的</p>" +
            "		</a>" +
            "	</li>" +
            "</ul>" +
            "</footer>";
        $('.addmenu').append(_html);

    }
    bottom('m1');
    // $('.addmenu').on('click', 'li', function() {
    //     var d = $(this).attr("index");
    //     bottom(d);
    // });
})