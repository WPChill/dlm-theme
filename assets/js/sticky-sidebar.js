(function($, undefined){
	$.extend({
		"stickysidebarscroll": function(el, config){
			if (config && config.offset) {
				config.offset.bottom = parseInt(config.offset.bottom,10);
				config.offset.top = parseInt(config.offset.top,10);
			} else {
				config.offset = {bottom: 100, top: 0};	
			}
			var el =$(el);
			if(el && el.offset()){
				var el_top = el.offset().top,
				el_left = el.offset().left,
				el_height = el.outerHeight(true),
				el_width = el.outerWidth(),
				el_position = el.css("position"),
				el_position_top = el.css("top"),
				el_margin_top = parseInt(el.css("marginTop"),10),
				doc_height=$(document).height(),
				max_height = $(document).height() - config.offset.bottom,
				top = 0,
				swtch = false,
				locked=false,
				pos_not_fixed = false;
				if (config.forcemargin === true || navigator.userAgent.match(/\bMSIE (4|5|6)\./) || navigator.userAgent.match(/\bOS (3|4|5|6)_/) || navigator.userAgent.match(/\bAndroid (1|2|3|4)\./i)){
					pos_not_fixed = true;
				}
				$(window).bind('scroll resize orientationchange load',el,function(e){
					if(doc_height !== $(document).height()) {
						max_height = $(document).height() - config.offset.bottom;
						doc_height=$(document).height();
					}
					if(locked == false) {
						el_top = el.offset().top;
					}
					var el_height = el.outerHeight(),
						scroll_top = $(window).scrollTop();
					if(pos_not_fixed && document.activeElement && document.activeElement.nodeName === "INPUT"){
						return;	
					}	
					locked=true;
					if (scroll_top >= (el_top-(el_margin_top ? el_margin_top : 0)-config.offset.top)) {
						if (max_height < (scroll_top + el_height + el_margin_top + config.offset.top)) {
							top = (scroll_top + el_height + el_margin_top + config.offset.top) - max_height;
						} else {
							top = 0;	
						}
						if (pos_not_fixed) {
							el.css({'marginTop': parseInt(((el_margin_top ? el_margin_top : 0) + (scroll_top - el_top - top) + 2 * config.offset.top),10)+'px'});
						} else {
							el.css({'position': 'fixed','top':(config.offset.top-top)+'px', 'width':el_width +"px"});
						}
					} else {
						locked=false;
						el_left = el.offset().left;
						el.css({'position': el_position,'top': el_position_top, 'left': el_left, 'width':el_width +"px", 'marginTop': (el_margin_top ? el_margin_top : 0)+"px"});
					}
				});	
			}
		}
	});
    $(document).ready(function() {
        $.stickysidebarscroll(".dlm-extension-detail-info",{offset: {top: 10, bottom: 450}});
    });
})(jQuery);