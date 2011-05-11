﻿=== Artiss Code Embed ===
Contributors: dartiss
Donate link: http://artiss.co.uk/donate
Tags: embed, code, artiss, script, HTML, JavaScript, XHTML, YouTube, video
Requires at least: 2.0.0
Tested up to: 3.1.2
Stable tag: 1.5

Artiss Code Embed (formally Simple Code Embed) provides a very easy and efficient way to embed code (JavaScript and HTML) in your posts and pages.

== Description ==

Artiss Code Embed (formally Simple Code Embed) allows you to embed code - JavaScript and HTML primarily - in a post. This is incredibly useful for embedding video, etc, when required. It cannot be used for server side code, such as PHP.

This plugin works for both posts and pages. However, for simplicity I will simply refer to posts - bear in mind that pages work in the same way.

**Options Screen**

To use first of all visit the options page. In the Administration menu, under the Settings section there will a new settings option titled "Code Embed". Click on this and an options screen will appear.

Code embedding is performed via a special keyword that you must use to uniquely identify where you wish the code to appear. This consist of an opening identifier (some that that goes at the beginning), a keyword and then a closing identifier. You may also add a suffix to the end of the keyword if you wish to embed multiple pieces of code within the same post. 

From this options screen you can specify the above identifier that you wish to use. By default the opening and closing identifiers are percentage signs and the keyword is `CODE`. During these instructions these will be used in all examples.

**Embedding**

To embed in a post you need to find the meta box under the post named "Custom Fields". If this is missing you may need to add it by clicking on the "Screen Options" tab at the top of the new post screen.

Now create a new custom field with the name of your keyword - e.g. `CODE`. The value of this field will be the code that you wish to embed. Save this custom field.

Now, wherever you wish the code to appear in your post, simply put the full identifier (opening, keyword and closing characters). For example, `%CODE%`.

If you wish to embed multiple pieces of code within a post you can add a suffix to the keyword. So we may set up 2 custom fields named `CODE1` and `CODE2`. Then in our post we would specify either `%CODE1%` or `%CODE2%` depending on which you wish to display.

Don't forget - via the options screen you can change any part of this identifier to your own taste.

**For help with this plugin, or simply to comment or get in touch, please read the appropriate section in "Other Notes" for details. This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Licence ==

This WordPRess plugin is licensed under the [GPLv2 (or later)](http://wordpress.org/about/gpl/ "GNU General Public License").

== Support ==

All of my plugins are supported via [my website](http://www.artiss.co.uk "Artiss.co.uk").

Please feel free to visit the site for plugin updates and development news - either visit the site regularly, follow [my news feed](http://www.artiss.co.uk/feed "RSS News Feed") or [follow me on Twitter](http://www.twitter.com/artiss_tech "Artiss.co.uk on Twitter") (@artiss_tech).

For problems, suggestions or enhancements for this plugin, there is [a dedicated page](http://www.artiss.co.uk/code-embed "Simple Code Embed") and [a forum](http://www.artiss.co.uk/forum "WordPress Plugins Forum"). The dedicated page will also list any known issues and planned enhancements.

**This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Reviews & Mentions ==

"Works like a dream. Fantastic!" - Anita.

"Thank you for this plugin. I tried numerous other iframe plugins and none of them would work for me! This plugin worked like a charm the FIRST time." - KerryAnn May.

[Embedding content](http://wsdblog.westbrook.k12.me.us/blog/2009/12/24/embedding-content/ "Embedding content") - WSD Blogging Server.

[Animating images with PhotoPeach](http://comohago.conectandonos.gov.ar/2009/08/05/animando-imagenes-con-photopeach/ "Animando imágenes con PhotoPeach") - Cómo hago.

== Installation ==

1. Upload the entire `simple-code-embed` folder to your wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Under the Settings section of the administration menu there should now be a new option named "Code Embed". Select this option to set the default options.
4. Add the identifier code to the appropriate posts and pages where you wish the code to be embedded.

== Frequently Asked Questions ==

= My code doesn't work =

If you code contains the characters `]]>` then you'll find that it doesn't - WordPress modifies this itself.

= What's the maximum size of the embed code that I can save in a custom field? =

WordPress stores the custom field contents in a MySQL table using the `longtext` format. This can hold over 4 billion characters.

= Which version of PHP does this plugin work with? =

It has been tested and been found valid from PHP 4 upwards.

== Screenshots ==

1. The custom field meta box with a Code Embed field set up to show some YouTube embed code
2. Example embed code in a post
3. The resultant video from the previous example code

== Changelog ==  
  
= 1.0 =  
* Initial release

= 1.1 =  
* The instructions have been corrected (thanks to John J. Camilleri for pointing it out!)
* Plugin has been tested with version 2.8 of WordPress
* No code changes have been made

= 1.2 =
* Simplification of code

= 1.3 =
* Increased limit of number of code embeds from 5 to 20

= 1.4 =
* Option screen which allows you to specify the maximum number of possible embeds per post and the embed word

= 1.4.1 =
* Version details as HTML comments were being output whether an embed existed or not - corrected

= 1.5 =
* Renamed plugin to bring in line with new plugin conventions
* Plugin re-write to create more efficient code - can now also completely personalise the embed code used in the post
* PHPDoc used throughout for documentation purposes, plus new coding standards
* Support information improved, including contextual help on the settings screen (if supported)
* All of the changes are backwards compatible with previous versions of this plugin
* Instructions completely re-written

== Upgrade Notice ==

= 1.3 =
* Upgrade if you'd like to be able to embed more than 5 scripts on a single page

= 1.4 =
* Update to specify your own embed word and max. embeds per post

= 1.4.1 =
* Minor bug fix

= 1.5 =
* Much more efficient performance and ability to totally personalise the embed code used in posts