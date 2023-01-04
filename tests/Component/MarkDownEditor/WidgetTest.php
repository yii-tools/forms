<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\MarkDownEditor;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Asset\MarkDownEditorAsset;
use Yii\Forms\Component\MarkDownEditor;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class WidgetTest extends TestCase
{
    use TestTrait;

    public function testAutoFocusEditor(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->autoFocusEditor();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testAutoSave(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->autoSave();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testForceSync(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->forceSync();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testHiddenIcons(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])
            ->hiddenIcons(['heading-1', 'heading-2', 'heading-3']);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testIndentWithTabs(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->indentWithTabs();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testInitialValue(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->initialValue('Hello World');
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testLineWrapping(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->lineWrapping();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testOptions(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])
            ->options('placeholder', 'Hello World');
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testPromptURLs(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->promptURLs();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testPlaceholder(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->placeholder('Hello World');
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testRegisterAssets(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string']);
        $markDownEditor->render();

        $this->assertInstanceof(MarkDownEditorAsset::class, $this->assetManager->getBundle(MarkDownEditorAsset::class));
        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testRun(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]"></textarea>
            HTML,
            MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->render(),
        );
    }

    public function testShowIcons(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])
            ->showIcons(['heading-1', 'heading-2', 'heading-3']);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testSpellChecker(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->spellChecker();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testStyleSelectedText(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->styleSelectedText();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testTabSize(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->tabSize(2);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testToolbar(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->toolbar(['bold', 'italic']);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testToolbarTips(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->toolbarTips();
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    private function getScript(): string
    {
        $webViewState = Assert::inaccessibleProperty($this->webView, 'state');

        foreach ($webViewState->getJS() as $js) {
            foreach ($js as $key => $value) {
                $script = $value;
            }
        }

        return $script;
    }
}
