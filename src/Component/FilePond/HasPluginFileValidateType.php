<?php

declare(strict_types=1);

namespace Yii\Forms\Component\FilePond;

/**
 * HasPluginFileValidateType provides methods for managing the file validate type plugin.
 */
trait HasPluginFileValidateType
{
    private string $fileValidateTypeDetectType = '';

    /**
     * Return new instance with enable or disable file type validation.
     *
     * @param bool $value Enable or disable file type validation. Default: `true`.
     */
    public function allowFileTypeValidation(bool $value): self
    {
        $new = clone $this;
        $new->options['allowFileTypeValidation'] = $value;

        return $new;
    }

    /**
     * Return new instance with accepted file types. Can be mime types or wild cards.
     * For instance ['image/*'] will accept all images. ['image/png', 'image/jpeg'] will only accepts PNGs and JPEGs.
     *
     * @param array $value Accepted file types. Default: `[]`.
     */
    public function acceptedFileTypes(array $value): self
    {
        $new = clone $this;
        $new->options['acceptedFileTypes'] = $value;

        return $new;
    }

    /**
     * Return new instance specifies function that receives a file and the type detected by FilePond, should return a
     * Promise, resolve with detected file type, reject if can't detect.
     *
     * @param string $value Specifies function that receives a file and the type detected by FilePond.
     *
     * Code example:
     * ```JS
     * acceptedFileTypes: ['image/png'],
     * fileValidateTypeDetectType: (source, type) =>
     *     new Promise((resolve, reject) => {
     *     // Do custom type detection here and return with promise
     *
     *     resolve(type);
     * }),
     * ```
     *
     * @link https://pqina.nl/filepond/docs/api/plugins/file-validate-type/#custom-type-detection
     */
    public function fileValidateTypeDetectType(string $value): self
    {
        $new = clone $this;
        $new->fileValidateTypeDetectType = $value;

        return $new;
    }

    /**
     * Return new instance with message shown to indicate the allowed file types. Available placeholders are {allTypes},
     * {allButLastType}, {lastType}.
     *
     * @param string $value Message shown to indicate the allowed file types.
     * Default: 'Expects {allButLastType} or {lastType}'.
     */
    public function fileValidateTypeLabelExpectedTypes(string $value): self
    {
        $new = clone $this;
        $new->options['fileValidateTypeLabelExpectedTypes'] = $value;

        return $new;
    }

    /**
     * Return new instance allows mapping the file type to a more visually appealing label,
     * { 'image/jpeg': '.jpg' } will show .jpg in the expected types label. Set to null to hide a type from the label.
     *
     * @param array $values Allows mapping the file type to a more visually appealing label. Default: `[]`.
     */
    public function fileValidateTypeLabelExpectedTypesMap(array $values): self
    {
        $new = clone $this;
        $new->options['fileValidateTypeLabelExpectedTypesMap'] = $values;

        return $new;
    }

    /**
     * Return new instance with label for file type not allowed error.
     *
     * @param string $value Label for file type not allowed error. Default: `File type not allowed`.
     */
    public function labelFileTypeNotAllowed(string $value): self
    {
        $new = clone $this;
        $new->options['labelFileTypeNotAllowed'] = $value;

        return $new;
    }
}
