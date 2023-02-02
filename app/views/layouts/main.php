<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */

use Kitman\Infrastructure\Web\Assets\AppAsset;
use Kitman\Infrastructure\Web\Helper\Url;
use Kitman\Infrastructure\Web\Widgets\Alert;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-light">
<?php $this->beginBody() ?>
<header class="py-3 mb-4 border-bottom bg-white">
    <div class="container-sm d-flex align-items-center flex-wrap">
        <a href="/" class="d-flex fs-4 ms-2 me-auto text-dark text-decoration-none">
            Kitman
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                   aria-expanded="false">
                    <?= "What to do?" ?>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <?= Html::a(
                            "Add Recipe",
                            Url::addRecipe(),
                            ['class' => 'dropdown-item']
                        ) ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>
<main class="bg-light">
    <div class="container-sm">
        <?= Alert::widget(['delay' => 5000, 'options' => ['class' => 'fade show']]) ?>

        <?= $content ?>
    </div>
</main>
<footer class="py-3 my-4 border-top fixed-bottom">
    <div class="container-sm d-flex flex-wrap justify-content-end align-items-center">
            <span>
                Powered by Yii
                <img width="30px"
                     src="https://www.yiiframework.com/image/design/logo/yii3_sign_black.svg">
            </span>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
