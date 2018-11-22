// This script is responsible for:
// 1. Creating a new object with products or retrieving it from Local Storage ( If it was prev saved)
// 2.Each product plus, minus, re-calculate the Header cart icon sum




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









$(document).ready(function(){
	
	
	//In mobile version we change menu order, we put "Search" field on the top in order it not to be hidden by pop-up keyboard
	change_MenuOrder_in_Mobile();
	
	
	
	
	// Click + button*************
	$("#plus").click(function(){
        actionPlus();
		//refreshCartIcon();
    });
	//-----------------------------
	
	
	
	
	
	// Click - minus button*******
	$("#minus").click(function(){
        actionMinus();
		//refreshCartIcon();
    });
	//-----------------------------
	
	
	
	
	// Click Add to cart************
	$("#addToCart").click(function(){
        addToCart(); // add selected product to cart - add product values to OBJECT {productsObject}
		refreshCartIcon(); // recalculate the Cart Icon -  Calculates the Object sum and refresh the Cart Icon
    });
	//------------------------------
	
	
	
	// Click to see the object************
	$("#cartPrice").click(function(){
       alert(JSON.stringify(productsObject, null, 4));
    });
	//------------------------------
	
	
	
	// Click to see the object************
	$("#openSidePagewithCart").click(function(){
       openCalcSidePagewithCart();
    });
	//------------------------------
	
	
	
	// Onen cart Button Click (second)
	$(".myCart").click(function(){
		openNav();
        openCalcSidePagewithCart();
    });
	//------------------------------
	
	
	
	// Click ++plus in Full Final Cart List from Left Panel************
	$(document).on("click", '.fullCartPlus', function() {   // for newly generated
       plusItemInSideFinalCart(this.id);
    });
	//------------------------------
	
	
	// Click -- ninus in Full Final Cart List from Left Panel************
	$(document).on("click", '.fullCartMinus', function() {   // for newly generated
       minusItemInSideFinalCart(this.id);
    });
	//------------------------------
	
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 

	function actionPlus () 
	{
		//var parentID = $(this).parent().parent().attr('id');
	    //var parentID = $(this).closest('.prName').attr('id');
		
		var prodName = info[0]; // get it from modalBox.js
		var prodPrice = info[1]; // get price from modalBox.js
		var pcs = $("#productPcs").html(); // get the amount of pieces
		//alert(prodPrice + pcs);
		++pcs; //increase pieces + 1
		$("#productPcs").html(pcs);
		
		var total = prodPrice * pcs; // total price = price * amount
		total = total.toString(); // otherwise indexOf works with strings only
		
		// checks if the total price contain ".", if yes, make sure that we won't have price like 12.999999
		if ( total.indexOf(".") != -1 ) {
			//alert ('subst');
			totalArr = total.split(".");
			totalArr[1] = totalArr[1].substring(0,2); // cut the amount after the dot to 2 symbols only
			total = totalArr[0] + "." + totalArr[1];
		}
		
		$("#productTotal").html(total);
		
	}	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function actionMinus () 
	{
		var prodName = info[0]; // get it from modalBox.js
		var prodPrice = info[1]; // get price from modalBox.js
		var pcs = $("#productPcs").html(); // get the amount of pieces
		
		// if the selected amount in NULL, do nothing
		if (pcs == 0) {
			return;
			
		} else if (pcs == 1) { // if user has 1 pcs and wants to null it
			
			if (confirm ("Are you sure to null this order?")) {
				
			    --pcs; //increase pieces + 1
		        $("#productPcs").html(pcs);	
			    $("#productTotal").html(0);
			    delete productsObject[prodName]; // delete this product from object
				
				// Save OBJECT to LocalStorage (use it for -last item only, others variant will use addToCart ();)
			    localStorage.setItem('localStorageObject', JSON.stringify(productsObject)); // Parse Object to string and save to LStorage
				$('#myModal').fadeOut(1900);
				refreshCartIcon();
			}
			
		} else {
			--pcs; //increase pieces + 1
		    $("#productPcs").html(pcs);
			
			var total = prodPrice * pcs; // total price = price * amount
		    total = total.toString(); // otherwise indexOf works with strings only
		
		    // checks if the total price contain ".", if yes, make sure that we won't have price like 12.999999
		    if ( total.indexOf(".") != -1 ) {
			    //alert ('subst');
			    totalArr = total.split(".");
			    totalArr[1] = totalArr[1].substring(0,2); // cut the amount after the dot to 2 symbols only
			    total = totalArr[0] + "." + totalArr[1];
		    }
		
		    $("#productTotal").html(total);
			
		}
		
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	//Local STORAGE ADDING SHOULD BE HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	// add selected product to cart - add product values to OBJECT {productsObject}
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function addToCart () 
	{
		var prodName = info[0]; // get product name from modalBox.js
		var prodPrice = info[1]; // get price from modalBox.js
		var pcs = $("#productPcs").html(); // get the amount of pieces
		alert (prodPrice);
		
		if (pcs == 0) {
			alert ("Empty");
			return;
		} else { // add to Object product object {} and insert to it product.price and product.pcs
			productsObject[prodName] = {};
			productsObject[prodName]['price'] = prodPrice;
			productsObject[prodName]['quantity'] = pcs;
			alert(JSON.stringify(productsObject, null, 4)); //to alert OBJECT
			
			// Save OBJECT to LocalStorage
			localStorage.setItem('localStorageObject', JSON.stringify(productsObject)); // Parse Object to string and save to LStorage
			//var retrievedObject = localStorage.getItem('localStorageObject'); // get Loc Storage item
			//var retrievedObject = JSON.parse(retrievedObject); // turn LC string item to object type again
			//alert("Loc ST " + JSON.stringify(retrievedObject, null, 4));
		}
		$('#myModalConfirm').fadeIn(1200);
		
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	});
	// END ready
	
	
	
	// Calculates the Object sum and refresh the Cart Icon.    -MOVED TO a separate js -> refreshCartIcon.js
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	/*
	function refreshCartIcon() 
	{
		var sum = 0;
		for (var key in productsObject) {
			 var sumX = productsObject[key]['price'] * productsObject[key]['quantity'];
			 sum = sum + sumX;
		}
		
		sumXX = substringSum (sum); //cut odd digits (12.999999)
		
		if(sumXX == undefined) {  // if user -- pieces till 0 and it was the only product, so OBJECT is empty, can actually check if OBJECT empty before running for() loop 
		    $("#cartPrice").html("0 UAH");         // updating price in header cart icon
			$("#totalSumCartFull").html("0 UAH"); // updating price in left full page cart list
		} else {
		    $("#cartPrice").html(sumXX + " UAH");       // updating price in header cart icon
			$("#totalSumCartFull").html(sumXX + " UAH");// updating price in left full page cart list
			//alert("Screen width "+screen.width);
			if (screen.width < 600) {  // if screen is mobile html the price to Home menu
			   $("#home").html(sumXX + " UAH");
			}
		}
		
	}
	*/
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	// substring sum if it has too much digits after dot (i.e 12.99999999)
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function substringSum(mySum) 
	{
		mySum = mySum.toString(); // otherwise indexOf works with strings only
		if (mySum.indexOf(".") != -1 ) {  // if float, i.e 13.344444
			//alert ('subst');
			mySum = Math.round(parseFloat (mySum) * 100) / 100; //alert (totalArr[1]); // round 13.344444 to biggest closest, otherwise in some cases we loose 1 kopeks
			//alert(mySum);
			totalArr = mySum.toString().split(".");  // devide  13.344444 to totalArr = [13, 344444];
			
			totalArr[1] = totalArr[1].substring(0,2); // cut the amount after the dot to 2 symbols only
			mySum = totalArr[0] + "." + totalArr[1];
			return mySum;
		} else {
			return mySum;
		}
			
	}

    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
     
	
	// opens side page with full Cart list and calculates all from the data in OBJECT, generates auto id for +- (i.e id="product_plus")
	// opening by itself is in index.html
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function openCalcSidePagewithCart() 
	{
	    //alert(JSON.stringify(productsObject, null, 4)); //to alert OBJECT
        var finalText = "<div class='container' style='word-wrap: break-word;'>";  // word-wrap: break-word to prevent text overlapping
		finalText +=  "<div class='row smallText'>" +
						"<div class='col-sm-4 col-xs-3'> Product</div> " +
						"<div class='col-sm-2 col-xs-1'> P</div> " +
						
						"<div class='col-sm-1 col-xs-2'></div>" +  //+button
						"<div class='col-sm-1 col-xs-2'></div>" + //-button
						"<div class='col-sm-2 col-xs-2'>Price</div> " +
						"<div class='col-sm-2 col-xs-2'>Total</div>" +
						"</div></br>";
		
		
		for (var key in productsObject) {
			
			var addID = decodeSpecilalChars(key);//key is an object name(i.e product name) //decodeSpecilalChars()-> Decode "_"(if any in product name) in id name to avoid crashing in js/myCore.js-> plusItemInSideFinalCart(this.id) /minusItemInSideFinalCart(this.id);
			//decodeSpecilalChars(addID); // Decode "_"(if any in product name) in id name to avoid crashing in js/myCore.js-> plusItemInSideFinalCart(this.id) /minusItemInSideFinalCart(this.id);
			finalText = finalText + 
			            "<div class='row'>" +
						"<div class='col-sm-4 col-xs-3'>" + key + "</div> " +
						"<div class='col-sm-2 col-xs-1'>" + productsObject[key]['quantity'] + "</div> " +
						
						"<div class='col-sm-1 col-xs-2'><button type='button' class='btn btn-success fullCartPlus' id=' "  + addID + "_plus'>&nbsp; + &nbsp;</button></div>" +  //+button
						"<div class='col-sm-1 col-xs-2'><button class='btn btn-danger fullCartMinus'               id=' "  + addID + "_minus'>&nbsp; - &nbsp;</button>" + "</div>" + //-button
						"<div class='col-sm-2 col-xs-2'>" + productsObject[key]['price'] + "</div> " +
						"<div class='col-sm-2 col-xs-2'>" + substringSum (productsObject[key]['quantity'] * productsObject[key]['price']) +
						"</div>" +
						"</div></br>";
		}
		finalText = finalText + "</div>";
		
		$("#fullCartList").html(finalText);
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	//13Niv Fix
	//decode productname, if event name has "_" (i.e "Stella_Artua") change it to ("Stella:Artua")
	// Decode "_"(if any in product name) in id name to avoid crashing in js/myCore.js-> plusItemInSideFinalCart(this.id) /minusItemInSideFinalCart(this.id);
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function decodeSpecilalChars(charX){
	   
	    if(charX.search("_") > -1){ //if Event has "_"
		
		    charX = charX.split('_').join(':');  //repalce all "_" with ":"
		} else {
			charX = charX; //no changes
		}
		//alert(charX);
		return charX;
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	//Is used to decode back product names decoded with {decodeSpecilalChars(charX)}, it decodes back ("Stella:Artois" to "Stella_Artois")
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function decodeBack(charX){
	   
	    if(charX.search(":") > -1){ //if Event has ":"
		
		    charX = charX.split(':').join('_');  //repalce all ":" with "_"
		} else {
			charX = charX; //no changes
		}
		//alert(charX);
		return charX;
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	// Click ++ plus in Final Full Cart from Left
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function plusItemInSideFinalCart(id)
	{
	    //var idm= $("#" +id).val();
		idArray = id.split("_"); 
		var productZ = decodeBack(idArray[0]); // get 1st element = product name (from id="product_plus") + decode it back (if product name has ":"), we decode it back to "_",(("Stella:Artois" to "Stella_Artois")), ie if name was previously decoded with {decodeSpecilalChars(charX)}
		
		//alert (productZ.trim().length);
	    productZ = productZ.trim(); // trim product as it get 1 blankspace and cause the crash in next line
		var pcs = productsObject[productZ]['quantity']; // get quantity from Object
		++pcs;
		productsObject[productZ]['quantity'] = pcs; // assing new quantity
		localStorage.setItem('localStorageObject', JSON.stringify(productsObject)); // Parse Object to string and save to LStorage
		openCalcSidePagewithCart(); // refresh Left Panel Full Cart
		refreshCartIcon (); // refersh total amount in header cart + total amount in left Full Cart List
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	// Click -- minus in Final Full Cart from Left
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function minusItemInSideFinalCart(id)
	{
	    //var idm= $("#" +id).val();
		idArray = id.split("_"); 
		var productZ = decodeBack(idArray[0]); // get 1st element = product name (from id="product_plus") + decode it back (if product name has ":"), we decode it back to "_",(("Stella:Artois" to "Stella_Artois")), ie if name was previously decoded with {decodeSpecilalChars(charX)}
		
		//alert (productZ.trim().length);
	    productZ = productZ.trim(); // trim product as it get 1 blankspace and cause the crash in next line
		var pcs = productsObject[productZ]['quantity']; // get quantity from Object
		
		if (pcs != 1) {
		    --pcs;
		    productsObject[productZ]['quantity'] = pcs; // assing new quantity
		    localStorage.setItem('localStorageObject', JSON.stringify(productsObject)); // Parse Object to string and save to LStorage
		    openCalcSidePagewithCart(); // refresh Left Panel Full Cart
		    refreshCartIcon (); // refersh total amount in header cart + total amount in left Full Cart List
			
		} else if (pcs == 1) { // if user has 1 pcs and wants to null it
			
			if (confirm ("Are you sure to null this order?")) {
				
			    --pcs; //increase pieces + 1
		        $("#productPcs").html(pcs);	
			    //$("#productTotal").html(0);
			    delete productsObject[productZ]; // delete this product from object
				
				// Save OBJECT to LocalStorage (use it for -last item only, others variant will use addToCart ();)
			    localStorage.setItem('localStorageObject', JSON.stringify(productsObject)); // Parse Object to string and save to LStorage
				openCalcSidePagewithCart(); // refresh Left Panel Full Cart
				//$('#myModal').fadeOut(1900);
				refreshCartIcon();
			}
		}	
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	// onFocus in custom form (VertRows, HorizColumn) in  mobile version scroll the page to input
	/*
	$( "#searchProduct" ).focus(function() {
        if(screen.width <= 640){ //alert("focus");
		    $("#myTopnav a:last-child").css("margin-bottom", "200px");
		
	        scrollResults("#searchProduct"); //scroll the page down to currencies results  //#currencyResult
	    }
    });
	*/
	
	
	
	 //In mobile version we change menu order, we put "Search" field on the top in order it not to be hidden by pop-up keyboard
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	 function change_MenuOrder_in_Mobile()
	 {
	     if(screen.width <= 640){ 
		     //var tests = $('#myTopnav');
             //tests.first().insertAfter(tests.last()); 
		     $("#searchX").insertBefore($("#pcControl"));    
	     }
	 }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	//=============================== DONOR =======================================================================
	   
	 // Scroll the page to results  #resultFinal
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function scrollResults(divName, parent)  //arg(DivID, levels to go up from DivID)
	{   //if 2nd arg is not provided while calling the function with one arg
		if (typeof(parent)==='undefined') {
		
            $('html, body').animate({
                scrollTop: $(divName).offset().top
                //scrollTop: $('.your-class').offset().top
             }, 'slow'); 
		     // END Scroll the page to results
		} else {
			//if 2nd argument is provided
			var stringX = "$(divName)" + parent + "offset().top";  //i.e constructs -> $("#divID").parent().parent().offset().top
			$('html, body').animate({
                scrollTop: eval(stringX)         //eval is must-have, crashes without it
                }, 'slow'); 
		}
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	 // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	
	function scroll_toTop() 
	{
	    $("html, body").animate({ scrollTop: 0 }, "slow");	
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	