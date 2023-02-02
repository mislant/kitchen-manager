<?php
/**
 * @var View $this
 * @var Recipe[] $recipes
 */

use Kitman\Infrastructure\Web\Helper\Url;
use yii\bootstrap5\Html;
use yii\web\View;
use Kitman\Application\Query\Recipe\Recipe;

?>

<div class="container">
    <h1 class="fw-light mb-2"><?= "List of available recipes" ?></h1>
    <div class="row row-cols gy-3">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="rounded-1 border-5 border-start border-primary
                            d-flex bg-white shadow ps-3 h-100">
                    <div class="w-100 py-2 d-flex flex-column">
                        <h5 class="text-primary border-1 border-bottom">
                            <?= $recipe->name ?> <?= $recipe->calories ?>cal
                        </h5>
                        <span>
                            <?= $recipe->description ?>
                        </span>
                    </div>
                    <div class="border-1 border-start d-flex align-items-center justify-content-end px-3">
                        <?= Html::a(
                            '<i class="bi bi-pencil"></i>',
                            Url::editRecipe($recipe->uuid),
                            ['class' => 'text-decoration-none']
                        ) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
