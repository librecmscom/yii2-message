<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yuncms\message\models\Message;

/** @var \yuncms\message\models\Message $model */
/** @var \yuncms\message\models\Message $message */
$message = $model->lastMessage;

if ($message->isRecipient()) {//收件人是自己 别人对你说
    $form = Html::a($message->from->nickname, ['/user/space/view', 'id' => $message->from_id], ['rel' => 'author']);
    $to = Html::a(Yii::t('message', 'You'), ['/user/space/view', 'id' => $message->user_id], ['rel' => 'author']);
} else {//你对别人说
    $form = Html::a(Yii::t('message', 'You'), ['/user/space/view', 'id' => $message->from_id], ['rel' => 'author']);
    $to = Html::a($message->user->nickname, ['/user/space/view', 'id' => $message->user_id], ['rel' => 'author']);
}
?>

<div class="media-left">
    <a href="<?= Url::to(['/user/space/view', 'id' => $message->from_id]); ?>" rel="author">
        <img class="media-object" src="<?= $message->from->getAvatar('small'); ?>" alt="utf-8">
    </a>
</div>

<div class="media-body">
    <div class="media-heading">
        <?= Yii::t('message', '{form} say to {to}', ['form' => $form, 'to' => $to,]); ?>
    </div>
    <div class="media-content"><?= mb_substr(Html::encode($message->message), 0, 100) ?></div>
    <div class="media-action"><?= Yii::$app->formatter->asRelativeTime($message->created_at); ?>
        <span class="pull-right">
                    <?= $message->status == Message::STATUS_NEW ? Yii::t('message', 'Unread') : Yii::t('message', 'Read'); ?>
            |
                    <a href="<?= Url::to(['/message/message/view', 'id' => $message->parent ? $message->parent : $message->id]); ?>"><?= Yii::t('message', 'Detail'); ?>
                        (<?= $model->getMessages()->count() ?>)</a>
                </span>
    </div>
</div>
