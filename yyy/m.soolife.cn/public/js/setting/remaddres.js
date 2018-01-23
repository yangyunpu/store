$(function(){
	  //选择城市
 //    var area = new LArea();
	// area.init({
	//     'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
	//     'valueTo':'#value1',//选择完毕后id属性输出到该位置
	//     'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
	//     'type':1,//数据源类型
	//     'data':LAreaData//数据源
	// });
	//修改地址提交
	var regionno = $("[name|='regionno']").val();
	$(".btn_sure").click(function(){
	 	// var name = $(".name").val();
	 	// var iphone = $(".iphones").val();
	 	// var three =$(".three_level").val();
	 	// var address =$('.detail').val();
	 	// console.log(name);
	 	// console.log(iphone);
	 	// console.log(three);
	 	// console.log(address);
	 	// delectAjax(name,iphone,three,address);
	var consignee = $("[name|='consignee']").val();
	var mobile = $("[name|='mobile']").val();
	var address = $("[name|='address']").val();
	var id = $("[name|='id']").val();
	if(!(/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/.test(mobile))){
		// alert_mark('手机号码格式输入不正确',3000);
		alert('手机格式不正确');
		return;
	};
	if(consignee=='' || mobile=='' || address=='' || regionno==''){
		// alert_mark('信息填写不完整',3000);
		alert('信息填写不完整');
		return;
	};
	console.log(111);
	setAfterData.id = id;
	setAfterData.consignee = consignee;
	setAfterData.mobile = mobile;
	setAfterData.address = address;
	setAfterData.regionno = regionno;
	submitSite(setAfterData);

	})


	function submitSite(){
		console.log(setAfterData);
		$.ajax({
			url: '/setting/revampaddress',
			type: 'GET',
			dataType: 'json',
			data: setAfterData,
			success:function(res){
				console.log(res);
				if(res.data.success){
					window.location.href = '/setting/site.html';
				};
			}
		});
	};


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
$('#demo1').click(function(){
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
	$("[name|='regionno']").val(regionno);
	setAfterData.regionno = regionno;
	// console.log(setAfterData);
	var text = $('#province').text()+$('#city').text()+$('#county').text();
	$('#demo1').val(text);
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

})