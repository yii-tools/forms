<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Button;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Button::class widget must be a string or null value.');

        Button::widget()->value([])->render();
    }
}
