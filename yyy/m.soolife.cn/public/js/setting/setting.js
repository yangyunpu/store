$(function(){
    $('.ramark_xiangqing').click(function(event) {
        $(".mask-prompt").show();
        // document.querySelector('body').addEventListener('touchstart', function(ev) {
        //     ev.preventDefault();
        // });
    });
	//手机号中间4位变星星
	var tel = $('.iphone').html();  
    var mtel = tel.substring(0,3) + '****' + tel.substring(7); 
    $('.iphone').text(mtel);  
    $('.mask').hide();
    $('.renzheng').click(function(){
         $('.mask').show();
    });
    $('.mask').click(function(){
         $('.mask').hide();
    });
});