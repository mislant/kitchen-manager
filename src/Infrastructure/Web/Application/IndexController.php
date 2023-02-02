<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Application;

use Kitman\Application\Query\Recipe\RecipeQuery;

final class IndexController extends Controller
{
    public function actionIndex(): string
    {
        $recipes = \Yii::$container->get(RecipeQuery::class)
            ->allRecipes();

        return $this->render('index', ['recipes' => $recipes]);
    }

    public function actionRouting(): string
    {
        return $this->render('routing');
    }
}