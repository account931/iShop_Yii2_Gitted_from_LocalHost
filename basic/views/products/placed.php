<?php

// Display all placed Orders with status 0, intended for Admin Only
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = "Submitted Orders";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>
	<h3><?= Html::encode("Display all submitted placed Orders with status 0, intended for Admin Only") ?></h3>
	
	
	
	<!-- Bootsrap dropdown----->
	<div class="dropdown">
       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">var_dump(Inner Join) 
       <span class="caret"></span></button>
       <div class="dropdown-menu">
  
	       <?php
	       var_dump($query);
	       ?>
	</div></div><br>
	<!-- END Bootsrap dropdown----->
	
	
	
	<?php
	//echo "<br>->" . $query[0]['b_mobile'] . "<br>";
	
	/* Works but can be sorted
	array_walk_recursive($query, function ($item, $key) {
        echo "<br>$key = $item\n";
    });
    */
      
	  
	 //CORE, all buyers result + Inner Join
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	  
	  //just for test, comment it 
	  /*
	  foreach($countBuyOrders_quantity as $key )
	  {	  
		  echo "<br> count: " . $key;
	  }
	  */
	  // END just for test, comment it 
	  
	  
	  
	  
	  // Core here
	  for ($i = 0; $i < count($buyersResults); $i++ ) // length = count($buyersResults), i.e quantity of orders in Buyers(passed from Controller->actionPlaced())
	  { 
          $orderNumber = $i + 1; //Order number 
	      echo "<div class='placed row'><h3> Order $orderNumber </h3>" ;
		  
		  //Loop for user info from Buyers, fetched in $buyersResults (from Controller->actionPlaced())
		  echo "Customer: " .     $buyersResults[$i]['b_name'];  //gets the name from Buyres AR query
		  echo "<br>Order ID: " . $buyersResults[$i]['b_order_unique_id']; 
		  echo "<br>Address: " .  $buyersResults[$i]['b_address'];
		  echo "<br>Mobile: " .   $buyersResults[$i]['b_mobile'];
          echo "<br>Date: " .     $buyersResults[$i]['b_time']; 
          echo "<br>Total: " .    $buyersResults[$i]['b_total_sum'] . " UAH";
          echo "<br>Ordered : " . $countBuyOrders_quantity[$i] . " items";	// quantity of products in order	  
		  echo "<hr>";
		  
         
		  
		  $start = 0; 
		  $end = $countBuyOrders_quantity[$i]; // $end = value from relevant array element in $countBuyOrders_quantity['$i']), array {$countBuyOrders_quantity[]} contains a quantity of products for every Order, ie [2, 4, 6]
		  
           // start loop for products, fetched in INNER JOIN $query (from Controller->actionPlaced()) ---		  
 		   for ($j = $start; $j < $end; $j++ )
		   { 
		       echo "<div class='row'>";
			      echo "<div class='col-sm-1 col-xs-3'>"; //name product
			          echo "<span class='underline'>" . $query[$j]['order_product'];	// product name from Inner Join based on Orders/Buyers SQL, (passed from Controller->actionPlaced())
                  echo "</div>";
				  echo "<div class='col-sm-2 col-xs-5'>"; // pcs * items
			          echo  $query[$j]['order_pcs'] . " items";
                      echo " * " . $query[$j]['order_price'] . " UAH  ";
				  echo "</div>";
				  echo "<div class='col-sm-2 col-xs-4'>";
					  echo $query[$j]['order_pcs'] * $query[$j]['order_price'] . " UAH</span>" ;	
			      echo "</div>";	  
               echo "</div>";	//end <div class='row'>";   
		   }
		    // End  loop for products------ 
			
		   $start = $start + $countBuyOrders_quantity[$j]; // change $start of iteration, array {$countBuyOrders_quantity[]} contains a quantity of products for every Order, ie [2, 4, 6]
		   $iter = $j + 1; // takes the next iteration value
		   $end2 =  $countBuyOrders_quantity[$iter] ;
		   $end = $end + $end2;
		  
		   echo "<hr>";
		   echo "<select><option value='0'>Not proccessed</option><option value='1'>Proccessed</option></select><button>OK</button>";// display status
           echo "<hr>";
		   echo "</div><br>";
	  }
	  // END Core here
	  
	// **                                                                                  **
    // ***************/***********************************************************************
    // **************************************************************************************  
	  
	  
	  
	  
	  
	  
	// Inner Join , CAN BE COMMENTED, NOT USED-----------------------------------------------
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	$counter = 0;
	//echo "<br><hr>Customer: " . $query[$counter]['b_name'] . "<br>Order ID: " . $query[$counter]['b_order_unique_id'] . "<br>" ;
	
	foreach($query as $key => $value){
		
			++$counter;
		    //echo "<script>alert($counter);</script>";
			
		    echo "<br><hr>Customer: " . $query[$counter]['b_name'] . "<br>Order ID: " . $query[$counter]['b_order_unique_id'] . "<br>" ;
		
		
		
        if(is_array($value)){
			
			
            foreach( array_slice($value, 5)  as $key => $value){  //array_slice($value, 3)   - skipp first 4 iteration
			
                echo $key." :".$value."<br>";
				
            }
        }
        echo "<br>";
    }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	// End Inner Join----------------------------------------------------
	
	?>
	
</div>
