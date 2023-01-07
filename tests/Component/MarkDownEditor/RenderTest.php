<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\MarkDownEditor;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Asset\MarkDownEditorAsset;
use Yii\Forms\Component\MarkDownEditor;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class RenderTest extends TestCase
{
    use TestTrait;

    public function testAutoFocusEditor(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->autoFocusEditor(false);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testAutoSave(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->autoSave(500);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
        $this->assertSame(
            ['delay' => 500, 'enabled' => true, 'uniqueId' => Assert::invokeMethod($markDownEditor, 'getId')],
            Assert::inaccessibleProperty($markDownEditor, 'editorOptions')['autosave'],
        );
    }

    public function testForceSync(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->forceSync(false);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testGetElementId(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string']);
        $markDownEditor->render();
        $expected = 'var TestformString = new SimpleMDE({ element: document.getElementById("testform-string"), ' .
        'toolbar: ["bold","italic","strikethrough","heading","heading-smaller","heading-bigger","heading-1","heading-2",' .
        '"heading-3","code","quote","unordered-list","ordered-list","link","image","table","horizontal-rule","preview",' .
        '"side-by-side","fullscreen","guide"],  });';

        $this->assertSame($expected, $this->getScript());
    }

    public function testHiddenIcons(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])
            ->hiddenIcons(['heading-1', 'heading-2', 'heading-3']);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testIndentWithTabs(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->indentWithTabs(false);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testInitialValue(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->initialValue('Hello World');
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testLineWrapping(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->lineWrapping(true);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testOptions(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])
            ->options('placeholder', 'Hello World');
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testPromptURLs(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->promptURLs(true);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testPlaceholder(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->placeholder('Hello World');
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testRegisterAssets(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string']);
        $markDownEditor->render();

        $this->assertInstanceof(MarkDownEditorAsset::class, $this->assetManager->getBundle(MarkDownEditorAsset::class));
    }

    public function testRun(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]"></textarea>
            HTML,
            MarkDownEditor::widget([new TestForm(), 'string'])->render(),
        );
    }

    public function testShowIcons(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])
            ->showIcons(['heading-1', 'heading-2', 'heading-3']);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testSpellChecker(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->spellChecker(true);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testStyleSelectedText(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->styleSelectedText(true);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testTabSize(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->tabSize(2);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testToolbar(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->toolbar(['bold', 'italic']);
        $markDownEditor->render();

        $this->assertSame(Assert::invokeMethod($markDownEditor, 'getScript'), $this->getScript());
    }

    public function testToolbarTips(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string'])->toolbarTips(true);
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
