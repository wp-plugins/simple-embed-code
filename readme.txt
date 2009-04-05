=== Simple Code Embed ===
Contributors: dartiss
Donate link: http://tinyurl.com/bdc4uu
Tags: Code, HTML, JavaScript, XHTML, Embed, YouTube
Requires at least: 2.0.0
Tested up to: 2.7.1
Stable tag: 1.0

Embed code, whether HTML or JavaScript, directly in your posts and pages. Ideal for showing YouTube videos!

== Description ==

As you probably know if you put code directly into your post or page, it is often simply displayed as written rather than actually actioned. So, if you put the embed code of a YouTube video in a post it won't display the video.

This plugin makes use of the Custom Fields facility when creating/editing posts and pages.

Add a custom field named `%CODEx%`, where x is a number between 1 and 5 (this allows you to have up to 5 pieces of embedded code per page or post). In the value field place your embedded code - this can be HTML, XHTML, JavaScript, etc. Server side languages, such as PHP, doesn't work.

Now, in your post or page simply add a reference to `%CODEx%` (again where x is the number that you used before).

Here's an example. I create a custom field named `%CODE1%` with a value of...

`<object width="425" height="344">`
`<param name="movie" value="http://www.youtube.com/v/oHg5SJYRHA0&hl=en&fs=1"></param>`
`<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>`
`<embed src="http://www.youtube.com/v/oHg5SJYRHA0&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed>`
`</object>`

Then, where I wish the video to appear in my post I simply add `%CODE1%`. Simple!

== Installation ==

1. Upload the entire simple-code-embed folder to your wp-content/plugins/ directory.
2. Activate the plugin through the ‘Plugins’ menu in WordPress.
3. There is no options screen.

== Frequently Asked Questions ==

= How can I get help or request possible changes =

Feel free to report any problems, or suggestions for enhancements, to me either via my contact form or by the plugins homepage at http://www.artiss.co.uk/simple-code-embed