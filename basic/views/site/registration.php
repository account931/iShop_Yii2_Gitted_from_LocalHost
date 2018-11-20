<?php
//use yii\helpers\Html;
//donor
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
//END  DONOR
echo "REG IT";
 echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/sun.jpg' , $options = ["class"=>"sunimg","width"=>"7%","margin-left"=>"3%"] ); 
?>






<?php
$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>





<!---  FLASH------>
<div style="font-size:18px;color:orange;border:0px solid  red;padding:17px 17px 17px 17px;display: inline-block">
 <?= Yii::$app->session->getFlash('regged'); ?>
</div>
<!---  END FLASH------>





<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    







<!-- Troubles-->

<p>Please fill out the following fields to make  your  registration</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>   
                <?= $form->field($model, 'password')->passwordInput() ?>  <!--  TROUBLE IN HERE, WAS  = $form->field($model, 'password')->passwordInput(), in Controller  was  used User  model instead of SingupForm(model) -->
                 <?= $form->field($model, 'password_confirm')->passwordInput() ?> 


         <!-------Start  Captcha  --->
               <!--   <?= $form->field($model, 'captcha')->widget(Captcha::className()) ?>-->

         <?=$form->field($model, 'captcha')->widget(Captcha::classname(), [
         'template' => '{image}{input}',
         ]); //this code showing captcha input to end users.
         ?>
        <!------------End  captcha  -->


                <div class="form-group"> 
                    <?= Html::submitButton('register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>





            <?php ActiveForm::end(); ?>
        </div>

    </div>
<!--  END  TROUBLES -->



<?php
 echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/frame.png' , $options = ["class"=>"","width"=>"","margin-left"=>""] ); 
?>
 




</div>
