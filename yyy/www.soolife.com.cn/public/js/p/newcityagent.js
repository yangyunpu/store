$(function() {

	var seclectp = document.getElementById('seclectp');
	var twoselect1 = document.getElementsByClassName('twoselect1')[0];
	var twoselectbtn = document.getElementsByClassName('twoselectbtn')[0];
	var twoselect21 = document.getElementsByClassName('twoselect21')[0];
	var twoselect2 = document.getElementsByClassName('twoselect2')[0];
	var sec_wen = document.getElementsByClassName('sec_wen')[0];
	seclectp.onchange = function(){
		var s=this.options.selectedIndex;
		if(s==1){
			twoselect1.style.display = 'none';
			twoselect2.style.display = 'inline-block';
		};
		if(s==0){
			twoselect2.style.display = 'none';
			twoselect1.style.display = 'inline-block';
		};
		if(s==2){
			twoselect2.style.display = 'none';
			twoselect1.style.display = 'none';
		};
	};
	twoselectbtn.onchange = function(){
		var s=this.options.selectedIndex;
		if(s==1){
			twoselect21.style.display = 'inline-block';
		};
		if(s==0){
			twoselect21.style.display = 'none';
		};
	};
	//点击快捷留言
	$(".quiz").on("click",'li',function(){
		texts = $(this).text();
		$(".speek").html(texts);
	})
	//表单提交
	$('.submit').on("click",function(){
		var data = new Object();
		data.name = ($('input[name=name]').val()).trim();
		if(data.name == ''){
			alert('请输入您的姓名');return;
		}
		data.phone = ($('input[name=phone]').val()).trim();
		if(!isMobile(data.phone)){
            alert('请输入正确的手机号');return;
        }
		data.region = ($('input[name=region]').val()).trim();
		if(data.region == ''){
			alert('请输入您所在的地区');return;
		}
		data.email = ($('input[name=email]').val()).trim();
		if(!isEmail(data.email)){
            alert('请输入正确的邮箱号');return;
        }
		data.field = $('#seclectp option:selected').val();
		data.rank = $('.twoselect1 option:selected').val();
		data.team = $('.twoselectbtn option:selected').val();
		data.teamscale = $('.twoselect21 option:selected').val();
		var a = $('textarea[name=content]').val()
		if(a !=undefined && a !=null && a !=""){
			data.content = ($('textarea[name=content]').val()).trim();
		}else{
			data.content=''; 
		}
		
		$.ajax({
			url : '/partner/newcityagent.html',
			data : data,
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            dataType : "json",
			success : function(e){
                if (e.success){
                    bootbox.alert(e.msg,function(){
                    	window.location.reload();
                    });
                }else{
                    bootbox.alert(e.msg);
                }
            }
		});
	});
	//验证电话号码
    var isMobile = function(value) {
        var length = (value.trim()).length;
        return (length == 11 && /^(((14[0-9]{1})|(17[0-9]{1})|(13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
    }
    //验证Email地址
    var isEmail = function(value){
        var strin = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;
        return strin.test(value);
    }
});
$(function(){

	$('.slide .icon li').not('.up,.down').mouseenter(function(){
		$('.slide .info').addClass('hover');
		$('.slide .info li').hide();
		$('.slide .info li.'+$(this).attr('class')).show();//.slide .info li.qq
	});
	$('.slide').mouseleave(function(){
		$('.slide .info').removeClass('hover');
	});
	
	$('#btn').click(function(){
		$('.slide').toggle();
		if($(this).hasClass('index_cy')){
			$(this).removeClass('index_cy');
			$(this).addClass('index_cy2');
		}else{
			$(this).removeClass('index_cy2');
			$(this).addClass('index_cy');
		}
		
	});
	// 左右文字滚动
	var demo = document.getElementById("demo");
	var demo1 = document.getElementById("demo1");
	var demo2 = document.getElementById("demo2");
	demo2.innerHTML=document.getElementById("demo1").innerHTML;
	function Marquee(){
		if(demo.scrollLeft-demo2.offsetWidth>=0){
		   demo.scrollLeft-=demo1.offsetWidth;
		}
		else{
		   demo.scrollLeft++;
		}
	}
	var myvar=setInterval(Marquee,30);
	demo.onmouseout=function (){myvar=setInterval(Marquee,30);}
	demo.onmouseover=function(){clearInterval(myvar);}
});