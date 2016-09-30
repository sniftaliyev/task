<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TaskType;

/* @var $this yii\web\View */
/* @var $model app\models\TaskType */

?>
<div class="task-type-form">

    <h1>Please choose default task type</h1>

    <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <?= Html::dropDownList('default_task_id', null,
                ArrayHelper::map(TaskType::find()->where('id!=:id', [':id' => $model->id])->all(),'id','name')
            ) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
