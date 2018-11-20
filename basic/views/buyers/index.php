<?php
//It is for Buyres SQL DB only, does nothing more, so far

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buyers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buyers-index">

    <p>
        <?= Html::a('Products Sql DB', ['/products/index', 'period' => "",], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Buyers Sql DB', ['buyers/index', 'period' => "",], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Orders Sql DB', ['/orders/index', 'period' => "",], ['class' => 'btn btn-danger']) ?>
    </p> 

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Buyers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'b_id',
            'b_name',
            'b_mobile',
            'b_address',
            'b_order_unique_id',
            //'b_status',
            //'b_total_sum',
            //'b_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
