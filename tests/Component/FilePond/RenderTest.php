<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\FilePond;

use JsonException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\FilePond\Asset\Npm\FilePondAsset;
use Yii\Forms\Component\FilePond;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
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
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testAllowMultiple(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->allowMultiple(true)->render();

        $this->assertStringContainsString('allowMultiple', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testClassName(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->className('TestClass')->render();

        $this->assertStringContainsString('TestClass', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testCanBePluginImageCrop(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->canBePluginImageCrop()->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageCrop', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testCanBePluginPdfPreview(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->canBePluginPdfPreview()->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginPdfPreview', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testLabelIdle(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])
            ->labelIdle('Drag & Drop or <span class="filepond--label-action"> Browse </span>')
            ->render();

        $this->assertStringContainsString('labelIdle', $this->getScript());
        $this->assertStringContainsString(
            'Drag & Drop or <span class=\"filepond--label-action\"> Browse <\/span>',
            $this->getScript(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testPluingDefault(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->canBePluginPdfPreview()->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testRender(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertSame(
            '<input class="filepond" id="testform-string" name="TestForm[string][]" type="file">',
            $filePond->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testRegisterAssets(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->render();

        $this->assertInstanceof(FilePondAsset::class, $this->assetManager->getBundle(FilePondAsset::class));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws ReflectionException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testTranslation(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string'])->render();

        $script = $this->getScript();

        $this->assertStringContainsString('labelIdle', $script);
        $this->assertStringContainsString('labelInvalidField', $script);
        $this->assertStringContainsString('labelFileWaitingForSize', $script);
        $this->assertStringContainsString('labelFileSizeNotAvailable', $script);
        $this->assertStringContainsString('labelFileLoading', $script);
        $this->assertStringContainsString('labelFileLoadError', $script);
        $this->assertStringContainsString('labelFileProcessing', $script);
        $this->assertStringContainsString('labelFileProcessingComplete', $script);
        $this->assertStringContainsString('labelFileProcessingAborted', $script);
        $this->assertStringContainsString('labelFileProcessingError', $script);
        $this->assertStringContainsString('labelFileProcessingRevertError', $script);
        $this->assertStringContainsString('labelFileRemoveError', $script);
        $this->assertStringContainsString('labelTapToCancel', $script);
        $this->assertStringContainsString('labelTapToRetry', $script);
        $this->assertStringContainsString('labelTapToUndo', $script);
        $this->assertStringContainsString('labelButtonRemoveItem', $script);
        $this->assertStringContainsString('labelButtonAbortItemLoad', $script);
        $this->assertStringContainsString('labelButtonRetryItemLoad', $script);
        $this->assertStringContainsString('labelButtonAbortItemProcessing', $script);
        $this->assertStringContainsString('labelButtonUndoItemProcessing', $script);
        $this->assertStringContainsString('labelButtonRetryItemProcessing', $script);
        $this->assertStringContainsString('labelButtonProcessItem', $script);
        $this->assertStringContainsString('labelMaxFileSizeExceeded', $script);
        $this->assertStringContainsString('labelMaxFileSize', $script);
        $this->assertStringContainsString('labelMaxTotalFileSizeExceeded', $script);
        $this->assertStringContainsString('labelMaxTotalFileSize', $script);
        $this->assertStringContainsString('labelFileTypeNotAllowed', $script);
        $this->assertStringContainsString('fileValidateTypeLabelExpectedTypes', $script);
        $this->assertStringContainsString('imageValidateSizeLabelFormatError', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageSizeTooSmall', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageSizeTooBig', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMinSize', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMaxSize', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageResolutionTooLow', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageResolutionTooHigh', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMinResolution', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMaxResolution', $script);
    }

    private function getScript(): string
    {
        $script = '';

        foreach (Assert::inaccessibleProperty($this->webView, 'state')->getJS() as $js) {
            foreach ($js as $value) {
                $script = $value;
            }
        }

        return $script;
    }
}
