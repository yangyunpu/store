/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
(function(){
	//var is_agent = true;
	var lcy_business = {
		start:function(){
				var token      = $('.lh_business').attr("token");
				var url_member = $('.lh_business').attr("url_member");
				var id         = $('.lh_business').attr("mid");
				if(token == 0){
			 	$.base64.utf8encode = true;
			 	var url =encodeURIComponent($.base64.btoa(window.location.href));
			 	window.location.href=url_member+"/login.html?return_url="+url; 
				}
				else{
					$.ajax({
		       	   	url  : "/isbusiness.html",
		       	   	type : "post",
		       	   	data : {
						"id" : id
					},
					dataType : 'json',
					success : function(data){
						//console.log(data)
						if(data.data.is_agent == true)
							var is_agent = true;
						else
							var is_agent = false;
						if(is_agent == false){
							$('.lcy_apply,.lcy_submit,.h_contract,.h_way').hide();
							$('.h_bcxy').show();
						} else{
							$('.lcy_apply,.lcy_submit,.h_contract,.h_bcxy').hide();
							$('.h_way').show();
						}
					}
		       	   })
				}

			$('#yes').click(function(){
				var id = $(".lh_business").attr("mid");
				$.ajax({
				    url  : "/subbusiness.html",
		       	   	type : "post",
		       	   	data : {
						"id" : id
					},
					dataType : 'json',
					success : function(data){
					}

				})
				$('.lcy_apply,.h_bcxy,.h_contract,.lcy_submit').hide();
				$('.h_way').show();
			});
			$('#no').click(function(){
				$('.lcy_apply').show();
				$('.lcy_submit,.h_contract,.h_bcxy,.h_way').hide();
			});
			$('#m_bao').click(function(){
				$('.lcy_submit').show();
				$('.lcy_apply,.h_contract,.h_bcxy,.h_way').hide();
			});
			$('#m_qian').click(function(){
				$('.h_contract').show();
				$('.lcy_apply,.lcy_submit,.h_bcxy,.h_way').hide();
			});
		},
       address:function(){
        //选择区域
        $('.text_mark').click(function(){
       	   $('.mark').show();       	    
       	   $('.marks').show();
       	   var id ="cn";
       	   $.ajax({
       	   	url : "/address.html",
       	   	type : "post",
       	   	data : {
				"id" : id
			},
			dataType : 'json',
			success : function(data){
				var data_list = data.data;
				for(i in data_list)
				{
					
					$(".sheng").append('<li id = '+data_list[i].region_id+' class = "aa">'+data_list[i].name+'</li>');

				}
				
			}
       	   })
       	});

       	// 点击省份
       	$('.provinced').click(function(){
       	   $('.spinner').show();
       	});
       	$('.spinner').on("click","li",function(){
       		var sheng = $(this).html();
       		$('.provinced').attr('data',sheng);
       		$('.provinced').html($(this).html());
       		$('.spinner').hide();
       		var id = $(this).attr('id');
       		$('.citys').html('');
       		$.ajax({
       	   	url : "/address.html",
       	   	type : "post",
       	   	data : {
				"id" : id
			},
			dataType : 'json',
			success : function(data){
				var data_list = data.data;
				if(data_list == undefined)
				{
					$('.citys').html('');
			        $('.sanjaksd').html('');
					$(".citys").css("display","none");
			        $(".sanjaksd").css("display","none");
			        
				}else{
					$(".citys").css("display","");
			        $(".sanjaksd").css("display","");
				}
				
				$(".bb").remove('.bb');
				$(".sanjaksd").text('');
				for(i in data_list)
				{
					$(".shi").append('<li id = '+data_list[i].region_id+' class="bb" >'+data_list[i].name+'</li>');
				}
				
			}
       	   })
       	});
      //   点击城市
       $('.citys').click(function(){
       	      $('.cityed').show();
         	});
        $('.cityed').on("click","li",function(){
       		var shi = $(this).html()      	
       		$('.citys').attr('data',shi);
       		$('.citys').html($(this).html());
       		$('.cityed').hide();

       		var id = $(this).attr('id');
       		$('.sanjaksd').html('');
       		$.ajax({
       	   	url : "/address.html",
       	   	type : "post",
       	   	data : {
				"id" : id
			},
			dataType : 'json',
			success : function(data){
				var data_list = data.data;
				$(".cc").remove('.cc');
				for(i in data_list)
				{
					$(".qu").append('<li id = '+data_list[i].region_id+' class="cc">'+data_list[i].name+'</li>');
				}
				
			}
       	   })
       	});
       // 点击县区
       $('.sanjaksd').click(function(){
       	      $('.countiesd').show();
         });
        $('.countiesd').on("click","li",function(){
       		var xian = $(this).html(); 	
       		$('.sanjaksd').attr('data',xian);   	
       		$('.sanjaksd').html($(this).html());
       		$('.countiesd').hide();
       	});
       	// 点击确定按钮
       	$(".sure").click(function(){
       		var sheng = $('.provinced').html();
       		var shi = $('.citys').html();
       		var xian = $('.sanjaksd').html();
       	    $('.marks').hide();
       	    $('.mark').hide();
       	    $('.elect').html(sheng+' '+shi+' '+xian)
            
       	})

   }

	}
	lcy_business.start();
	lcy_business.address();	
    
    $(".submit").on("click",function(){
    	//alert(1);
    	var a = $.trim($('.a').val());
    	var b = $.trim($('.b').val());
    	var c = $.trim($('.c').val());
    	var d = $.trim($('.elect').html());
    	var e = $.trim($('.e').val());
    	var f = $.trim($('.f').val());
    	var g = $.trim($('.g').val());
    	var h = $.trim($('.h').val());
    	var i = $.trim($('.i').val());
    	
    	
    	//信息来源
    	var h1_checked = $(".h1 input:checked");
    	var h1_text = '';
    	h1_checked.each(function(i){
    		h1_text += $(h1_checked[i]).attr("data") + ",";
    	});
    	h1_text=h1_text.substring(0,h1_text.length-1);
    	
    	//联系与否
    	var h2_checked = $(".h2 input:checked");
    	var h2_text = '';
    	h2_text = $(h2_checked).attr("data");
    
    	if(a == ''|| b == ''|| c == ''|| d ==''|| e ==  ''|| f == ''|| g ==  ''|| h ==  ''|| i ==''|| h1_text == '' || h2_text ==''  )
    	{
    	 alert('信息不全,请填写完整！');
    	 return;
    	}
    	$.ajax({
    		url : "/supplierpply.html",
	    	type : "post",
	    	dataType :"json",
	    	data : {
	    		"a" : a,
	    		"b" : b,
	    		"c" : c,
	    		"d" : d,
	    		"e" : e,
	    		"f" : f,
	    		"g" : g,
	    		"h" : h,
	    		"i" : i,
	    		"h1_text" : h1_text,
	    		"h2_text" : h2_text,
	    	},
	    	success : function(data){
	    		if(data.data.msg == "报备公司名称有相同，请检查后提交")
	    		{
	    			alert("数据有重复,请重新填写");
	    		}else{
	    			alert('提交成功,请等待审核！');
	    			var url = $(".submit").attr("url_member");
	    			window.location.href = url+'/exist/income.html';
	    		}
	    		
	    	}

    	})
    })
})();
