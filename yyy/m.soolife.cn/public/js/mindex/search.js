$(function() {
    $('.hunt_for input').focus();
    //搜索自动补充  
    $("#title_in").bind("input propertychange", function(event) { //input框修改事件
        $(".search_hi ul").html("");
        var keyword = $(this).val();
        $('.search_hi').show(); //放到遍历外边
        $.ajax({
            url: '/mindex/searchAutoAjax',
            type: 'POST',
            dataType: 'json',
            data: {
                "keyword": keyword
            },
            success: function(res) {
                if (res.code == 200 && res.success) {
                    if (res.data) {
                        for (var i = 0; i < res.data.length; i++) {
                            $(".search_hi ul").append("<li class='border-b'>" + res.data[i].wd + "</li>"); //添加放在遍历里边
                        }
                    }else{
                       $('.search_hi').hide();
                    }
                }
            }
        });
    });

    // 搜索跳转
    var firstcode = '';
    $(".search_hi ul").on("click", "li", function() {
        var text = $(this).text();
        hosity(text);
    });
    $(".history ul").on("click", "li", function() {
        var text = $(this).text();
        hosity(text);
    });
    $(".hot_search ul").on("click", "li", function() {
        var text = $(this).text();
        hosity(text);
    });
    $(".news").click(function() {
        $("#title_in").val("");
        $(".search_hi").hide();
        window.location.href = "./newindex.html";
    });
    $("#title_in").keyup(function() {
        if (event.keyCode == 13) {
          var text = $('#title_in').val();
          if(!text){
            text = $('#title_in').attr('placeholder');
          }
            hosity(text);
        }

    })

    function hosity(text) {
        // var hosityList = JSON.stringify(a);
        var list = [];
        var hosity_list = $('.hosity_list').text();
        if (hosity_list) {
            var li = JSON.parse(hosity_list);
            li.forEach(function(currentValue, index) {
                if (currentValue == text) {
                    li.splice(index, 1);
                }
            });

            if (li.length >= 20) {
                list = li.splice(0, 19);
            } else {
                list = li;
            }
        }
        list.unshift(text);
        var data = JSON.stringify(list);
        localStorage.setItem('search_hosity', data);
        // if (text == '') return;
        var goHref = '/newcategory/threecate.html?firstcode=' + firstcode + '&keyword=' + text + '&csstag=9';
        window.location.href = goHref;
    }

    // localStorage.setItem(string key, string value)
    var search_hosity = localStorage.getItem('search_hosity');
    if (search_hosity) {
        $('.history ul').html("");
        $('.exhibition').hide();
        $('.scroll').show();
        $('.below').show();
        $('.hosity_list').text(search_hosity);
        var search = JSON.parse(search_hosity);
        search.forEach(function(e) {
            $('.history ul').append('<li class="border-b">' + e + '</li>')
        });
    }
    $('.empty').click(function(event) {
        localStorage.removeItem('search_hosity');
        $('.hosity_list').text("");
        $('.history').hide();
        $('.history ul').html("");
        $('.delete').show();
        var a = 2;
        setInterval(function() {
            if (a == 2) {
                $('.delete').hide();
                location.reload();

            }
            a--;
        }, 1000);
    });

})