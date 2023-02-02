<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Application;

use Kitman\Application\Query\Recipe\RecipeQuery;
use yii\web\ErrorAction;

final class IndexController extends Controller
{
    public function actions(): array
    {
        return [
            'error' => ErrorAction::class
        ];
    }

    public function actionIndex(): string
    {
        $recipes = \Yii::$container->get(RecipeQuery::class)
            ->allRecipes();

        return $this->render('index', ['recipes' => $recipes]);
    }
}