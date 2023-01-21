<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Concern;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\BasicForm;
use Yii\Forms\Tests\Support\TestTrait;

final class HasErrorTest extends TestCase
{
    use TestTrait;

    public function testAddError(): void
    {
        $formModel = new BasicForm();
        $errorContent = 'Invalid username.';
        $formModel->addError('username', $errorContent);

        $this->assertTrue($formModel->hasError('username'));
        $this->assertSame($errorContent, $formModel->getFirstError('username'));
    }

    public function testAddErrors(): void
    {
        $formModel = new BasicForm();
        $errorContent = ['username' => ['0' => 'Invalid username']];
        $formModel->clearError();

        $this->assertEmpty($formModel->getFirstError('username'));

        $formModel->addErrors($errorContent);

        $this->assertTrue($formModel->hasError('username'));
        $this->assertSame('Invalid username', $formModel->getFirstError('username'));
    }

    public function testClearAllErrors(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Username is required');
        $formModel->addError('email', 'Email is required');

        $this->assertSame(
            ['username' => ['Username is required'], 'email' => ['Email is required']],
            $formModel->getAllError(),
        );

        $formModel->clearError();

        $this->assertEmpty($formModel->getAllError());
    }

    public function testClearForAttribute(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Username is required');
        $formModel->addError('email', 'Email is required');

        $this->assertSame(
            ['username' => ['Username is required'], 'email' => ['Email is required']],
            $formModel->getAllError(),
        );

        $formModel->clearError('username');

        $this->assertSame(['email' => ['Email is required']], $formModel->getAllError());
    }

    public function testGetAllError(): void
    {
        $formModel = new BasicForm();

        $this->assertSame([], $formModel->getAllError());
    }

    public function testGetError(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Invalid username');

        $this->assertSame(['Invalid username'], $formModel->getError('username'));
    }

    public function testGetErrorWithEmpty(): void
    {
        $formModel = new BasicForm();

        $this->assertSame([], $formModel->getError('username'));
    }

    public function testGetFirstError(): void
    {
        $formModel = new BasicForm();

        $this->assertSame('', $formModel->getFirstError('username'));
    }

    public function testGetFirstsError(): void
    {
        $formModel = new BasicForm();
        $formModel->addErrors(
            [
                'username' => ['0' => 'Invalid username'],
                'email' => ['0' => 'Invalid email'],
            ],
        );

        $this->assertSame(
            ['username' => 'Invalid username', 'email' => 'Invalid email'],
            $formModel->getFirstsError(),
        );
    }

    public function testGetFirstsErrorWithEmpty(): void
    {
        $formModel = new BasicForm();

        $this->assertSame([], $formModel->getFirstsError());
    }

    public function testGetSummaryError(): void
    {
        $formModel = new BasicForm();
        $formModel->addErrors(
            [
                'username' => ['0' => 'Invalid username'],
                'email' => ['0' => 'Invalid email'],
            ],
        );

        $this->assertSame(['Invalid username', 'Invalid email'], $formModel->getSummaryError());
    }

    public function testGetSummaryErrorWithEmpty(): void
    {
        $formModel = new BasicForm();

        $this->assertSame([], $formModel->getSummaryError());
    }

    public function testGetSummaryErrorWithOnlyAttributes(): void
    {
        $formModel = new BasicForm();
        $formModel->addErrors(
            [
                'username' => ['0' => 'Invalid username'],
                'email' => ['0' => 'Invalid email'],
            ],
        );

        $this->assertSame(['Invalid username'], $formModel->getSummaryError(['username']));
    }

    public function testGetSummaryFirstError(): void
    {
        $formModel = new BasicForm();
        $formModel->addErrors(
            [
                'username' => ['0' => 'The field is required', '1' => 'Invalid username'],
                'email' => ['0' => 'Invalid email'],
            ],
        );

        $this->assertSame(
            ['username' => 'The field is required', 'email' => 'Invalid email'],
            $formModel->getSummaryFirstError(),
        );
    }

    public function testHasError(): void
    {
        $formModel = new BasicForm();

        $this->assertFalse($formModel->hasError());
    }

    public function testHasErrorWithAttribute(): void
    {
        $formModel = new BasicForm();
        $formModel->addError('username', 'Invalid username');

        $this->assertTrue($formModel->hasError('username'));
    }
}
