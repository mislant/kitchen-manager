<?php
/**
 * @var View $this
 * @var DetailedRecipe $recipe
 */

use Kitman\Application\Query\Recipe\Model\DetailedRecipe;
use Kitman\Web\Helper\Url;
use yii\bootstrap5\Html;
use yii\web\View;

?>

<?php foreach ($recipe->ingredients as $ingredient): ?>
    <li>
        <?= $ingredient->name ?>
        <span class="fw-normal"><?= $ingredient->amount ?></span>
        <?= $ingredient->measure ?>
        <?= Html::a(
            '<i class="bi bi-dash-circle"></i>',
            Url::deleteIngredient($recipe->uuid, $ingredient->name),
            ['class' => 'delete-ingredient-action']
        ) ?>
    </li>
<?php endforeach; ?>
