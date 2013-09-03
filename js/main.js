if(!Date.prototype.toISOString) 
{
    Date.prototype.toISOString = function() 
	{
        function pad(n) {return n < 10 ? '0' + n : n}
        return this.getUTCFullYear() + '-'
            + pad(this.getUTCMonth() + 1) + '-'
                + pad(this.getUTCDate()) + 'T'
                    + pad(this.getUTCHours()) + ':'
                        + pad(this.getUTCMinutes()) + ':'
                            + pad(this.getUTCSeconds()) + 'Z';
    };
}
function onAfterSlide(prevSlide, currentSlide)
{
	var expando = $(this).get(0)[jQuery.expando];
	$("#slider_navigation_" + expando + " .slider_control").addClass("inactive");
	$("#" + $(currentSlide).attr("id") + "_content").fadeIn(200, function(){
		$("#slider_navigation_" + expando + " .slider_control").removeClass("inactive");
	});	
}
function onBeforeSlide(prevSlide, currentSlide)
{
	var expando = $(this).get(0)[jQuery.expando];
	$(".slider_" + expando + "_content_container .slider_content").fadeOut(200);
	var position = $($("#" + $(currentSlide).attr("id") + "_control")).position();
	var positionPrev = $($("#" + $(prevSlide).attr("id") + "_control")).position();
	$("#slider_navigation_" + expando + " .slider_control_bar").css("display", "none");
	$("#slider_navigation_" + expando + " .slider_bar").css({
		"display": "block",
		"margin-left": positionPrev.left + "px"
	});
	$("#slider_navigation_" + expando + " .slider_bar").animate({
		'margin-left': position.left + "px"
	}, 750, "easeInOutQuint", function(){
		$(this).css("display", "none");
		$("#" + $(currentSlide).attr("id") + "_control").children("#slider_navigation_" + expando + " .slider_control_bar").css("display", "block");
	});
}
var map = null;
jQuery(document).ready(function($){
	//mobile menu
	$(".mobile_menu select").change(function(){
		window.location.href = $(this).val();
		return;
	});
	
	//slider
	$(".slider").carouFredSel({
		responsive: true,
		prev: {
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		},
		next: {
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		},
		auto: {
			play: true,
			pauseDuration: 5000,
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		}
	},
	{
		wrapper: {
			classname: "caroufredsel_wrapper caroufredsel_wrapper_slider"
		}
	});
	$(".slider").sliderControl({
		appendTo: $(".slider_content_box"),
		contentContainer: $(".slider_content_box")
	});
	
	//image carousel
	$(".image_carousel").carouFredSel({
		responsive: true,
		prev: {
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		},
		next: {
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		},
		auto: {
			play: false,
			pauseDuration: 5000,
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		}
	});
	$(".image_carousel").sliderControl({
		appendTo: "",
		contentContainer: ""
	});
	
	/*$("ul.gallery_item_details_list").css({
		"height": 0,
		"display": "none"
	});
	$(".gallery_item_details_list li.gallery_item_details").css("display", "none");*/
	
	//horizontal carousel
	$(".horizontal_carousel").carouFredSel({
		items: {
			visible: 4
		},
		scroll: {
			items: 1,
			easing: "swing",
			pauseOnHover: true
		},
		auto: {
			play: false,
			items: 1
		}
	});
	$(".our_clinic").trigger("configuration", {
		prev: '#our_clinic_prev',
		next: '#our_clinic_next'
	});
	$(".carousel").trigger("configuration", {
		prev: '#carousel_prev',
		next: '#carousel_next'
	});
	setTimeout(function(){
		$(".testimonials").trigger("configuration", {
			items: {
				visible: 2
			},
			prev: '#testimonials_prev',
			next: '#testimonials_next'
		});
	}, 1000);
	
	//training_classes
	$(".accordion").accordion({
		event: 'change',
		autoHeight: false
	});
	$(".accordion.wide").bind("accordionchange", function(event, ui){
		$("html, body").animate({scrollTop: $("#"+$(ui.newHeader).attr("id")).offset().top}, 400);
	});
	$(".tabs").bind("tabsbeforeactivate", function(event, ui){
		$("html, body").animate({scrollTop: $("#"+$(ui.newTab).children("a").attr("id")).offset().top}, 400);
	});
	$(".tabs").tabs({
		event: 'change',
		show: true,
		create: function(){
			$("html, body").scrollTop(0);
		}
	});
	
	//image controls
	var currentControls;
	$(".gallery_box").hover(function(){
		var width = $(this).find("img").first().width();
		var height = $(this).find("img").first().height();
		currentControls = $(this).find(".controls");
		var currentControlsWidth = currentControls.outerWidth();
		var currentControlsHeight = currentControls.outerHeight();
		if(!currentControls.hasClass("hovered"))
		{
			currentControls.addClass("hovered");
			currentControls.css({
				"display": "block",
				"margin-left": (width/2-currentControlsWidth/2) + "px",
				"top": (height) + "px"
			});
			currentControls.animate({"top": (height/2-currentControlsHeight/2) + "px"},250,'easeInOutCubic');
		}
		
	},function(){
		if(currentControls.hasClass("hovered"))
		{
			currentControls.css("display", "block");
			var height = $(this).find("img").first().height();
			currentControls.animate({"top": (height) + "px"},250,'easeInOutCubic', function(){
				$(this).css("display","none");
				$(this).removeClass("hovered");
			});
		}
	});
	
	//browser history
	$(".tabs .ui-tabs-nav a").click(function(){
		if($(this).attr("href").substr(0,4)!="http")
			$.bbq.pushState($(this).attr("href"));
		else
			window.location.href = $(this).attr("href");
	});
	$(".ui-accordion .ui-accordion-header").click(function(){
		$.bbq.pushState("#" + $(this).attr("id").replace("accordion-", ""));
	});
	
	//tabs box navigation
	$(".tabs_box_navigation").mouseover(function(){
		$(this).find("ul").removeClass("tabs_box_navigation_hidden");
	});
	$(".tabs_box_navigation a").click(function(){
		$(".tabs_box_navigation_selected .selected").removeClass("selected");
		$(this).parent().addClass("selected");
		$(this).parent().parent().parent().children('span').text($(this).text());
		$(this).parent().parent().addClass("tabs_box_navigation_hidden");
	});
	$(".contact_form .tabs_box_navigation a").click(function(event){
		event.preventDefault();
		$(this).parent().parent().parent().children("[type='hidden']").first().val($.trim($(this).text()));
	});
	
	//hashchange
	$(window).bind("hashchange", function(event){
		var hashSplit = $.param.fragment().split("-");
		var hashString = "";
		for(var i=0; i<hashSplit.length-1; i++)
			hashString = hashString + hashSplit[i] + (i+1<hashSplit.length-1 ? "-" : "");
		if(hashSplit[0].substr(0,7)!="filter=")
		{
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent($.param.fragment())).trigger("change");
			$(".tabs_box_navigation a[href='#" + decodeURIComponent($.param.fragment()) + "']").trigger("click");
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent(hashString)).trigger("change");
		}
		$('.tabs .ui-tabs-nav [href="#' + decodeURIComponent(hashString) + '"]').trigger("change");
		$('.tabs .ui-tabs-nav [href="#' + decodeURIComponent($.param.fragment()) + '"]').trigger("change");
		if(hashSplit[0].substr(0,7)!="filter=")
			$('.tabs .ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent($.param.fragment())).trigger("change");
		$(".testimonials, .scrolling_list").trigger("updateSizesCustom");
		
		// get options object from hash
		var hashOptions = $.deparam.fragment();

		if(typeof(hashOptions.filter)!="undefined")
		{
			// apply options from hash
			$(".isotope_filters a").removeClass("selected");
			if($('.isotope_filters a[href="#filter='+hashOptions.filter+'"]').length)
				$('.isotope_filters a[href="#filter='+hashOptions.filter+'"]').addClass("selected");
			else
				$(".isotope_filters li:first a").addClass("selected");
			$(".gallery:not('.horizontal_carousel')").isotope(hashOptions);
			//$(".timetable_isotope").isotope(hashOptions);
		}
		
		//open gallery details
		if(location.hash.substr(1,21)=="gallery-details-close" || typeof(hashOptions.filter)!="undefined")
		{
			$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint', complete:function(){
				$(this).css("display", "none")
				$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			}
			});
		}
		else if(location.hash.substr(1,15)=="gallery-details")
		{
			var detailsBlock = $(location.hash);
			$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			detailsBlock.css("display", "block");
			var galleryItem = $("#gallery-item-" + location.hash.substr(17));
			detailsBlock.find(".prev").attr("href", (galleryItem.prevAll(":not('.isotope-hidden')").first().length ? galleryItem.prevAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".gallery:not('.horizontal_carousel')").children(":not('.isotope-hidden')").last().find(".open_details").attr("href")));
			detailsBlock.find(".next").attr("href", (galleryItem.nextAll(":not('.isotope-hidden')").first().length ? galleryItem.nextAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".gallery:not('.horizontal_carousel')").children(":not('.isotope-hidden')").first().find(".open_details").attr("href")));
			var visible=parseInt($(".gallery_item_details_list").css("height"))==0 ? false : true;
			var galleryItemDetailsOffset;
			if(!visible)
			{
				$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()}, 500, 'easeOutQuint', function(){
					$(this).css("height", "100%");
					$(location.hash + " .image_carousel").trigger("updateSizesCustom");
				});
				galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
				$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
			}
			else
			{
				/*$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint',complete:function() 
				{
					$(this).css("display", "none")*/
					//$(".gallery_item_details_list").css("height", "100%");
					galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
					$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
					$(location.hash + " .image_carousel").trigger("updateSizesCustom");
					/*$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()},{duration:500,easing:'easeOutQuint'});
				}});*/
			}
		}
	}).trigger("hashchange");
	
	//tweets
	$.getJSON('https://api.twitter.com/1/statuses/user_timeline/quanticalabs.json?count=10&include_rts=true&callback=?', function(data)
	{
		if(data.length)
		{
			var list=$(".latest_tweets");
			var date;
			$(data).each(function(index,value)
			{
				if($.browser.msie)
					date = new Date(Date.parse(value.created_at.replace(/( \+)/, ' UTC$1'))).toISOString();
				else
					date = new Date(Date.parse(value.created_at)).toISOString();
				list.append($('<li class="icon_small_arrow right_white">').append($('<p>').html(linkify(value.text)+'<abbr class="timeago" title="'+date+'">'+date+'</abbr>')));
			});

			$('.latest_tweets a').attr('target','_blank');

			list.carouFredSel({
				direction: "up",
				items: {
					visible: 3
				},
				scroll: {
					items: 1,
					easing: "swing",
					pauseOnHover: true,
					height: "variable"
				},
				prev: '#latest_tweets_prev',
				next: '#latest_tweets_next',
				auto: {
					play: false
				}
			});	
			$("abbr.timeago").timeago();
		}
	});
	
	//timeago
	$("abbr.timeago").timeago();
	
	//footer recent posts, most commented, most viewed, scrolling list
	$(".footer_recent_posts, .most_commented, .most_viewed, .scrolling_list_0").carouFredSel({
		direction: "up",
		items: {
			visible: 3
		},
		scroll: {
			items: 1,
			easing: "swing",
			pauseOnHover: true,
			height: "variable"
		},
		auto: {
			play: false
		}
	});
	$(".footer_recent_posts").trigger("configuration", {
		prev: '#footer_recent_posts_prev',
		next: '#footer_recent_posts_next'
	});
	$(".most_commented").trigger("configuration", {
		prev: '#most_commented_prev',
		next: '#most_commented_next'
	});
	$(".most_viewed").trigger("configuration", {
		prev: '#most_viewed_prev',
		next: '#most_viewed_next'
	});
	$(".scrolling_list_0").trigger("configuration", {
		prev: '#scrolling_list_0_prev',
		next: '#scrolling_list_0_next'
	});
	
	if($("#map").length)
	{
		//google map
		var coordinate = new google.maps.LatLng(-37.732304, 144.868641);
		var mapOptions = {
			zoom: 12,
			center: coordinate,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false,
			mapTypeControl: false
		};

		map = new google.maps.Map(document.getElementById("map"),mapOptions);
		new google.maps.Marker({
			position: new google.maps.LatLng(-37.732304, 144.868641),
			map: map,
			icon: new google.maps.MarkerImage("images/map_pointer.png", new google.maps.Size(38, 45), null, new google.maps.Point(18, 44))
		});
	}
	
	//window resize
	$(window).resize(function(){
		$(".training_classes").accordion("resize");
		if(map!=null)
			map.setCenter(coordinate);
		if($(".gallery:not('.horizontal_carousel')").length)
		{
			$(".gallery:not('.horizontal_carousel')").isotope({
				masonry: {
					//columnWidth: 225,
					gutterWidth: ($(".gallery:not('.horizontal_carousel')").width()>462 ? 30 : 12)
				  }
			});
		}
	});
	
	//scroll top
	$("a[href='#top']").click(function() {
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});
	
	//comments number scroll
	$(".single .comments_number").click(function(event){
		event.preventDefault();
		var offset = $("#comments_list").offset();
		$("html, body").animate({scrollTop: offset.top-10}, 400);
	});
	
	//reply button scroll
	$(".reply_button").click(function(event){
		event.preventDefault();
		var offset = $("#comment_form").offset();
		$("html, body").animate({scrollTop: offset.top-10}, 400);
		$("#cancel_comment").css('display', 'block');
	});
	
	//cancel comment button
	$("#cancel_comment").click(function(event){
		event.preventDefault();
		$(this).css('display', 'none');
	});
	
	//hint
	$(".search input[type='text']").hint();
	
	//tooltip
	$(".tooltip").bind("mouseover click", function(){
		var position = $(this).position();
		var tooltip_text = $(this).children(".tooltip_text");
		tooltip_text.css("width", $(this).outerWidth() + "px");
		tooltip_text.css("height", tooltip_text.height() + "px");
		tooltip_text.css({"top": position.top-tooltip_text.innerHeight() + "px", "left": position.left + "px"});
	});
	
	//isotope
	$(".gallery:not('.horizontal_carousel')").isotope({
		masonry: {
			//columnWidth: 225,
			gutterWidth: ($(".gallery:not('.horizontal_carousel')").width()>462 ? 30 : 12)
		  }
	});
	//$(".timetable_isotope").isotope();
	
	//fancybox
	$(".fancybox").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'cyclic': 'true'
	});
	$(".fancybox-video").bind('click',function() 
	{
		$.fancybox(
		{
			'autoScale':false,
			'speedIn': 600, 
			'speedOut': 200,
			'transitionIn': 'elastic',
			'width':(this.href.indexOf("vimeo")!=-1 ? 600 : 680),
			'height':(this.href.indexOf("vimeo")!=-1 ? 338 : 495),
			'href':(this.href.indexOf("vimeo")!=-1 ? this.href : this.href.replace(new RegExp("watch\\?v=", "i"), 'embed/')),
			'type':'iframe',
			'swf':
			{
				'wmode':'transparent',
				'allowfullscreen':'true'
			}
		});
		return false;
	});
	$(".fancybox-iframe").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'width' : '75%',
		'height' : '75%',
		'autoScale' : false,
		'titleShow': false,
		'type' : 'iframe'
	});
	
	//contact form
	if($(".contact_form").length)
		$(".contact_form")[0].reset();
	$(".contact_form").submit(function(event){
		event.preventDefault();
		var data = $(this).serializeArray();
		$("#contact_form .block").block({
			message: false,
			overlayCSS: {
				opacity:'0.3',
				"backgroundColor": "#FFF"
			}
		});
		$.ajax({
			url: $(".contact_form").attr("action"),
			data: data,
			type: "post",
			dataType: "json",
			success: function(json){
				$("#contact_form [name='submit'], #contact_form [name='first_name'], #contact_form [name='last_name'], #contact_form [name='email'], #contact_form [name='message']").qtip('destroy');
				if(typeof(json.isOk)!="undefined" && json.isOk)
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#contact_form [name='submit']").qtip(
						{
							style: {
								classes: 'ui-tooltip-success'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
						$(".contact_form")[0].reset();
						$(".contact_form [name='department']").val("");
						$(".contact_form .tabs_box_navigation_selected>span").text("Select department");
					}
				}
				else
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#contact_form [name='submit']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_first_name)!="undefined" && json.error_first_name!="")
					{
						$("#contact_form [name='first_name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_first_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_last_name)!="undefined" && json.error_last_name!="")
					{
						$("#contact_form [name='last_name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_last_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_email)!="undefined" && json.error_email!="")
					{
						$("#contact_form [name='email']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_email 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_message)!="undefined" && json.error_message!="")
					{
						$("#contact_form [name='message']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_message 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
				}
				$("#contact_form").unblock();
			}
		});
	});
	$(".contact_form [name='date_of_birth']").datepicker({
		dateFormat: "mm-dd-yy"
	});
	$(".closing_in").each(function(){
		var self = $(this);
		var time = parseInt(self.children(".seconds").text());
		var id = setInterval(function(){
			time--;
			self.children(".seconds").text(time);
			if(time==0)
			{
				self.parent().prev(".notification_box").fadeOut(500, function(){
					$(this).remove();
				});
				self.remove();
				clearInterval(id);
			}
		}, 1000);
	});
});