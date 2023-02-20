<?php

declare(strict_types=1);

namespace Kitman\Web\Application\Recipe;

use Kitman\Application\Command\AddIngredient\AddIngredientRequest;
use Kitman\Domain\Model\Recipe\IngredientType;
use Kitman\Web\Application\Core\Model;

final class AddIngredientForm extends Model
{
    /** @var string */
    public $name;
    /** @var string */
    public $type;
    /** @var float */
    public $amount;

    public function rules(): array
    {
        return [
            [['name', 'type', 'amount'], 'required'],
            ['type', 'in', 'range' => $this->types()],
            ['amount', 'number', 'min' => 0]
        ];
    }

    public function types(): array
    {
        return [
            IngredientType::liquid->name,
            IngredientType::solid->name,
            IngredientType::countable->name,
        ];
    }

    public function typesLabels(): array
    {
        // TODO: Add i18n
        return array_map(static fn(string $label) => $label, $this->types());
    }

    public function toRequest(string $uuid): AddIngredientRequest
    {
        return new AddIngredientRequest(
            $uuid,
            $this->name,
            (float)$this->amount,
            $this->type
        );
    }
}