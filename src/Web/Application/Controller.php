<?php

declare(strict_types=1);

namespace Kitman\Web\Application;

use Kitman\Web\Application\Core\Alert;

abstract class Controller extends \yii\web\Controller
{
    private Alert $alert;

    protected function alert(): Alert
    {
        if (!isset($this->alert)) {
            $this->alert = \Yii::$container
                ->get(Alert::class);
        }
        return $this->alert;
    }
}