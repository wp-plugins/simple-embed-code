<?php
/**
* Code Embed Options
*
* Allow the user to change the default options
*
* @package	Artiss-Code-Embed
* @since	1.4
*
* @uses artiss_code_embed_help	Return help text
*/
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Artiss Code Embed Options</h2>
<?php
// If options have been updated on screen, update the database
if( !empty( $_POST[ 'Submit' ] ) ) {
	
	// Update the options array from the form fields. Strip invalid tags.
	$options[ 'opening_ident' ] = strtoupper( trim( $_POST[ 'code_embed_opening' ], '[]<>' ) );
	$options[ 'keyword_ident' ] = strtoupper( trim( $_POST[ 'code_embed_keyword' ], '[]<>' ) );
	$options[ 'closing_ident' ] = strtoupper( trim( $_POST[ 'code_embed_closing' ], '[]<>' ) );
	
	// If any fields are blank assign default values
	if ( $options[ 'opening_ident' ] == "" ) {$options[ 'opening_ident' ] = "%";}
	if ( $options[ 'keyword_ident' ] == "" ) {$options[ 'keyword_ident' ] = "CODE";}	
	if ( $options[ 'closing_ident' ] == "" ) {$options[ 'closing_ident' ] = "%";}	
	
    update_option( 'artiss_code_embed', $options );
}

// Fetch options into an array
$options = get_code_embed_paras();
?>

<form method="post" action="<?php echo get_bloginfo('wpurl').'/wp-admin/options-general.php?page=artiss-code-embed-settings&amp;updated=true' ?>">

<?php _e( '<h3>Identifier Format</h3>Specify the format that will be used to define the way the code is embedded in your post.<br/>The formats are case insensitive and characters &lt; &gt [ ] are invalid.' ); ?>

<table class="form-table">

<tr>
<th scope="row"><?php _e('Keyword'); ?></th>
<td><input type="text" size="12" maxlength="12" name="code_embed_keyword" value="<?php echo $options['keyword_ident']; ?>"/>&nbsp;<span class="description">The keyword that is used to name the custom field and then place in your post where the code should be embedded. A suffix on any type can then be placed on the end.</span></td>
</tr>

<tr>
<th scope="row"><?php _e('Opening Identifier'); ?></th>
<td><input type="text" size="4" maxlength="4" name="code_embed_opening" value="<?php echo $options['opening_ident']; ?>"/>&nbsp;<span class="description">The character(s) that must be placed in the post before the keyword to uniquely identify it.</span></td>
</tr>

<tr>
<th scope="row"><?php _e('Closing Identifier'); ?></th>
<td><input type="text" size="4" maxlength="4" name="code_embed_closing" value="<?php echo $options['closing_ident']; ?>"/>&nbsp;<span class="description">The character(s) that must be placed in the post after the keyword to uniquely identify it.</span></td>
</tr>

</table>

<br/><input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Settings'); ?>"/>

</form>

<?php

_e( '<h3>How to Embed</h3>' );
_e( '<p>To add a custom field containing embed code simple name it <strong>'.$options[ 'keyword_ident'].'x</strong>, where <strong>x</strong> is any suffix you wish. The code to embed is then added as the field value.</p>' );
_e( '<p>Then, to add the code into your post simple add <strong>'.$options[ 'opening_ident'].$options[ 'keyword_ident']."x".$options[ 'closing_ident'].'</strong> where you wish it to appear. <strong>x</strong> is the suffix you used for the custom field name.</p>' );
_e( '<p>For example, I may add a custom field named <strong>'.$options[ 'keyword_ident'].'1</strong>, where the value is the code I wish to embed. I would then in my post add <strong>'.$options[ 'opening_ident'].$options[ 'keyword_ident']."1".$options[ 'closing_ident'].'</strong> where I wish the code to then appear.</p>' );

_e( '<h3>Support Information</h3>' );
if ( !function_exists( 'add_contextual_help' ) ) {
	_e( artiss_code_embed_help() );
} else {
	_e( '<p>Useful support information and links can be found by clicking on the Help tab at the top right-hand of the screen.</p>' );
}
?>

</div>