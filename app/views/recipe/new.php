<?php
/**
 * @var View $this
 * @var NewRecipeForm $form
 */

use Kitman\Infrastructure\Web\Application\Recipe\New\NewRecipeForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= "Add new recipe" ?>
                    </h5>
                    <?php $af = ActiveForm::begin() ?>

                    <div class="row">
                        <div class="col-8">
                            <?= $af->field($form, 'name')->textInput() ?>
                        </div>
                        <div class="col-4">
                            <?= $af->field($form, 'calories')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <?= $af->field($form, 'description')->textarea() ?>
                    </div>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

                    <?php $af::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
