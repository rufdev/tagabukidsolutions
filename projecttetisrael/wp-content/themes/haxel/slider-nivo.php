<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.
if ( get_theme_mod('haxel_main_slider_enable' ) && is_front_page() ) : 

	$count_x = $count = get_theme_mod('haxel_main_slider_count');
		
		?>
		<div id="slider-bg">
			<div class="container">
				<div class="slider-wrapper theme-default">
			            <div id="nivoSlider" class="nivoSlider">
			            <?php
			            for ( $i = 1; $i <= $count; $i++ ) :
	
							$url = esc_url ( get_theme_mod('haxel_slide_url'.$i) );
							$img = esc_url ( get_theme_mod('haxel_slide_img'.$i) );
							
							if ($img != '') :
							?>
							
				            <a href="<?php echo $url; ?>"><img src="<?php echo $img ?>" title="#caption_<?php echo $i ?>" /></a>
				            
			             <?php
				             endif;
				         endfor; ?>
			               
			            </div>
			            
			            <?php
			            for ( $i = 1; $i <= $count_x; $i++ ) :
	
							$title = get_theme_mod('haxel_slide_title'.$i);
							$desc = get_theme_mod('haxel_slide_desc'.$i);
							$button = get_theme_mod('haxel_slide_CTA_button'.$i);
							$url = esc_url ( get_theme_mod('haxel_slide_url'.$i) );
							
							
							?>
				            <div id="caption_<?php echo $i ?>" class="nivo-html-caption">
				                <a href="<?php echo $url ?>">
					                <div class="slide-title"><?php echo $title ?></div>
					                <div class="slide-desc"><span><?php echo $desc ?></span></div>
					                <?php if ($button != "") { ?><div class="slide-cta"><span><?php echo $button ?></span></div><?php } ?>
				                </a>
				            </div>
			            <?php endfor; ?>
			            
			        </div>
			</div> 
		</div>
	
	<?php	
	
endif;	?>	   