<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

//Added Loader spinner on ajax + send ajax with Orders object, Unique order number, User address, mobile, gets the Php Json data


//Register my custom css/js Asset Bundle for this View only(detailed instruction in -> assets/IshopAssetOnly.php)
use app\assets\HistoryAssetOnly; // using my custom asset to use modal.js/mycore.js Only in this View
HistoryAssetOnly::register($this); // register my custom asset to use modal.js/mycore.js Only in this View (1st name-> is the name of Class)



//Uses Spinner Loader on while ajax {1.<img src="images/load-spinner.gif" id="loading-indicator". 2.#loading-indicator css + thickbox-open  {-webkit-filter: blur(2px); 3.$(document).ajaxSend(function(event, request, settings) { $('body').addClass('thickbox-open'); $('#loading-indicator').show(400);}

/* @var $this yii\web\View */
/* @var $searchModel app\models\Products_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'user_orders_history';
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
	<h2>Orders history for a specific user, link to this page is visible for Logged users only</h2>
		
</div> <!-- <div class="checkout-index">-->

<!----AJAX LOADER SPINNER--->
<img src="images/load-spinner.gif" id="loading-indicator" style="display:none" /> <!--- Animation while ajax Load Spinner-->






