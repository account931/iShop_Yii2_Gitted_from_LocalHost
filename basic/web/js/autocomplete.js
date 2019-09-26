//JQ autocomplete UI,(+ must include JQ_UI.js + JQ_UI.css in index.php)
$(document).ready(function(){
	
	//to make this script works only on SiteController/ViewOne
	if (typeof calenderEvents === 'undefined') { 
	    //alert ('false');
		return false;
	}
	
	
	//gets php object $query(i.e from Product Controller/actionShop), i.e all froducts from shop SQL. Php object is echoed in JSON in Controller Product/action Shop
	
	//alert(JSON.stringify(calenderEvents, null, 4));
	//console.log(JSON.stringify(calenderEvents, null, 4));
	
	
	//array which will contain all products for autocomplete
	var arrayAutocomplete = [];
	
	
	//Loop through passed php object, object is echoed in JSON in Controller Product/action Shop
	for (var key in calenderEvents) {
		arrayAutocomplete.push({
			  label: calenderEvents[key]['pr_name'], 
		      //value: calenderEvents[key]['pr_name'] //
		}); //gets name of every product and price
	}
	
	
	
	//alert("Autocomplete SQL values -> " + arrayAutocomplete);
	
    //Autocomplete itself
    $( function() {
		/*
		//test manual array for autocomplete
        var availableProducts = [ 
                              "Amsterdam_1",
							  "Anchorage_2",
							  "Anfgfg",
							  "Anvbvbv",
							  "Anchgffgfgfgf",				
        ];
		*/
		
		//connect autocomplete array to input
        $( "#searchProduct" ).autocomplete({
			//addon, trying to fix Z-index overlap of autocomplete, was fixed with css {.ui-autocomplete { position: absolute; cursor: default;z-index:999930 !important;}}
		    /* open: function(){
               // setTimeout(function () { $('.ui-autocomplete').css('z-index', 99999999999999888888); }, 0);
			   $(this).autocomplete('widget').zIndex(999999999999910);
             }, */
		     //addon
			
            source: arrayAutocomplete   //source autocom array
        });
   } );
   
   
   
   


});