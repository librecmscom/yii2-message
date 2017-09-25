<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\message\widgets\models;

use Yii;
use yii\base\Model;
use yuncms\message\models\Message;

/**
 * Class MessageSendForm
 * @package yuncms\user\models
 */
class MessageSendForm extends Model
{

    /**
     * @var int 用户ID
     */
    public $user_id;

    /**
     * @var string 用户昵称
     */
    public $nickname;

    /**
     * @var string 消息内容
     */
    public $message;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'nickname'], 'required'],
            [['nickname', 'message'], 'filter', 'filter' => 'trim'],
            ['nickname', 'validateNickname'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('message', 'User ID'),
            'nickname' => Yii::t('message', 'Nickname'),
            'message' => Yii::t('message', 'Message Body'),
        ];
    }

    /**
     * 验证用户是否已存在
     * @param string $attribute
     * @param array $params
     */
    public function validateNickname($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->_user) {
                $this->addError($attribute, Yii::t('message', 'You enter the user name does not exist oh！'));
            }
        }
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->getUser();
            return true;
        }
        return false;
    }

    public function save()
    {
        if ($this->validate()) {
            $new = new Message();
            $new->from_id = Yii::$app->user->getId();
            $new->user_id = $this->_user->id;
            $new->message = $this->message;
            return $new->save();
        }
        return false;
    }

    /**
     * 通过手机号查询已经报名的用户
     *
     * @return \yuncms\user\models\User
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $userClass = Yii::$app->user->identityClass;
            $this->_user = $userClass::findOne(['nickname' => $this->nickname]);
        }
        return $this->_user;
    }
}