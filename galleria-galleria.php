<?php
/*
Plugin Name: Galleria Galleria
Plugin URI: https://github.com/samargulies/galleria-galleria/
Description: Transform standard WordPress galleries into galleria slideshows.
Version: 0.2
Author: Sam Margulies
Author URI: 
License: GPLv2

.

Based on Photo Galleria by Thad Allender
http://wordpress.org/extend/plugins/photo-galleria/

Bravo Aino!
http://galleria.aino.se/

Mr. Philip Arthur Moore for IE debugging of Photo Galleria
http://www.philiparthurmoore.com

*/

/**
 * Define plugin constants
 */
 
define ( 'GALLERIA_GALLERIA_PLUGIN_URL', WP_PLUGIN_URL . '/' . dirname( plugin_basename(__FILE__) ) );
define ( 'GALLERIA_GALLERIA_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . dirname( plugin_basename(__FILE__) ) );
define ( 'GALLERIA_GALLERIA_USER_THEME_FOLDER',  '/galleria-themes/' );

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
	$options_page = add_options_page( __( 'Galleria Galleria' ), __( 'Galleria Galleria' ), 'manage_options', 'galleria_galleria_options', 'galleria_galleria_options_do_page' );
	
	// Adds actions to hook in the required css and javascript
	add_action("admin_print_styles-$options_page",'galleria_galleria_admin_styles');
	add_action("admin_print_scripts-$options_page", 'galleria_galleria_admin_scripts');
}
add_action( 'admin_menu', 'galleria_galleria_options_add_page' );


/* Loads admin page the CSS */

function galleria_galleria_admin_styles() {
	wp_enqueue_style('color-picker', GALLERIA_GALLERIA_PLUGIN_URL . '/css/colorpicker.css');
}	

/* Loads admin page javascript */

function galleria_galleria_admin_scripts() {

	// Inline scripts from options-interface.php
	add_action('admin_head', 'galleria_galleria_admin_head');
	
	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('color-picker', GALLERIA_GALLERIA_PLUGIN_URL . '/js/colorpicker.js', array('jquery'));
}

/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */
 
function galleria_galleria_admin_head() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
				
			// Color Picker
			$('.colorSelector').each(function(){
				var Othis = this; //cache a copy of the this variable for use inside nested function
				var initialColor = $(Othis).next('input').attr('value');
				$(this).ColorPicker({
				color: initialColor,
				onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
				},
				onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
				},
				onChange: function (hsb, hex, rgb) {
				$(Othis).children('div').css('backgroundColor', '#' + hex);
				$(Othis).next('input').attr('value','#' + hex);
			}
			});
			}); //end color picker
		});//end document ready functions
	</script>
	<?php
}

/**
 * Create arrays for our select and radio options
 */

function galleria_galleria_default_options() {

	//Stylesheets Reader
	$alt_stylesheets = array();
	$alt_stylesheets_path = get_stylesheet_directory() . GALLERIA_GALLERIA_USER_THEME_FOLDER;
	if ( is_dir($alt_stylesheets_path) ) {
	    if ($alt_stylesheet_dir = opendir($alt_stylesheets_path) ) { 
	        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
	            if( stristr($alt_stylesheet_file, ".js") !== false) {
	                $alt_stylesheets[] = $alt_stylesheet_file;
	            }
	        }    
	    }
	}
	
	$options['design'] = array(
		'classic' => array(
			'value' =>	'classic',
			'label' => __( 'Classic' )
		),
		'dots' => array(
			'value' =>	'dots',
			'label' => __( 'Dots' )
		),
	/*
			'fullscreen' => array(
			'value' =>	'fullscreen',
			'label' => __( 'Fullscreen' )
		)
	*/
	);
	
	if( !empty($alt_stylesheets) ) {
		foreach($alt_stylesheets as $alt_stylesheet) {
			$options['design'][$alt_stylesheet] = array(
				'value' =>	$alt_stylesheet,
				'label' => $alt_stylesheet
			);
		}
	}
	
	$options['transition'] = array(
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
	
	$options['image'] = array(
		'medium' => array(
			'value' =>	'medium',
			'label' => __( 'Medium' )
		),
		'large' => array(
			'value' =>	'large',
			'label' => __( 'Large' )
		)
	);
	
	return $options;
}


/**
 * Create the options page
 */
 
function galleria_galleria_options_do_page() {
	$defaults = galleria_galleria_default_options();

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

								foreach ( $defaults['design'] as $option ) {
									$label = $option['label'];
									$value = esc_attr( $option['value'] );
									
									echo "<option style='padding-right: 10px;' value='$value'";
									if ( $selected == $option['value'] ) {
										echo ' selected=selected ';
									}
									echo ">$label</option>";
								}
							?>
						</select>
						<label class="description" for="galleria_galleria[design]"><?php _e( 'Select a design.  Don\'t be shy.' ); ?></label>
					</td>
				</tr>

				<?php
				
				/**
				 * Transition options
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Transition' ); ?></th>
					<td>
						<select name="galleria_galleria[transition]">
							<?php
								$selected = $options['transition'];
								
								foreach ( $defaults['transition'] as $option ) {
									$label = $option['label'];
									$value = esc_attr( $option['value'] );
									
									echo "<option style='padding-right: 10px;' value='$value'";
									if ( $selected == $option['value'] ) {
										echo ' selected=selected ';
									}
									echo ">$label</option>";
								}
							?>
						</select>
						<label class="description" for="galleria_galleria[transition]"><?php _e( 'How galleria will move between images.' ); ?></label>
					</td>
				</tr>
				
				<?php	
				
				/**
				 * Width and Height options
				 */
				
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Gallery size' ); ?></th>
					<td>
						<label for="galleria_galleria[width]">Width</label>
						<input name="galleria_galleria[width]" type="text" id="galleria_galleria[width]" value="<?php esc_attr_e( $options['width'] ); ?>" class="small-text">
						<label for="galleria_galleria[height]">Height</label>
						<input name="galleria_galleria[height]" type="text" id="galleria_galleria[height]" value="<?php esc_attr_e( $options['height'] ); ?>" class="small-text">
						<label class="description" for="galleria_galleria[height]"><?php _e( "Defaults to your theme's max embed sizes at Settings &rarr; Media." ); ?></label>
					</td>
				</tr>
		
				<?php
				
				/**
				 * Color options
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Background color' ); ?></th>
					<td>
						<div class="colorSelector"><div style="background-color:<?php esc_attr_e( $options['color'] ); ?>"></div></div><input id="galleria_galleria[color]" size="7" type="text" name="galleria_galleria[color]" value="<?php esc_attr_e( $options['color'] ); ?>" />
						<label class="description" for="galleria_galleria[color]"><?php _e( '' ); ?></label>
					</td>
				</tr>
				
				<?php
				
				/**
				 * Image sizes
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Image Size' ); ?></th>
					<td>
						<select name="galleria_galleria[image]">
							<?php
								$selected = $options['image'];
								
								foreach ( $defaults['image'] as $option ) {
									$label = $option['label'];
									$value = esc_attr( $option['value'] );
									
									echo "<option style='padding-right: 10px;' value='$value'";
									if ( $selected == $option['value'] ) {
										echo ' selected=selected ';
									}
									echo ">$label</option>";
								}
							?>
						</select>
						<label class="description" for="galleria_galleria[image]"><?php _e( 'Select the size of the image you want this plugin to use.  These sizes are determined at Settings &rarr; Media.' ); ?></label>
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
	$defaults = galleria_galleria_default_options();

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['autoplay'] ) )
		$input['autoplay'] = null;
	$input['autoplay'] = ( $input['autoplay'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['color'] ) ) {
		$input['color'] = '#000000';
	}
	
	
	// Our text option must be safe text with no HTML tags
	$input['color'] = wp_filter_nohtml_kses( $input['color'] );
	$input['height'] = wp_filter_nohtml_kses( $input['height'] );
	$input['width'] = wp_filter_nohtml_kses( $input['width'] );
	
	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['design'], $defaults['design'] ) )
		$input['design'] = null;

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['transition'], $defaults['transition'] ) )
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
		
	wp_enqueue_script('galleria', plugins_url( '/js/galleria-1.2.2.min.js', __FILE__ ), array('jquery'));
	wp_print_scripts('galleria');
	galleria_galleria_script_options();
}
add_action('wp_footer', 'galleria_galleria_load_scripts' );

/**
 * Add scripts to head
 */
 
function galleria_galleria_script_options(){
	// Retreive our plugin options
	$galleria_galleria = get_option( 'galleria_galleria' );
	
	$design = $galleria_galleria['design'];
		if( $design == 'classic' || $design == '' ) {
			$design_url = GALLERIA_GALLERIA_PLUGIN_URL . '/galleria-themes/classic/galleria.classic.min.js';
		} else if( $design == 'dots' ) {
			$design_url = GALLERIA_GALLERIA_PLUGIN_URL . '/galleria-themes/dots/galleria.dots.min.js';
		} else if( $design == 'fullscreen' ) {
			$design_url = GALLERIA_GALLERIA_PLUGIN_URL . '/galleria-themes/fullscreen/galleria.fullscreen.js';
		} else if( stristr($design, '.js') !== false ) {
			$design_url = get_stylesheet_directory_uri() . GALLERIA_GALLERIA_USER_THEME_FOLDER . $design;
		}
	$autoplay = $galleria_galleria['autoplay'];
	if ($autoplay == 1) { 
		$autoplay = '5000'; 
	} else { 
		$autoplay = 'false'; 
	}
	$wp_default_sizes = wp_embed_defaults();
	$height = $galleria_galleria['height'] ? $galleria_galleria['height'] : $wp_default_sizes['height'];
    $width = $galleria_galleria['width'] ? $galleria_galleria['width'] : $wp_default_sizes['width'];
	$transition = $galleria_galleria['transition'];
	
echo "\n<script>
	jQuery(document).ready(function($){
  // Load theme
  Galleria.loadTheme('" . $design_url . "');\n\t";

  // run galleria and add some options
  echo "$('.galleria-gallery').galleria({
  	  autoplay: " . $autoplay . ",
      //height: " . $height . ",
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
	
	$height = $galleria_galleria['height'] ? $galleria_galleria['height'] : $wp_default_sizes['height'];
    $width = $galleria_galleria['width'] ? $galleria_galleria['width'] : $wp_default_sizes['width'];
    
	?>
	<script type="text/javascript">
	document.documentElement.className += ' galleria-galleria-active';
	</script>
	<?php
	echo "<style type='text/css'>
	.galleria-gallery{ width: {$width}px; height: {$height}px;}
	.galleria-container{background-color:{$color}; }
	.galleria-galleria-active .galleria-gallery .gallery {display:none;} 
	.galleria-galleria-active .galleria-gallery{background-color:{$color}; }
	</style>";
}
add_action('wp_head','galleria_galleria_css_head');

/**
 * Lets make new gallery shortcode
 */
function galleria_galleria_shortcode($attr) {
	global $add_galleria_scripts;
	$add_galleria_scripts = true;
	
	//change default gallery_shortcode to link to images of a specified size instead of originals
	add_action('wp_get_attachment_link', 'galleria_galleria_get_attachment_link', 2, 6);
	
	//force gallery to link to image files
	$attr['link'] = 'file';
		
	$style = '';
	
	if( isset( $attr['height'] ) && $height = intval( $attr['height'] ) ) {
		$style = "style='height:{$height}px;'";
	}
	
	$content = "<div class='galleria-gallery' $style>";
	$content .= gallery_shortcode($attr);
	$content .= '</div><!-- end .galleria-gallery -->';
	
	//remove our action to avoid changing this behavior for others
	remove_action('wp_get_attachment_link', 'galleria_galleria_get_attachment_link', 2, 6);

	return $content;
}

function galleria_galleria_get_attachment_link($content, $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false) {
	$galleria_galleria = get_option( 'galleria_galleria' );
	
	$id = intval($id);
	$_post = & get_post( $id );

	if ( ('attachment' != $_post->post_type) || !$url = wp_get_attachment_image_src($_post->ID, $galleria_galleria['image']) ) {
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
        array_push($links, $settings_link);
    }

    return $links;
}
add_filter('plugin_action_links', 'galleria_galleria_plugin_action_links', 10, 2);

?>