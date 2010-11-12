=== Simple Code Embed ===
Contributors: dartiss
Donate link: http://artiss.co.uk/donate
Tags: Embed, Code, Script, HTML, JavaScript, XHTML, YouTube, Video
Requires at least: 2.0.0
Tested up to: 3.0.1
Stable tag: 1.4.1

Embed code, whether HTML or JavaScript, directly in your posts and pages. Ideal for showing YouTube videos!

== Description ==

As you probably know if you put code directly into your post or page, it is often simply displayed as written rather than actually actioned. So, if you put the embed code of a YouTube video in a post it won't display the video.

This plugin makes use of the Custom Fields facility when creating/editing posts and pages.

Add a custom field named `CODEx`, where x is a number between 1 and 20 (this allows you to have up to 20 pieces of embedded code per page or post). In the value field place your embedded code - this can be HTML, XHTML, JavaScript, etc. Server side languages, such as PHP, doesn't work.

Now, in your post or page simply add a reference to `%CODEx%` (again where x is the number that you used before).

Here's an example. I create a custom field named `CODE1` with a value of...

`<object width="425" height="344">`
`<param name="movie" value="http://www.youtube.com/v/oHg5SJYRHA0&hl=en&fs=1"></param>`
`<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>`
`<embed src="http://www.youtube.com/v/oHg5SJYRHA0&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed>`
`</object>`

Then, where I wish the video to appear in my post I simply add `%CODE1%`. Simple!

**Settings Screen**

The plugin has a settings screen where you can make 2 changes...

1. The embed word. This defaults to CODE but can be changed to any other word.
2. The maximum number of embeds allowed per post/page. The more you specify, the less efficient the program is as it will look for this number each time you display the post/page.

== Installation ==

1. Upload the entire `simple-code-embed` folder to your `wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How can I get help or request possible changes =

Feel free to report any problems, or suggestions for enhancements, to me either via [my contact form](http://www.artiss.co.uk/contact "Contact Me") or by [the plugins' homepage](http://www.artiss.co.uk/simple-code-embed "Simple Code Embed").

= My code doesn't work =

If you code contains the characters `]]>` then you'll find that it doesn't - WordPress modifies this itself.

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

== Upgrade Notice ==

= 1.3 =
* Upgrade if you'd like to be able to embed more than 5 scripts on a single page

= 1.4 =
* Update to specify your own embed word and max. embeds per post

= 1.4.1 =
* Minor bug fix