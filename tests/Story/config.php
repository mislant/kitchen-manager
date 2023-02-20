<?php

use Kitman\Web\Config\Main;

return call_user_func(static function (): array {
    $main = Main::get(codecept_root_dir());

    // Mock assets directory
    \yii\helpers\FileHelper::createDirectory(codecept_output_dir('assets'));
    $main['components']['assetManager']['basePath'] = codecept_output_dir('assets');

    return $main;
});
