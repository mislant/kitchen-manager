<?php

use Kitman\Tests\Unit\Utils\ValueObjectComparator;
use SebastianBergmann\Comparator\Factory;

call_user_func(static function () {
    $factory = Factory::getInstance();
    $factory->register(new ValueObjectComparator());
});