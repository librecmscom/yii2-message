<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('message', 'Send Message');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-12 main">
        <h2 class="h3 profile-title">
            <?= Yii::t('message', 'Send Message'); ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?= Url::to(['/message/message/index']); ?>"><?= Yii::t('message', 'Back to message list'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'nickname')->label(Yii::t('message','Username'))->input('', ['placeholder' => Yii::t('message','Please enter a user name')]); ?>
                <?= $form->field($model, 'message')->label(Yii::t('message','Message content'))->textarea(['placeholder' => Yii::t('message','Please enter the message content')]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('message','Send Message'), ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>