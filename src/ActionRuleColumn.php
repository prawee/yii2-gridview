<?php
/*
 * 2015-03-10
 * @author Prawee Wongsa <prawee@hotmail.com>
 */

namespace prawee\grid;

class ActionRuleColumn extends \yii\grid\ActionColumn
{

    protected function initDefaultButtons()
    {

        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model) {

                return Html::a('<span class="glyphicon glyphicon-eye-open btn btn-xs btn-primary"></span>',
                        $url,
                        [
                        'title' => Yii::t('yii', 'View'),
                        'data-pjax' => '0',
                        'data-toggle' => 'tooltip'
                ]);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model) {

                return Html::a('<span class="glyphicon glyphicon-pencil btn btn-xs btn-warning"></span>',
                        $url,
                        [
                        'title' => Yii::t('yii', 'Update'),
                        'data-pjax' => '0',
                        'data-toggle' => 'tooltip'
                ]);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model) {

                return Html::a('<span class="glyphicon glyphicon-trash btn btn-xs btn-danger"></span>',
                        $url,
                        [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii',
                            'Are you sure you want to delete this item ?'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                        'data-toggle' => 'tooltip'
                ]);
            };
        }
    }
}