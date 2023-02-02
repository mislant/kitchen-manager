<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Application\Recipe;

use Kitman\Application\Command\AddRecipe\AddRecipeCommand;
use Kitman\Infrastructure\Web\Application\Controller;
use Kitman\Infrastructure\Web\Application\Recipe\New\NewRecipeForm;
use Kitman\Domain\Exception\DomainException;
use Kitman\Infrastructure\Web\Helper\Url;
use yii\web\Response;

final class RecipeController extends Controller
{
    public function actionNew(): string|Response
    {
        $form = new NewRecipeForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $add = \Yii::$container->get(AddRecipeCommand::class);
                $add($form->toRequest());
                $this->alert()->success("Recipe added!");
                return $this->redirect(Url::home());
            } catch (DomainException $e) {
                $this->alert()->error($e->getMessage());
            }
        }
        return $this->render("new", ['form' => $form]);
    }
}