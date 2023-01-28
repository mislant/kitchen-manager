<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain\Model;

use Codeception\Test\Unit;
use Kitman\Domain\Model\Entity;

final class EntityTest extends Unit
{
    public function testBusinessLogicWorks(): void
    {
        $entity = new Entity();

        $result = $entity->business();

        $this->assertEquals("this is business", $result);
    }
}