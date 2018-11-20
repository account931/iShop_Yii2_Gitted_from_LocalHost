<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Products_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>





<p>
  <?= Html::a('Products Sql DB', ['/products/index', 'period' => "",], ['class' => 'btn btn-info']) ?>
  <?= Html::a('Buyers Sql DB', ['buyers/index', 'period' => "",], ['class' => 'btn btn-success']) ?>
  <?= Html::a('Orders Sql DB', ['/orders/index', 'period' => "",], ['class' => 'btn btn-danger']) ?>
</p> 










<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
	<?= Html::a( "Go Shopping now ", ['/products/shop', /*'period' => "",*/   ] /* $url = null*/, $options = ['title' => 'Shop',] ) ?>

    <br><br>
	<center>
	
	<img src="http://cloudhost.com.ng/blog/wp-content/uploads/2016/10/create-mysql-database.jpg"/>
	
	<!----Dropdown Bootstrap, part1---->
	<div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown CRUD
        <span class="caret"></span></button>
		<div class="dropdown-menu">
	<!----END Dropdown Bootstrap, part1---->
	
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pr_id',
            'pr_name',
            'pr_description',
            'pr_price',
            'pr_image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	
	<!----Dropdown Bootstrap, part2---->
	</div></div>
	<!----Dropdown Bootstrap, part2---->
	
	</center>
	
</div>
