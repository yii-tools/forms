<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Date;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Date;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    public function testImmutability(): void
    {
        $date = Date::widget([new TestForm(), 'string']);

        $this->assertNotSame($date, $date->max(0));
        $this->assertNotSame($date, $date->min(0));
        $this->assertNotSame($date, $date->step(0));
    }
}
