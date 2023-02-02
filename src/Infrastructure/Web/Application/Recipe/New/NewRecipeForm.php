<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Application\Recipe\New;

use Kitman\Application\Command\AddRecipe\AddRecipeRequest;
use yii\base\Model;

final class NewRecipeForm extends Model
{
    public string $name = '';
    public float $calories = 0;
    public string $description = '';

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
            $this->calories,
            $this->description
        );
    }
}