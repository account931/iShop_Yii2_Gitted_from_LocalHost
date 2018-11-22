<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use yii\bootstrap\Dropdown;// class for dropdown

AppAsset::register($this); // register main Asset
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	
	
	
	<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--> <!-- Product Input autocomplete JS UI, autocomplete won't work without it -->
	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--> <!-- Product Input autocomplete CSS UI, autocomplete won't work without it -->
     
	 
	<!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
	
	<style> <!-- Start Responsive-->
  .topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:not(.menuForm):hover  {
  background-color: white;
  color: black;
}

/* Class always highlighted 1st menu item */
.activeZ {
  background-color: #4CAF50;
  color: white;
}

/* Class for highlighted current menu */
.activeMenuItem {
  background-color: ;
  color: white;
  border: 1px solid white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {  /* was 600 */
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {  /* was 600 */
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

.current-page {background-color:green;}

  </style><!-- End Responsive-->
  

</head>
<body>
<?php $this->beginBody() ?>  <!-- Left from original-->



    <!-- added original Yii2 wrap div to suppres the footer to bottom, this div is closed before footer----->
    <div class="wrap"> <!-- Left from original-->
	
	
	
	
	
	<!----------Start Injected Menu---------------->
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
		
		
		
		
  
        <!--------------------- Responsive Header menu, we need each <a> with class="check", to hightlight active menu in js/main_layou.js----------------------->
	    <div class="topnav" id="myTopnav">
			<?= Html::a( "Home", ['/site/index', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'activeZ', 'id'=>'home', 'title' => 'Go home',] ) ?>
            <!--<a href="#home" class="active" id="home">Home</a>-->
			<?= Html::a( "PControl", ['/products/index', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'id'=>'pcControl', 'title' => 'Access to all DB',   ] ) ?>
			<? //Html::a( "About", ['/site/about', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'About us',] ) ?>
			<? //Html::a( "Contact", ['/site/contact', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Contact us',] ) ?>
		    <?= Html::a( "Shop", ['/products/shop'] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Shop',] ) ?>
			<?= Html::a( "Cart", ['/products/shop', 'period' => "open-cart",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Shop with openrd cart',] ) ?>
			<?= Html::a( "CheckOut", ['/products/checkout', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Shop',] ) ?>
            <?= Html::a( "Placed", ['/products/placed', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Non proccessed all Server Orders',] ) ?>
			
			<?php 
			//Makes this link visible for Logged users only - users purchases history
			if (!Yii::$app->user->isGuest) {
			    echo Html::a( "History", ['/products/userordershistory', 'period' => "",  ] /* $url = null*/,  $options = ['class'=>'check', 'title' => 'Server Specific User"s Orders History', ] );
			}
			?>
		
			
			<?= Html::a( "Local", ['/products/history', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Local storage Orders History',] ) ?>
			<?//= Html::a( "Buy.DB", ['/buyers/index', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Buyers DB',] ) ?>
			<?= Html::a( "Ord.DB", ['/orders/index', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Orders DB',] ) ?>
			
			
			
			
			<!-----DropDown Yii2 Widget, SO FAR DEACTIVATED------>
           <!--<div class="dropdown">
               <a href="#" data-toggle="dropdown" class="dropdown-toggle">Label <b class="caret"></b></a>
              <?php
			  
              echo Dropdown::widget([
                       'items' => [
                      ['label' => 'Buyres CRUD', 'url' => '/buyers/index'], //does not route correctly
                      Html::a( "Orders DB CRUD", ['/orders/index', 'period' => "", ] , $options = ['title' => 'Orders DB', 'style'=>'color:black'] ),
                      ],
                   ]);
			
                ?>
            </div>-->
			<!-----END DropDown Yii2 Widget------>
			 
			
			
			
			
			<?php 
			//Log in/ Log Out
			if (Yii::$app->user->isGuest) {
		        echo Html::a( "Login", ['/site/login', 'period' => "",   ] /* $url = null*/, $options = ['class'=>'check', 'title' => 'Login',] );
            } else {  //display Log out
                //echo Html::a( 'Logout (' . Yii::$app->user->identity->username . ')' , ['/site/logout', 'post', 'period' => "",   ] /* $url = null*/, $options = ['title' => 'Login',] );
                echo '<a>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-link logout logout-mine', ]   //['class' => 'btn btn-link logout']
                                        )
                    . Html::endForm()
                    . '</a>';
			}
			?>

	  
	        <!--- Search input --->
			<!-- In mobile version we change menu order, we put "Search" field on the top in order it not to be hidden by pop-up keyboard -->
	        <a href="#" class="menuForm" id="searchX">
	            <input type="text" class="" placeholder="Search" name="search" id="searchProduct">
                <button class="" type="submit" id="<?php echo Yii::$app->request->baseUrl. "/index.php?r=products/get_single_ajax_product";?> ">    
                    <i class="glyphicon glyphicon-search"></i>
                </button>
	        </a>
			<!--- END Search input --->
	  
	    <!--Mine BASKET -->
	    <a href="#aboutZ" style="float: right;>
	        <span class="">Cart: </span>
            <span id="cartPrice"> &nbsp;0 UAH</span> 
         </a>
	    <!-- End mine Basket-->
	
	    <!-- Must be the last element in menu, that is the invisible in desktop icon-->
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a> 
        </div>

        <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                 x.className = "topnav";
            }
        }
        </script>
	    <!--End Responsive header menu-->
	
	
        </div>
    </nav>
 
    <!----------END Injected Menu---------------->
	
	
	
	
	


  
	 
	<!-- Left from original-->
    <div class="container"> 
	
	<?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        
        <?= $content ?>
    
    </div>
    <!-- END Left from original-->


    
	</div><!--<div class="wrap">--> <!-- Left from original-->
	
	
	
	<!-- Left from original-->
	<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Dima F / <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
    </footer>
	<!-- END Left from original-->
	
	
	<!---------PAGE LOADER START, visible while the page is loading, uses js/main_layout.js, css is in yii2_mine.css--------------->
	<div id="overlay">
     	<?= Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/load-spinner.gif' , $options =["id"=>"","marginleft"=>"",  "class"=>"rotateX","width"=>"", "alt"=>"click", "title"=>"Loader"] ); ?>
     </div>
    <!---------END PAGE LOADER --------------->
	

	

<?php $this->endBody() ?> <!-- Left from original-->
</body>
</html>
<?php $this->endPage() ?>
