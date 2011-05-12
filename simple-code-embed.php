<?php
/*
Plugin Name: Artiss Code Embed
Plugin URI: http://www.artiss.co.uk/artiss-code-embed
Description: Allows you to embed code into your posts & pages
Version: 1.5.1
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

/**
* Artiss Code Embed
*
* Embed code into a post
*
* @package	Artiss-Code-Embed
*/

define( 'artiss_code_embed_version', '1.5' );

/**
* Artiss Code Embed
*
* Filter to add embed to any posts
*
* @since		1.5
*
* @uses 	get_code_embed_paras	Get default options
*
* @param	string  $content		Post content without embedded code
* @return	string					Post content with embedded code
*/
add_filter( 'the_content', 'artiss_code_embed' );
function artiss_code_embed( $content ) {
	
	$plugin_name = 'Artiss Code Embed';	
	global $post;
	
	// Set initial values
	$options = get_code_embed_paras();
	$found_pos = strpos( $content, $options[ 'opening_ident' ] . $options[ 'keyword_ident' ], 0 );
	$prefix_len = strlen( $options[ 'opening_ident' ] . $options[ 'keyword_ident' ] );

	// Loop around the post content looking for all requests for code embeds
	while ( $found_pos !== false ) {

		// Get the position of the closing identifier - ignore if one is not found
		$end_pos = strpos( $content, $options[ 'closing_ident' ], $found_pos + $prefix_len );
		if ( $end_pos !== false ) {

			// Extract the suffix
			$suffix_len = $end_pos - ( $found_pos + $prefix_len );
			if ( $suffix_len == 0 ) {
				$suffix = '';
			} else {
				$suffix = substr( $content, $found_pos + $prefix_len, $suffix_len );
			}

			// Get the custom field data and replace in the post
			if ( $suffix_len < 13 ) {
				$html = get_post_meta( $post -> ID, $options[ 'keyword_ident' ].$suffix, false );
				$search = $options[ 'opening_ident' ] . $options[ 'keyword_ident' ] . $suffix . $options[ 'closing_ident' ];
				$replace = '<!-- ' . $plugin_name . ' v' . artiss_code_embed_version . ' | http://www.artiss.co.uk/' . str_replace( ' ', '-', strtolower( $plugin_name ) ) . " -->\n" . $html[ 0 ] .= '<!-- End of ' . $plugin_name . " code -->\n";
				$content = str_replace($search , $replace, $content );
			}
		}
		$found_pos = strpos( $content, $options[ 'opening_ident' ] . $options[ 'keyword_ident' ], $found_pos + 1 );
	}
	
	return $content;
}

/**
* Get Code Embed Parameters
*
* Fetch options - if none exist set them. If the old options exist, move them over
*
* @since	1.5
*
* @return	string	Array of default options
*/
function get_code_embed_paras() {

	$options = get_option( 'artiss_code_embed' );
	$changed = false;

	// If array doesn't exist, set defaults
	if ( !is_array( $options ) ) {
		$options = array( 'opening_ident' => '%', 'keyword_ident' => 'CODE', 'closing_ident' => '%' );
		$changed = true;
	}

	// If the old options exist, import and delete them	
	if ( get_option( 'simple_code_embed' ) ) {
		$old_option = get_option( 'simple_code_embed' );
		$options[ 'keyword_ident' ] = $old_option[ 'prefix'];
		delete_option( 'simple_code_embed' );
		$changed = true;
	}

	// Update the options, if changed, and return the result
	if ( $changed ) {update_option( 'artiss_code_embed', $options );}
	
	return $options;
}

/**
* Code Embed Menu
*
* Add a new option to the Admin menu
*
* @since	1.4
*
* @uses artiss_code_embed_help	Return help text
*/
add_action( 'admin_menu','artiss_code_embed_menu' );
function artiss_code_embed_menu() {
	$code_embed_hook = add_options_page( 'Artiss Code Embed Settings', 'Code Embed', 10, 'artiss-code-embed-settings', 'artiss_code_embed_options' );
	if ( function_exists( 'add_contextual_help' ) ) {add_contextual_help( $code_embed_hook, __( artiss_code_embed_help() ) );}
}

/**
* Code Embed Options
*
* Define an option screen
*
* @since	1.4
*/
function artiss_code_embed_options() {
	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . "/simple-code-embed-options.php" );
}

/**
* Code Embed Help
*
* Return help text
*
* @since	1.5
*
* @return	string	Help Text	
*/
function artiss_code_embed_help() {
	$help_text = '<p><a href="http://www.artiss.co.uk/code-embed">Artiss Code Embed Plugin Documentation</a></p>';
	$help_text .= '<p><a href="http://www.artiss.co.uk/forum/specific-plugins-group2/artiss-code-embed-forum3">Artiss Code Embed Support Forum</a></p>';
	$help_text .= '<p>All of my plugins are supported via <a title="Artiss.co.uk" href="http://www.artiss.co.uk" target="_blank">my website</a>. Please feel free to visit the site for plugin updates and development news - either visit the site regularly, follow <a title="RSS News Feed" href="http://www.artiss.co.uk/feed" target="_blank">my news feed</a> or <a title="Artiss.co.uk on Twitter" href="http://www.twitter.com/artiss_tech" target="_blank">follow me on Twitter</a> (@artiss_tech).</p>';	
	$help_text .= '<h4>This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.</h4>';
	return $help_text;
}
?>