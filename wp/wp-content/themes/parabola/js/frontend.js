/*
 * Parabola Theme custom frontend scripting
 * http://www.cryoutcreations.eu/
 *
 * Copyright 2013-14, Cryout Creations
 * Free to use and abuse under the GPL v3 license.
 */

jQuery(document).ready(function() {

	/* Standard menu touch support for tablets */
	var custom_event = ('ontouchstart' in window) ? 'touchstart' : 'click'; // check touch support 
	var ios = /iPhone|iPad|iPod/i.test(navigator.userAgent);
		jQuery('#access .menu > ul > li a').on('click', function(e){
			var $link_id = jQuery(this).attr('href');
			if (jQuery(this).parent().data('clicked') == $link_id) { // second touch 
				jQuery(this).parent().data('clicked', null);
			}
			else { // first touch 
				if (custom_event != 'click' && !ios && (jQuery(this).parent().children('.sub-menu').length >0)) {e.preventDefault();}
				jQuery(this).parent().data('clicked', $link_id);
			}
		}); 

/* Back to top button animation */
jQuery(function() {
	jQuery(window).scroll(function() {
		var x=jQuery(this).scrollTop();
		 var ver = getInternetExplorerVersion();
		/* no fade animation (transparency) if IE8 or below */
		if ( ver > -1 && ver <= 8 ) {
			if(x != 0) {
					jQuery('#toTop').show();
					} else {
					jQuery('#toTop').hide();
						}
		}
		/* fade animation if not IE8 or below */
		else {
		if(x != 0) {
				jQuery('#toTop').fadeIn(3000);
			} else {
				jQuery('#toTop').fadeOut();
			}
	}
	});
	jQuery('#toTop').click(function() { jQuery('body,html').animate({scrollTop:0},800); });
});


/* Menu animation */

jQuery("#access > div > ul > li").hover(function(){
	if (jQuery(this).find('ul').length > 0)
	jQuery("#access > div > ul > li > ul").hide();
							});

jQuery("#access ul ul").css({display: "none"}); /* Opera Fix */
jQuery("#access > .menu ul li > a:not(:only-child)").attr("aria-haspopup","true");/* IE10 mobile Fix */

jQuery("#access li").hover(function(){
	jQuery(this).find('ul:first').stop();
	jQuery(this).find('ul:first').css({opacity: "0.5"}).css({visibility: "visible",display: "none",overflow:"visible"}).slideDown({duration:200}).animate({"opacity":"1"},{queue:false});
	},function(){ 
	jQuery(this).find('ul:first').css({visibility: "visible",display: "block",overflow:"visible"}).slideUp(150);
							});
							
/* Social Icons Animation */
jQuery(".socialicons").append('<div class="socials-hover"></div>');
jQuery(".socialicons").hover(function(){
		jQuery(this).find(".socials-hover").animate({"bottom":"0px"},{queue:false,duration:150});
	},function() {
		jQuery(this).find(".socials-hover").animate({"bottom":"30px"},{queue:false,duration:150, complete: function() {
			jQuery(this).css({bottom:"-30px"});
			}
		});
	} 
);

/* Detect and apply custom class for Safari */
if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	jQuery('body').addClass('safari');
}

}); 
/* end document.ready */


/* Mobile Menu v2 */
function parabola_mobilemenu_init() {
	var state = false;
	jQuery("#nav-toggle").click(function(){
		jQuery("#access").slideToggle(function(){ if (state) {jQuery(this).removeAttr( 'style' )}; state = ! state; } );
	});
}

/* Columns equalizer, used if at least one sidebar has a bg color */
function equalizeHeights(){
    var h1 = jQuery("#primary").height();
	var h2 = jQuery("#secondary").height();
	var h3 = jQuery("#content").height();
    var max = Math.max(h1,h2,h3);
	if (h1<max) { jQuery("#primary").height(max); };
	if (h2<max) { jQuery("#secondary").height(max); };

}

/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){
  "use strict";
  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {
      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];
      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = '&shy;<style> .fluid-width-video-wrapper { width: 100%; position: relative; padding: 0; } .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } </style>';
      ref.parentNode.insertBefore(div,ref);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); /* SwfObj conflict patch */

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
		if ( width<cryout_global_content_width ) { return; } /* hack to not resize small objects */
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})( jQuery );


/* Returns the version of Internet Explorer or a -1
  (indicating the use of another browser). */
function getInternetExplorerVersion()
{
  var rv = -1; /* assume not IE. */
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}