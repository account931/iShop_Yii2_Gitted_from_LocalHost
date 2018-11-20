<?php
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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/modalBox.css', //ishop
		'css/myStyle.css', //ishop
		'css/sideNavFullScreenMenu.css', //ishop
		'css/yii2_mine.css', //yii2 mine
		
    ];
    public $js = [
	    //'js/modalBox.js', //ishop -> moved to asserts/ishopAssertOnly.php
		//'js/myCore.js', //ishop   -> moved to asserts/ishopAssertOnly.php
		'js/main_layout.js', //js for views/layout/main.php
	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
