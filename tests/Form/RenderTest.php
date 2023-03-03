<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Form;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Stringable;
use Yii\Forms\Form;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testAcceptCharset(): void
    {
        $this->assertSame(
            <<<HTML
            <form accept-charset="UTF-8">
            HTML,
            Form::widget()->acceptCharset('UTF-8')->begin(),
        );
    }

    public function testAction(): void
    {
        $this->assertSame(
            <<<HTML
            <form action="/test">
            HTML,
            Form::widget()->action('/test')->begin(),
        );
    }

    public function testBegin(): void
    {
        $this->assertSame(
            <<<HTML
            <form>
            HTML,
            Form::widget()->begin(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <form action="/example" method="GET">
            <input name="id" type="hidden" value="1">
            <input name="title" type="hidden" value="&lt;">
            HTML,
            Form::widget()->action('/example?id=1&title=%3C')->method('GET')->begin(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <form action="/foo" method="GET">
            <input name="p" type="hidden">
            HTML,
            Form::widget()->action('/foo?p')->method('GET')->begin(),
        );
    }

    /**
     * Data provider for {@see testCsrf()}.
     *
     * @return array test data
     */
    public static function csrf(): array
    {
        return [
            // empty csrf name and token
            ['<form action="/foo" method="POST">', 'POST', '', ''],
            // empty csrf token
            ['<form action="/foo" method="POST">', 'POST', '', 'myToken'],
            // only csrf token value
            ['<form action="/foo" method="GET" _csrf="tokenCsrf">', 'GET', 'tokenCsrf', ''],
            // only csrf custom name
            [
                '<form action="/foo" method="POST" myToken="tokenCsrf">' . PHP_EOL .
                '<input name="myToken" type="hidden" value="tokenCsrf">',
                'post',
                'tokenCsrf',
                'myToken',
            ],
            // object stringable
            [
                '<form action="/foo" method="POST" myToken="tokenCsrf">' . PHP_EOL .
                '<input name="myToken" type="hidden" value="tokenCsrf">',
                'POST',
                new class () {
                    public function __toString(): string
                    {
                        return 'tokenCsrf';
                    }
                },
                'myToken',
            ],
        ];
    }

    #[DataProvider('csrf')]
    public function testCsrf(string $expected, string $method, string|Stringable $csrfToken, string $csrfName): void
    {
        $formWidget = $csrfName !== ''
            ? Form::widget()->action('/foo')->csrf($csrfToken, $csrfName)->method($method)->begin()
            : Form::widget()->action('/foo')->csrf($csrfToken)->method($method)->begin();
        $this->assertSame($expected, $formWidget);
    }

    public function testEnd(): void
    {
        Form::widget()->begin();
        $this->assertSame(
            <<<HTML
            </form>
            HTML,
            Form::end(),
        );
    }

    public function testNovalidate(): void
    {
        $this->assertSame(
            <<<HTML
            <form novalidate>
            HTML,
            Form::widget()->novalidate()->begin(),
        );
    }

    public function testRender(): void
    {
        $this->assertSame(
            <<<HTML
            <form></form>
            HTML,
            Form::widget()->begin() . Form::end(),
        );
    }
}
