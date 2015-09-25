<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Form */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Form',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
