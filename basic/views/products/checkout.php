<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

//Added Loader spinner on ajax + send ajax with Orders object, Unique order number, User address, mobile, gets the Php Json data

//Register my custom css/js Asset Bundle for this View only(detailed instruction in -> assets/CheckOutAssetOnly.php)
use app\assets\CheckOutAssetOnly; // using my custom asset to use modal.js/mycore.js Only in this View
CheckOutAssetOnly::register($this); // register my custom asset to use modal.js/mycore.js Only in this View (1st name-> is the name of Class)


//REGISTER this as it contains calculating the whole sum in header
//Register my custom css/js Asset Bundle for this View only(detailed instruction in -> assets/IshopAssetOnly.php)
//use app\assets\IshopAssetOnly; // using my custom asset to use modal.js/mycore.js Only in this View
//IshopAssetOnly::register($this); // register my custom asset to use modal.js/mycore.js Only in this View (1st name-> is the name of Class)


//Uses Spinner Loader on while ajax {1.<img src="images/load-spinner.gif" id="loading-indicator". 2.#loading-indicator css + thickbox-open  {-webkit-filter: blur(2px); 3.$(document).ajaxSend(function(event, request, settings) { $('body').addClass('thickbox-open'); $('#loading-indicator').show(400);}

/* @var $this yii\web\View */
/* @var $searchModel app\models\Products_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Check_Out';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.bordX {
    border: 1px solid #000000;
}
/* Ajax load image*/
#loading-indicator {
  position: absolute;
  left: 23%;
  top: 18%;
  width:40%;

}

/* Class to blur when Ajax is working */
.thickbox-open  {
  -webkit-filter: blur(2px);
  -moz-filter: blur(2px);
  -ms-filter: blur(2px);
  -o-filter: blur(2px);
  filter: blur(2px); 
}
</style>

	

	

	
	
	
	
	
		
<div class="checkout-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/check.png' , $options =["id"=>"","marginleft"=>"5%",  "class"=>"rotateX","width"=>"11%","alt"=>"click","title"=>"click to add a  new  one"] ); ?>


    
	
	<?= Html::a( "Shop itself", ['/products/shop', 'period' => "",   ] /* $url = null*/, $options = ['title' => 'Shop', "marginleft"=>"5%",] ) ?>
    <br><br>
	
	
	<h2><?= Html::encode("Your orders") ?></h2>
	<br><br>
	
	
	    <!---------------------User's order list from JS object, filled with web/js/checkout.js------------->
	    <div class="checkList">
		</div><!--END <div class="checkList">-->
		<br><br>
		<!---------------------User's order list from JS object, filled with web/js/checkout.js------------->
		
		
		
		
		
		
		
		<!---------------------USER DETAILS FORM------------->
		<div class="checkUserContactForm">
		    <h2><?= Html::encode('Customer Check-out information') ?></h2>
			
			
			
			
		    <?php
           
			
			//$searchModel - is a My model derived in controller from models/ProductUserInfoForm (No SQL DB connection) for User Information input in view/products/checkout.php
			 Pjax::begin(); 
			 
			 
			 
			 // Check if Guest or not and put the ID, name, mail to form
			 if (Yii::$app->user->isGuest){ 
			     $d = "Guest";
				 $mailX = "enter mail";
			} else {
				$d = Yii::$app->user->identity->username;
				$mailX = Yii::$app->user->identity->email;
			} 
			// END Check if Guest or not and put the ID, name, mail to form 
			 
			 
			 
			 
			 
			 // Form Start--------------------------------------------------------------------------------------
			$form =  ActiveForm::begin([
                        'action' => [''],
                        //'method' => 'get',
                        'options' => ['id' => 'myForm', 'enableAjaxValidation' => 'true',]
                        ]); ?>

            <?= $form->field($searchModel, 'username')->textInput(['maxlength' => true, 'value'=>$d, 'id'=>'name_id']) ?>
			<?= $form->field($searchModel, 'mobile')->textInput(['maxlength' => true, 'value'=>$mailX, 'id'=>'mobile_id']) ?>
			<?= $form->field($searchModel, 'address')->textarea(['rows' => 3, 'id'=>'address_id']) ?> 

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-success', 'id'=>'submit_id']) ?>
				
				
				<?php
				//Link to edit the cart, i.e to go to products/shop with $_GET["period"] =  "open-cart",
				//whick JS trigger openNav();(opens side slide modal with cart) + openCalcSidePagewithCart();  //calc all items in myCore.js -> openCalcSidePagewithCart()
				 echo "<br><br>";
				 echo Html::a('Edit your cart', ['/products/shop', 'period' => 'open-cart',], $options = ['title' => 'Edit Cart' ] );
				 echo Html::a(Html::img('images/edit.png'), ['/products/shop', 'period' => 'open-cart',], $options = ['title' => 'Edit Cart' ] ); //A href with img
				      
				?>
				
			<?php 
			   //NOT IN USE????
			    echo "<br><br>" . Html::a('Your Link name -> Not in USE','products/action', [
                            'title' => Yii::t('yii', 'Close'),
                            'onclick'=>"$('#close').dialog('open');//for jui dialog in my page
                            $.ajax({
                                type     :'POST',
                                cache    : false,
                                url  : 'products/action',
                                success  : function(response) {
                                    $('#close').html(response);
                                }
                            });return false;",
                        ]);
				?>
            </div>
            <?php ActiveForm::end(); 
			 // END Form ----------------------------------------------------------------------------------------
			 
			Pjax::end(); 
			
			
			
	        // Start if  Person is  LOGGED-------
            // **************************************************************************************
            // **************************************************************************************
            //                                                                                     **
            if (!Yii::$app->user->isGuest){
			
			    // End if  Person is   logged
                                                                                             
            } else {  // Start if  Person is  not  logged
			    echo "<br><br>";
                echo Html::encode("You are not logged. In order to see your order in future, please ");
                echo Html::a( "log in to view orders", ['/site/login', 'traceURL' => "logTime",   ] /* $url = null*/, $options = ['title' => 'Login',] ); 
            }
			
            // **                                                                                  **
            // **************************************************************************************
            // **************************************************************************************         
            // END if  Person is  not  logged
			?>
		</div><!--END <div class="checkUserContactForm">-->
		<!---------------------USER DETAILS FORM------------->
		
		
		
</div> <!-- <div class="checkout-index">-->

<!----AJAX LOADER SPINNER--->
<img src="images/load-spinner.gif" id="loading-indicator" style="display:none" /> <!--- Animation while ajax Load Spinner-->






    <?php 
    $URL = Yii::$app->request->baseUrl . "/index.php?r=products/getajaxorderdata";   //WORKING,  gets the url to send ajax, defining it in  $ajax causes routing to 404, Not found, as the url address does not render correctly
    //url: 'http://localhost/iShop_yii/yii-basic-app-2.0.15/basic/web/index.php?r=products/getajaxorderdata',  // the correct address sample for ajax

    $Controller = Yii::$app->controller->id; // to pass in ajax

	//My working JS Register
	//Checks in JS if the Validation runs fine 
	$this->registerJs( <<< EOT_JS_CODE
	// JS code here   //afterValidate
	
	// function to generate unique order number--------------------
	function generateUUID() { // Public Domain/MIT
        var d = new Date().getTime();
        if (typeof performance !== 'undefined' && typeof performance.now === 'function'){
            d += performance.now(); //use high-precision timer if available
        }
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
       });
      }
	  // END  function to generate unique order number
  //-----------------------------------------------------------------
  

 
   $("#myForm").on("beforeSubmit", function (event, messages) {
       // Now you can work with messages by accessing messages variable
       //var attributes = $(this).data().attributes; // to get the list of attributes that has been passed in attributes property
       //var settings = $(this).data().settings; // to get the settings
       //alert (attributes);
 
       var form = $(this);
	   if (form.find('.has-error').length ) {  //if validation failed
	   
	       alert("Validate failed"); 
		   return false;  //prevent submitting and reload
		   
	   } else { 
	   
	        alert("Validate OK");  //alert(<?php echo Yii::$app->request->baseUrl?> +"/products/getajaxorderdata" );
		    // runs ajax here
			//var userInput = $(this).serialize();  //user form input-FAILS
			//alert("form " + userInput);
			
			// Start AJAX
            $.ajax({
			    //url      : '<?php echo Yii::app()->createUrl("products/getajaxorderdata");?>',
		        url: '$URL',  //WORKING
				//url: form.attr('getajaxorderdata'),
                
                type: 'post',
				// dataType : "html",
				//dataType:'json', // use JSON
               
			    //passing the data to ajax
				data: {
                    controller : '$Controller ',
				    //_csrf : '<?= Yii::$app->request->csrfToken; ?>',
				    searchname : 'Dima',  //just fot test, may drop later
					userName : $('#name_id').val(), //passing the UserName info input
					userCell : $('#mobile_id').val(), //passing cell mobile
					userAddress : $('#address_id').val(), //passing address info input
					uniqueOrderNumber : generateUUID() , // unique Order number
					orderObject : JSON.stringify( productsObject ), // pass an Object with all order to php, it saves it DB and JSOn echo it for getting answer in JS below
					orderTotalSum : substringSum(totalSum), // pass total sum
                },
				
				// if send was successful
                success: function(res){
                    console.log(res);
				    //alert (res);
				    //alert (res.name); 
					//alert (res.result_status);
					
					//Format the anwer based on Order Object
					var formatted_allOrders = '<br>You have ordered:'; //will contain the whole orders answer
					var priceTotal = 0; // total price of all oreders
					
					var objMine = JSON.parse(res.allOrders); // covert data JSON  echoed by Php ctionGetajaxorderdata, part with orders to JS Object
					//alert(JSON.stringify(objMine, null, 4));
					
					for (var key in objMine) {
						 priceTotal = priceTotal + objMine[key]['price'] * objMine[key]['quantity'] ; // total price of all oreders
						 formatted_allOrders = formatted_allOrders + "<br>" + key + ": " + objMine[key]['price'] + " * " + objMine[key]['quantity'] + " items = " + substringSum (objMine[key]['price'] * objMine[key]['quantity']) + " UAH";
					 }
                     formatted_allOrders = formatted_allOrders /* + "<br>Total: " + priceTotal + " UAH"*/;	//adding total price of all oreders	 
					
				    textMine = res.result_status + "<br> Current Controller: " + res.controller + "<br>" +res.userformData + "<br>" +res.userCell + "<br>" +
  					    res.userAddr + "<br>Order ID: " + res.orderNumber + "<br>OrderList:<br> " + formatted_allOrders +
						"<br>Total = " + res.totalSum + "UAH<br>" + res.sql_status_buyers + "<br>" +res.sql_status_orders; // formate the answer to html in view
						
						
					//html with animation
					$('.checkout-index').stop().fadeOut("slow",function(){  $('.checkout-index').html(textMine) }).fadeIn(2000);
                },
                error: function(){
                     alert('Error from View!');
                }
            });
			// END runs AJAX here
		    return false; //prevent reloading/submitting the form
		  
	   } // end else
  });
  
  //Image to show while ajax load - Load Spinner--------
  $(document).ajaxSend(function(event, request, settings) {
	  $("html, body").animate({ scrollTop: 0 }, "slow"); // scroll the page up to bottom
      //$('body').addClass('thickbox-open'); // adds blur class to body while loading
	  //$('#loading-indicator').parents().removeClass("thickbox-open");
      $('#loading-indicator').show();
      
  });

  $(document).ajaxComplete(function(event, request, settings) {
      //$('body').removeClass('thickbox-open');  // removes blur class to body while loading
      setTimeout("$('#loading-indicator').hide(1200)", 5000);  // remove spinner loader with some delay
  });
  //END Image to show while ajax load Load Spinner-------
  
  // END JS code here		
  

EOT_JS_CODE
);
  ////any spaces before EOT_JS_CODE will cause the crash
	?>

