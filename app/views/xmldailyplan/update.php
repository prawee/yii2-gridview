<?php

//use yii\helpers\Html;

$this->title = 'Update Xml: ' . ' ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Xmls', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="xml-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
