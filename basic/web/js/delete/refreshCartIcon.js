


$(document).ready(function(){
	

	
	
	
	
	});
	// END ready----------------------------------------------------------------------------------------------------------
	
	
	
	
	
	
	//Taken out of myCore.js to be used in different asserts
	// Calculates the Object sum and refresh the Cart Icon. 
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
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
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	// substring sum if it has too much digits after dot (i.e 12.99999999)
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function substringSum (mySum) 
	{
		mySum = mySum.toString(); // otherwise indexOf works with strings only
		if ( mySum.indexOf(".") != -1 ) {  // if float, i.e 13.344444
			//alert ('subst');
			mySum = Math.round( parseFloat (mySum) * 100) / 100; //alert (totalArr[1]); // round 13.344444
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
	