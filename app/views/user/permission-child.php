<?php

use yii\bootstrap\Modal;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\fancytree\FancytreeWidget;
use yii\web\JsExpression;
use kartik\widgets\Alert;

Modal::begin([
    'id' => 'form-modal',
    'header' => Icon::show('cog') . '<b>Permission</b>',
    'closeButton'=>[
        'aria-hidden' =>'true',
        'class'=>'hide',
    ]
]);

if (Yii::$app->session->hasFlash('error-modal')):
    echo Alert::widget([
        'type' => Alert::TYPE_DANGER,
        'title' => 'Delete!',
        'icon' => 'glyphicon glyphicon-remove-sign',
        'body' => Yii::$app->session->getFlash('error-modal'),
        'showSeparator' => true,
        'delay' => 8000
    ]);
endif;
if (Yii::$app->session->hasFlash('success-modal')):
    echo Alert::widget([
        'type' => Alert::TYPE_SUCCESS,
        'title' => 'Success!',
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => Yii::$app->session->getFlash('success-modal'),
        'showSeparator' => true,
        'delay' => 3000
    ]);
endif;
if (Yii::$app->session->hasFlash('info-modal')):
    echo Alert::widget([
        'type' => Alert::TYPE_INFO,
        'title' => 'Info!',
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => Yii::$app->session->getFlash('info-modal'),
        'showSeparator' => true,
        'delay' => 3000
    ]);
endif;

$roles = Yii::$app->authManager->getRoles();
$items=null;
$data=null;

$form = ActiveForm::begin([
    'id' => 'assign-form',
    'enableAjaxValidation' =>true,
    'options'=>['class'=>'form-inline']
]);
foreach($roles as $role){
    $items['title']=ucfirst($role->description);
    $items['key']=$role->name;
    $items['folder']=true;
    $items['expanded']=true;
    

    $chkAuth=Yii::$app->authManager->getAssignment($role->name,$user->id);
    $items['selected']=is_null($chkAuth)?false:true;

    $permissions=Yii::$app->authManager->getPermissionsByRole($role->name);
    $items['children']=null;
    $childrenCount=0;
    foreach ($permissions as $permission) {
        $chkPermission=Yii::$app->authManager->getAssignment($permission->name,$user->id);
        $childrenCount+=is_null($chkPermission)?0:1;
        $items['children'][] = [
            'title' => ucfirst($permission->description),
            'key' => $permission->name,
            'selected'=>(is_null($chkPermission)?false:true)
        ];
    }
    
    //adding expanded
    //$items['expanded']=$childrenCount>0?true:false;

    $data[]=$items;
}
echo FancytreeWidget::widget([
    'class'=>'expanded',
    'options' =>[
        'checkbox'=>true,
        'keep_selected_style'=>true,
        'source' => $data,
        'extensions'=>['dnd','glyph','childcounter'],
        'glyph'=>[
            'map'=>[
            ]
        ],
        'dnd' => [
            'preventVoidMoves' => true,
            'preventRecursiveMoves' => true,
        ],
        'childcounter'=>[
            'deep'=>true,
            'hideZeros'=>true,
            'hideExpanded'=>true,
        ],
        'select'=>new JsExpression('function(node,data){
            if(data.node.key){
                $.ajax({
                    url:"assignment",
                    data:{key:data.node.key,type:data.node.selected,userid:"'.$user->id.'"},
                    success:function(){
                        window.location.reload();
                    }
                });
            }
         }'),
    ]
]);
?>
<br/>
<div class="form-group">
    <?= Html::submitButton('Assign', ['class' => 'btn hide btn-success', 'name' => 'assign-button']) ?>
    <?= Html::a(Icon::show('times-circle').'Close',['/user/child','id'=>Yii::$app->getRequest()->get('ref')],[
        'class' => 'btn btn-danger', 
        'name' => 'assign-button',
    ]) ?>
</div>
<?php
ActiveForm::end();
Modal::end();

?>


<style type="text/css">
span.fancytree-icon {
  position: relative;
}
span.fancytree-childcounter {
  color: #fff;
  background: #428BCA;
/*  border: 1px solid gray; */
  position: absolute;
  top: -6px;
  right: -6px;
  min-width: 10px;
  height: 10px;
  line-height: 1;
  vertical-align: baseline;
  border-radius: 10px; /*50%;*/
  padding: 2px;
  text-align: center;
  font-size: 9px;
}
</style>
