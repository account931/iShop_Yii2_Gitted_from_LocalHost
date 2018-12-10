
$(document).ready(function(){
	
	});
	// END ready----------------------------------------------------------------------------------------------------------
	
	
	
	//BOOTSTRAP hover menu, by default ir works on click only
    jQuery('.dropdown-toggle, .dropdown-menu').hover(function() { 
        jQuery('.dropdown-menu').stop(true, true).delay(50).fadeIn();
    }, function() {
        jQuery('.dropdown-menu').stop(true, true).delay(50).fadeOut();
    });
	//BOOTSTRAP hover menu, by default ir works on click only
	
	
	
	
	
	
	
	//JS on hover meenu appear
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	 $('.my-drop, .dropdown-content-my').bind('mouseenter', 
        function(event){ 
		
		    $(".dropdown-content-my").show();
           
      });
      $('.my-drop , .dropdown-content-my').bind('mouseleave', 
        function(event){ 
           $(".dropdown-content-my").hide();
      });
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	$(".dropdown-content-my a").css({"background-color": "yellow", "font-size": "1em", "display": "block"});
	
	//$(".dropdown-z").css({"position": "relative"});
	
	//$(".dropdown-content-my").css({"position": "absolute"});