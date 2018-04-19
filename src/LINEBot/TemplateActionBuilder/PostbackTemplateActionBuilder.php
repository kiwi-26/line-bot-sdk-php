<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace LINE\LINEBot\TemplateActionBuilder;

use LINE\LINEBot\Constant\ActionType;
use LINE\LINEBot\TemplateActionBuilder;

/**
 * A builder class for postback action.
 *
 * @package LINE\LINEBot\TemplateActionBuilder
 */
class PostbackTemplateActionBuilder implements TemplateActionBuilder
{
    /** @var string */
    private $label;
    /** @var string */
    private $data;
    /** @var string|null */
    private $text;
    /** @var bool */
    private $isDisplayOnly;

    /**
     * PostbackAction constructor.
     *
     * @param string $label Label of action.
     * @param string $data Data of postback.
     * @param string|null $text The text which will be sent or displayed when action is executed (optional).
     * @param bool $isDisplayOnly Display only option. If you choose true, the text won't sent to server.
     *                            The text property is deprecated, but default value is false for backward compatibility.
     */
    public function __construct($label, $data, $text = null, $isDisplayOnly = false)
    {
        $this->label = $label;
        $this->data = $data;
        $this->text = $text;
        $this->isDisplayOnly = !is_null($isDisplayOnly) ? $isDisplayOnly : false;
    }

    /**
     * Builds postback action structure.
     *
     * @return array Built postback action structure.
     */
    public function buildTemplateAction()
    {
        $action = [
            'type' => ActionType::POSTBACK,
            'label' => $this->label,
            'data' => $this->data,
        ];

        if (isset($this->text)) {
            if ($this->isDisplayOnly) {
                $action['displayText'] = $this->text;
            } else {
                $action['text'] = $this->text;
            }
        }

        return $action;
    }
}
