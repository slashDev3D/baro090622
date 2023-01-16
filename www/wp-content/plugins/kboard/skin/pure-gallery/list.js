/**
 * @author https://www.cosmosfarm.com/
 */

/**
 * inViewport jQuery plugin by Roko C.B.
 * http://stackoverflow.com/a/26831113/383904 Returns a callback function with
 * an argument holding the current amount of px an element is visible in
 * viewport (The min returned value is 0 (element outside of viewport)
 */
(function($, win) {
	$.fn.kboardPureGalleryViewport = function(cb) {
		return this.each(function(i, el) {
			function visPx() {
				var elH = $(el).outerHeight(), H = $(win).height(), r = el.getBoundingClientRect(), t = r.top, b = r.bottom;
				return cb.call(el, Math.max(0, t > 0 ? Math.min(elH, H - t) : (b < H ? b : H)));
			}
			visPx();
			$(win).on("resize scroll", visPx);
		});
	};
}(jQuery, window));

jQuery(document).ready(function(){
	kboard_pure_gallery_list_layout();
	
	setTimeout(function(){
		jQuery('.kboard-pure-gallery-list .kboard-list-item').kboardPureGalleryViewport(function(px){
			if(jQuery('#kboard-pure-gallery-list').hasClass('active-fadein')){
				if(px && !jQuery(this).hasClass('animation-fadein')){
					jQuery(this).addClass('animation-fadein');
				}
			}
		});
	});
});

jQuery(window).resize(function(){
	kboard_pure_gallery_list_layout();
});

function kboard_pure_gallery_list_layout(){
	jQuery('.kboard-pure-gallery-list').each(function(){
		var parent = jQuery(this).parent('#kboard-pure-gallery-list');
		var width = jQuery(parent).width();

		if(!jQuery(parent).hasClass('pure-gallery-row')){
			if(width > 1400){
				jQuery(parent).removeClass('mw1400');
				jQuery(parent).removeClass('mw1200');
				jQuery(parent).removeClass('mw1000');
				jQuery(parent).removeClass('mw800');
				jQuery(parent).removeClass('mw600');
			}
			else if(width > 1200){
				jQuery(parent).addClass('mw1400');
				jQuery(parent).removeClass('mw1200');
				jQuery(parent).removeClass('mw1000');
				jQuery(parent).removeClass('mw800');
				jQuery(parent).removeClass('mw600');
			}
			else if(width > 1000){
				jQuery(parent).removeClass('mw1400');
				jQuery(parent).addClass('mw1200');
				jQuery(parent).removeClass('mw1000');
				jQuery(parent).removeClass('mw800');
				jQuery(parent).removeClass('mw600');
			}
			
			else if(width > 800){
				jQuery(parent).removeClass('mw1400');
				jQuery(parent).removeClass('mw1200');
				jQuery(parent).addClass('mw1000');
				jQuery(parent).removeClass('mw800');
				jQuery(parent).removeClass('mw600');
			}
			else if(width > 600){
				jQuery(parent).removeClass('mw1400');
				jQuery(parent).removeClass('mw1200');
				jQuery(parent).removeClass('mw1000');
				jQuery(parent).addClass('mw800');
				jQuery(parent).removeClass('mw600');
			}
			else{
				jQuery(parent).removeClass('mw1400');
				jQuery(parent).removeClass('mw1200');
				jQuery(parent).removeClass('mw1000');
				jQuery(parent).removeClass('mw800');
				jQuery(parent).addClass('mw600');
			}
		}
		var item_width = jQuery('.kboard-list-item', this).width();
		jQuery('.kboard-list-item .kboard-list-thumbnail', this).css({'height':item_width+'px'});
	});
}

function kboard_pure_gallery_search_toggle(){
	if(jQuery('.kboard-pure-gallery-search').hasClass('active-search')){
		jQuery('.kboard-pure-gallery-search').removeClass('active-search');
	}
	else{
		jQuery('.kboard-pure-gallery-search').addClass('active-search');
	}
}