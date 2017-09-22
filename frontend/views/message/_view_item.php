<?php
use yii\helpers\Html;
use yii\helpers\Url;
if ($model->isRecipient()) {//收件人是自己 别人对你说
    $form = Html::a($model->from->nickname, ['/user/space/view', 'id' => $model->from_id], ['rel' => 'author']);
    $to = Html::a(Yii::t('message', 'You'), ['/user/space/view', 'id' => $model->user_id], ['rel' => 'author']);

} else {//你对别人说
    $form = Html::a(Yii::t('message', 'You'), ['/user/space/view', 'id' => $model->from_id], ['rel' => 'author']);
    $to = Html::a($model->user->nickname, ['/user/space/view', 'id' => $model->user_id], ['rel' => 'author']);
}
?>
<div class="media-left">
    <a href="<?= Url::to(['/user/space/view', 'id' => $model->from_id]); ?>" rel="author">
        <img class="media-object" src="<?= $model->from->getAvatar('small'); ?>" alt="utf-8">
    </a>
</div>

<div class="media-body">
    <div class="media-heading">
        <?= Yii::t('message', '{form} say to {to}', ['form' => $form, 'to' => $to,]); ?>
        <?php if($model->isRecipient() && !$model->isRead()):?>
            <?php $model->setRead();?>
        <span class="badge" style="background-color: #f52c32">new</span>
        <?php endif;?>
    </div>
    <div class="media-content"><?= mb_substr(Html::encode($model->message), 0, 100) ?></div>
    <div class="media-action">
        <?= Yii::$app->formatter->asRelativeTime($model->created_at); ?>
    </div>
</div>