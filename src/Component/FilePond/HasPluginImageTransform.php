<?php

declare(strict_types=1);

namespace Yii\Forms\Component\FilePond;

/**
 * HasPluginImageExifOrientation provides methods for managing the plugin image exif orientation.
 */
trait HasPluginImageTransform
{
    /**
     * Return new instance with enable or disable image transform.
     *
     * @param bool $value Enable or disable image transform. Default: `true`.
     */
    public function allowImageTransform(bool $value): self
    {
        $new = clone $this;
        $new->options['allowImageTransform'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform after create blob. A hook to make changes to the file after the file has
     * been created.
     */
    public function imageTransformAfterCreateBlob(array $value): self
    {
        $new = clone $this;
        $new->options['imageTransformAfterCreateBlob'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform before create blob. A hook to make changes to the canvas before the
     * file is created.
     *
     * @param array $value Image transform before create blob. Default: `null`.
     */
    public function imageTransformBeforeCreateBlob(array $value): self
    {
        $new = clone $this;
        $new->options['imageTransformBeforeCreateBlob'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform canvas memory limit. A memory limit to make sure the canvas can be used
     * correctly when rendering the image. By default this is only active on iOS.
     *
     * @param int $value Image transform canvas memory limit. Default: `isBrowser && isIOS ? 4096 * 4096 : null`.
     */
    public function imageTransformCanvasMemoryLimit(int $value): self
    {
        $new = clone $this;
        $new->options['imageTransformCanvasMemoryLimit'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform client transform. An array of transforms to apply on the client, useful
     * if we, for instance, want to do resizing on the client but cropping on the server. null means apply all
     * transforms ('resize', 'crop').
     *
     * @param array $value Image transform client transform. Default: `null`.
     */
    public function imageTransformClientTransforms(array $value): self
    {
        $new = clone $this;
        $new->options['imageTransformClientTransforms'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform output quality. The quality of the output image supplied as a value
     * between `0` and `100`. Where `100` is best quality and `0` is worst. When not supplied it will use the browser
     * default quality which averages around `94`.
     *
     * @param int $value Image transform output quality. Default: `null`.
     */
    public function imageTransformOutputQuality(int $value): self
    {
        $new = clone $this;
        $new->options['imageTransformOutputQuality'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform output quality mode. Should output quality be enforced, set the
     * 'optional' to only apply when a transform is required due to other requirements (e.g. resize or crop).
     *
     * @param string $value Image transform output quality mode. Default: 'always'.
     */
    public function imageTransformOutputQualityMode(string $value): self
    {
        $new = clone $this;
        $new->options['imageTransformOutputQualityMode'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform output strip image head. Should JPEG EXIF data be stripped from the
     * output image, defaults to true (as that is what the browser does), set to false to copy over the EXIF data from
     * the original image to the output image. This will automatically remove the EXIF orientation tag to prevent
     * orientation problems.
     *
     * @param bool $value Image transform output strip image head. Default: `true`.
     */
    public function imageTransformOutputStripImageHead(bool $value): self
    {
        $new = clone $this;
        $new->options['imageTransformOutputStripImageHead'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform variants. An object that can be used to output multiple different files
     * based on different transfom instructions.
     *
     * @param array $value Image transform variants. Default: `null`.
     */
    public function imageTransformVariants(array $value): self
    {
        $new = clone $this;
        $new->options['imageTransformVariants'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform variants default name. The name to use in front of the file name.
     *
     * @param string $value Image transform variants default name. Default: `null`.
     */
    public function imageTransformVariantsDefaultName(string $value): self
    {
        $new = clone $this;
        $new->options['imageTransformVariantsDefaultName'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform variants include default. Should the transform plugin output the default
     * transformed file.
     *
     * @param bool $value Image transform variants include default. Default: `true`.
     */
    public function imageTransformVariantsIncludeDefault(bool $value): self
    {
        $new = clone $this;
        $new->options['imageTransformVariantsIncludeDefault'] = $value;

        return $new;
    }

    /**
     * Return new instance with image transform variants include original. Should the transform plugin output the
     * original file.
     *
     * @param bool $value Image transform variants include original. Default: `false`.
     */
    public function imageTransformVariantsIncludeOriginal(bool $value): self
    {
        $new = clone $this;
        $new->options['imageTransformVariantsIncludeOriginal'] = $value;

        return $new;
    }
}
