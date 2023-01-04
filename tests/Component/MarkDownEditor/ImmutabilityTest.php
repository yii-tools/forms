<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\MarkDownEditor;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\MarkDownEditor;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string']);

        $this->assertNotSame($markDownEditor, $markDownEditor->autoFocusEditor());
        $this->assertNotSame($markDownEditor, $markDownEditor->autoSave(5000));
        $this->assertNotSame($markDownEditor, $markDownEditor->forceSync());
        $this->assertNotSame($markDownEditor, $markDownEditor->hiddenIcons(['heading-1', 'heading-2', 'heading-3']));
        $this->assertNotSame($markDownEditor, $markDownEditor->indentWithTabs(true));
        $this->assertNotSame($markDownEditor, $markDownEditor->initialValue('initial value'));
        $this->assertNotSame($markDownEditor, $markDownEditor->lineWrapping(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->options('autofocus', true));
        $this->assertNotSame($markDownEditor, $markDownEditor->placeholder('placeholder'));
        $this->assertNotSame($markDownEditor, $markDownEditor->promptURLs(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->showIcons(['heading-1', 'heading-2', 'heading-3']));
        $this->assertNotSame($markDownEditor, $markDownEditor->spellChecker(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->styleSelectedText(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->tabSize());
        $this->assertNotSame($markDownEditor, $markDownEditor->toolbar(['heading-1', 'heading-2', 'heading-3']));
        $this->assertNotSame($markDownEditor, $markDownEditor->toolbarTips(false));
    }
}
