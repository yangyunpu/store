/**
	 * @param obj select 对像名
	 * @param pid 父级id
	 * @param def 默人值
	 */
	

	function list_region(obj, pid, def) {
		if (def == null || def == '') {
			def = $("#" + obj).attr("data-value");
		}
		$.ajax({
			url : '/address/region',
			data : {
				"pid" : pid
			},
			method:'POST',
			dataType : 'json',	
			success : function(d) {
				var p = $("#" + obj);
				if (d.msg.length > 0) {
					p.empty();//清空里面的内容
					$.each(d.msg, function(i, n) {						
						var s = "<option value='" + n.id + "' "+ ((n.id==def)?"selected='selected'":"")+"  >" + n.name + "</option>";
						p.append(s);
					});
					$("#" + obj).attr("value",def);
					p.change();
				}
			}
		});

	}
	
		$(function(){
			list_region('province', 'CN', $("#province").attr("data-value"));

				$("#province").change(function() {
				if(this.value== 'CN71' || this.value == 'CN81' || this.value == 'CN82'){
					$("#city").css("display","none");
					$("#region").css("display","none");
				}else{
					$("#city").css("display","");
					$("#region").css("display","");
					list_region('city', this.value, '');
				}
				});
				$("#city").change(function() {
					list_region('region', this.value, '');
				});
});
