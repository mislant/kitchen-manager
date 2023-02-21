<?php

declare(strict_types=1);

namespace Kitman\Web\Application\Recipe;

use Kitman\Application\Command\AddRecipe\AddRecipeRequest;
use Kitman\Web\Application\Core\Model;

final class NewRecipeForm extends Model
{
    /** @var string */
    public $name;
    /** @var int */
    public $calories;
    /** @var string */
    public $description;

    public function rules(): array
    {
        return [
            [['name', 'calories', 'description'], 'required'],
            [['name', 'description'], 'string'],
            ['name', 'string', 'max' => 80],
            ['calories', 'number']
        ];
    }

    public function toRequest(): AddRecipeRequest
    {
        return new AddRecipeRequest(
            $this->name,
            (float)$this->calories,
            $this->description
        );
    }
}