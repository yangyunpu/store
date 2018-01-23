function show(){
var oShow = document.getElementById('show1');
oShow.style.visibility = 'visible';
var sWidth = $("#show1").width();
var iWidth = document.documentElement.clientWidth;
var sHeight = $("#show1").height();
var iHeight = document.documentElement.clientHeight;
var itop  = document.body.scrollTop || document.documentElement.scrollTop;
var bgObj = document.createElement("div");
bgObj.setAttribute("id","bgbox");
bgObj.style.width = iWidth+"px";
bgObj.style.height =Math.max(document.body.clientHeight, iHeight)+"px";
document.body.appendChild(bgObj);
oShow.style.left = (iWidth-sWidth)/2+"px";
oShow.style.top = itop+ (iHeight-sHeight)/2+"px";
function oClose(){
oShow.style.visibility = 'hidden';
document.body.removeChild(bgObj);
}
var oClosebut=document.getElementById("show_but");
oShow.appendChild(oClosebut);
oClosebut.onclick = oClose;
}

