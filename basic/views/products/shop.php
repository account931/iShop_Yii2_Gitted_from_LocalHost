<?php
//Shop start page, displays all products from DB Products
use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Products; //my model for iShop products
use yii\helpers\Json; //used to pass php var to autocomplete.js

//Register my custom css/js Asset Bundle for this View only(detailed instruction in -> assets/IshopAssetOnly.php)
use app\assets\IshopAssetOnly; // using my custom asset to use modal.js/mycore.js Only in this View
IshopAssetOnly::register($this); // register my custom asset to use modal.js/mycore.js Only in this View (1st name-> is the name of Class)

/* @var $this yii\web\View */
/* @var $searchModel app\models\Products_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop with Animated Modals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title); 
	echo "<br>";
	echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/cog.png' , $options =["id"=>"","marginleft"=>"4%","class"=>"rotateX cog","width"=>"7%","alt"=>"click","title"=>"rotate cog"] );
    ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
	<?php
	//------------------------------------------------------------------------------------------------------------
	//passing PHP object $query(i.e all products array from Controller) to external Js-> autocomplete.js. Requires {use yii\helpers\Json;}
     /* @var $this yii\web\View */
    $this->registerJs(
           "var calenderEvents = ".Json::encode($query).";", 
           yii\web\View::POS_HEAD, 
           'calender-events-script'
     );
	 //End passing php obj to autocomplete.js-----------------------------------------------------------------------
    ?>	
	
	  <?php
	//Decide weather to open a modal with Cart(). It happens, when user click link "Cart",
    //which addresses the same page as shop, but with $_GET['period'] = open-cart
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **  
	 if(Yii::$app->getRequest()->getQueryParam('period') && strcmp(Yii::$app->getRequest()->getQueryParam('period'), 'open-cart') == 0 ) {
     ?>
		 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                openNav();  //opens side slide modal with cart
				openCalcSidePagewithCart();  //calc all items in myCore.js -> openCalcSidePagewithCart()
            });
        </script>
		 
	<?php
	 } 
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	?>
	
	
	
<!--  Start mine FULL Screen Menu Appear from Left (i.e CART) -->
<!-- Full price list is generated in myCore.js -> openCalcSidePagewithCart() -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
  <br><br><p id="fullCartList">V</p>
  <br><p> Total: <span id="totalSumCartFull"> 0 UAH</span></p>
  <br><br><br>
  <?= Html::a('Check-out the order', ['/products/checkout', 'period' => "",  ],  $options = ['title' => 'Shop', "width"=>"", 'class' => 'btn zzz']) ?> 
  <br><br>
</div>

<br><!--<br><br>-->
<!--<h2>Animated Sidenav Example Full Width</h2>-->
<!--<p>Click on the element below to open the navigation menu.</p>-->
<span style="font-size:30px;cursor:pointer" id="openSidePagewithCart" onclick="openNav()">&#9776; open Cart <img class="cart-img" style="width:3%;" src="images/product_icon.png"/></span>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<!--end mine Full Screen Menu-->






  








<!--Start Mine Small Modal, when u click on product from list, Box uses src="js/modalBox.js-->
<div>
<!--
<h2>Shop with Animated Modals</h2>
-->

<!-- Trigger/Open CART (was The Modal) -->
<!--
<button class="myCart" >Open Cart</button>
-->
<!--<button class="myBtn" >Open Cart</button>-->




<!-------------------------------------- The Modal, displays a single product, when u click it on the list ---------------------->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Product Header</h2>
    </div>
	
    <div class="modal-body">
	  <!--<div class="container ff"> -->  <!-- for bootstrap-->
	  
	  <div class="row row1"> <!--Bstrap inj-->
	  
        <div class="col-sm-5"> 
          <p>Product Name: &nbsp; <span id="productName" class="prName"></span> </p>
          <p>Some other text...</p> <br><br>
           <p><img src="images/cart.png" style="width:10%;"/></p>
          <!--<p>Some other text...</p>	-->	  
	    </div>
		
        <div class="col-sm-3">
	      <p>Price:<span id="productPrice"></span> </p>
	    </div>
		
		<div class="col-sm-2">
	      <p>Pcs: &nbsp; <span id="productPcs">0</span> <p>
		  <button type="button" class="btn btn-success" id="plus"> + </button>
		  <button class="btn btn-danger" id="minus"> - </button>
	    </div>
		
		<div class="col-sm-2">
	      <p>Total &nbsp; <span id="productTotal">0 </span> UAH <p>
	    </div>
		
	  </div> <!--class="row1">-->
	  
	  <div class="row row2">
	    <div class="col-sm-10"></div>
		<div class="col-sm-2">
		  <!--<button class="btn" id="cancelThis"> Cancel</button>-->
		  <button class="btn btn-info" id="addToCart"> Add to cart </button>
		</div>
	  </div> <!--class="row2">-->
	  
	 <!--</div>--> <!--<div class="container ff" --for bootstrap--> 
    </div>
    <div class="modal-footer">
      <h3>Product Footer</h3>
    </div>
  </div>

</div>
</div>
<script>

</script>
<!-------------------------------------- END The Modal, displays a single product, when u click it on the list ---------------------->






<!------------------------------Confirm order modal box------------------------------->
<!-- The Modal -->
<div id="myModalConfirm" class="modalConf">

  <!-- Modal content -->
  <div class="modal-contentZ">
    <span class="closeConfirm">&times;</span>
	<center>
	<img id="addedImage" src="images/cart.png"/>
	</center>
    <br><br><p>Order has been added</p><br>
  </div>

</div>
<!--------------------------------Confirm order modal box------------------------------->








    <!--------------------------------Content by Yii2---------------------------------->
	<?php
	    echo "<br>";
	    //echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/cog.png' , $options =["id"=>"","marginleft"=>"4%","class"=>"rotateX","width"=>"7%","alt"=>"click","title"=>"rotate cog"] );
	    //echo Html::encode(" Start Shopping");
		echo "<br><br>";
	?>
	<div class="list-group" id="productDisplayArea">
	
	<?php
	    // Logic is in models/products.php
		//Display all products from SQL
		Products::displayProducts();
	?>
     </div>
    <!--------------------------------END Content by Yii2------------------------------->


	
	
	

<!--<div class="container">-->

  <br>
  
  <div class="list-group"> <!-- should be replaced by SQL-->
    <!--
    <a href="#" class="list-group-item list-group-item-success  myBtn" id="Dnb-12.55">   <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/> First item : <b>Drum'n'bass LP </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
	<a href="#" class="list-group-item list-group-item-info     myBtn" id="Dub-7.2">     <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/> Second item :<b>Dub LP         </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
	<a href="#" class="list-group-item list-group-item-info  myBtn" id="Techno-1.4">  <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/>Third item :  <b>Techno LP      </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
	<a href="#" class="list-group-item list-group-item-danger   myBtn" id="Neuro-17.33"> <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/>Fourth item : <b>Neurofunk LP   </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
    
	<a href="#" class="list-group-item list-group-item-success  myBtn" id="Obolon-9.35">        <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/>  <b> Obolon 0.5L       </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
	<a href="#" class="list-group-item list-group-item-info  myBtn"    id="StellaArtois-17.05"> <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/>  <b>Stella Artois 0.33L</b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
    <a href="#" class="list-group-item list-group-item-warning  myBtn" id="Staropramen-21.85">  <div class="row"><div class="col-sm-5"> <img class="prod-img" src="images/product_icon.png" alt=""/>  <b>Staropramen 1L     </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
    <a href="#" class="list-group-item list-group-item-danger  myBtn"  id="Heineken-11.4">      <div class="row"><div class="col-sm-5">  <img class="prod-img" src="images/product_icon.png" alt=""/> <b>Heineken 0.5L      </b> <br><img class="packaging" src="images/packaging.png"/>   </div><div class="col-sm-5 textX">Product text description <br>Price details</div></div></a>
   -->
	
	<!---OLD-->
	<br><br>
	<!--
	<a href="#" class="list-group-item list-group-item-success  myBtn" id="Dnb-12.55"><img class="prod-img" src="images/product_icon.png" alt=""/> First item : Drum'n'bass LP <a>
	<a href="#" class="list-group-item list-group-item-info     myBtn" id="Dub-7.2"> <img class="prod-img" src="images/product_icon.png" alt=""/> Second item : Dub LP  </a>
	<a href="#" class="list-group-item list-group-item-warning  myBtn" id="Techno-1.4"> <img class="prod-img" src="images/product_icon.png" alt=""/>Third item : Techno LP </a>
	<a href="#" class="list-group-item list-group-item-danger   myBtn" id="Neuro-17.33"> <img class="prod-img" src="images/product_icon.png" alt=""/>Fourth item : Neurofunk LP  </a>
    
	<a href="#" class="list-group-item list-group-item-success  myBtn" id="Obolon-9.35"><img class="prod-img" src="images/product_icon.png" alt=""/>  Obolon 0.5L  </a>
	<a href="#" class="list-group-item list-group-item-info  myBtn"    id="StellaArtois-17.05"> <img class="prod-img" src="images/product_icon.png" alt=""/> Stella Artois 0.33L  </a>
    <a href="#" class="list-group-item list-group-item-warning  myBtn" id="Staropramen-21.85"> <img class="prod-img" src="images/product_icon.png" alt=""/> Staropramen 1L  </a>
    <a href="#" class="list-group-item list-group-item-danger  myBtn"  id="Heineken-11.4"> <img class="prod-img" src="images/product_icon.png" alt=""/> Heineken 0.5L  </a>
    -->
	<!---OLD-->
	
  </div>
  
  
  <!--<h3>Navbar Forms</h3>
  <p>Use the .navbar-form class to vertically align form elements (same padding as links) inside the navbar.</p>
  <p>The .input-group class is a container to enhance an input by adding an icon, text or a button in front or behind it as a "help text".</p>
  -->
	
	
	
	
	
	
	
	
	
	
</div>




