<?php
/*
Plugin Name: Simple Code Embed
Plugin URI: http://www.artiss.co.uk/simple-code-embed
Description: Allows you to embed code into your posts & pages
Version: 1.4.1
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/
add_filter('the_content','simple_code_embed');
add_action('admin_menu','simple_code_embed_menu');
define('simple_code_embed_version','1.4.1');

// Main function to embed code
function simple_code_embed($content) {
    $plugin_name="Simple Code Embed";
    $options=get_option("simple_code_embed");
    if (!is_array($options)) {$options=array('prefix'=>'CODE','number'=>'20');}
    global $post;
    $changed=false;
    $loop=1;
    while ($loop<($options['number'])+1) {
        $html=get_post_meta($post->ID,$options['prefix'].$loop,false);
        $search="%".$options['prefix'].$loop."%";
        if (strpos($content,$search)!==false) {
            $content=str_replace($search,$html[0],$content);
            $changed=true;
        }
        $loop++;
    }
    if ($changed) {$content="<!-- ".$plugin_name." v".simple_code_embed_version." | http://www.artiss.co.uk/".str_replace(" ","-",strtolower($plugin_name))." -->\n".$content.="<!-- End of ".$plugin_name." code -->\n";}
    return $content;
}

// Define a dashboard menu option
function simple_code_embed_menu() {
    add_options_page('Simple Code Embed Settings','Simple Code Embed',10,'simple-code-embed-settings','simple_code_embed_options');
}

// Define an option screen
function simple_code_embed_options() {
    include_once(WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))."/simple-code-embed-options.php");}
?>