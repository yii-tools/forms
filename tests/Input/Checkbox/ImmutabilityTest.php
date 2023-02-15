<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Checkbox;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Checkbox;
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
        $checkbox = Checkbox::widget([new TestForm(), 'string']);

        $this->assertNotSame($checkbox, $checkbox->container(false));
        $this->assertNotSame($checkbox, $checkbox->containerAttributes());
        $this->assertNotSame($checkbox, $checkbox->containerClass(''));
        $this->assertNotSame($checkbox, $checkbox->unchecked(''));
    }
}
