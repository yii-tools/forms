<?php

declare(strict_types=1);

namespace Yii\Forms\Component\FilePond;

/**
 * HasPluginImageCrop provides methods for managing the plugin image crop.
 */
trait HasPluginImageCrop
{
    /**
     * Return new instance with enable or disable image crop.
     *
     * @param bool $value Enable or disable image crop. Default: `true`.
     */
    public function allowImageCrop(bool $value): self
    {
        $new = clone $this;
        $new->options['allowImageCrop'] = $value;

        return $new;
    }

    /**
     * Return new instance with the aspect ratio of the crop in human readable format, for example '1:1' or '16:10'.
     *
     * @param string $value The aspect ratio of the crop. Default: `null`.
     */
    public function imageCropAspectRatio(string $value): self
    {
        $new = clone $this;
        $new->options['imageCropAspectRatio'] = $value;

        return $new;
    }
}
