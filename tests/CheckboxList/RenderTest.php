<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CheckboxList;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
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

    /** @var string[] */
    private array $sex = [1 => 'Female', 2 => 'Male'];

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testBoolean(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="testform-array">Do you like this post?</label>
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="0">No</label>
            <label><input name="TestForm[array][]" type="checkbox" value="1">Yes</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->boolean()->label('Do you like this post?')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testContainerWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->container(false)->items($this->sex)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test-class" id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->containerAttributes(['class' => 'test-class'])
                ->items($this->sex)
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </article>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->containerTag('article')->items($this->sex)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testIndividualItemsAttributes(): void
    {
        // Set disabled `[1 => ['disabled' => 'true']]`, `[2 => ['class' => 'test-class']]`.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1" disabled>Female</label>
            <label><input class="test-class" name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->individualItemsAttributes([1 => ['disabled' => true], 2 => ['class' => 'test-class']])
                ->items($this->sex)
                ->render(),
        );

        // Set required `[1 => ['required' => 'true']]`, and `[2 => ['disabled' => 'true']]`.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1" required>Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2" disabled>Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->items($this->sex)
                ->individualItemsAttributes([1 => ['required' => true], 2 => ['disabled' => true]])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testItemsAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input class="test-class" name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input class="test-class" name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->items($this->sex)
                ->itemsAttributes(['class' => 'test-class'])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="testform-array">Select your gender?</label>
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->items($this->sex)
                ->label('Select your gender?')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label class="test-class" for="testform-array">Select your gender?</label>
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->items($this->sex)
                ->label('Select your gender?')
                ->labelAttributes(['class' => 'test-class'])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label class="test-class" for="testform-array">Select your gender?</label>
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->items($this->sex)
                ->label('Select your gender?')
                ->labelClass('test-class')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testRender(): void
    {
        $this->assertEmpty(CheckboxList::widget([new TestForm(), 'array'])->render());

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="red">Red</label>
            <label><input name="TestForm[array][]" type="checkbox" value="blue">Blue</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->items(['red' => 'Red', 'blue' => 'Blue'])->render(),
        );
    }
}
