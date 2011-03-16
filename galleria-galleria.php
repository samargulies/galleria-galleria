<?php
/*
Plugin Name: Galleria Galleria
Plugin URI: 
Description: Transform standard WordPress galleries into galleria slideshows.
Version: 0.1
Author: Sam Margulies
Author URI: 
License: GPL

.

Based on Galleria Galleria by Thad Allender
http://graphpaperpress.com/

Bravo Aino!
http://galleria.aino.se/

Mr. Philip Arthur Moore for IE debugging
http://www.philiparthurmoore.com

*/

/**
 * Define plugin constants
 */
 
define ( 'GALLERIA_GALLERIA_PLUGIN_URL', WP_PLUGIN_URL . '/' . dirname( plugin_basename(__FILE__) ) );
define ( 'GALLERIA_GALLERIA_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . dirname( plugin_basename(__FILE__) ) );

/**
 * Add plugin options & menu
 */
 

/**
 * Init plugin options to white list our options
 */
 
function galleria_galleria_options_init(){
	register_setting( 'galleria_galleria_options', 'galleria_galleria', 'galleria_galleria_options_validate' );
}
add_action( 'admin_init', 'galleria_galleria_options_init' );
/**
 * Load up the menu page
 */
 
function galleria_galleria_options_add_page() {
	add_options_page( __( 'Galleria Galleria' ), __( 'Galleria Galleria' ), 'manage_options', 'galleria_galleria_options', 'galleria_galleria_options_do_page' );
}
add_action( 'admin_menu', 'galleria_galleria_options_add_page' );
/**
 * Create arrays for our select and radio options
 */

$design_options = array(
	'classic' => array(
		'value' =>	'classic',
		'label' => __( 'Classic' )
	),
	'dots' => array(
		'value' =>	'dots',
		'label' => __( 'Dots' )
	),
		'fullscreen' => array(
		'value' =>	'fullscreen',
		'label' => __( 'Fullscreen' )
	)
);

$transition_options = array(
	'fade' => array(
		'value' =>	'fade',
		'label' => __( 'Fade' )
	),
	'flash' => array(
		'value' =>	'flash',
		'label' => __( 'Flash' )
	),
	'slide' => array(
		'value' => 'slide',
		'label' => __( 'Slide' )
	),
	'fadeslide' => array(
		'value' => 'fadeslide',
		'label' => __( 'Fade & Slide' )
	)
);

$image_options = array(
	'medium' => array(
		'value' =>	'medium',
		'label' => __( 'Medium' )
	),
	'large' => array(
		'value' =>	'large',
		'label' => __( 'Large' )
	)
);

/**
 * Create the options page
 */
 
function galleria_galleria_options_do_page() {
	global $design_options, $transition_options, $image_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

	?>
	<div class="wrap">
		<h2><?php _e( 'Galleria Galleria' ); ?></h2>
		
		<p></p>
		
		<form method="post" action="options.php">
			<?php settings_fields('galleria_galleria_options'); ?>
			<?php $options = get_option('galleria_galleria'); ?>

			<table class="form-table">
			
				<?php
				
				/**
				 * Design options
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Design' ); ?></th>
					<td>
						<select name="galleria_galleria[design]">
							<?php
								$selected = $options['design'];
								$p = '';
								$r = '';

								foreach ( $design_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="galleria_galleria[design]"><?php _e( 'Select a design.  Don\'t be shy.' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Autoplay
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Autoplay' ); ?></th>
					<td>
						<input id="galleria_galleria[autoplay]" name="galleria_galleria[autoplay]" type="checkbox" value="1" <?php checked( '1', $options['autoplay'] ); ?> />
						<label class="description" for="galleria_galleria[autoplay]"><?php _e( 'Check to play as a slideshow' ); ?></label>
					</td>
				</tr>

				<?php
				
				/**
				 * Height options
				 */
				/*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Height' ); ?></th>
					<td>
						<input style="width:100px" id="galleria_galleria[height]" class="regular-text" type="text" name="galleria_galleria[height]" value="<?php esc_attr_e( $options['height'] ); ?>" />
						<label class="description" for="galleria_galleria[height]"><?php _e( 'Set a maximum fixed height in pixels. Otherwise, things break.  Numbers only.  Example: 590' ); ?></label>
					</td>
				</tr>
				
				<?php
				*/
				
				/**
				 * Width options
				 */
				/*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Width' ); ?></th>
					<td>
						<input style="width:100px" id="galleria_galleria[width]" class="regular-text" type="text" name="galleria_galleria[width]" value="<?php esc_attr_e( $options['width'] ); ?>" />
						<label class="description" for="galleria_galleria[width]"><?php _e( 'Set a maximum fixed width in pixels. This is theme-specific, so measure the width of the space Galleria Galleria will occupy.  Numbers only.  Example: 500' ); ?></label>
					</td>
				</tr>

				<?php
				*/
				
				/**
				 * Transition options
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Transition' ); ?></th>
					<td>
						<select name="galleria_galleria[transition]">
							<?php
								$selected = $options['transition'];
								$p = '';
								$r = '';

								foreach ( $transition_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="galleria_galleria[transition]"><?php _e( 'How do you want Galleria Galleria to transition from image to image?' ); ?></label>
					</td>
				</tr>
				
				<?php
				
				/**
				 * Color options
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Background color' ); ?></th>
					<td>
						<input style="width:100px" id="galleria_galleria[color]" class="regular-text" type="text" name="galleria_galleria[color]" value="<?php esc_attr_e( $options['color'] ); ?>" />
						<label class="description" for="galleria_galleria[color]"><?php _e( 'Must be a hexidecimal value, example: #000000.  Must include the #.' ); ?></label>
					</td>
				</tr>
				
				<?php
				
				/**
				 * Image sizes
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Image Sizes' ); ?></th>
					<td>
						<select name="galleria_galleria[image]">
							<?php
								$selected = $options['image'];
								$p = '';
								$r = '';

								foreach ( $image_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="galleria_galleria[image]"><?php _e( 'Select the size of the image you want this plugin to use.  These sizes are determined on Settings -> Media.' ); ?></label>
					</td>
				</tr>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function galleria_galleria_options_validate( $input ) {
	global $design_options, $transition_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['autoplay'] ) )
		$input['autoplay'] = null;
	$input['autoplay'] = ( $input['autoplay'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	//$input['height'] = wp_filter_nohtml_kses( $input['height'] );
	//$input['width'] = wp_filter_nohtml_kses( $input['width'] );
	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['design'], $design_options ) )
		$input['design'] = null;

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['transition'], $transition_options ) )
		$input['transition'] = null;

	return $input;
}

/**
 * Load javascripts
 */
	
function galleria_galleria_load_scripts( ) {
	global $add_galleria_scripts;
	
	if( !$add_galleria_scripts )
		return;
		
	wp_enqueue_script('photo-galleria', plugins_url( 'galleria-1.2.2.min.js', __FILE__ ), array('jquery'));
	wp_print_scripts('photo-galleria');
	galleria_galleria_scripts_head();
}

/**
 * Add scripts to head
 */
function galleria_galleria_scripts_head(){
	// Retreive our plugin options
	$galleria_galleria = get_option( 'galleria_galleria' );
	
	$design = $galleria_galleria['design'];
		if ($design == 'classic' || $design == '') {
				$design = GALLERIA_GALLERIA_PLUGIN_URL . '/galleria-themes/classic/galleria.classic.min.js';}
			elseif ($design == 'dots') {
				$design = GALLERIA_GALLERIA_PLUGIN_URL . '/galleria-themes/dots/galleria.dots.min.js';}
			elseif ($design == 'fullscreen') {
				$design = GALLERIA_GALLERIA_PLUGIN_URL . '/galleria-themes/fullscreen/galleria.fullscreen.js';}
	$autoplay = $galleria_galleria['autoplay'];
	if ($autoplay == 1) { 
		$autoplay = '5000'; 
	} else { 
		$autoplay = 'false'; 
	}
	$wp_default_sizes = wp_embed_defaults();
	$height = $wp_default_sizes['height'];
    $width = $wp_default_sizes['width'];
	$transition = $galleria_galleria['transition'];
	
echo "\n<script>
	jQuery(document).ready(function($){
  // Load theme
  Galleria.loadTheme('" . $design . "');\n\t";

  // run galleria and add some options
  echo "$('.galleria-gallery').galleria({
  		autoplay: " . $autoplay . ",
      height: " . $height . ",
      width: " . $width . ",
      transition: '" . $transition . "',
      data_config: function(img) {
          // will extract and return image captions from the source:
          return  {
              title: $(img).parent().next('strong').html(),
              description: $(img).parent().next('strong').next().html()
          };
      }
  });
  });
  </script>\n";
}

function galleria_galleria_css_head() {
	$galleria_galleria = get_option( 'galleria_galleria' );
	$color = $galleria_galleria['color'];
	if ($color != '')
		echo "<style type='text/css'>.galleria-container {background-color:{$color};}</style>";
}


/**
 * Lets make new gallery shortcode
 */
function galleria_galleria_shortcode($attr) {
	global $post, $add_galleria_scripts;
	
	$add_galleria_scripts = true;
	$pid = $post->ID;
	$galleria_galleria = get_option( 'galleria_galleria' );
	$image_size = $galleria_galleria['image'];

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID,
		'size' => $image_size,
	), $attr));

	$id = intval($id);
	$attachments = get_children("post_parent={$id}&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}

	// Build galleria markup
	$output = apply_filters('gallery_style', '<div class="galleria-gallery"><!-- Begin Galleria -->');

	// Loop through each image
	foreach ( $attachments as $id => $attachment ) {
		
		// Attachment page ID
		$att_page = get_attachment_link($id);
		// Returns array
		$img = wp_get_attachment_image_src($id, $image_size);
		$img = $img[0];
		$thumb = wp_get_attachment_image_src($id, 'thumbnail');
		$thumb = $thumb[0];
		// Set the image titles
		$title = $attachment->post_title;
		// Get the Permalink
		$permalink = get_permalink();
		// Set the image captions
		$description = $attachment->post_content;
		if($description == '') $description = $attachment->post_excerpt;

		// Build html for each image
		$output .= "\n\t\t<div>";
		$output .= "\n\t\t\t<a href='".$img."'>";
		$output .= "\n\t\t\t\t<img src='".$thumb."' longdesc='".$permalink."' alt='".$description."' title='".$description."' />";
		$output .= "\n\t\t</a>";
		$output .= "\n\t\t<strong>".$title."</strong>";
		$output .= "\n\t\t<span>".$description."</span>";
		$output .= "\n\t\t</div>";
	
	// End foreach
	}
	
	// Close galleria markup
	$output .= "\n\t</div><!-- End Galleria -->";
	return $output;
}


	
	function galleria_galleria_init() {
		// Remove original wp gallery shortcode
		remove_shortcode('gallery');

		// Add our new shortcode with galleria markup
		add_shortcode('gallery', 'galleria_galleria_shortcode');
		add_action('wp_footer', 'galleria_galleria_load_scripts' );
		add_action('wp_head','galleria_galleria_css_head');
		
	}
	add_action('init', 'galleria_galleria_init');
?>