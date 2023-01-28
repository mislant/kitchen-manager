<?php

declare(strict_types=1);

namespace Kitman\Tests\Web\Smoke;

use Kitman\Tests\Support\WebTester;

final class WebApplicationCest
{
    public function applicationConfiguredProperly(WebTester $I): void
    {
        $I->amOnPage('/');

        $I->see("Application works!");
    }

    public function applicationRoutingWorks(WebTester $I): void
    {
        $I->amOnPage('site/routing');

        $I->see("Routing works!");
    }
}