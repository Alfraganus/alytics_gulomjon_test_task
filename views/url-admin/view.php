<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UrlChecker */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Url Checkers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="url-checker-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'url:url',
            'last_checked_at',
            'frequency_interval',
            'attempt',
            'http_code',
        ],
    ]) ?>

</div>
