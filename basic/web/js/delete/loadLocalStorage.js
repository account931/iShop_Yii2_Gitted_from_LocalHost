


$(document).ready(function(){
	

	
	
	
	
	});
	// END ready----------------------------------------------------------------------------------------------------------
	
	
	
	
	
	
	//Taken out of myCore.js to be used in different asserts
	// FALSE - Initialize OBJECT productsObject, was in myCore, but thus was executed there with delay and Line 46 here was failing
    //checking if object for all product exist and creat it if not
    window.productsObject;
    // Check if Object was already saved in Local Storage, if not - creat it
    if (localStorage.getItem("localStorageObject") != null) { // If Local Storage was prev created and exists
		    var retrievedObject = localStorage.getItem('localStorageObject'); // get Loc Storage item
			var retrievedObject = JSON.parse(retrievedObject);
			productsObject = retrievedObject;
			refreshCartIcon(); // recalc the header cart icon, had to outline it out of ready section, as it was invisible
			//alert ("Loc St exists" + JSON.stringify(productsObject, null, 4) ); //IMPORTANT ALERT
    } else {
        
		// if Loc Storage does not exist (i.e Object was never initialized), create a new Object
	    if (typeof productsObject == "undefined") {
            alert("Object will be created now");
		    var productsObject = { }; //empty object for all cart products
        } else {
		    alert("Object Exists"); // will never fire
	    }
	}	
