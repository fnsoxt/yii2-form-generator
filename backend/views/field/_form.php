<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Field */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_id')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'default')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'required')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
