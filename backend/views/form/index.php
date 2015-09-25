<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Forms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Form',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'desc:ntext',
            // 'template_name',
            'status:boolean',
            // 'options:ntext',
            'create_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{field}<br>{data}',
                'buttons' => [
                    'field' => function($url,$moel,$key){
                        return Html::a('表单选项',Url::to(['field/index','FieldSearch[form_id]'=>$key,'FieldSearch[order]'=>'','FieldSearch[required]'=>'']));
                    },
                    'data' => function($url,$moel,$key){
                        return Html::a('表单数据',Url::to(['item/index','ItemSearch[form_id]'=>$key]));
                    },
                ],
            ],
        ],
    ]); ?>

</div>
