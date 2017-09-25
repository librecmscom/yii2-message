<?php

namespace yuncms\message\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use yuncms\message\widgets\models\MessageSendForm;

/**
 * Class SendMessage
 * @package yuncms\message\frontend\widgets
 */
class SendMessage extends Widget
{
    /** @var bool */
    public $validate = true;

    /**
     * @var string 收件人昵称
     */
    public $nickname;

    /** @inheritdoc */
    public function init()
    {
        parent::init();
        if (empty ($this->nickname)) {
            throw new InvalidConfigException ('The "nickname" property must be set.');
        }
    }


    /** @inheritdoc */
    public function run()
    {
        $model = new MessageSendForm();
        $model->nickname = $this->nickname;
        return $this->render('send_message', [
            'model' => $model
        ]);
    }
}