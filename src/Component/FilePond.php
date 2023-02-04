<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use Yii\FilePond\Asset\Npm;
use Yii\FormModel\FormModelInterface;
use Yii\Html\Helper\Utils;
use Yii\Widget\Component\AbstractComponentWidget;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

final class FilePond extends AbstractComponentWidget
{
    use FilePond\HasPluginFileValidateSize;
    use FilePond\HasPluginFileValidateType;
    use FilePond\HasPluginImageCrop;
    use FilePond\HasPluginImageExifOrientation;
    use FilePond\HasPluginImagePreview;
    use FilePond\HasPluginImageTransform;
    use FilePond\HasPluginPdfPreview;

    private array $options = [];
    /** @psalm-var string[] */
    private array $plugingAssets = [
        'FilePondPluginFileEncode' => Npm\FilePondPluginFileEncodeAsset::class,
        'FilePondPluginFileValidateSize' => Npm\FilePondPluginFileValidateSizeAsset::class,
        'FilePondPluginFileValidateType' => Npm\FilePondPluginFileValidateTypeAsset::class,
        'FilePondPluginImageCrop' => Npm\FilePondPluginImageCropAsset::class,
        'FilePondPluginImageExifOrientation' => Npm\FilePondPluginImageExifOrientationAsset::class,
        'FilePondPluginImagePreview' => Npm\FilePondPluginImagePreviewAsset::class,
        'FilePondPluginImageTransform' => Npm\FilePondPluginImageTransformAsset::class,
        'FilePondPluginPdfPreview' => Npm\FilePondPluginPdfPreviewAsset::class,
    ];
    /** @psalm-var string[] */
    private array $pluginDefault = [
        'FilePondPluginFileEncode',
        'FilePondPluginFileValidateSize',
        'FilePondPluginFileValidateType',
        'FilePondPluginImageExifOrientation',
        'FilePondPluginImagePreview',
    ];
    private string $translationCategory = 'filepond';
    /** @psalm-var string[] */
    private array $translationTagDefault = [
        'labelIdle',
        'labelInvalidField',
        'labelFileWaitingForSize',
        'labelFileSizeNotAvailable',
        'labelFileLoading',
        'labelFileLoadError',
        'labelFileProcessing',
        'labelFileProcessingComplete',
        'labelFileProcessingAborted',
        'labelFileProcessingError',
        'labelFileProcessingRevertError',
        'labelFileRemoveError',
        'labelTapToCancel',
        'labelTapToRetry',
        'labelTapToUndo',
        'labelButtonRemoveItem',
        'labelButtonAbortItemLoad',
        'labelButtonRetryItemLoad',
        'labelButtonAbortItemProcessing',
        'labelButtonUndoItemProcessing',
        'labelButtonRetryItemProcessing',
        'labelButtonProcessItem',
        'labelMaxFileSizeExceeded',
        'labelMaxFileSize',
        'labelMaxTotalFileSizeExceeded',
        'labelMaxTotalFileSize',
        'labelFileTypeNotAllowed',
        'fileValidateTypeLabelExpectedTypes',
        'imageValidateSizeLabelFormatError',
        'imageValidateSizeLabelImageSizeTooSmall',
        'imageValidateSizeLabelImageSizeTooBig',
        'imageValidateSizeLabelExpectedMinSize',
        'imageValidateSizeLabelExpectedMaxSize',
        'imageValidateSizeLabelImageResolutionTooLow',
        'imageValidateSizeLabelImageResolutionTooHigh',
        'imageValidateSizeLabelExpectedMinResolution',
        'imageValidateSizeLabelExpectedMaxResolution',
    ];

    public function __construct(
        private FormModelInterface $formModel,
        private string $attribute,
        private readonly AssetManager $assetManager,
        private readonly Webview $webView,
        private readonly TranslatorInterface $translator
    ) {
    }

    /**
     * Return new instance with enable or disable multiple file upload.
     *
     * @param bool $value Enable or disable multiple file upload. Default: `true`.
     */
    public function allowMultiple(bool $value): self
    {
        $new = clone $this;
        $new->options['allowMultiple'] = $value;

        return $new;
    }

    /**
     * Return new instance wheather enable or disable plugin image crop.
     */
    public function canBePluginImageCrop(): self
    {
        $new = clone $this;
        $new->pluginDefault[] = 'FilePondPluginImageCrop';

        return $new;
    }

    /**
     * Return new instance wheather enable or disable plugin PDF preview.
     */
    public function canBePluginPdfPreview(): self
    {
        $new = clone $this;
        $new->pluginDefault[] = 'FilePondPluginPdfPreview';

        return $new;
    }

    /**
     * Return new instance with the class name of the FilePond.
     *
     * @param string $value The class name of the FilePond. Default: `null`.
     */
    public function className(string $value): self
    {
        $new = clone $this;
        $new->options['className'] = $value;

        return $new;
    }

    /**
     * Return new instance with number of files to load and display in the list.
     *
     * @param int $value The number of files to load and display in the list. Default: `null`.
     */
    public function maxFiles(int $value): self
    {
        $new = clone $this;
        $new->options['maxFiles'] = $value;

        return $new;
    }

    /**
     * Return new instance with the label shown to indicate this is a drop area. FilePond will automatically bind browse
     * file events to the element with CSS class.
     *
     * @param string $value The label shown to indicate this is a drop area.
     * Default: `Drag & Drop your files or <span class="filepond--label-action"> Browse </span>`.
     */
    public function labelIdle(string $value): self
    {
        $new = clone $this;
        $new->options['labelIdle'] = $value;

        return $new;
    }

    /**
     * Return new instance with set config options for FilePond.
     *
     * @param array $value The config options for FilePond. Default: `[]`.
     *
     * ```php
     * [
     *    'allowMultiple' => true,
     *    'maxFiles' => 3,
     *    'acceptedFileTypes' => ['image/png', 'image/jpeg', 'image/gif'],
     * ];
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;

        return $new;
    }

    /**
     * Return new instance with plugins default to register in FilePond.
     *
     * @param array $value The plugins default to register in FilePond. Default: `[]`.
     *
     * ```php
     * [
     *     'FilePondPluginFileEncode',
     *     'FilePondPluginFileValidateSize',
     *     'FilePondPluginFileValidateType',
     *     'FilePondPluginImageExifOrientation',
     *     'FilePondPluginImagePreview',
     * ];
     *
     * @psalm-param string[] $value
     */
    public function pluginDefault(array $value): self
    {
        $new = clone $this;
        $new->pluginDefault = $value;

        return $new;
    }

    /**
     * Return new instance wheather is required or not.
     *
     * @param bool $value Wheather is required or not. Default: `true`.
     */
    public function required(bool $value): self
    {
        $new = clone $this;
        $new->options['required'] = $value;

        return $new;
    }

    /**
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws CircularReferenceException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function render(): string
    {
        $className = 'filepond';

        $this->registerAssets();

        $fileTag = Input\File::widget([$this->formModel, $this->attribute])
            ->attributes($this->attributes)
            ->class($className);

        if (array_key_exists('allowMultiple', $this->options) && $this->options['allowMultiple']) {
            $fileTag = $fileTag->multiple();
        }

        if (array_key_exists('className', $this->options) && is_string($this->options['className'])) {
            $fileTag = $fileTag->class($this->options['className']);
        }

        return $fileTag->render();
    }

    private function buildTranslation(): array
    {
        $translation = [];

        foreach ($this->translationTagDefault as $tag) {
            if (array_key_exists($tag, $this->options) === false) {
                $translation[$tag] = $this->translator->translate($tag, [], $this->translationCategory);
            }
        }

        return $translation;
    }

    private function getScript(): string
    {
        $closure = $this->fileValidateTypeDetectType;
        $id = Utils::generateInputId($this->formModel->getFormName(), $this->attribute);
        $options = array_merge($this->options, $this->buildTranslation());
        $pluginConfig = implode(', ', $this->pluginDefault);
        $setOptions = json_encode($options);

        return <<<JS
		FilePond.registerPlugin($pluginConfig);
		FilePond.setOptions($setOptions);
		FilePond.create(document.querySelector('input[type="file"][id="$id"]'), {
			$closure
		});
		JS;
    }

    /**
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    private function registerAssets(): void
    {
        $assetManager = $this->assetManager;
        $depends = [];

        foreach ($this->pluginDefault as $plugin) {
            $depends[] = $this->plugingAssets[$plugin];
        }

        $assetManager->registerCustomized(Npm\FilePondAsset::class, ['depends' => $depends]);

        $this->webView->registerJs($this->getScript());
    }
}
