<?php

declare(strict_types=1);

namespace Yii\Forms\Component\FilePond;

/**
 * HasPluginImageExifOrientation provides methods for managing the plugin image exif orientation.
 */
trait HasPluginImagePreview
{
    /**
     * Return new instance with enable or disable image preview.
     *
     * @param bool $value Enable or disable image preview. Default: `true`.
     */
    public function allowImagePreview(bool $value): self
    {
        $new = clone $this;
        $new->options['allowImagePreview'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new image preview filter. Use to filter file items before generating the preview,
     * useful to filter certain image types or names if we do not wish to generate a preview. Receives a file item as
     * the first argument. Return false to skip generating an image preview. (item) => !/svg/.test(item.fileType) will
     * skip generating previews for SVGs.
     *
     * @param string $value The image preview filter. Default: `(fileItem) => true`.
     */
    public function imagePreviewFilterItem(string $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewFilterItem'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new image preview height. Fixed image preview height, overrides min and max preview
     * height
     *
     * @param int $value The image preview height. Default: `null`.
     */
    public function imagePreviewHeight(int $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewHeight'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new image preview markup filter. Use to filter markup items, useful to show only
     * certain items and hide others till the image file is generated by the image transform plugin.
     *
     * @param string $value The image preview markup filter. Default: `(markupItem) => true`.
     */
    public function imagePreviewMarkupFilter(string $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewMarkupFilter'] = $value;

        return $new;
    }

    /**
     * Return new instance wheater enable or disable image preview markup.
     *
     * @param bool $value Enable or disable image preview markup. Default: `true`.
     */
    public function imagePreviewMarkupShow(bool $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewMarkupShow'] = $value;

        return $new;
    }

    /**
     * Return new instance with image preview max file size. Can be used to prevent loading of large images when
     * createImageBitmap is not supported. By default no maximum file size is defined, expects a string, like `2MB`
     * or `500KB`.
     *
     * @param string $value The image preview max file size. Default: 256.
     */
    public function imagePreviewMaxFileSize(string $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewMaxFileSize'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new image preview max height.
     *
     * @param int $value The image preview height. Default: 256.
     */
    public function imagePreviewMaxHeight(int $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewMaxHeight'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new image preview max instant preview file size. Maximum file size for images to
     * preview immediately, if files are larger and the browser doesn't support createImageBitmap the preview is
     * queued till FilePond is in rest state.
     *
     * @param string $value The image preview max instant preview file size. Default: `1000000`.
     */
    public function imagePreviewMaxInstantPreviewFileSize(string $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewMaxInstantPreviewFileSize'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new image preview min height.
     *
     * @param int $value The image preview height. Default: 44.
     */
    public function imagePreviewMinHeight(int $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewMinHeight'] = $value;

        return $new;
    }

    /**
     * Return new instance with transparency grid behind the image, set to a color value (for example '#f00') to set
     * transparent image background color. Please note that this is only for preview purposes, the background color or
     * grid is not embedded in the output image.
     *
     * @param string $value The image preview transparency indicator. Default: `null`.
     */
    public function imagePreviewTransparencyIndicator(string $value): self
    {
        $new = clone $this;
        $new->options['imagePreviewTransparencyIndicator'] = $value;

        return $new;
    }
}