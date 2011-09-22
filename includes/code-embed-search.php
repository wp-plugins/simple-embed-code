<?php
/**
* Code Embed Searcg
*
* Allow the user to change the default options
*
* @package	Artiss-Code-Embed
* @since	1.6
*
* @uses	ace_get_embed_paras	Get the options
*/
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Artiss Code Embed Search</h2>

<?php
if ( !function_exists( 'add_contextual_help' ) ) {
	_e( ace_search_help() );
} else {
	_e( '<p>Enter the suffix to search for below and press the "Search" button to view the results. Further help can be found by clicking on the Help tab at the top right-hand of the screen.</p>' );
}
?>

<?php
// Get the suffix - either from the submitted field or via the URL line
if ( $_GET[ 'suffix' ] != '' ) {
	$suffix = $_GET[ 'suffix' ];
} else {
	if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'code-embed-search' , 'code_embed_search_nonce' ) ) ) {
		$suffix = $_POST[ 'ace_suffix' ];
	} else {
		$suffix = '';
	}
}

// Fetch options into an array
$options = ace_get_embed_paras();
?>

<form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/tools.php?page=code-embed-search&amp;updated=true'; ?>">

	<?php echo $options[ 'opening_ident' ] . $options[ 'keyword_ident' ]; ?>

	<input type="text" size="6" name="ace_suffix" value="<?php echo $suffix; ?>"/>

	<?php echo $options[ 'closing_ident' ]; ?>

	<?php wp_nonce_field( 'code-embed-search', 'code_embed_search_nonce', true, true ); ?>

	<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Search' ); ?>"/>

</form>

<h4>This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.</h4>

<?php
if ( $suffix != '' ) {

	global $wpdb;
	$meta = $wpdb -> get_results( "SELECT meta_value, post_title, ID FROM $wpdb->postmeta, $wpdb->posts WHERE meta_key = '" . $options[ 'keyword_ident' ] . $suffix . "' AND post_id = ID ORDER BY meta_value" );
	$records = $wpdb -> num_rows;

	if ( $records > 0 ) {

		echo '<table class="form-table">';
		$color1 = 'CCCCCC';
		$color2 = 'EAF2FA';
		$color = $color1;
		$prev_html = '';

		foreach ( $meta as $meta_data ) {
			$html = $meta_data -> meta_value;
			$post_title = $meta_data -> post_title;
			$post_id = $meta_data -> ID;

			// Switch background colours as the code changes
			if ( $html != $prev_html ) { if ( $color == $color1 ) { $color = $color2; } else { $color = $color1; } }

			echo "<tr style=\"background-color: #" . $color . "\">\n";
			echo '<td><a href="' . home_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit" style="color: #f00;">'.$post_title."</td>\n";
			echo '<td><textarea readonly="readonly" rows="3" cols="80">' . htmlspecialchars( $html ) . "</textarea></td>\n";
			echo "</tr>\n";

			$prev_html = $html;
		}

		echo "</table>\n";

	} else {

		echo "<p style=\"color: #f00\">No posts were found containing that embed code.</p>\n";

	}
}
?>

</div>