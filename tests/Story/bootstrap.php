<?php

use Kitman\Infrastructure\Web\Env\Env;
use Phinx\Console\PhinxApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

call_user_func(static function () {
    // Load Yii2's class locator
    require codecept_root_dir("vendor/yiisoft/yii2/Yii.php");
    // Environments
    Env::init(codecept_root_dir());
    // Set sqlite as test database
    Env::set('CURRENT_DB', 'sqlite');
    Env::set('SQLITE_FILE', 'tests/_output/db.sqlite3');
    // Clear previous db
    unlink(codecept_output_dir('db.sqlite3'));
    // Migrate database
    $phinx = new PhinxApplication();

    $args = [
        '-c' => codecept_root_dir('phinx.php')
    ];
    $input = new ArrayInput($args);

    $result = $phinx->find('migrate')
        ->run($input, new NullOutput());
    if ($result !== 0) {
        die("Unable to migrate test database");
    }
    // Set recreating entity map
    Env::set("SCHEMA_CACHE_ENABLE", '0');
});
