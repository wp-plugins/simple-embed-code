<?php
/*
Plugin Name: Simple Code Embed
Plugin URI: http://www.artiss.co.uk/simple-code-embed
Description: Allows you to embed code into your posts & pages
Version: 1.2
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/
add_filter('the_content', 'simple_code_embed');
function simple_code_embed($content) {
    global $post;
    $loop=1;
    while ($loop<6) {
        $code="CODE".$loop;
        $html=get_post_meta($post->ID,$code,false);
        $content=str_replace("%".$code."%",$html[0],$content);
        $loop++;
    }
    return $content;
}
?>