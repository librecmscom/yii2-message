<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'message-form',
    'action' => ['/message/message/send']
]); ?>
<?= $form->field($model, 'nickname')->label(false)->hiddenInput(); ?>
<?= $form->field($model, 'message')->label(false)->textarea(['class' => 'form-control']) ?>

<?= Html::submitButton(Yii::t('message', 'Send'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

