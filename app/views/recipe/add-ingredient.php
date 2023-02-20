<?php
/**
 * @var View $this
 * @var AddIngredientForm $form
 */

use Kitman\Web\Application\Recipe\AddIngredientForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

?>

<?php $af = ActiveForm::begin([
    'id' => 'add-ingredient-form'
]) ?>
<?= $af->field($form, 'name')->textInput() ?>
<?= $af->field($form, 'type')->dropDownList(
    array_combine(
        $form->types(),
        $form->typesLabels()
    )
) ?>
<?= $af->field($form, 'amount')->textInput() ?>
<?= Html::submitButton("Add", ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end() ?>
