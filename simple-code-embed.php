<?php
/*
Plugin Name: Simple Code Embed
Plugin URI: http://www.artiss.co.uk/simple-code-embed
Description: Allows you to embed code into your posts & pages
Version: 1.3
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/
add_filter('the_content','simple_code_embed');
function simple_code_embed($content) {
    global $post;
    $loop=1;
    while ($loop<21) {
        $html=get_post_meta($post->ID,"CODE".$loop,false);
        $content=str_replace("%CODE".$loop."%",$html[0],$content);
        $loop++;
    }
    return $content;
}
?>