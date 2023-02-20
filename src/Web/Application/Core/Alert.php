<?php

declare(strict_types=1);

namespace Kitman\Web\Application\Core;

use yii\web\Session;

final class Alert
{
    public const SUCCESS = 'alert-success';
    public const ERROR = 'alert-error';
    public const WARNING = 'alert-warning';

    public function __construct(
        private readonly Session $session
    ) {
    }

    public function success(string $message): void
    {
        $this->session->addFlash(self::SUCCESS, $message);
    }

    public function error(string $message): void
    {
        $this->session->addFlash(self::ERROR, $message);
    }

    public function warning(string $message): void
    {
        $this->session->addFlash(self::WARNING, $message);
    }
}