 $(function(){
    var edit_type = $('input[name=edit]').val();
    //beigin 三级联动////////////////////////////////////////////////////////////////////////
    var changeRegion = function(obj, pid, def) {
        var addres = $("#" + obj);
        if (def == null || def == '') {
            def = addres.attr("data-id");
        }
        $.ajax({
            url: "/sop/address",
            type: "post",
            data: {
                pid: pid
            },
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            success: function(d) {
                if (d.length > 0) {
                    //清空里面的内容
                    addres.empty();
                    $.each(d, function(i, n) {
                        var s = "<option value='" + n.region_id + "' " + (n.region_id == def ? "selected='selected'" : "") + ">" + n.name + "</option>";
                        addres.append(s);
                    });
                    addres.change();
                }
            },
        });
    };
    $("#province").change(function() {
        if (this.value == 'CN71' || this.value == 'CN81' || this.value == 'CN82') {
            $("#city").css("display", "none");
            $("#county").css("display", "none");
        } else {
            $("#city").css("display", "");
            $("#county").css("display", "");
            if (edit_type == 1){
                changeRegion('city', this.value, region.f_region_id);
            }else{
                changeRegion('city', this.value, '');
            }
        }
    });
    $("#city").change(function() {
        if (edit_type == 1) {
            changeRegion('county', this.value, region.region_id);
        }else{
            changeRegion('county', this.value, '');
        }
    });
    if (edit_type == 1) {
        changeRegion('province', 'CN', region.ff_region_id);
    }else {
        changeRegion('province', 'CN', '');
    }
    //end 三级联动////////////////////////////////////////////////////////////////////////
// 时间选择器
   jeDate({
    		dateCell:"#dateinfo",
    		format:"YYYY-MM-DD",
    		// isinitVal:true,
    		isTime:false, //isClear:false,
    		// minDate:"2014-09-19 00:00:00",
    		okfun:function(val){alert(val)}
  	})
    jeDate({
    		dateCell:"#dateinfos",
    		format:"YYYY-MM-DD",
    		// isinitVal:true,
    		isTime:false, //isClear:false,
    		// minDate:"2014-09-19 00:00:00",
    		okfun:function(val){alert(val)}
  	})
    jeDate({
    		dateCell:"#dateinfoer",
    		format:"YYYY-MM-DD",
    		// isinitVal:true,
    		isTime:false, //isClear:false,
    		// minDate:"2014-09-19 00:00:00",
    		okfun:function(val){alert(val)}
	});
    $('.scertified_image').ace_file_input({
        style: 'well',
        btn_choose: '点选图片',
        btn_change: null,
        no_icon: 'ace-icon fa fa-cloud-upload',
        droppable: true,
        maxSize: 153600,//bytes
        whitelist:'gif|png|jpg|jpeg',
        thumbnail: 'large',
    });
})