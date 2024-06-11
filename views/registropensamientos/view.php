<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Registropensamientos $model */

$this->title = $model->regpen;
$this->params['breadcrumbs'][] = ['label' => 'Registropensamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registropensamientos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'regpen' => $model->regpen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'regpen' => $model->regpen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'regpen',
            'identrada',
            'codpen',
        ],
    ]) ?>

</div>
