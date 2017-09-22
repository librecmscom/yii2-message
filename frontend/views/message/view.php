<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yuncms\user\models\Message;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('message', 'Message Inbox');
//$this->params['breadcrumbs'][] = $this->title;

if ($model->isRecipient()) {//收件人是自己
    $dialogue = Html::a($model->from->nickname, ['/user/space/view', 'id' => $model->from_id], ['rel' => 'author']);
} else {
    $dialogue = Html::a($model->user->nickname, ['/user/space/view', 'id' => $model->user_id], ['rel' => 'author']);
}
?>
<div class="row">
    <div class="col-xs-12 col-md-12 main">
        <h2 class="h3 profile-title">
            <?= Yii::t('message', 'Dialogue in {dialogue}', ['dialogue' => $dialogue]); ?>
            <div class="pull-right">
                <a class="btn btn-primary"
                   href="<?= Url::to(['/message/message/index']); ?>"><?= Yii::t('message', 'Back to message list'); ?></a>
            </div>
        </h2>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['tag' => 'li', 'class' => 'media'],
            'itemView' => '_view_item',//子视图
            'layout' => "{items}\n{pager}",
            'options' => [
                'tag' => 'ul',
                'class' => 'media-list'
            ]
        ]); ?>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => "{input}{error}\n{hint}",
                    ],
                ]); ?>
                <?= $form->field($formModel, 'parent', ['template' => '{input}'])->hiddenInput() ?>
                <?= $form->field($formModel, 'message')->textarea() ?>
                <div class="form-group">
                    <span class="send-tip stp2"><?= Yii::t('message', 'Click the SEND button to send the message'); ?></span>
                    <div class="pull-right">
                        <button type="reset" class="btn btn-primary resetbtn"><?= Yii::t('message', 'Reset'); ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('message', 'Send') ?></button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
