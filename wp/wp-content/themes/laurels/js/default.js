jQuery(document).ready(function() {	 
	 jQuery("#media_slide").owlCarousel({		
		items : 2,
		itemsDesktop : [1199,2],
		itemsTablet : [768, 1],
		itemsDesktopSmall : [979,2],
		itemsMobile : [480,1]
	 });
	var owl = jQuery("#media_slide");
	owl.owlCarousel();
	jQuery(".next").click(function(){
		owl.trigger('owl.next'); 
	 });
	  jQuery(".prev").click(function(){
		owl.trigger('owl.prev'); 
	 });
});

