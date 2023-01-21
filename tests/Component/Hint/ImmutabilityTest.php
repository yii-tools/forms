<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Hint;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Hint;
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
        $hint = Hint::widget([new TestForm(), 'string']);

        $this->assertNotSame($hint, $hint->attributes([]));
        $this->assertNotSame($hint, $hint->closure(fn () => ''));
        $this->assertNotSame($hint, $hint->content(''));
        $this->assertNotSame($hint, $hint->tag('div'));
    }
}
