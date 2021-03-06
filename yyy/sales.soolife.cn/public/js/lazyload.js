window.onload=function(){
function lazyload(p) {
	var a = p?p:{  
			    lazyTime:0,
			    lazyRange:10
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
        for (var d = ~~b.getAttribute("data-range") || a.lazyRange, e = c + document.documentElement.clientHeight + d, f = 0;
        "BODY" !== b.tagName;) f += b.offsetTop,
        b = b.offsetParent;
        return e > f
    }
    function k(b) {
        a.lazyTime ? setTimeout(function() {
            l(b)
        },
        a.lazyTime + ~~b.getAttribute("data-time")) : l(b)
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
var lazyloading = lazyload();
};