$(function(){
	var text = document.getElementById('aa').getAttribute('str');
	var btn = document.getElementById('btn');
	btn.onclick = function(){
         copyToClipboard(text);
	};


	function copyToClipboard(text) {
	  window.prompt("请复制链接到剪切板中", text);
	}
})