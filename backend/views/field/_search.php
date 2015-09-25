<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FieldSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'form_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'default') ?>

    <?php // echo $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'required') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
