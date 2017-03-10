/* Theme Name:iDea - Clean & Powerful Bootstrap Theme
 * Author:HtmlCoder
 * Author URI:http://www.htmlcoder.me
 * Author e-mail:htmlcoder.me@gmail.com
 * Version: 1.4
 * Created:October 2014
 * License URI:http://support.wrapbootstrap.com/
 * File Description: Place here your custom scripts
 */
jQuery(document).ready(function($) { 
    $(".scroll").click(function(event){ 
    	if($(this.hash).offset()){
	        event.preventDefault();
	        $('html,body').animate({scrollTop:$(this.hash).offset().top - 100}, 800);
    	}
   });
    /*$(window).on("scroll",function(event){
    	var hash = window.location.hash;
    	if($(hash).offset()){
    		var padding = parseInt($(hash).css("padding-top").replace("px", ""));
	        event.preventDefault();
	        $('html,body').animate({scrollTop:$(hash).offset().top - 200 + padding}, 800);
	        $(window).unbind('scroll')
    	}
    });*/

	$(".owl-carousel.clients2").owlCarousel({
		items: 5,
		autoPlay: 3500,
		pagination: false,
		navigation: false
	});

	$(".owl-carousel.clients3").owlCarousel({
		items: 4,
		autoPlay: 2000,
		pagination: false,
		navigation: false,
	});
    _activeMenu();
});

function _activeMenu(){
	$(".navbar.navbar-default").find('.active').removeClass('active');
	var href = window.location.origin + window.location.pathname;
	var link = $('a[href="'+href+'"]');
	_checkActive(link.parent('li')).addClass('active');
}

function _checkActive(li){
	var parent = li.parents('li');
	if(parent.length == 0)
		return li;
	return _checkActive(parent);
}