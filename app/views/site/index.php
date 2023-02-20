<?php
/**
 * @var View $this
 * @var \Kitman\Application\Query\Recipe\Model\RecipePreview[] $recipes
 */

use Kitman\Web\Helper\Img;
use Kitman\Web\Helper\Url;
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
                        <h5 class="text-primary" style="width: 90%"><?= $recipe->name ?></h5>
                        <?= Html::a(
                            Html::tag('i', options: ['class' => 'bi bi-eye']),
                            Url::viewRecipe($recipe->uuid),
                            ['class' => 'text-decoration-none']
                        ) ?>
                    </div>
                    <p class="fs-6 fw-light">Calories: <?= $recipe->calories ?></p>
                    <p class="d-inline-block text-wrap" style=""><?= $recipe->description ?></p>
                </div>
                <div class="col-4 border-1 overflow-hidden">
                    <img src="<?= Img::placeholder() ?>"
                         class="p-1 w-100 h-100" alt="Dish Image"
                         style="object-fit: cover">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
