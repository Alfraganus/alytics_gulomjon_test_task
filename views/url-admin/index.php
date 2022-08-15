<?php

use app\models\UrlChecker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UrlCheckerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Url Check admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-checker-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'date',
                "value" => function ($model) {
                    return date('d-m-Y h:i', strtotime($model->date));
                },
            ],

            'is_available:boolean',
            'has_error:boolean',
            'url:url',
            'frequency_interval',
            'attempt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UrlChecker $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
