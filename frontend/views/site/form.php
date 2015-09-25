<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '开始报名';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-xs-12 col-md-6 col-md-push-3 text-center">
        <div style="font-size:24px;margin:20px 0;">填写报名信息</div>
    </div>
</div>

<div class="row">
    <div class="site-baoming col-xs-12 col-md-6 col-md-push-3">
        <?php $form = \metalguardian\formBuilder\ActiveFormBuilder::begin(); ?>
        <div class="form-group">
        <?= $model_form->desc?>
        </div>
        <?= $form->renderForm($model, $fields_config) ?>
        <div class="form-group">
            <?= Html::submitButton('确认提交', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php \metalguardian\formBuilder\ActiveFormBuilder::end(); ?>
    </div>
</div>
