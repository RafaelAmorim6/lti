$(document).ready(function(){
	resize_fun();
	});
$(window).resize(function(){
	resize_fun();
	})	
window.onorientationchange = function(){
	resize_fun();
	}	
function resize_fun (){
	var window_height = $(window).innerHeight();
	var header_height = $(".main-header-block").innerHeight();
	var footer_height = $(".main-footer-block").innerHeight();
	var r_header_height = $(".main-nav-container .nav-tabs").innerHeight();
	var r_footer_height = $(".foter-navs").innerHeight();
	var body_height = window_height - (header_height + footer_height);
	var right_tab_height = body_height - (r_header_height + r_footer_height);
	$(".main-body-block").height(body_height-1);
	$(".main-nav, .main-body-block>.container").height(body_height-1);
	$(".main-nav-container .tab-content").height(right_tab_height-2);
	}	
	
	
