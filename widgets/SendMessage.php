<?php

namespace yuncms\message\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use yuncms\message\models\MessageSendForm;

class SendMessage extends Widget
{
    /** @var bool */
    public $validate = true;

    /**
     * @var string 收件人用户名
     */
    public $name;

    /** @inheritdoc */
    public function init()
    {
        parent::init();
        if (empty ($this->name)) {
            throw new InvalidConfigException ('The "name" property must be set.');
        }
    }


    /** @inheritdoc */
    public function run()
    {
        $model = new MessageSendForm();
        $model->name = $this->name;
        return $this->render('send_message', [
            'model' => $model
        ]);
    }
}