<?php

//  WILL not be used, just for checking rendering from ajax
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = "Ajax";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php echo "This -> " . $ress; echo "<br>";?>

    <?= Yii::$app->request->csrfParam; ?>
	
	<?php echo Yii::$app->request->baseUrl. '/products/getajaxorderdata' ?>
	
	
	<?php  echo $arrayDecoded;?>
	
</div>
