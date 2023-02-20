<?php

use Kitman\Web\Config\Main;
use Kitman\Web\Env\Env;
use yii\web\Application;

call_user_func(static function () {
    $root = dirname(__DIR__, 2);

    require $root . '/vendor/autoload.php';
    require $root . '/vendor/yiisoft/yii2/Yii.php';

    Env::init($root);
    (new Application(Main::get($root)))->run();
});