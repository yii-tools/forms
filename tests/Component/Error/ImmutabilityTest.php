<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Error;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Error;
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
        $error = Error::widget([new TestForm(), 'string']);

        $this->assertNotSame($error, $error->closure(static fn () => ''));
        $this->assertNotSame($error, $error->content(''));
        $this->assertNotSame($error, $error->tag('div'));
    }
}
