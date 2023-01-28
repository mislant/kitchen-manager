<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web;

final class Controller extends \yii\web\Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionRouting(): string
    {
        return $this->render('routing');
    }
}