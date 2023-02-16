<?php

declare(strict_types=1);

namespace Yii\Forms\Input\Base;

use Yii\Forms\Input\Hidden;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

abstract class AbstractFile extends AbstractInputWidget
{
    use Attribute\CanBeMultiple;
    use Attribute\HasAccept;

    protected Hidden|null $unchecked = null;

    /**
     * Returns a new instance with hidden widget that corresponds to "unchecked" state of the input.
     *
     * @param string $value The value of the "unchecked" state.
     * @param array $values The Attribute values indexed by attribute names for hidden widget.
     *
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     * @throws NotFoundException
     */
    public function unchecked(string $value, array $values = []): self
    {
        $values['value'] = $value;

        $new = clone $this;
        $new->unchecked = Hidden::widget([$this->formModel, $this->attribute])->attributes($values);

        return $new;
    }
}
