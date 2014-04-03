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
		$settings_link = '<a href="admin.php?page=ace-options">' . __( 'Settings', 'simple-embed-code' ) . '</a>';
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

		$links = array_merge( $links, array( '<a href="http://wordpress.org/support/plugin/simple-embed-code">' . __( 'Support', 'simple-embed-code' ) . '</a>' ) );
	}

	return $links;
}
add_filter( 'plugin_row_meta', 'ace_set_plugin_meta', 10, 2 );

/**
* Code Embed Menu
*
* Add a new option to the Admin menu and context menu
*
* @since	1.4
*
* @uses ace_help		Return help text
*/

function ace_menu() {

    // Add search sub-menu    

    global $ace_search_hook;

	$ace_search_hook = add_submenu_page( 'tools.php', __( 'Code Embed Search', 'simple-embed-code' ), __( 'Code Search', 'simple-embed-code' ), 'edit_posts', 'ace-search', 'ace_search' );

    add_action('load-'.$ace_search_hook, 'ace_add_search_help');
   
    // Add options sub-menu

    global $ace_options_hook;

    $ace_options_hook = add_submenu_page( 'options-general.php', __( 'Code Embed Settings', 'simple-embed-code' ), __( 'Code Embed', 'simple-embed-code' ), 'manage_options', 'ace-options', 'ace_options' );

    add_action('load-'.$ace_options_hook, 'ace_add_options_help');

}
add_action( 'admin_menu','ace_menu' );

/**
* Add Options Help
*
* Add help tab to options screen
*
* @since	2.0
*
* @uses     ace_options_help    Return help text
*/

function ace_add_options_help() {

    global $ace_options_hook;
    $screen = get_current_screen();

    if ( $screen->id != $ace_options_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'ace-options-help-tab', 'title'	=> __( 'Help', 'simple-embed-code' ), 'content' => ace_options_help() ) );
}

/**
* Add Search Help
*
* Add help tab to search screen
*
* @since	2.0
*
* @uses     ace_search_help    Return help text
*/

function ace_add_search_help() {

    global $ace_search_hook;
    $screen = get_current_screen();

    if ( $screen->id != $ace_search_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'ace-search-help-tab', 'title' => __( 'Help', 'simple-embed-code' ), 'content' => ace_search_help() ) );
}

/**
* Code Embed Options
*
* Define an option screen
*
* @since	1.4
*/

function ace_options() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'ace-options.php' );

}

/**
* Code Embed Search
*
* Define a the search screen
*
* @since	1.6
*/

function ace_search() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'ace-search.php' );

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

	$help_text = '<p>' . __( 'Use this screen to modify the identifiers and keyword used to specify your embedded code.', 'simple-embed-code' ) . '</p>';
	$help_text .= '<p>' . __( 'The keyword is the name used for your custom field. The custom field\'s value is the code that you wish to embed.', 'simple-embed-code' ) . '</p>';  
	$help_text .= '<p>' . __( 'The keyword, sandwiched with the identifier before and after, is what you then need to add to your post or page to activate the embed code.', 'simple-embed-code' ) . '</p>';
	$help_text .= '<p>' . sprintf( __( 'You are using Code Embed version %s. It was written by Dark Designs.', 'simple-embed-code' ), artiss_code_embed_version ) . '</p>';


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

	$help_text = '<p>' . __( 'This screen allows you to search for the post and pages that a particular code embed has been used in.', 'simple-embed-code' ) . '</p>';
	$help_text .= '<p>' . __( 'Simply enter the code suffix that you wish to search for and press the \'Search\' key to display a list of all the posts using it. In addition the code will be shown alongside it. Click on the post name to edit the post.', 'simple-embed-code' ) . '</p>';
	$help_text .= '<p>' . __( 'The search results are grouped together in matching code groups, so posts with the same code will be shown together with the same colour background.', 'simple-embed-code' ) . '</p>';

	return $help_text;
}
?>