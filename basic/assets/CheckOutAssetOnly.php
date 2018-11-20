<?php
// This script is used in view/products/checkout.php
//Responsible for final Ordering check-out,

//------ How to create custom asset bundle
//This is a custom asset file to register some js files for ONE View only.
//1. Create in assets folder new file {IshopAssetOnly.php}, class of this file should have the same name { IshopAssetOnly}
//2. In View u want to register this css/js Asset Bundle put:
     //use app\assets\IshopAssetOnly; // using my custom asset to use modal.js/mycore.js Only in this View
     //IshopAssetOnly::register($this); // register my custom asset to use modal.js/mycore.js Only in this View (1st name-> is the name of Class)



namespace app\assets;

use yii\web\AssetBundle;

/**
 * Additional application asset bundle.
 *
 
 */
class CheckOutAssetOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'css/site.css',
		
		
    ];
    public $js = [
	    'js/refreshCartIcon.js', //refreshCartIcon(), must be before 'js/myCore.js'
	    'js/checkOut.js', //check out JS
		
	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
