<?php
//This is a custom asset file to register some js files for ONE View only.
//1. Create in assets folder new file {IshopAssetOnly.php}, class of this file should have the same name { IshopAssetOnly}
//2. In View u want to register this css/js Asset Bundle put:
     //use app\assets\IshopAssetOnly; // using my custom asset to use modal.js/mycore.js Only in this View
     //IshopAssetOnly::register($this); // register my custom asset to use modal.js/mycore.js Only in this View (1st name-> is the name of Class)

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HistoryAssetOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'css/site.css',
		
		
    ];
    public $js = [
	    //'js/modalBox.js', //ishop
		'js/refreshCartIcon.js', //refreshCartIcon(), must be before 'js/myCore.js'
		'js/loadLocalStorage.js', //load lS
		
	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
