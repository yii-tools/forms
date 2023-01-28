<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\MarkDownEditor;

use JsonException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\MarkDownEditor;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\SimpleMde\Asset\Npm\Min\MarkDownEditorAsset;
use Yii\Support\Assert;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testAutoFocusEditor(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->autoFocusEditor(false)->render();

        $this->assertStringContainsString('autofocus: false', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testAutoSave(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->autoSave(500)->render();

        $this->assertStringContainsString(
            'autosave: {"delay":500,"enabled":true,"uniqueId":"testform-string"}',
            $this->getScript(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testForceSync(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->forceSync(false)->render();

        $this->assertStringContainsString('forceSync: false', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testGetElementId(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->render();

        $this->assertStringContainsString('element: document.getElementById("testform-string")', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testHiddenIcons(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->hiddenIcons(['heading-1', 'heading-2', 'heading-3'])
            ->render();

        $this->assertStringContainsString('hideIcons: ["heading-1","heading-2","heading-3"', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testIndentWithTabs(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->indentWithTabs(false)->render();

        $this->assertStringContainsString('indentWithTabs: false', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testInitialValue(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->initialValue('Hello World')->render();

        $this->assertStringContainsString('initialValue: "Hello World"', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testLineWrapping(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->lineWrapping(true)->render();

        $this->assertStringContainsString('lineWrapping: true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testOptions(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->options('placeholder', 'Hello World')->render();

        $this->assertStringContainsString('placeholder: "Hello World"', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testPromptURLs(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->promptURLs(true)->render();

        $this->assertStringContainsString('promptURLs: true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testPlaceholder(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->placeholder('Hello World')->render();

        $this->assertStringContainsString('placeholder: "Hello World"', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testRender(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]"></textarea>
            HTML,
            MarkDownEditor::widget([new TestForm(), 'string'])->render(),
        );
        $this->assertTrue($this->assetManager->isRegisteredBundle(MarkDownEditorAsset::class));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testShowIcons(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->showIcons(['heading-1', 'heading-2', 'heading-3'])
            ->render();

        $this->assertStringContainsString('showIcons: ["heading-1","heading-2","heading-3"]', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testSpellChecker(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->spellChecker(true)->render();

        $this->assertStringContainsString('spellChecker: true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testStyleSelectedText(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->styleSelectedText(true)->render();

        $this->assertStringContainsString('styleSelectedText: true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testTabSize(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->tabSize(2)->render();

        $this->assertStringContainsString('tabSize: 2', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testToolbar(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->toolbar(['bold', 'italic'])->render();

        $this->assertStringContainsString('toolbar: ["bold","italic"]', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testToolbarTips(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])->toolbarTips(true)->render();

        $this->assertStringContainsString('toolbarTips: true', $this->getScript());
    }

    /**
     * @psalm-suppress MixedMethodCall
     */
    private function getScript(): string
    {
        $script = '';

        /** @psalm-var string[][] $getAllJs */
        $getAllJs = Assert::inaccessibleProperty($this->webView, 'state')->getJS();

        foreach ($getAllJs as $js) {
            foreach ($js as $value) {
                $script = $value;
            }
        }

        return $script;
    }
}
