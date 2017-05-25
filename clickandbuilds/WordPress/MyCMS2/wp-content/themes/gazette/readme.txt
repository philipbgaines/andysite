=== Gazette ===

Contributors: automattic
Tags: blue, white, light, two-columns, right-sidebar, responsive-layout, custom-header, custom-menu, featured-images, flexible-header, post-formats, rtl-language-support, sticky-post, theme-options, translation-ready

Requires at least: 4.0
Tested up to: 4.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A minimalist magazine-style theme.

== Description ==

Gazette is a clean and flexible theme perfectly suited for minimalist magazine-style sites, personal blogs, or any content-rich site. It allows you to highlight specific articles on the homepage, and to balance readability with a powerful use of photography — all in a layout that works on any device.

* Responsive layout.
* Social menu.
* Jetpack.me compatibility for Infinite Scroll, Featured Content, Responsive Videos, Site Logo.
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= I don't see the Featured Content menu in my customizer, where can I find it? =

To make the Featured Content menu appear in your customizer, you need to install the [Jetpack plugin](http://jetpack.me) because it has the required code needed to make [featured content](http://jetpack.me/support/featured-content/) work for the Gazette theme.

Once Jetpack is active, the Featured Content menu will appear in your customizer. No special Jetpack module is needed and a WordPress.com connection is not required for the Featured Content feature to function. Featured Content will work on a localhost installation of WordPress if you add this line to `wp-config.php`:

`define( 'JETPACK_DEV_DEBUG', TRUE );`

= Where can I add widgets? =

Gazette offers two widget areas, which can be configured in Appearance → Widgets:

* An optional sidebar widget area, which appears on the right.
* An optional footer widget area.

= How do I add the Social Links to the menu? =

Gazette allows you display links to your social media profiles, like Twitter and Facebook, with icons.

1. Create a new Custom Menu, and assign it to the Social Links Menu location.
2. Add links to each of your social services using the Links panel.
3. Icons for your social links will automatically appear if it's available.

Available icons: (Linking to any of the following sites will automatically display its icon in your social menu).

* CodePen
* Digg
* Dribbble
* Dropbox
* Email (mailto: links)
* Facebook
* Flickr
* Foursquare
* GitHub
* Google+
* Instagram
* LinkedIn
* Path
* Pinterest
* Polldaddy
* Reddit
* RSS Feed (urls with /feed/)
* Spotify
* StumbleUpon
* Tumblr
* Twitch
* Twitter
* Vimeo
* Vine
* WordPress
* YouTube

Social networks that aren't currently supported will be indicated by a generic share icon.

== Quick Specs (all measurements in pixels) ==

1. The main column width for posts is 540.
2. The main column width for pages is 870.
3. A widget is 270 wide.
4. Featured Images are 1920 wide by 768 high.

== Changelog ==

= 1 February 2016 =
* Adding clear rules to RTL stylesheet, to ensure the layout doesn't break.

= 20 January 2016 =
* Remove custom PollDaddy styles

= 31 December 2015 =
* Replace incorrect text domain & bump version number.

= 18 December 2015 =
* Make sure post thumbnail is displayed for video posts. Closes #3598

= 29 September 2015 =
* Update screenshot

= 13 August 2015 =
* Make sure images aren't being displayed in .entry-summary

= 12 August 2015 =
* Improve "Continue reading" link and make sure it's being displayed even when user uses a manual excerpt.

= 3 August 2015 =
* Add missing "Continue reading" link.

= 31 July 2015 =
* Remove `.screen-reader-text:hover` and `.screen-reader-text:active` style rules.

= 16 July 2015 =
* Always use https when loading Google Fonts. See #3221;

= 6 July 2015 =
* Forgot the echo -- I'm so silly!!!
* Remove printf from the post thumbnail.

= 28 May 2015 =
* add back-compatibilty for css transform

= 26 May 2015 =
* format `printf`s with argument to resolve 'too few arguments' warnings.

= 23 May 2015 =
* Remove :hover and :active states on screen-reader-text

= 21 May 2015 =
* Tweak comment list and comment form

= 20 May 2015 =
* Fix page entry-footer margin-bottom depending on screen size
* Add margin-top to entry-footer on pages only when screen >= 600px

= 19 May 2015 =
* Fix .sep vertical align
* Fix .site-info vertical alignement and clearing

= 15 May 2015 =
* format cat-links `printf` with argument to resolve 'too few arguments' warning.

= 9 May 2015 =
* Rename author info js function
* Remove wpcom infinite handle styles since it matches wporg now (with the button)

= 8 May 2015 =
* Trigger a window resize when uploading a new site logo
* Fix php error on php version < 5.5 where empty() can't use method return
* Add theme option to unfix header
* Fix site-footer extra padding when no sidebar
* Clear float when blog has a footer-text, social-nav and site-info
* Fix z-index when search-form is open

= 7 May 2015 =
* Tweak fonts form better customization
* Don't move search if menu doesn't exist
* Make sure featured-content hentries don't have a border-bottom
* Add readme
* Rename all JS functions so they have the same style, Fix featured-content JS
* Update description
* Add separator between posts on small devices
* Fix wrong margins/align in rtl stylesheet
* Fix .post-link height depending on screen size
* Tweak recipe shortcode
* Add rtl stylesheet
* Fix native video display when video post format
* Increase .main-navigation z-index to make sure it's showing in front of .entry-hero

= 6 May 2015 =
* Make sure search-form is hidden on load on mobile devices
* Move search form into menu on small devices
* Move featured-content display block in the featuredContentPostion() function to avoid page to jump
* Fix calendar table width
* Use inherit color so we don't have to worry about the color anno
* Fix .bypostauhtor color when it has a link
* Fix php warning in customizer and change theme option label

= 1 May 2015 =
* Change the transport of site-logo to refresh so it triggers the header JS

= 29 April 2015 =
* Fix .entry-meta width in the Featured Content area
* Fix featured-content height
* Increase social-navigation font-size on small devices -- easier to reach out
* Be more specific when targeting the footer
* Reduce margin bottom of hentry on archive/blog/search view on small screens
* Make sure .search-field font-size isn't overwritten by the custom font
* Don't display search form on screens < 600px
* Reduce font-size of site-title on smaller devices
* New screenshot
* Fix on mobile if no widget the sidebar trigger
* Tweak related posts a bit
* Simplify font sizes and cleanup stylesheets
* Reduce button/input/textarea font-size
* Add style for placeholders

= 28 April 2015 =
* Small fix for color annotations and little bit of cleaning
* Make sure all links have an :active and :focus state
* Move comments-link to the left when there are tons of categories

= 27 April 2015 =
* Fix related posts width
* Tweak color of entry-meta on image, gallery and link post format
* Add style for when comment is waiting for moderation
* Remove sidebar for archive page results
* Remove aside post format support
* be more specific when targeting tiled galleries
* Remove menu animation
* Fix IS trigger style on wpcom
* More wpcom widgets
* Add more wpcom widgets styles
* Add styles for follow blog widget
* Add styles for flickr widget
* Add styles for Author, Akismet widgets and remove the Contact widget style from the wpcom stylesheet
* Add styles for About.me widget
* Tweak Reblogger styles
* Add Polldaddy styles + remove Goodreads styles from the wpcom stylesheet
* Add final styles for comment form

= 24 April 2015 =
* Start tweaking the wpcom stylesheet with the right color and improve margin of the comment form
* Set the appropriate content width + Fix menu margin-top when site-branding isn't being displayed
* Tweak related posts -- make it 3 columns on larger screens
* Reduce font-size on small screnns
* Add better styles for Sharedaddy and start tweaking the comment form
* Tweak width of .featured-content .hentry to make sure it doesn't look ridiculously tiny on small screens
* Fix max length of the .site-branding

= 23 April 2015 =
* Increase the lenght of the excerpt for image and gallery post format
* Add style for current menu item
* Tweak error 404 page
* Add style for error 404
* Add small border to long menu to hide item separator
* Reduce size of featured image on single post/page and add small js function to make sure tables don't overflow the content-area
* Revert little experiment regarding the featured content image size
* Little experimientation: Reduce the height/width of the featured image on single page
* Revert featured content opacity proprietes when hover and non-hover
* Fix top position of featured-image if it's a gallery or an image post format
* Fix featured-content background-image issue
* Display featured content area only when blog has featured posts
* Add style-wpcom.css (copied from Boardwalk -- will need tweaking)
* Add wpcom.php
* Break long words in .entry-summary
* Fix php error on video post format

= 16 April 2015 =
* Initial import of the .org version of the gazette theme

== Credits ==

* Genericons: font by Automattic (http://automattic.com/), licensed under [GPL2](https://www.gnu.org/licenses/gpl-2.0.html)
* Images: images by Unsplash (https://unsplash.com/), licensed under [CC0](http://creativecommons.org/choose/zero/)