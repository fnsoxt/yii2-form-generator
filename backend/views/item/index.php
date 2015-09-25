<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;

$columns = [];
$columns[] = ['class' => 'yii\grid\SerialColumn'];
// $columns[] = 'id';

$fields = $dataProvider->models[0]->form->fields;
foreach ($fields as $key => $value) {
    $id = $value->id;
    $columns[] = [
        'label' => $value->name,
        'content' => function($model) use ($id) {
            if($model->getFields($id))
                return $model->getFields($id)->value;
            else
                return null;
        },
    ];
}

// $columns[] = 'form_id';
$columns[] = 'ip:ntext';
$columns[] = 'create_at:datetime';
$columns[] = ['class' => 'yii\grid\ActionColumn'];

?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Item',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

</div>
