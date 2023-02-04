<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Date;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Date;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class RenderTest extends TestCase
{
    use TestTrait;

    public function testRender(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date">',
            Date::widget([new TestForm(), 'string'])->render(),
        );
    }
}
