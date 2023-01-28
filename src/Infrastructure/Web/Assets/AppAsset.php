<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Assets;

use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

final class AppAsset extends AssetBundle
{
    public $css = [
        'css/site.css'
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class
    ];
}