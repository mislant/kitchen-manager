<?php

declare(strict_types=1);

namespace Kitman\Web\Application\Recipe;

use Kitman\Application\Command\AddIngredient\AddIngredientCommand;
use Kitman\Application\Command\AddRecipe\AddRecipeCommand;
use Kitman\Application\Command\DeleteIngredient\DeleteIngredientCommand;
use Kitman\Application\Command\DeleteIngredient\DeleteIngredientRequest;
use Kitman\Application\Query\Recipe\RecipeQuery;
use Kitman\Domain\Exception\DomainException;
use Kitman\Web\Application\Controller;
use Kitman\Web\Helper\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

final class RecipeController extends Controller
{
    public function actionNew(): string|Response
    {
        $form = new NewRecipeForm();
        if ($form->validatePost($this->request)) {
            try {
                $add = \Yii::$container->get(AddRecipeCommand::class);
                $add($form->toRequest());
                $this->alert()->success("Recipe added!");
                return $this->redirect(Url::home());
            } catch (DomainException $e) {
                $this->alert()->error($e->getMessage());
            }
        }
        return $this->render("new", compact('form'));
    }

    public function actionView(string $uuid): string
    {
        $recipe = \Yii::$container
            ->get(RecipeQuery::class)
            ->detailedRecipe($uuid)
            ->getOrCall(static fn() => throw new NotFoundHttpException("Recipe not found"));


        return $this->render("view", compact('recipe'));
    }

    public function actionAddIngredient(string $uuid): Response
    {
        $form = new AddIngredientForm();
        if ($form->validatePost($this->request)) {
            try {
                \Yii::$container->get(AddIngredientCommand::class)(
                    $form->toRequest($uuid)
                );
                $result = true;
            } catch (DomainException $e) {
                $message = $e->getMessage();
                $result = false;
            }

            return $this->asJson([
                'done' => true,
                'result' => $result,
                'message' => $message ?? ""
            ]);
        }
        return $this->asJson([
            'done' => false,
            'html' => $this->renderAjax(
                "add-ingredient",
                compact('form')
            )
        ]);
    }

    public function actionUpdateIngredients(string $uuid): string
    {
        $recipe = \Yii::$container
            ->get(RecipeQuery::class)
            ->detailedRecipe($uuid)
            ->getOrCall(static fn() => throw new NotFoundHttpException("Recipe not found"));


        return $this->renderPartial("ingredients-list", compact('recipe'));
    }

    /** @throws ServerErrorHttpException */
    public function actionDeleteIngredient(string $uuid, string $name): Response
    {
        if (!$this->request->isPost) {
            throw new ServerErrorHttpException("Unexpected token");
        }

        try {
            $command = \Yii::$container->get(DeleteIngredientCommand::class);
            $command(
                new DeleteIngredientRequest(
                    $uuid,
                    $name
                )
            );
        } catch (DomainException $e) {
            $result = false;
            $message = $e->getMessage();
        }

        return $this->asJson([
            'result' => $result ?? true,
            'message' => $message ?? ''
        ]);
    }
}