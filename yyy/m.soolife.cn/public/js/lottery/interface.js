$(function(){
    $('.hl-banner').bind("click",function(){
        $(".hkl-fex").show();
        $(".hkl-neir").show();
    })
    $('.neir-img').bind("click",function(){
        $(".hkl-fex").hide();
        $(".hkl-neir").hide();
    })

    $(".good-btm").on("click",function(){
        var skuid = $(this).data("skuid");
        var fullid = $(this).data("fullid");
        $.ajax({
            url : "/lottery/addcart.html",
            contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
            dataType : 'json',
            type : 'post',
            data :{"skuid":skuid,"fullid":fullid},
            success : function(d) {
                if (d.success) {
                    if(d.data.price>9999){
                        $(".price").html("￥9999+")
                    }else{
                        var price = Math.floor(d.data.price);
                        $(".price").html("￥"+price)
                    }
                } else {
                    alert(d.msg);
                }
            }
        });
    })

    
})