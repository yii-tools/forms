<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use InvalidArgumentException;
use Stringable;
use Yii\Forms\Asset\MarkDownEditorAsset;
use Yii\Forms\Base\AbstractFormWidget;
use Yii\Model\AbstractFormModel;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Strings\Inflector;
use Yiisoft\View\WebView;

final class MarkDownEditor extends AbstractFormWidget
{
    /** @psalm-var array<string, mixed> $editorOptions */
    private array $editorOptions = [];
    private array $toolbar = [
        'bold',
        'italic',
        'strikethrough',
        'heading',
        'heading-smaller',
        'heading-bigger',
        'heading-1',
        'heading-2',
        'heading-3',
        'code',
        'quote',
        'unordered-list',
        'ordered-list',
        'link',
        'image',
        'table',
        'horizontal-rule',
        'preview',
        'side-by-side',
        'fullscreen',
        'guide',
    ];

    public function __construct(
        AbstractFormModel $formModel,
        string $attribute,
        private AssetManager $assetManager,
        private Webview $webView
    ) {
        parent::__construct($formModel, $attribute);
    }

    /**
     * Returns a new instance specifying autofocuses the editor.
     * Defaults to `false`.
     */
    public function autoFocusEditor(): static
    {
        $new = clone $this;
        $new->editorOptions['autofocus'] = true;

        return $new;
    }

    /**
     * Returns a new instance specifying saves the text that's being written and will load it back in the future.
     * It will forget the text when the form it's contained in is submitted.
     *
     * @param int $delay The delay in milliseconds between each save.
     * Defaults to `1000`.
     */
    public function autoSave(int $delay = 1000): self
    {
        $new = clone $this;
        $new->editorOptions['autosave'] = [
            'enabled' => true,
            'uniqueId' => $this->getId(),
            'delay' => $delay,
        ];

        return $new;
    }

    /**
     * Returns a new instance specifying force text changes made in SimpleMDE to be immediately stored in original
     * textarea.
     * Defaults to `false`.
     */
    public function forceSync(): self
    {
        $new = clone $this;
        $new->editorOptions['forceSync'] = true;

        return $new;
    }

    /**
     * Returns a new instance specifying an array of icon names to hide. Can be used to hide specific icons shown by
     * default without completely customizing the toolbar.
     *
     * @param array $icons The icon names to hide.
     */
    public function hiddenIcons(array $icons): self
    {
        $this->validateIconsToolbar($icons);

        $new = clone $this;
        $new->editorOptions['hideIcons'] = $icons;

        return $new;
    }

    /**
     * Returns a new instance specifying indent using spaces instead of tabs.
     * Defaults to `true`.
     */
    public function indentWithTabs(bool $value = false): self
    {
        $new = clone $this;
        $new->editorOptions['indentWithTabs'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the initial value of the editor.
     *
     * @param mixed $value The initial value of the editor.
     */
    public function initialValue(mixed $value): self
    {
        $new = clone $this;
        $new->editorOptions['initialValue'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying disable line wrapping.
     * Defaults to `false`.
     */
    public function lineWrapping(bool $value = true): self
    {
        $new = clone $this;
        $new->editorOptions['lineWrapping'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the options for the editor.
     *
     * @param string $attribute The name of the option.
     * @param mixed $value The value of the option.
     */
    public function options(string $attribute, mixed $value): self
    {
        $new = clone $this;
        $new->editorOptions[$attribute] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the placeholder text to display when the editor is empty.
     *
     * @param string $value The placeholder text to display when the editor is empty.
     */
    public function placeholder(string $value): self
    {
        $new = clone $this;
        $new->editorOptions['placeholder'] = $value;

        return $new;
    }

    /**
     * Returns a new instance that specifies whether a JS alert window requests the image URL or link.
     */
    public function promptURLs(bool $value = true): self
    {
        $new = clone $this;
        $new->editorOptions['promptURLs'] = $value;

        return $new;
    }

    public function render(): Stringable|string
    {
        $this->registerAssets();

        return TextArea::widget([$this->formModel, $this->attribute])->id($this->getId())->render();
    }

    /**
     * Returns a new instance specifying the icons to show in the toolbar.
     *
     * @param array $icons The icon names to show.
     */
    public function showIcons(array $icons): self
    {
        $this->validateIconsToolbar($icons);

        $new = clone $this;
        $new->editorOptions['showIcons'] = $icons;

        return $new;
    }

    /**
     * Returns a new instance specifying whether spell checking is enabled.
     * Defaults to `false`.
     */
    public function spellChecker(bool $value = true): self
    {
        $new = clone $this;
        $new->editorOptions['spellChecker'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying whether to style the selected text.
     * Defaults to `false`.
     */
    public function styleSelectedText(bool $value = true): self
    {
        $new = clone $this;
        $new->editorOptions['styleSelectedText'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the tab size.
     * Defaults to `2`.
     */
    public function tabSize(int $value = 4): self
    {
        $new = clone $this;
        $new->editorOptions['tabSize'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the toolbar configuration.
     *
     * @param array $toolbar The toolbar configuration.
     *
     * @see toolbar
     */
    public function toolbar(array $toolbar): self
    {
        $this->validateIconsToolbar($toolbar);

        $new = clone $this;
        $new->toolbar = $toolbar;

        return $new;
    }

    /**
     * Returns a new instance specifying whether to show tooltips for toolbar buttons.
     * Defaults to `false`.
     *
     * @param bool $value Whether to show tooltips for toolbar buttons.
     */
    public function toolbarTips(bool $value = true): self
    {
        $new = clone $this;
        $new->editorOptions['toolbarTips'] = $value;

        return $new;
    }

    private function getElement(): string
    {
        return 'element: document.getElementById("' . $this->getId() . '")';
    }

    private function getScript(): string
    {
        $varName = (new Inflector())->toPascalCase('editor_' . $this->getId());
        $options = $this->getElement() . ',' . $this->getToolbar();

        /** @psalm-var mixed $value */
        foreach ($this->editorOptions as $attribute => $value) {
            $options .= ',' . $attribute . ': ' . json_encode($value);
        }

        return 'var' . $varName . ' = new SimpleMDE({' . $options . '});';
    }

    private function getToolbar(): string
    {
        return 'toolbar: ' . json_encode($this->toolbar);
    }

    private function registerAssets(): void
    {
        $this->assetManager->register(MarkDownEditorAsset::class);
        $this->webView->registerJs($this->getScript());
    }

    private function validateIconsToolbar(array $icons): void
    {
        /** @psalm-var string[] $icons */
        foreach ($icons as $icon) {
            if (!in_array($icon, $this->toolbar)) {
                throw new InvalidArgumentException('Invalid toolbar item: ' . $icon);
            }
        }
    }
}
