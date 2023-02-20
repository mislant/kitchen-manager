<?php

declare(strict_types=1);

namespace Kitman\Web\Application\Core;

use yii\web\Request;

abstract class Model extends \yii\base\Model
{
    public function validatePost(Request $request): bool
    {
        return $this->load($request->post()) &&
            $this->validate();
    }
}