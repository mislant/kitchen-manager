<?php

declare(strict_types=1);

namespace Kitman\Web\Widgets;

use Kitman\Web\Application\Core\Alert as CoreAlert;
use yii\bootstrap5\Widget;
use yii\web\View;

final class Alert extends Widget
{
    private array $types = [
        CoreAlert::SUCCESS => 'alert-success',
        CoreAlert::WARNING => 'alert-warning',
        CoreAlert::ERROR => 'alert-danger',
    ];

    public string $alertContainer = '';
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

        $this->registerAlertFunctions();
    }

    private function registerDelay(string $alertId): void
    {
        if (empty($this->delay)) {
            return;
        }

        $this->view->registerJs(
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

    private function registerAlertFunctions(): void
    {
        if (empty($this->alertContainer)) {
            return;
        }

        $this->view->registerJs(
            <<<JS
            const alert = (id, type, message) => {
                let html = '<div id="' + id + '" class="' + type + ' fade show alert alert-dismissible" role="alert">'
                    + message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
            
                const template = document.createElement('template');
                template.innerHTML = html.trim();
                return template.content.firstChild;
            }
            
            function showAlert(id, type, message) {
                const alertTypes = ['alert-success', 'alert-warning', 'alert-danger'];
            
                if (!alertTypes.includes(type)) {
                    return;
                }
            
                let container = $('{$this->alertContainer}');
                let delay = {$this->delay};
                let div = alert(id, type, message)
            
                container.prepend(div)
                if (delay > 0) {
                    setTimeout(() => {
                        let bsAlert = new bootstrap.Alert(div);
                        bsAlert.close()
                    }, delay)
                }
            }
            JS
        );
    }
}