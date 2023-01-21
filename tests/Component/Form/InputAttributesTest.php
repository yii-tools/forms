<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Form;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Form;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class InputAttributesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAutocomplete(): void
    {
        $this->assertSame(
            <<<HTML
            <form autocomplete="on">
            HTML,
            Form::widget()->autocomplete('on')->begin(),
        );
    }
}
