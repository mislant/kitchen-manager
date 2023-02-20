<?php
/**
 * @var View $this
 * @var DetailedRecipe $recipe
 */

use Kitman\Application\Query\Recipe\Model\DetailedRecipe;
use yii\web\View;

?>
<?php foreach ($recipe->ingredients as $ingredient): ?>
    <li>
        <?= $ingredient->name ?>
        <span class="fw-normal"><?= $ingredient->amount ?></span>
        <?= $ingredient->measure ?>
    </li>
<?php endforeach; ?>
