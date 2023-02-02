<?php
/**
 * @var View $this
 * @var RecipeView[] $recipes
 */

use Kitman\Application\Query\Recipe\RecipeView;
use Kitman\Infrastructure\Web\Helper\Url;
use yii\bootstrap5\Html;
use yii\web\View;

?>

<div class="container">
    <h1 class="fw-light mb-2"><?= "List of available recipes" ?></h1>
    <div class="d-flex flex-wrap justify-content-start">
        <?php foreach ($recipes as $index => $recipe): ?>
            <div class="my-2 me-3 row g-0 rounded-1 border-5 border-start border-primary bg-white shadow ps-3"
                 style="width: 390px; max-height: 300px">
                <div class="col-8 d-flex flex-column">
                    <div class="d-flex pt-2 mb-2 border-1 border-bottom">
                        <h5 class="text-primary" style="width: 90%"><?= $recipe->title ?></h5>
                        <div class="dropdown dropstart">
                            <a class="fs-5" type="button" id="recipeDropDown<?= $index ?>"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-sliders"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="recipeDropDown<?= $index ?>">
                                <li><?= Html::a('Edit', Url::editRecipe($recipe->uuid), ['class' => 'dropdown-item']
                                    ) ?></li>
                            </ul>
                        </div>
                    </div>
                    <p class="fs-6 fw-light">Calories: <?= $recipe->calories ?></p>
                    <p class="d-inline-block text-wrap" style=""><?= $recipe->description ?></p>
                </div>
                <div class="col-4 border-1 overflow-hidden">
                    <img src="https://via.placeholder.com/300x200"
                         class="p-1 w-100 h-100" alt="Dish Image"
                         style="object-fit: cover">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
