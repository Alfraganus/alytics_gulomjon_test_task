<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UrlChecker */

$this->title = 'Create Url Checker';
$this->params['breadcrumbs'][] = ['label' => 'Url Checkers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-checker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
