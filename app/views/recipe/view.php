<?php
/**
 * @var View $this
 * @var DetailedRecipe $recipe
 */

use Kitman\Application\Query\Recipe\Model\DetailedRecipe;
use Kitman\Web\Helper\Img;
use Kitman\Web\Helper\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\web\View;

?>

<h1 class="text-center">
    <?= $recipe->name ?>
</h1>
<div class="shadow my-3 row bg-white overflow-hidden" style="height: 200px">
    <img style="width:100%; height: 100%; object-fit: cover;"
         src="<?= Img::placeholder() ?>">
</div>
<h3 class="fw-light">
    <?= "About" ?>
</h3>
<p class="fs-5 fw-light text-left">
    <?= $recipe->description ?>
</p>
<hr>
<h3 class="fw-light">
    <?= "Ingredients" ?>
</h3>
<ul id="ingredients-list" class="fs-5 fw-light">
    <?= $this->render('ingredients-list', compact('recipe')) ?>
</ul>
<?= Html::a(
    'Add ingredient<i class="bi bi-plus"></i>',
    Url::addIngredient($recipe->uuid),
    [
        'id' => 'add-ingredient',
        'class' => 'btn btn-outline-primary mt-4'
    ],
) ?>

<?php Modal::begin([
    'id' => 'add-ingredient-modal',
    'title' => 'Add ingredient',
    'centerVertical' => true
]) ?>
<div id="add-ingredient-modal-content">

</div>
<?php Modal::end() ?>

<?php
$js = <<< JS

const bsModal = document.getElementById('add-ingredient-modal');

function updateIngredients(delay) {
    async function fetch() {
        let link = window.location.href + "/update-ingredients";
        return new Promise((resolve, reject) => {
            $.ajax({
                url: link, type: "GET", success: (html) => {
                    resolve(html)
                }, error: () => {
                    reject()
                }
            })
        })
    }

    let res = fetch();

    const ingredients = $("#ingredients-list");

    async function ingredientsFadeOut() {
        return new Promise(resolve => {
            ingredients.fadeOut(delay, resolve)
        })
    }

    async function ingredientFadeIn() {
        return new Promise(resolve => {
            ingredients.fadeIn(delay, resolve)
        })
    }

    ingredientsFadeOut().then(() => {
        ingredients.html(spinner())
        return ingredientFadeIn()
    }).then(() => {
        return res
    }).then((html) => {
        ingredientsFadeOut().then(() => {
            ingredients.html(html)
            return ingredientFadeIn()
        })
    });
}

$('#add-ingredient').on('click', function (event) {
    event.preventDefault()

    async function fetch(link) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: link, type: "GET", success: (form) => {
                    resolve(form.html)
                }, error: () => {
                    reject()
                }
            })
        })
    }

    function show(html) {
        $("#add-ingredient-modal-content").html(html);
        let modal = bootstrap.Modal.getInstance(bsModal);
        modal.show()
    }

    fetch($(this).attr('href')).then(show)
});

$(document).on('beforeSubmit', '#add-ingredient-form', function (event) {
    event.preventDefault();

    async function send(link, data) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: link, type: 'POST', data: data, success: (response) => {
                    resolve(response);
                }, error: () => {
                    reject()
                }
            })
        })
    }

    let res = send($(this).attr("action"), $(this).serialize());

    const content = $("#add-ingredient-modal-content");
    const delay = 1000;

    async function contentFadeOut() {
        return new Promise((resolve) => {
            content.fadeOut(delay, resolve)
        });
    }

    async function contentFadeIn() {
        return new Promise(resolve => {
            content.fadeIn(delay, resolve)
        });
    }

    function endAdding(result, message = "") {
        let modal = bootstrap.Modal.getInstance(bsModal);
        modal.hide();
        result ? updateIngredients(delay): showAlert('add-ingredient-error', 'alert-danger', message);
    }

    function showForm(form) {
        contentFadeOut().then(() => {
            content.html(form)
            return contentFadeIn()
        })
    }

    contentFadeOut().then(() => {
        content.html(spinner());
        return contentFadeIn();
    }).then(() => {
        return res;
    }).then((response) => {
        response.done ? endAdding(response.result, response.message) : showForm(response.html)
    })

    return false;
});

$(document).on('click', '.delete-ingredient-action', function (event) {
    event.preventDefault();

    async function fetch(link) {
        return new Promise((resolve) => {
            $.ajax({
                url: link, type: 'POST', success: (response) => {
                    resolve(response)
                }, error: (error) => {
                    console.log("Server error")
                }
            })
        });
    }

    fetch($(this).attr('href')).then((response) => {
        response.result
            ? updateIngredients(1000)
            : showAlert(
                'delete-ingredient-error',
                'alert-danger',
                response.message
            )
    })
    
    return false;
});


JS;
$this->registerJs($js);
?>
