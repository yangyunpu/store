(function(){
	// 红包达人
	var lcyMoneyLead = {
		bEvent:function(){
			this.boardMove();
		},
		boardMove:function(){
			var n = 0;
			var timer;
			var firstLi_h;
			var m_top;
			var	firstLi = $('.main_board ul li:first-child');
			var	lastLi = $('.main_board ul li:last-child');
			var _ul = $('.main_board ul');
			timer = setInterval(function(){
				n -= 1;
				_ul.css({'margin-top':n});
				firstLi_h = firstLi.outerHeight();
				m_top = parseInt(_ul.css('margin-top').replace(/[^0-9]/g, ""));
				if(-m_top <= -firstLi_h){
					n=0;
					_ul.css({'margin-top':'0'});
					$('.main_board ul li:first-child').insertAfter($('.main_board ul li:last-child'));
				};
			},200);
		}
	}
	lcyMoneyLead.bEvent();
})();