/*!
 * liScroll 1.0
 * Examples and documentation at: 
 * http://www.gcmingati.net/wordpress/wp-content/lab/jquery/newsticker/jq-liscroll/scrollanimate.html
 * 2007-2010 Gian Carlo Mingati
 * Version: 1.0.2.1 (22-APRIL-2011)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires:
 * jQuery v1.2.x or later
 * 
 */


jQuery.fn.liScroll = function(settings) {
	settings = jQuery.extend({
		travelocity: 0.1
	}, settings);	

	return this.each(function()
	{
		var $strip = jQuery(this);
		$strip.addClass("newsticker");
		var stripWidth = 1;

		$strip.find("li").each(function(i){
			stripWidth += jQuery(this, i).outerWidth(true); // thanks to Michael Haszprunar and Fabien Volpi
		});

		var $mask = $strip.wrap("<div class='mask'></div>");
		var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
		var containerWidth = $strip.parent().parent().width();	//a.k.a. 'mask' width 	
		$strip.width(stripWidth);			

		var totalTravel = stripWidth+containerWidth;
		var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		

		function scrollnews(spazio, tempo){
			$strip.animate({left: '-='+ spazio}, 
			tempo, "linear", 
			function(){
				$strip.css("left", containerWidth); 
				scrollnews(totalTravel, defTiming);
			});
		}

		scrollnews(totalTravel, defTiming);	

		$strip.hover(function(){
			jQuery(this).stop();
		},
		function(){
			var offset = jQuery(this).offset();
			var residualSpace = offset.left + stripWidth;
			var residualTime = residualSpace/settings.travelocity;
			scrollnews(residualSpace, residualTime);
		});			
	});	
};
/**
 * Created by ughostephan on 05/09/2016.
 */
$(document).ready(function() {
    $.material.init();

    $('.delete').delay(3000).fadeOut(500, function () {
        $(this).remove();
    });
});
/**
 * Created by ughostephan on 05/09/2016.
 */
$(document).ready(function() {
    $("#nav-mobile").html($("#nav-main").html());
    $("#nav-trigger span").click(function() {
        if ($("nav#nav-mobile ul").hasClass("expanded")) {
            $("nav#nav-mobile ul.expanded").removeClass(
                "expanded").slideUp(250);
            $(this).removeClass("open");
        } else {
            $("nav#nav-mobile ul").addClass("expanded")
                .slideDown(250);
            $(this).addClass("open");
        }
    s});
});
//# sourceMappingURL=all.js.map
