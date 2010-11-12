<div class="wrap">
<?php screen_icon(); ?>
<h2>Simple Code Embed Options</h2>
<?php
// If options have been updated on screen, update the database
if(!empty($_POST['Submit'])) {
    $options['prefix']=$_POST['simple_code_embed_prefix'];
    $options['number']=$_POST['simple_code_embed_number'];
    update_option("simple_code_embed",$options);
}
// Fetch options into an array
$options=get_option("simple_code_embed");
// Set defaults if no array is defined
if (!is_array($options)) {
    echo "<div class=\"updated\"><p><strong>Please review the options below and click \"Save Settings\" to update them.</strong></p></div>\n";
    $options = array('prefix'=>'CODE','number'=>'20');}
?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float: right;" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick"/>
<input type="hidden" name="hosted_button_id" value="2827258"/>
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_SM.gif" name="submit" alt="Donate!"/>
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1"/>
</form>

<p><?php _e('If you like this plugin, please consider donating.'); ?></p>

<form method="post" action="<?php echo get_bloginfo('wpurl').'/wp-admin/options-general.php?page=simple-code-embed-settings&amp;updated=true' ?>">
<table class="form-table">

<tr>
<th scope="row"><?php _e('Prefix'); ?></th>
<td><input type="text" size="12" maxlength="12" name="simple_code_embed_prefix" value="<?php echo $options['prefix']; ?>"/></td>
</tr>

<tr>
<th scope="row"><?php _e('Max. Number Per Post'); ?></th>
<td><input type="text" size="2" maxlength="2" name="simple_code_embed_number" value="<?php echo $options['number']; ?>"/></td>
</tr>

</table>
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Settings'); ?>"/>
</p>
</form>

<h3>Further Help</h3>
<p>Comprehensive instructions can be found on <a href="http://www.artiss.co.uk/simple-code-embed">the official site page</a>, along with <a href="http://www.artiss.co.uk/category/software/wordpress">blog updates</a> and a comprehensive <a href="http://www.artiss.co.uk/feed">news feed</a>.</p>
<p>Alternatively, please see <a href="http://wordpress.org/extend/plugins/simple-code-embed/">the WordPress plugin page</a>.</p>

<p><a href="http://validator.w3.org"><img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31px" width="88px" style="float: right"/></a></p>
</div>