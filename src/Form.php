<?php

declare(strict_types=1);

namespace Yii\Forms;

use Yii\Html\Tag;
use Yiisoft\Http\Method;

use function explode;
use function implode;
use function strpos;
use function substr;
use function urldecode;

/**
 * A form is a component of a web page that has form controls, such as text, buttons, checkboxes, range, or color
 * picker controls. A user can interact with such a form, providing data that can then be sent to the server for
 * further processing (e.g. returning the results of a search or calculation). No client-side scripting is needed in
 * many cases, though an API is available so that scripts can augment the user experience or use forms for purposes
 * other than submitting data to a server.
 *
 * Writing a form consists of several steps, which can be performed in any order: writing the user interface,
 * implementing the server-side processing, and configuring the user interface to communicate with the server.
 *
 * @link https://www.w3.org/TR/html52/sec-forms.html
 */
final class Form extends Base\AbstractForm
{
    /**
     * @return string the generated form start tag.
     *
     * {@see end())}
     */
    public function begin(): string
    {
        parent::begin();

        $attributes = $this->attributes;
        $action = $this->action;
        $hiddenInputs = [];

        if ($this->csrfToken !== '' && $this->method === Method::POST) {
            $hiddenInputs[] = Tag::create(
                'input',
                '',
                ['name' => $this->csrfName, 'type' => 'hidden', 'value' => $this->csrfToken],
            );
        }

        if ($this->method === Method::GET && ($pos = strpos($action, '?')) !== false) {
            /**
             * Query parameters in the action are ignored for GET method we use hidden fields to add them back.
             */
            foreach (explode('&', substr($action, $pos + 1)) as $pair) {
                if (($pos1 = strpos($pair, '=')) !== false) {
                    $hiddenInputs[] = Tag::create(
                        'input',
                        '',
                        [
                            'name' => urldecode(substr($pair, 0, $pos1)),
                            'type' => 'hidden',
                            'value' => urldecode(substr($pair, $pos1 + 1)),
                        ],
                    );
                } else {
                    $hiddenInputs[] = Tag::create('input', '', ['name' => urldecode($pair), 'type' => 'hidden']);
                }
            }

            $action = substr($action, 0, $pos);
        }

        if ('' !== $action) {
            $attributes['action'] = $action;
        }

        if ('' !== $this->method) {
            $attributes['method'] = $this->method;
        }

        if ('' !== $this->csrfToken) {
            $attributes[$this->csrfName] = $this->csrfToken;
        }

        $form = Tag::begin('form', $attributes);

        if (!empty($hiddenInputs)) {
            $form .= PHP_EOL . implode(PHP_EOL, $hiddenInputs);
        }

        return $form;
    }

    protected function run(): string
    {
        return Tag::end('form');
    }
}
