$(function(){ 
	    //下拉刷新////////////////////////////////////////////////////////////////////////////
     window.onscroll=function(){
        var a = $(window).height(); //是获取当前 也就是你浏览器所能看到的页面的那部分的高度 
        var c = $(document).height();
        var e = $(document).scrollTop();  
        // console.log(a);
        // console.log(e);
        // console.log(c);
        if(c>3000){
        	$('.lj_data').append( ); 
        	return;	
        }
        if(a+e == c){ 
            str ='<li>130****2354</li>'
	 			+'<li>138****5401</li>'
	 			+'<li>135****6689</li>'
	 			+'<li>152****3568</li>'
	 			+'<li>150****5742</li>'
	 			+'<li>133****2648</li>'
	 			+'<li>171****2215</li>'
	 			+'<li>188****9950</li>'
	 			+'<li>137****5521</li>'
	 			+'<li>150****1459</li>'
	 			+'<li>155****6584</li>'
	 			+'<li>138****9962</li>'
	 			+'<li>132****8564</li>'
	 			+'<li>178****5564</li>'
	 			+'<li>135****8541</li>'
	 			+'<li>150****8843</li>'
	 			+'<li>133****2623</li>'
	 			+'<li>133****4990</li>'
	 			+'<li>137****5418</li>'
	 			+'<li>150****0085</li>';
	 		$('.lj_load').hide();
	 		$('.lj_data').append(str);	
            return;
        }
    };
})