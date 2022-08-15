<?php

use app\models\UrlChecker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UrlCheckerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Url Checkers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-checker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Url Checker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'url:url',
            'frequency_interval',
            'check_repetition_if_error',
        ],
    ]); ?>


</div>
