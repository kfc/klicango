(function( $ ) {
	$.extend({		
		/*Add/remove help text in input-text fields and text areas, using "title" attribute.*/
		inputtextValuesSet: {
			setValues: function(){
				$('input[type="text"], textarea').each(function(){
					var curEl = this;
					var curElObj = $(this);
					
					if(curElObj.attr('title') && $.inputtextValuesSet.fTrim(curEl.value).length === 0){
						curEl.value = curElObj.attr('title');
					}
					
					if(curElObj.attr('title') == $.inputtextValuesSet.fTrim(curEl.value)) {
						curElObj.addClass('defaultText');
					}
					
					curElObj.blur(function(){
						var sValue = $.inputtextValuesSet.fTrim(curEl.value);
						if(sValue.length===0 && curElObj.attr('title')){
							curEl.value = curElObj.attr('title');
							curElObj.addClass('defaultText');
						}
					});
					
					curElObj.focus(function(){
						curElObj.removeClass('defaultText');
						var sValue = $.inputtextValuesSet.fTrim(curEl.value);
						if(curElObj.attr('title') && sValue==curElObj.attr('title')){
							curEl.value= '';
						}
					});
				});
			},
			fTrim: function(s){
				return s.replace(/^\s*(.*?)\s*$/,"$1");
			}
		},
		
		/*Fix apple devices bug after Portrait/landscape changing*/
		appleScaleFix: {
			viewportmeta: document.querySelector && document.querySelector('meta[name="viewport"]'),
			ua: navigator.userAgent,
			gestureStart: function () {
				$.appleScaleFix.viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
			},
			scaleFix: function () {
				if ($.appleScaleFix.viewportmeta && /iPhone|iPad/.test($.appleScaleFix.ua) && !/Opera Mini/.test($.appleScaleFix.ua)) {
					$.appleScaleFix.viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
					document.addEventListener("gesturestart", $.appleScaleFix.gestureStart, false);
				}
			}
		},
		
		init: function() {
			$.inputtextValuesSet.setValues();
			$.appleScaleFix.scaleFix();
		},
		
		initResize: function() {
		},
		
		initLoad: function() {
		}		
	});
} )(jQuery);
	
jQuery.noConflict();

jQuery( function( $ ) {
	$.init();
} );

jQuery(window).resize(function ( ) {
	jQuery.initResize();
} );

jQuery(window).load(function ( ) {
	jQuery.initLoad();
} );