<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\icons\Icon;
Icon::map($this);


Modal::begin([
    'id' =>'form-modal',
    'header' => Icon::show('cog') . '<b>Import XML</b>',
    'closeButton'=>[
        'aria-hidden' =>'true',
        'class'=>'hide',
    ]
]);

?>

<div class="xml-form">

    <?php $form = ActiveForm::begin([
        'validateOnType'=>true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model)?>
    
    <?= $form->field($model, 'name')->fileInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Icon::show('plus').'Create' : Icon::show('edit').'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Icon::show('times-circle').'Close',['/xmldailyplan/index'],[
        'class' => 'btn btn-danger', 
        'name' => 'assign-button',
    ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
Modal::end();