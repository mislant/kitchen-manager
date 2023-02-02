<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Widgets;

use Kitman\Infrastructure\Web\Application\Core\Alert as CoreAlert;
use yii\bootstrap5\Widget;
use yii\web\View;

final class Alert extends Widget
{
    private array $types = [
        CoreAlert::SUCCESS => 'alert-success',
        CoreAlert::WARNING => 'alert-warning',
        CoreAlert::ERROR => 'alert-danger',
    ];

    public array $closeButton = [];
    public int $delay = 0;

    public function run(): void
    {
        $appendClass = $this->options['class'] ?? '';

        foreach ($this->types as $type => $class) {
            $flash = \Yii::$app->session->getFlash($type);

            foreach ((array)$flash as $i => $message) {
                $alertId = "{$this->getId()}-$type-$i";
                echo \yii\bootstrap5\Alert::widget([
                    'body' => $message,
                    'closeButton' => $this->closeButton,
                    'options' => array_merge($this->options, [
                        'id' => $alertId,
                        'class' => "$class $appendClass"
                    ])
                ]);
                $this->registerDelay($alertId);
            }

            \Yii::$app->session->removeFlash($type);
        }
    }

    private function registerDelay(string $alertId): void
    {
        if (empty($this->delay)) {
            return;
        }

        \Yii::$app->view->registerJs(
            <<<JS
            setTimeout(function () {
                var alert = document.getElementById("$alertId")
                var bpAlert = new bootstrap.Alert(alert)
                bpAlert.close()
            }, {$this->delay});
            JS,
            View::POS_LOAD
        );
    }
}