$.base64.utf8encode = true;
var hate = /\//g;
var soolife = /\+/g;
$(function() {
	$(".mallSearch-form button,.websearch").click(function() {
		var name = $(this).parent().find("input").val();
		if (name == "" && $(this).attr('class') == "span-search") {
			name = $(this).parent().find("input").attr("placeholder");
		}
		if(name==""&& $(this).parent().attr('class') == "mallSearch-input clearfix"){
			name = $(this).parent().find("label").text();
		}
		if ($(this).attr('class') == "span-search" && $(this).attr('data-value') == "stores") {
			window.location.href = "http://store.soolife.loc/store/" + name+ ".html";
		} else {
			if(name!=""){
				name=$.base64.btoa(name);
				name=name.replace(hate, "[Ihateyou]");
				name=name.replace(soolife, "[soolife]");
			}
			window.location.href = "http://store.soolife.loc/search/-*" +name + ".html";
		}
	});
	$(".mallSearch-form .s-combobox-input,.goodsinput .code").keyup(function(e) {
		if (e.keyCode == 13) {
			var name = $(this).val();
			if (name == "" && $(this).attr('class') == "code") {
				name = $(this).attr("placeholder");
			}
			if ($(this).attr('class') == "code" && $(this).attr('data-value') == "stores") {
				window.location.href = "http://store.soolife.loc/store/" + name + ".html";
			} else {
				if(name!=""){
				name=$.base64.btoa(name);
				name=name.replace(hate, "[Ihateyou]");
				name=name.replace(soolife, "[soolife]");
				}
				window.location.href = "http://store.soolife.loc/search/-*" + name + ".html";
			}
		}
	});
	$(".mall-search .s-combobox-input").keyup(function(e) {
		if (e.keyCode != 13) {
			var name = $(this).val();
			if(name!=""){
				goodsname=$.base64.btoa(name);
				goodsname=goodsname.replace(hate, "[Ihateyou]");
				goodsname=goodsname.replace(soolife, "[soolife]");
			}
			$(".search_goods b").text("" + name + "");
			$(".search_store b").text("" + name + "");
			$(".search_goods a").attr("href", "http://store.soolife.loc/search/-*" + goodsname + ".html");
			$(".search_store a").attr("href", "http://store.soolife.loc/store/" + name + ".html");
		}
	});
});