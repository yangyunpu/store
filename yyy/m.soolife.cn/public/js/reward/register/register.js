
var countdown=60; 
function settime(obj) { 
    if (countdown == 0) { 
        obj.removeAttribute("disabled");    
        obj.innerHTML="获取验证码"; 
        countdown = 60; 
        return;
    } else { 
        obj.setAttribute("disabled", true); 
        obj.innerHTML="重新发送(" + countdown + ")"; 
        countdown--; 
    } 
setTimeout(function() { 
    settime(obj) }
    ,1000) 
}
// 滑动验证js部分
$(function () {
        var slider = new SliderUnlock(".slideunlock-slider", {}, function(){
            // alert('验证成功');
            $(".slideunlock-label").hide();
        }, function(){
        });
        slider.init();
// 滑动验证js部分end
        // 正则判断手机号
      window.onload = function(){
        var inpEle = document.getElementById('inp');
        var myreg = /^1[3458]\d{9}$/;
        inpEle.onblur = function(){
        var inpVal = this.value;
        if (!myreg.exec(inpVal)){
        // alert('请输入正确的手机号')
        $(".notes").css("opacity","1");
        }else{
         $(".notes").css("opacity","0");
           }
         }
        }
        // 正则判断密码是4-8个大小写字母
          function newPW(){
            regExp=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,16}$/;
            if($("#pas").val()==""){
                $(".note").text("*密码不能为空");
                $(".note").css("opacity","1");
                return false;
            }
            else if(!regExp.test($("#pas").val())){
                $(".note").text("*密码格式错误");
                $(".note").css("opacity","1");
                return false;
            }
            else{
                $(".note").text("*密码格式正常");
                $(".note").css("opacity","1");
                return true;
            }
        }
        $("#pas").blur(newPW);
}) 
