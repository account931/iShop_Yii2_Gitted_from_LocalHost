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
		
		var resultX = "<p>";
		resultX = resultX + data.result_status;
		resultX = resultX + "<br> " + data.search_value + "</p>";
		$("#productDisplayArea").stop().fadeOut("slow",function(){ $(this).html(resultX)}).fadeIn(2000);
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	