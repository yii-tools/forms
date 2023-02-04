<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Label;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Label;
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
        $label = Label::widget([new TestForm(), 'string']);

        $this->assertNotSame($label, $label->closure(fn () => ''));
        $this->assertNotSame($label, $label->content(''));
        $this->assertNotSame($label, $label->encode(true));
        $this->assertNotSame($label, $label->for(''));
    }
}
