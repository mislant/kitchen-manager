<?php

declare(strict_types=1);

namespace Kitman\Web\Assets;

use yii\bootstrap5\BootstrapAsset;
use yii\bootstrap5\BootstrapIconAsset;
use yii\bootstrap5\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

final class AppAsset extends AssetBundle
{
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
        BootstrapIconAsset::class
    ];

    public $js = [
        "js/base.js"
    ];
}