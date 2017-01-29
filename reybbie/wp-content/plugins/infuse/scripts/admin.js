jQuery(document).ready(function(){
	jQuery('.infuse-tab').click(function(){
		var tab = jQuery(this).attr('rel');
		jQuery('.infuse-tab').removeClass('infuse-tab-active');
		jQuery('.infuse-tab-group').removeClass('infuse-tab-active');
		jQuery(this).addClass('infuse-tab-active');
		jQuery(tab).addClass('infuse-tab-active');
	});
	
	jQuery('.infuse-tab-content').click(function(){
		var value = jQuery(this).attr('rel');
		jQuery('#block_location').val(value);
	});
});