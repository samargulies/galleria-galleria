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

Based on Photo Galleria by Thad Allender
http://wordpress.org/extend/plugins/photo-galleria/

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
						<label class="description" for="galleria_galleria[transition]"><?php _e( 'How galleria will move between images.' ); ?></label>
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
				
				<?php
				/**
				 * Autoplay
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Autoplay' ); ?></th>
					<td>
						<input id="galleria_galleria[autoplay]" name="galleria_galleria[autoplay]" type="checkbox" value="1" <?php checked( '1', $options['autoplay'] ); ?> />
						<label class="description" for="galleria_galleria[autoplay]"><?php _e( 'Play all galleries as slideshows on page load.' ); ?></label>
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
	
	if ( ! isset( $input['color'] ) ) {
		$input['color'] = '#000';
	}
	$input['color'] = wp_filter_nohtml_kses( $input['color'] );
	
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
add_action('wp_footer', 'galleria_galleria_load_scripts' );

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
          // will extract and return image captions and titles from the source:
          return  {
              title: $(img).attr('title'),
              description: $(img).parents('.gallery-item').find('.gallery-caption').text()
          };
      }
  });
  });
  </script>\n";
}

function galleria_galleria_css_head() {
	$galleria_galleria = get_option( 'galleria_galleria' );
	$color = $galleria_galleria['color'];
	$wp_default_sizes = wp_embed_defaults();
	$height = $wp_default_sizes['height'];
    $width = $wp_default_sizes['width'];
	echo '<script type="text/javascript">document.getElementsByTagName("html")[0].className+=" js"</script>';
	echo "<style type='text/css'>.galleria-gallery{ width: {$width}px; height: {$height}px;}.galleria-container{background-color:{$color}; } .js .galleria-gallery .gallery {display:none;}  .js .galleria-gallery{background-color:{$color}; } </style>";
}
add_action('wp_head','galleria_galleria_css_head');

/**
 * Lets make new gallery shortcode
 */
function galleria_galleria_shortcode($attr) {
	global $add_galleria_scripts;
	$add_galleria_scripts = true;
	
	add_action('wp_get_attachment_link', 'galleria_galleria_get_attachment_link', 2, 6);
	
	$attr['link'] = 'file';
	echo '<div class="galleria-gallery">';
	echo gallery_shortcode($attr);
	echo '</div><!-- end .galleria-gallery -->';
	
	remove_action('wp_get_attachment_link', 'galleria_galleria_get_attachment_link', 2, 6);
}

function galleria_galleria_get_attachment_link($content, $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false) {
	
	$id = intval($id);
	$_post = & get_post( $id );

	if ( ('attachment' != $_post->post_type) || !$url = wp_get_attachment_image_src($_post->ID, 'large') ) {
		return __('Missing Attachment');
	} else {
		$url = $url[0];
	}
	
	
	if ( $permalink )
		$url = get_attachment_link($_post->ID);

	$post_title = esc_attr($_post->post_title);

	if ( $text ) {
		$link_text = esc_attr($text);
	} elseif ( ( is_int($size) && $size != 0 ) or ( is_string($size) && $size != 'none' ) or $size != false ) {
		$link_text = wp_get_attachment_image($id, $size, $icon);
	} else {
		$link_text = '';
	}

	if( trim($link_text) == '' )
		$link_text = $_post->post_title;

	return apply_filters( 'galleria_galleria_get_attachment_link', "<a href='$url' title='$post_title'>$link_text</a>", $id, $size, $permalink, $icon, $text );
}
	
function galleria_galleria_init() {
	// Remove original wp gallery shortcode
	remove_shortcode('gallery');
	// Add our new shortcode with galleria markup
	add_shortcode('gallery', 'galleria_galleria_shortcode');
}
add_action('init', 'galleria_galleria_init');
	
function galleria_galleria_plugin_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        // The "page" query string value must be equal to the slug
        // of the Settings admin page we defined earlier
        $settings_link = '<a href="' . admin_url('options-general.php?page=galleria_galleria_options') . '">Settings</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}
add_filter('plugin_action_links', 'galleria_galleria_plugin_action_links', 10, 2);

?>