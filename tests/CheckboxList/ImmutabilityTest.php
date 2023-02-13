<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CheckboxList;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testImmutability(): void
    {
        $checkboxList = CheckboxList::widget([new TestForm(), 'array']);

        $this->assertNotSame($checkboxList, $checkboxList->boolean());
        $this->assertNotSame($checkboxList, $checkboxList->containerTag('div'));
        $this->assertNotSame($checkboxList, $checkboxList->individualItemsAttributes());
        $this->assertNotSame($checkboxList, $checkboxList->separator(''));
    }
}
