<?php
//It is for Orders SQL DB only, does nothing more, so far
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="orders-index">

    <p>
       <?= Html::a('Products Sql DB', ['/products/index', 'period' => "",], ['class' => 'btn btn-info']) ?>
       <?= Html::a('Buyers Sql DB', ['buyers/index', 'period' => "",], ['class' => 'btn btn-success']) ?>
       <?= Html::a('Orders Sql DB', ['/orders/index', 'period' => "",], ['class' => 'btn btn-danger']) ?>
    </p> 
	
	
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'order_unique_ID',
            'order_user_name',
            'order_date',
            'order_product',
            //'order_pcs',
            //'order_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
