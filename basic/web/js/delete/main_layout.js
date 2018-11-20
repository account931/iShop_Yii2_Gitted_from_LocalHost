//Used in vies/layout/main.php
//1. Start PreLoader, shows preloader spinner in views/layouts/main.php
//2. Highlight active current main menu item, all menu items should have class="check" to run verification

$(document).ready(function(){
	



    // Start PreLoader, shows preloader spinner in views/layouts/main.php---------------
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
    $("#overlay").fadeOut(2000, function() {
        $(".wrap").fadeIn(1000);        
    });
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
    // end  PreLoader, shows preloader spinner in views/layouts/main.php---------------
	
	
	
	
	
	
	
	// Start setting active menu item, it highlights the current active menu with class="activeMenuItem"-------------
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	var current = window.location.href ; //gets the current browser url address
	//runs through all main menu items with class="check"
    $('.check').each(function(){
        var $this = $(this);
		//alert($this.attr('href').slice(-24));
		//alert($this.attr('href'));
		//alert(current.slice(-24));
		
        // if the current path is like this link, make it active, {current.slice(-24} cuts and return last 24 letters, as the start of href may be dieffent
        if($this.attr('href').slice(-24) == current.slice(-24)/*.indexOf(current) !== -1*/){ 
            $this.addClass('activeMenuItem'); //assign this Class with spec colors to currently active menu
        }
    })
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	// Start setting active menu item, it highlights the current active menu-------------
	
	
	
	
	
	
	
	
	
	
	
	
//-------	
});
// END ready
	
	
