<?php

use Kitman\Infrastructure\Web\Env\Env;

// Load Yii2's class locator
require codecept_root_dir("vendor/yiisoft/yii2/Yii.php");
// Environments
Env::init(codecept_root_dir());