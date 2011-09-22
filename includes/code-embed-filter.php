<?php
/**
* Add Embed to Posts
*
* Functions to add embed code to posts
*
* @package	Artiss-Code-Embed
*/

/**
* Add filter to add embed code
*
* Filter to add embed to any posts
*
* @since		1.5
*
* @uses 	ace_get_embed_paras		Get default options
* @uses		ace_get_embed_code		Get embed code from other posts
*
* @param	string  $content		Post content without embedded code
* @return	string					Post content with embedded code
*/

function ace_filter( $content ) {

	$plugin_name = 'Artiss Code Embed';
	global $post;

	// Set initial values

	$options = ace_get_embed_paras();
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

				$search = $options[ 'opening_ident' ] . $options[ 'keyword_ident' ] . $suffix . $options[ 'closing_ident' ];

				// Get the meta for the current post
				$post_meta = get_post_meta( $post -> ID, $options[ 'keyword_ident' ].$suffix, false );
				if ( isset( $post_meta[ 0 ] ) ) {
					$html = $post_meta[ 0 ];
				} else {
					// No meta found, so look for it elsewhere
					$html = ace_get_embed_code( $options[ 'keyword_ident' ], $suffix );
				}

				$search = $options[ 'opening_ident' ] . $options[ 'keyword_ident' ] . $suffix . $options[ 'closing_ident' ];
				$replace = "\n<!-- " . $plugin_name . ' v' . artiss_code_embed_version . " | http://www.artiss.co.uk/code-embed -->\n" . $html .= "\n<!-- End of " . $plugin_name . " code -->\n";
				$content = str_replace( $search , $replace, $content );
			}
		}
		$found_pos = strpos( $content, $options[ 'opening_ident' ] . $options[ 'keyword_ident' ], $found_pos + 1 );
	}

	return $content;
}
add_filter( 'the_content', 'ace_filter' );

/**
* Get the Global Embed Code
*
* Function to look for and, if available, return the global embed code
*
* @since	1.6
*
* @uses		ace_report_error		Generate an error message
*
* @param	$ident			string	The embed code opening identifier
* @param	$suffix 		string	The embed code suffix
* @return					string	The embed code (or error)
*/

function ace_get_embed_code( $ident, $suffix ) {

	// Meta was not found in current post so look across meta table - find the number of distinct code results

	$meta_name = $ident . $suffix;
	global $wpdb;
	$unique_records = $wpdb -> get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = '" . $meta_name . "'" );
	$records = $wpdb -> num_rows;

	if ( $records > 0 ) {

		// Results were found

		$meta = $wpdb -> get_results( "SELECT meta_value, post_title, ID FROM $wpdb->postmeta, $wpdb->posts WHERE meta_key = '" . $meta_name . "' AND post_id = ID" );
		$total_records = $wpdb -> num_rows;

		if ( $records == 1 ) {

			// Only one unique code result returned so assume this is the global embed

			foreach ( $meta as $meta_data ) {
				$html = $meta_data -> meta_value;
			}

		} else {

			// More than one unique code result returned, so output the list of posts

			$error = 'Cannot use ' . $meta_name . ' as a global code as it is being used to store ' . $records . ' unique pieces of code in '.$total_records . ' posts - <a href='.get_bloginfo( 'wpurl' ) . '/wp-admin/tools.php?page=code-embed-search&amp;suffix='.$suffix.'>click here</a> for more details';

			$html = ace_report_error( $error, 'Artiss Code Embed', false );
		}
	} else {

		// No meta code was found so write out an error

		$html = ace_report_error( 'No embed code was found for ' . $meta_name, 'Artiss Code Embed', false );

	}
	return $html;
}

/**
* Report an error
*
* Function to report an error
*
* @since	1.6
*
* @param	$error			string	Error message
* @param	$plugin_name	string	The name of the plugin
* @param	$echo			string	True or false, depending on whether you wish to return or echo the results
* @return					string	True or the output text
*/

function ace_report_error( $error, $plugin_name, $echo = true ) {

	$output = '<p style="color: #f00; font-weight: bold;">' . $plugin_name . ': ' . __( $error ) . "</p>\n";

	if ( $echo ) {
		echo $output;
		return true;
	} else {
		return $output;
	}
}
?>