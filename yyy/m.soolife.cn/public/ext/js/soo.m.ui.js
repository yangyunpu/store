/* 
*this extend from zepto;
*cunyang_liu;
*2016.12.19;
*soolife
*/
/**
   * Soo()...；
   * make code similar to JQ
   */
var 
SooBody = document.getElementsByTagName('body')[0],
Soo = function(selector) {
		return new Soo.fn.init(selector);
	};
Soo.fn = Soo.prototype = {
	constructor: Soo,
	init: function(selector) {		
		this.selector = selector;
	}
};
Soo.fn.init.prototype = Soo.fn;
/**
   * Soo.extend(defObj,optObj)；
   * function to extend for object inherited;
   * param:first and second is object,return to new object is first obj ,but it is changed to second obj;
   */
Soo.extend = function(defObj,sourObj) {
	var def2Obj = Object.create(defObj);
	for(var attr in sourObj){
		def2Obj[attr] = sourObj[attr];
	};
	return def2Obj;
};
/**
   * Soo(param).hide()；
   * mark element to hide
   * param:elemt is hided
   */
var hideCreate = (function(elemt){
	var Fun = function(elemt){
		if(typeof(elemt)=='object'){
			var elemts = elemt.nodeType ==1?[elemt]:elemt;
		}else{
			var elemts = document.querySelectorAll(elemt);
		};
   		for(var i=0;i<elemts.length;i++){  
			elemts[i].style.display = 'none';			
   		};		                                                                                                                        
	};
	return Fun;
})();
Soo.fn.hide = function(){
	return new hideCreate(this.selector);
};
/**
   * Soo(param).show()；
   * mark element to show
   * param:elemt is showed
   */
var showCreate = (function(elemt){
	var Fun = function(elemt){
		if(typeof(elemt)=='object'){
			var elemts = elemt.nodeType ==1?[elemt]:elemt;
		}else{
			var elemts = document.querySelectorAll(elemt);
		};
   		for(var i=0;i<elemts.length;i++){  
			elemts[i].style.display = 'block';			
   		};
	};
	return Fun;
})();
Soo.fn.show = function(){
	return new showCreate(this.selector);
};
/**
   * hasClass(param);
   *classname has or without;
   * param:dom;
   */
window.hasClass = function(elemt, opt) {
  if(new RegExp(' ' + opt + ' ').test(' ' + elemt.className + ' ')){
  	return true;
  }else{
  	return false;
  };
}; 
/**
   * Soo(param1).addClass(param2);
   * add css className;
   * param1=>dom;param2=>added className;classname's typeof is string
   */
 var AddClassCreate = (function(){
   	var Fun = function(elemt,opt){
   		var elemts = typeof(elemt)=='object'?[elemt]:document.querySelectorAll(elemt);
   		for(var i=0;i<elemts.length;i++){
	 		if (!hasClass(elemts[i], opt)) {
			   elemts[i].className = elemts[i].className == '' ? opt : elemts[i].className + ' ' + opt;
			};  			
   		};
   	};
   	return Fun;
})();
Soo.fn.addClass = function(opts){
   	return new AddClassCreate(this.selector,opts);
};
/**
   * Soo(param1).removeClass(param2);
   * remove css className;
   * param1=>dom;param2=>removed className;classname's typeof is string
   */
 var RemoveClassCreate = (function(){
   	var Fun = function(elemt,opt){
   		var elemts = typeof(elemt)=='object'?elemt:document.querySelectorAll(elemt);
   		for(var i=0;i<elemts.length;i++){
	 		if (hasClass(elemts[i], opt)) {
			    var newClass = ' ' + elemts[i].className.replace(/[\t\r\n]/g, '') + ' ';
			    while (newClass.indexOf(' ' + opt + ' ') >= 0) {
			      newClass = newClass.replace(' ' + opt + ' ', ' ');
			    };
			    elemts[i].className = newClass.replace(/^\s+|\s+$/g, '');
			};  			
   		};
   	};
   	return Fun;
})();
Soo.fn.removeClass = function(opts){
   	return new RemoveClassCreate(this.selector,opts);
}; 
/**
   * sooPopup(param)；
   * have two type,one hand is warn,and other hand is make from own;
   * param:defaults
   */
var PopupCreate = (function(){
	var defaults = {
		selfClick:false,
 		warn:true,
 		warnText:'警告',
 		width:'50%',
 		height:'auto',
 		positionT:'20%'
	};
	var Fun = function(ele,opt){
		var _this = this;
		this.ele = ele;
		this.opts = Soo.extend(defaults,opt);
		if(this.opts.selfClick){
			var btn = document.getElementById(ele);
 			btn.addEventListener('click',function(){	
 				_this.show();
 			});
		}else{
			_this.show();
		};
	};
	Fun.prototype.show = function(){
		var popupSeat = document.createElement('div');
		SooBody.appendChild(popupSeat);
		if(this.opts.warn){
			var str ='<div id="popup-box">'
						+'<div id="popup-main" style="margin-top:'+this.opts.positionT+';width:'+this.opts.width+';height:'+this.opts.height+';">'
							+'<div id="popup-text">'
								+'<p>'+this.opts.warnText+'</p>'
							+'</div>'
							+'<div id="popup-btn">'
								+'<button id="hidden">确定</button>'
							+'</div>'
						+'</div>'
					+'</div>';				
		}else{
			var popupContent = document.querySelector('.popup-content.'+this.ele);
			this.opts.warnText = popupContent.innerHTML;
		 	var str = 	'<div id="popup-box">'
				+'<div id="popup-main" style="margin-top:'+this.opts.positionT+';width:'+this.opts.width+';height:'+this.opts.height+';">'
					+'<div id="popup-text">'
						+this.opts.warnText
					+'</div>'
					+'<div id="popup-btn">'
						+'<button id="sure">确定</button>'
						+'<button id="hidden">取消</button>'
					+'</div>'
				+'</div>'
			+'</div>';
		};
		popupSeat.innerHTML=str;		
		var popupBox = document.getElementById('popup-box');
		var hideBtn = document.querySelector('#popup-box #hidden');
		popupBox.addEventListener('touchmove',function(e){
		    e.preventDefault()
		});	
		hideBtn.addEventListener('click',function(){
		 	SooBody.removeChild(popupSeat);
		});
	};
	return Fun;
})();
Soo.fn.sooPopup = function(opt){
	return new PopupCreate(this.selector,opt);
};
/**
   * sooFixedHeader(param)；
   * fixed head-nav and change background from scroll;
   * param:defaults
   */
//
var FixedHeaderCreate = (function(){
   	var defaults = {
		bgState:"-webkit-gradient(linear,0 -50%,0 100%,from(rgba(51, 51, 51, 0.6)),to(rgba(255,255,255,0)))",
		bgColor:"205,6,6",
		changeRange:"300",
		opacityMax:"0.6"
   	};
   	var Fun = function(elemt,opts){
   		this.head = document.getElementById(elemt);
   		var scrollTop;
   		this.opts = Soo.extend(defaults,opts);
   		this.scroll();
   	};
   	Fun.prototype.scroll = function(){
   		var _this = this;
   		var scrollTop;
   		var ratio = _this.opts.changeRange/_this.opts.opacityMax;
   		window.addEventListener('scroll',function(){
   			scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
   			var _opacity = Math.floor((scrollTop/ratio)*100)/100; 
   			var bg = _opacity>_this.opts.opacityMax ?'rgba('+_this.opts.bgColor+','+_this.opts.opacityMax+')' :'rgba('+_this.opts.bgColor+','+_opacity+')';
   	        if(scrollTop == 0){
   	            _this.head.style.background = _this.opts.bgState;
   	        }else{
   	            _this.head.style.background = bg;
   	        };
   		});
   	};
   	return Fun;
})();
Soo.fn.sooFixedHeader = function(opts){
   	return new FixedHeaderCreate(this.selector,opts);
};
  
/**
   * sooBcakCeil(param)；
   * fixed head-nav and change background from scroll;
   * param:defaults
   */
//
var BcakCeilCreate = (function(){
   	var defaults = {
   		positionR:'20px',
   		positionB:'40px',
   		showRange:1000,
   		backSpeed:3,
   		instant:false
   	};
   	var Fun = function(elemt,opt){
   		this.backBtn = document.getElementById(elemt);
   		this.timer = null;
   		this.isTop = true;
   		this.opts = Soo.extend(defaults,opt);
   		this.backBtn.style.bottom = this.opts.positionB;
   		this.backBtn.style.right = this.opts.positionR;
   		this.scroll();
   		this.backMove();
   	};
   			
   	Fun.prototype.scroll = function(){  		
   		var _this = this;
   		var scrollTop;
   		window.addEventListener('scroll',function(){
   			scrollTop = document.documentElement.scrollTop||document.body.scrollTop; 
   			scrollTop>= _this.opts.showRange ?Soo(_this.backBtn).show():Soo(_this.backBtn).hide();
     		if(!_this.isTop) clearInterval(_this.timer);
	        _this.isTop = false;	        
   		});
   	};
   	Fun.prototype.backMove = function(){
		var _this = this;  		
		this.backBtn.onclick = function(){
			if(_this.opts.instant){
				 document.documentElement.scrollTop = document.body.scrollTop = 0;
			}else{
		        _this.timer = setInterval(function(){
		            var nowTop = document.documentElement.scrollTop || document.body.scrollTop;
		            var speed = Math.floor(-nowTop / 6);
		            document.documentElement.scrollTop = document.body.scrollTop = nowTop + speed;
		            _this.isTop =true; 
		            if(nowTop == 0) clearInterval(_this.timer);
		        },_this.opts.backSpeed);				
			};
		 };
   	};
   	return Fun;
})();
Soo.fn.sooBcakCeil = function(opts){
   	return new BcakCeilCreate(this.selector,opts);
};
    
/**
   * tab-classify()();
   * btn's type is classify;it's only in one html;
   * param:null
   */
Soo.tabClassify = (function(){
	var classifyMain = document.getElementById('tab-classify')||null;
	if(!classifyMain) return;
	var classifyBtnList = classifyMain.querySelectorAll('#classify-btn>#li-btn li');
	var classifyCentList = classifyMain.querySelectorAll('#classify-content .content');
	for(var i= 0;i<classifyBtnList.length;i++){
		classifyBtnList[i].index = i;
		classifyBtnList[i].addEventListener('click',function(){
			Soo('#classify-btn>#li-btn li').removeClass('btn-active');
			Soo(this).addClass('btn-active');
			var classifyCent = classifyCentList[this.index];
			var _text = this.innerHTML;
			var _p = classifyCent.getElementsByClassName('content-title')[0];
			_p.innerHTML = _text;
			Soo(classifyCentList).hide();
			Soo(classifyCent).show();
		});
	};
})();    
/**
   * tab-menus-up();
   * btn's type ismenus-up;
   * param:null
   */
Soo.tabMenusUp = (function(){
	var menusUps = document.querySelectorAll('.tab-menus-up');
	if(menusUps.length ==0) return;
	var a=[],
		b=[];
	for(var j=0;j<menusUps.length;j++){
		(function(j){
			a[j] = menusUps[j].querySelectorAll('.tab-up-btn>ul li');
			b[j] = menusUps[j].querySelectorAll('.tab-up-content>.content');	
			for(var i= j;i<a[j].length;i++){
				a[j][i].index = i;
				a[j][i].addEventListener('click',function(){
					Soo(a[j]).removeClass('menus-active');
					Soo(this).addClass('menus-active');
					var classifyCent = b[j][this.index];
					Soo(b[j]).hide();
					Soo(classifyCent).show();
				});
			};	
		})(j);
	};
})();  
/**
   * lazyload(param);
   * img lazyloading;
   * param:null
   */ 
Soo.lazyload = function(param) {
	var a = param?param:{ 
						 id:null,
						 lazyTime:0,
						 lazyRange:0
						 };
    function i() {
        for (var a = 0,
        b = h; b > a; a++) {
            var c = e[a];
            j(c) && (k(c), e.splice(a, 1), h--, 0 === h && m())
        }
    }
    function j(b) {
        var c = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
        if ("undefined" == typeof b) return ! 1;
        for (var d = ~~b.getAttribute("data-lazy-range") || a.lazyRange, e = c + document.documentElement.clientHeight + d, f = 0;
        "BODY" !== b.tagName;) f += b.offsetTop,
        b = b.offsetParent;
        return e > f
    }
    function k(b) {
        a.lazyTime ? setTimeout(function() {
            l(b)
        },
        a.lazyTime + ~~b.getAttribute("data-lazy-time")) : l(b)
    }
    function l(a) {
        a.src = a.getAttribute("data-lazy-src")
    }
    function m() {
        window.removeEventListener ? window.removeEventListener("scroll", i, !1) : window.detachEvent("onscroll", i)
    }
    var b = a.id ? document.getElementById(a.id) : document;
    if (null !== b) {
        for (var c = b.getElementsByTagName("img"), d = c.length, e = [], f = 0; d > f; f++) {
            var g = c[f];
            null !== g.getAttribute("data-lazy-src") && (j(g) ? l(g) : e.push(g))
        }
        var h = e.length;
        m(),
        window.addEventListener ? window.addEventListener("scroll", i, !1) : window.attachEvent("onscroll", i)
    }
};  