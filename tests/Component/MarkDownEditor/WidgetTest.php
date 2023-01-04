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
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->autoFocusEditor(false);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testAutoSave(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->autoSave(500);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
        $this->assertSame(
            ['delay' => 500, 'enabled' => true, 'uniqueId' => Assert::invokeMethod($markDownEditor, 'getId')],
            Assert::inaccessibleProperty($markDownEditor, 'editorOptions')['autosave'],
        );
    }

    public function testForceSync(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->forceSync(false);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testGetElementId(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string']);
        $markDownEditor->render();
        $expected = 'var PropertytypeformString = new SimpleMDE({ element: document.getElementById("propertytypeform-string"), ' .
        'toolbar: ["bold","italic","strikethrough","heading","heading-smaller","heading-bigger","heading-1","heading-2",' .
        '"heading-3","code","quote","unordered-list","ordered-list","link","image","table","horizontal-rule","preview",' .
        '"side-by-side","fullscreen","guide"],  });';

        $this->assertSame($expected, $this->getScript());
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
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->indentWithTabs(false);
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
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->lineWrapping(true);
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
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->promptURLs(true);
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
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->spellChecker(true);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testStyleSelectedText(): void
    {
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->styleSelectedText(true);
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
        $markDownEditor = MarkDownEditor::widget([new PropertyTypeForm(), 'string'])->toolbarTips(true);
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
