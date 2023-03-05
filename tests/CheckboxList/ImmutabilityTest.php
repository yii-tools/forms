<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CheckboxList;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $checkboxList = CheckboxList::widget([new TestForm(), 'array']);

        $this->assertNotSame($checkboxList, $checkboxList->boolean());
        $this->assertNotSame($checkboxList, $checkboxList->containerTag('div'));
        $this->assertNotSame($checkboxList, $checkboxList->individualItemsAttributes());
        $this->assertNotSame($checkboxList, $checkboxList->individualPrefix([]));
        $this->assertNotSame($checkboxList, $checkboxList->individualSuffix([]));
        $this->assertNotSame($checkboxList, $checkboxList->separator(''));
    }
}
