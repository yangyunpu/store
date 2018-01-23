$(function(){
     var calendar = new LCalendar();
	    calendar.init({
	        'trigger': '#demo1', //标签id
	        'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
	        'minDate': '1900-1-1', //最小日期
	        'maxDate': new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate() //最大日期
	    });
    //选择城市

	// 选择性别
	$("#birsty_sex").click(function(){
		$(".lj_mark2").show();
		$(".lj_mark2>ul>li").click(function(){
			var text = $(this).html();
			var type  = $(this).attr("data-id");

			$(".lj_mark2").hide();
			$("#gend").val(text);
			$(".sexed").val(type);
		})
	})
//选择地区
	var defregionno = $('#site_mian').data('defregionno'); 
	var setAfterData = {
		setDefault:0,
		regionno:defregionno,
		address:'',
		consignee:'',	
		mobile:''
	};
//处理地址
function dealHref(){
	var arr = [];
	var _href = decodeURIComponent(window.location.href);
	var _href_opsition = window.location.href.indexOf('?');
	var _hreflength = window.location.href.length;
	var href_p = _href.substring(_href_opsition+1,_hreflength);
	return href_p;
};
var return_url = dealHref() || false; 
// 点击地址选择
$('#demos').click(function(){
	$('#mark').show();
	getSiteData('cn','#site_box #province_box');
	$('#province_box').show().siblings().hide();
}); 
//点击 “省” 
$('#province').on("click",function(){
	getSiteData('cn','#site_box #province_box');
	$('#province_box').show().siblings().hide();
	$('#city').text('市辖区');
	$('#county').text('县');
});
//点击 “省”下面的单元
$('#site_box').on("click","#province_box li",function(){
	$('#province').text($(this).text());
	var regionid = $(this).data('regionid');
	getSiteData(regionid,'#site_box #city_box');
	$('#city_box').show().siblings().hide();
});
//点击 “市”下面的单元
$('#site_box').on("click","#city_box li",function(){
	$('#city').text($(this).text());
	var regionid = $(this).data('regionid');
	getSiteData(regionid,'#site_box #county_box');
	$('#county_box').show().siblings().hide();
});
//点击 “县”下面的单元
$('#site_box').on("click","#county_box li",function(){
	$('#county').text($(this).text());
	var regionno = $(this).data('regionid');
	// setAfterData.regionno = regionno;
	$("#value2").val(regionno);
	var text = $('#province').text()+$('#city').text()+$('#county').text();
	$('#demos').val(text);
	$('#mark').hide();
	$('#province').text('省');
	$('#city').text('市辖区');
	$('#county').text('县');
	$('#province_box,#city_box,#county_box').html('');
});
//地址遮罩的X
$('#mark #main #title img').click(function(){
	$('#mark').hide();
	$('#province').text('省');
	$('#city').text('市辖区');
	$('#county').text('县');
	$('#province_box,#city_box,#county_box').html('');
});
	//地址联动-ajax
function getSiteData(regionid,box){
	$.ajax({
		url: '/setting/siteDataAjax',
		type: 'GET',
		dataType: 'json',
		data: {
			'regionid': regionid
		},
		success:function(res){ 
			var str = '';
			length = res.data.length;
			for(var i=0;i<length;i++){
				str+='<li data-regionid="'+res.data[i].region_id+'">'+res.data[i].name+'</li>'
			};
			$(box).html(str);
		}
	});	
};
  //点击保存按钮
  $(".share").click(function(){ 
  	var sex = $(".sexed").val();
  	var birstry = $("#demo1").val(); 
  	var region = $("#value2").val();

    

	personData(sex,birstry,region);

  })  
 
	//修改设置个人信息
function personData(sex,birstry,region){ 
	$.ajax({
		url: '/setting/personel',
		type: 'POST',
		dataType: 'json',
		data: {
			'sex'    : sex,
			'birstry': birstry,
			'region' : region
		},
		success:function(res){ 
			 // console.log(res); 
			 alert_mark('设置成功',3000);
			 window.location.href='/setting/safeset.html';
		}
	});	
};
// 弹出框
function alert_mark(str,time){
  $('#alert_mark').html(str);
  $('#alert_mark').show();
  setTimeout(function(){$('#alert_mark').hide();},time);
};//alert_mark('库存不足');

})