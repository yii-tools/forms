<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Form;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Form;
use Yii\Forms\Tests\Support\TestTrait;

final class InputAttibutesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
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
