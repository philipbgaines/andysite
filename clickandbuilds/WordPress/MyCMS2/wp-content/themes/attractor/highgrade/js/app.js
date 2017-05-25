jQuery(window).load(function() { 
	jQuery(".loading").delay(500).fadeOut("slow"); 
	jQuery(".preloadermask").delay(1000).fadeOut("slow");
});
jQuery(document).ready(function() {
	"use strict";
	// PHP vars
	// home_url
	// template_directory_uri
	// retina_logo_url
	// menu_style
	// is_front_page
	
	// Testimonials carousel speed control
	jQuery('#testimonialsCarousel').carousel({
		interval: 3000
	});
	
	if(typeof menu_style === 'undefined'){
	   menu_style = 1;
	};
	
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		var animated = jQuery('.wpb_appear');
		jQuery('html').find(animated).each(function () { 
			jQuery(this).removeClass('wpb_animate_when_almost_visible').removeClass('wpb_appear').removeClass('wpb_start_animation').removeClass('wpb_left-to-right').removeClass('wpb_right-to-left');
		});
	}
	
	// Retina logo or regular?
	if (window.devicePixelRatio > 1 && typeof retina_logo_url != "undefined" ) {
		jQuery(".logo").attr("src", retina_logo_url);
	}
	
	// Floating menu or static?
	if( menu_style == 1 && is_front_page==='true') {
		jQuery(window).bind('scroll', function() {
				if (jQuery(window).scrollTop() > jQuery(window).height()) {
					jQuery('.bkaTopmenu').slideDown(200);
					jQuery(".bkaTopmenu").removeClass('hidden').addClass('displayed');
				}
				if (jQuery(window).scrollTop() < jQuery(window).height()) {
					jQuery('.bkaTopmenu').slideUp(200, function() {
						jQuery(".bkaTopmenu").removeClass('displayed').addClass('hidden');
					});
				}
			});
	}
	
	
	// If menu has sub-menu, submenu appears on hover top menu
	jQuery('ul.nav li.dropdown, ul.nav li.dropdown-submenu').hover(function() {
		jQuery(this).find(' > .dropdown-menu').stop(true, true).delay(200).fadeIn();
	}, function() {
		jQuery(this).find(' > .dropdown-menu').stop(true, true).delay(200).fadeOut();
	});
	
	// Onepage navigation, front page or blog section
	if(is_front_page==='true') {
		jQuery("ul.nav a[href*='#']").on( "click", function(){
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
			&& location.hostname == this.hostname) {
			  var $target = jQuery(this.hash);
			  var $selector = $target.selector;
			  $target = $target.length && $target
			  || jQuery('[name=' + this.hash.slice(1) +']');
			  if ($target.length && $selector.length > 1) {
				var targetOffset = $target.offset().top - 60;
				jQuery('html,body')
				.animate({scrollTop: targetOffset}, 1000);
			   return false;
			  }
			} 
		  });
		jQuery("ul.nav a:not(ul.nav a[href*='#'])").on( "click", function(){
			var currentItem = jQuery(this).attr('href');
			window.location = currentItem;
			return false;
		});
	} else {
		jQuery("#mainNavUl li a, .blog_widget ul li.menu-item a").live("click",function(){
			var currentItem = jQuery(this).attr('href');
			if(currentItem.charAt(0) == '#' && currentItem.length > 1) {
				var target =  home_url + currentItem;
				window.location = target;
				return false;
			} else {
				window.location = currentItem;
				return false;
			}
		});
	}
	
	// Enable menu scrollspy
	//jQuery('.navbar-default').scrollspy();
	//jQuery('body').attr('data-spy', 'scroll').attr('data-target', '.navbar-default').attr('data-offset', '61');
	
	var windowWidth = jQuery(window).width(); //retrieve current window width
	var windowHeight = jQuery(window).height(); //retrieve current window height
	
	jQuery('.hgrHeaderImage img').width(windowWidth).height(windowHeight);
	jQuery('.blogPosts').css("min-height",windowHeight);
	
	jQuery("#pagesContent").css("margin-top", windowHeight);
		
	jQuery(window).resize(function() {
		windowWidth = jQuery(window).width(); //retrieve current window width
		windowHeight = jQuery(window).height(); //retrieve current window height
		jQuery('.hgrHeaderImage img').width(windowWidth).height(windowHeight);
		jQuery('.blogPosts').css("min-height",windowHeight);
	});
	
	
	jQuery('.iconeffect').on( "mouseenter", function(){
		jQuery(this).find(".icon").addClass("hoveredIcon");
	});
	jQuery('.iconeffect').on( "mouseleave", function(){
		jQuery(this).find(".icon").removeClass("hoveredIcon");
	});
	
	
	
	jQuery(".readTheBlogBtn").click(function() {
		jQuery('html, body').animate({
			scrollTop: jQuery("#blogPosts").offset().top
		}, 1000);
	});

	
	// Back to top button
		jQuery(window).bind("scroll", function() {
			if (jQuery(window).scrollTop() > jQuery(window).height()) { 
				jQuery('.back-to-top').fadeIn(500);
			}
			if (jQuery(window).scrollTop() < jQuery(window).height()) {
				jQuery('.back-to-top').fadeOut(500);
			}
		});
		jQuery('.back-to-top').click(function(event) {
			event.preventDefault();
			jQuery('html, body').animate({scrollTop: 0}, 1000);
			return false;
    	});
	
	// Portfolio Isotope
	var container = jQuery('#portfolio-items');
	container.isotope({
		animationEngine : 'jquery',
		filter:"*",
	  	animationOptions: {
	     	duration: 500,
	     	queue: false
	   	},
		layoutMode: 'fitRows'
	});	
	jQuery('#filters a').click(function(){
		jQuery('#filters li').removeClass('active');
		jQuery(this).parent().addClass('active');
		var selector = jQuery(this).attr('data-filter');
	  	container.isotope({ filter: selector });
        setProjects();		
	  	return false;
	});
	function splitColumns() {
		var winWidth = jQuery(window).width(), 
			columnNumb = 1;			
		if (winWidth > 1024) {
			columnNumb = 4;
		} else if (winWidth > 900) {
			columnNumb = 3;
		} else if (winWidth > 479) {
			columnNumb = 2;
		} else if (winWidth < 479) {
			columnNumb = 1;
		}
		return columnNumb;
	}
	function setColumns() { 
	var container = jQuery('#portfolio-items');
		var winWidth = jQuery(window).width(), 
			columnNumb = splitColumns(), 
			postWidth = Math.floor(winWidth / columnNumb);
		
		container.find('.portfolio-item').each(function () { 
			jQuery(this).css( { 
				width : postWidth + 'px' 
			});
		});
	}
	function setProjects() { 
		setColumns();
		container.isotope('layout');
	}
	container.imagesLoaded(function () { 
		setProjects();	
	});
	jQuery(window).bind('resize', function () { 
		setProjects();			
	});
	setProjects();
		
		// open portfolio item
		jQuery(".portfolio-item .hover-info").live("click",function(){
			jQuery('.back-to-top').fadeOut(500);
			var postID = jQuery(this).attr('data-id');
			jQuery("body").css("overflow", "hidden");
			jQuery('.bkaTopmenu').slideUp(200, function() {
				jQuery(".bkaTopmenu").removeClass('displayed').addClass('hidden');
			});
			jQuery("#item-container").removeClass("hidden");
			jQuery("#item-container").height(windowHeight);
			jQuery("#item-container").html('<div class="loading"><img src="'+template_directory_uri+'/highgrade/images/preloader.svg" class="preloader"></div>');
			
			jQuery("#item-container").load( home_url+"?p="+postID);
			
		});
		
		// closes opened portfolio item
		jQuery("#itemcontainer-controller").live("click",function(){
			jQuery('.back-to-top').fadeIn(500);
			jQuery("body").css("overflow", "visible");
			jQuery("#item-container").html('');
			jQuery(".bkaTopmenu").slideDown(200).removeClass('hidden').addClass('displayed');
			jQuery("#item-container").addClass("hidden");
		});



	
	jQuery(window).resize(function() {
		jQuery('.parallax').each(function(){
			jQuery(this).css('background-position','center');
		});
	});
	
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		hgr_forMobile();
	}
	
	function hgr_forMobile(){
		jQuery('.parallax').each(function(){
			jQuery(this).css({"background-attachment":"scroll"});
		});
	}
});