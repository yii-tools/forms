<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\FilePond;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\FilePond;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginFileValidateSize(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowFileSizeValidation(false));
        $this->assertNotSame($filePond, $filePond->labelMaxFileSize(''));
        $this->assertNotSame($filePond, $filePond->labelMaxFileSizeExceeded(''));
        $this->assertNotSame($filePond, $filePond->labelMaxTotalFileSize(''));
        $this->assertNotSame($filePond, $filePond->labelMaxTotalFileSizeExceeded(''));
        $this->assertNotSame($filePond, $filePond->maxFileSize('3MB'));
        $this->assertNotSame($filePond, $filePond->maxTotalFileSize('3MB'));
        $this->assertNotSame($filePond, $filePond->minFileSize(0));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginFileValidateType(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowFileTypeValidation(false));
        $this->assertNotSame($filePond, $filePond->acceptedFileTypes([]));
        $this->assertNotSame($filePond, $filePond->fileValidateTypeDetectType(''));
        $this->assertNotSame($filePond, $filePond->fileValidateTypeLabelExpectedTypes(''));
        $this->assertNotSame($filePond, $filePond->fileValidateTypeLabelExpectedTypesMap([]));
        $this->assertNotSame($filePond, $filePond->labelFileTypeNotAllowed(''));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginImageCrop(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowImageCrop(false));
        $this->assertNotSame($filePond, $filePond->imageCropAspectRatio('1:1'));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginImageExifOrientation(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowImageExifOrientation(false));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginImagePreview(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowImagePreview(false));
        $this->assertNotSame($filePond, $filePond->imagePreviewFilterItem(''));
        $this->assertNotSame($filePond, $filePond->imagePreviewHeight(0));
        $this->assertNotSame($filePond, $filePond->imagePreviewMarkupFilter(''));
        $this->assertNotSame($filePond, $filePond->imagePreviewMarkupShow(false));
        $this->assertNotSame($filePond, $filePond->imagePreviewMaxFileSize(''));
        $this->assertNotSame($filePond, $filePond->imagePreviewMaxHeight(0));
        $this->assertNotSame($filePond, $filePond->imagePreviewMaxInstantPreviewFileSize(''));
        $this->assertNotSame($filePond, $filePond->imagePreviewMinHeight(0));
        $this->assertNotSame($filePond, $filePond->imagePreviewTransparencyIndicator(''));
        $this->assertNotSame($filePond, $filePond->imageTransformVariants([]));
        $this->assertNotSame($filePond, $filePond->imageTransformVariantsDefaultName(''));
        $this->assertNotSame($filePond, $filePond->imageTransformVariantsIncludeDefault(false));
        $this->assertNotSame($filePond, $filePond->imageTransformVariantsIncludeDefault(false));
        $this->assertNotSame($filePond, $filePond->imageTransformVariantsIncludeOriginal(false));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginImageTransform(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowImageTransform(false));
        $this->assertNotSame($filePond, $filePond->imageTransformAfterCreateBlob([]));
        $this->assertNotSame($filePond, $filePond->imageTransformBeforeCreateBlob([]));
        $this->assertNotSame($filePond, $filePond->imageTransformCanvasMemoryLimit(0));
        $this->assertNotSame($filePond, $filePond->imageTransformClientTransforms([]));
        $this->assertNotSame($filePond, $filePond->imageTransformOutputQuality(0));
        $this->assertNotSame($filePond, $filePond->imageTransformOutputQualityMode(''));
        $this->assertNotSame($filePond, $filePond->imageTransformOutputStripImageHead(true));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHasPluginPdfPreview(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowPdfPreview(false));
        $this->assertNotSame($filePond, $filePond->pdfPreviewHeight(0));
        $this->assertNotSame($filePond, $filePond->pdfComponentExtraParams(''));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testInmutability(): void
    {
        $filePond = FilePond::widget([new TestForm(), 'string']);

        $this->assertNotSame($filePond, $filePond->allowMultiple(false));
        $this->assertNotSame($filePond, $filePond->canBePluginImageCrop());
        $this->assertNotSame($filePond, $filePond->canBePluginPdfPreview());
        $this->assertNotSame($filePond, $filePond->className('filepond'));
        $this->assertNotSame($filePond, $filePond->maxFiles(1));
        $this->assertNotSame($filePond, $filePond->labelIdle(''));
        $this->assertNotSame($filePond, $filePond->options([]));
        $this->assertNotSame($filePond, $filePond->pluginDefault([]));
        $this->assertNotSame($filePond, $filePond->required(false));
    }
}
