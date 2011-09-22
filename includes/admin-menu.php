<?php
/**
* Administration Menu Options
*
* Add various adminstration menu options
*
* @package	Artiss-Code-Embed
*/

/**
* Add Settings link to plugin list
*
* Add a Settings link to the options listed against this plugin
*
* @since	1.6
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function ace_add_settings_link( $links, $file ) {

	static $this_plugin;

	if ( !$this_plugin ) { $this_plugin = plugin_basename( __FILE__ ); }

	if ( strpos( $file, 'code-embed.php' ) !== false ) {
		$settings_link = '<a href="admin.php?page=code-embed-options">' . __( 'Settings' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}
add_filter( 'plugin_action_links', 'ace_add_settings_link', 10, 2 );

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	1.6
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function ace_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, 'code-embed.php' ) !== false ) {

		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/forum/specific-plugins-group2/artiss-code-embed-forum3">' . __( 'Support' ) . '</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/donate">' . __( 'Donate' ) . '</a>' ) );
	}

	return $links;
}
add_filter( 'plugin_row_meta', 'ace_set_plugin_meta', 10, 2 );

/**
* Code Embed Menu
*
* Add a new option to the Admin menu
*
* @since	1.4
*
* @uses ace_help		Return help text
*/

function ace_menu() {

	$code_embed_hook = add_options_page( 'Artiss Code Embed Settings', 'Code Embed', 10, 'code-embed-options', 'ace_options' );

	if ( function_exists( 'add_contextual_help' ) ) {
		add_contextual_help( $code_embed_hook, __( ace_options_help() ) );
	}

	$code_embed_hook = add_submenu_page( 'tools.php', 'Code Embed Search', 'Code Embed Search', 10, 'code-embed-search', 'ace_search' );

	if ( function_exists( 'add_contextual_help' ) ) {
		add_contextual_help( $code_embed_hook, __( ace_search_help() ) );
	}

}
add_action( 'admin_menu','ace_menu' );

/**
* Code Embed Options
*
* Define an option screen
*
* @since	1.4
*/

function ace_options() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . "code-embed-options.php" );

}

/**
* Code Embed Search
*
* Define a the search screen
*
* @since	1.6
*/

function ace_search() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . "code-embed-search.php" );

}

/**
* Code Embed Options Help
*
* Return help text for options screen
*
* @since	1.5
*
* @return	string	Help Text
*/

function ace_options_help() {

	$help_text = '<p><a href="http://www.artiss.co.uk/code-embed">Artiss Code Embed Plugin Documentation</a></p>';
	$help_text .= '<p><a href="http://www.artiss.co.uk/forum/specific-plugins-group2/artiss-code-embed-forum3">Artiss Code Embed Support Forum</a></p>';
	$help_text .= '<p>All of my plugins are supported via <a title="Artiss.co.uk" href="http://www.artiss.co.uk" target="_blank">my website</a>. Please feel free to visit the site for plugin updates and development news - either visit the site regularly, follow <a title="RSS News Feed" href="http://www.artiss.co.uk/feed" target="_blank">my news feed</a> or <a title="Artiss.co.uk on Twitter" href="http://www.twitter.com/artiss_tech" target="_blank">follow me on Twitter</a> (@artiss_tech).</p>';
	$help_text .= '<h4>This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.</h4>';

	return $help_text;
}

/**
* Code Embed Search Help
*
* Return help text for search screen
*
* @since	1.6
*
* @return	string	Help Text
*/

function ace_search_help() {

	$help_text = '<p>This screen allows you to search for the post and pages that a particular code embed has been used in.</p>';
	$help_text .= '<p>Simply enter the code suffix that you wish to search for and press the "Search" key to display a list of all the posts using it. In addition the code will be shown alongside it. Click on the post name to edit the post.</p>';
	$help_text .= '<p>The search results are grouped together in matching code groups, so posts with the same code will be shown together with the same colour background.</p>';

	return $help_text;
}
?>