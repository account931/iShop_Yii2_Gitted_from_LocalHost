//This is used for ajax search for a product(in search input in the menu  top right)
//Sends ajax to ProductsController->public function actionGet_single_ajax_product()
//Input itself uses autocomplete.js

$(document).ready(function(){
	
	});
	// END ready----------------------------------------------------------------------------------------------------------
	
	
	
	// Click Search  button (in search input in the menu  top right)*************
	$("#searchX button").click(function(){
        send_ajax_for_searched_value($(this));
    });
	//-----------------------------
	
	
	
	
	

	//Send ajax to ProductsController->public function actionGet_single_ajax_product() to find one single item
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function send_ajax_for_searched_value(passed_this) 
	{
		var urlX = passed_this.attr("id"); //id of clicked button, in fact URL to send ajax (/iShop_yii/yii-basic-app-2.0.15/basic/web/index.php?r=products/getsingleajaxproduct )
		if($("#searchProduct").val().trim()== ""){
			alert("Empty");
			return false;
		}
		
		
		//hides responsive menu in mobile after the click(main js logic of responsive menu is in view/layout/main.php)
		document.getElementById("myTopnav").className = "topnav";  
		
		$.ajax({
            url: urlX,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the Venue ID
            data: { 
			    serverSearchValue: $("#searchProduct").val(),  //
			},
            success: function(data) {
               build_Single_Product_result(data);
			   
            },  //end success
			error: function (error) {
				$("#productDisplayArea").stop().fadeOut("slow",function(){ $(this).html("<h4 class='ajax-error'>ERROR!!! <br> NO Products FOUND<br> Go back to <a href='products/shop'>Shop</a> &nbsp;<i class='	fa fa-external-link' style='font-size:36px'></i></h4>")}).fadeIn(2000);
            }	
        });
                                               
       //  END AJAXed  part 
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	// Dispaly one single product from  search input in the menu (top right). NOT 100% FINISHED!!!! SHOW ONLY STATUS FROM ProductsController->public function actionGet_single_ajax_product()
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function build_Single_Product_result(data) 
	{
		//alert(JSON.stringify(data.productFound, null, 4));
		/*
		var resultX = "<p>";
		resultX = resultX + data.result_status;
		resultX = resultX + "<br> " + data.search_value;
		resultX+= "<br> price is =>  " + data.productFound['pr_price'] + "</p>";
		$("#productDisplayArea").stop().fadeOut("slow",function(){ $(this).html(resultX)}).fadeIn(2000);
		*/
		
		//assign ajax results to global var info[], will be used in +- functions 
		window.info = [data.productFound['pr_name'],data.productFound['pr_price']];
		
		//display modal window with found via ajax product 
		
		//Get the modal //RE-USED CODE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        var modal = document.getElementById('myModal');
		modal.style.display = "block";
		
		$("#headerName").html(info[0]); // html the Header in modal window
		$("#productName").html(info[0]); // html the product name
		$("#productPrice").html(info[1] + " UAH");  // html the product price
		
		//check if this id product has been selected previously (exists in object), and if contains any pcs amount already
		if (productsObject.hasOwnProperty(info[0])) {
			alert ('was selected');
			$("#productPcs").html(productsObject[info[0]]['quantity']); // html prev selected quantity
			$("#productTotal").html(substringSum (productsObject[info[0]]['price'] * productsObject[info[0]]['quantity'])); // html prev selected quantity
			
		} else {
			alert ("first time");
			$("#productPcs").html(0);
			$("#productTotal").html(0);
		}
		//END RE-USED CODE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	