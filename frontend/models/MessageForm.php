<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\message\frontend\models;

use Yii;
use yii\base\Model;
use yuncms\message\models\Message;

/**
 * Class MessageForm
 * @package yuncms\user\models
 */
class MessageForm extends Model
{

    public $parent;
    public $message;
    public $nickname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['message', 'filter', 'filter' => 'trim'],
            ['message', 'required'],

            ['parent', 'filter', 'filter' => 'trim'],
            ['parent', 'required'],

            ['nickname', 'filter', 'filter' => 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message' => Yii::t('message', 'Message'),
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $new = new Message();
            $new->from_id = Yii::$app->user->getId();
            $new->message = $this->message;
            if (!empty($this->parent)) {
                $message = Message::findOne($this->parent);
                if ($message->from_id == Yii::$app->user->getId()) {
                    $new->user_id = $message->user_id;
                } else {
                    $new->user_id = $message->from_id;
                }
                $new->link('parent', $message);
            } else {
                /** @var \yuncms\user\models\User $userClass */
                $userClass = Yii::$app->user->identityClass;
                $user = $userClass::findOne(['nickname' => $this->nickname]);
                $new->user_id = $user->id;
            }
            return $new->save();
        }
        return false;
    }
}