$(function() {
    $('.copy').click(function(event) {
        var a = true;
        var b = true;
        var text = $('#copy').text();
        var clipboard = new Clipboard('.copy');
        clipboard.on('success', function(e) {
            e.clearSelection();
            if(a){
             alert("复制成功！");
             a = false;
            }
            
            /*e.clearSelection();*/
        });
        clipboard.on('error', function(e) {
            if(b){
            alert("复制失败！请手动复制");
            b = false;
        }
        });
    });
    /*$('.shops img').click(function(event) {
        var name = $(this).attr('class');
        var a = '<img src="/public/mobile/img/brand/'+name+'.jpg">';
        $('.layer').html(a);
        $('.layer').addClass('mask');
    });
     $('.layer').click(function(event) {
        $('.layer').html('');
        $('.layer').removeClass('mask');
    });*/
})