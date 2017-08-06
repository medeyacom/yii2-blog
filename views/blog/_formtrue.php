<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use kartik\widgets\FileInput;





/* @var $this yii\web\View */
/* @var $model medeyacom\Blog */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="blog-form">

<?php 
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']
]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 200,
        #'formatting' =>['p','blockquots', 'h2','h1'],
        'imageUpload' => \yii\helpers\Url::to(['/site/save-redactor-img','sub'=>'blog']),
        'plugins' => [
            'clips',
            'fullscreen'
        ]
    ]
])?>

<?= $form->field ($model, 'file')->widget(\kartik\file\FileInput::classname(), [
'options'=> ['accept'=> 'image/*'],
    'pluginOptions' => [
        'showCaption' => false,
        'showRemove' => false,
        'showUpload' => false,
        'browseClass' => 'btn btn-primary btn-block',
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'browseLabel' =>  'Выбрать фото'
         ],
    ]);?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->dropDownList(\medeyacom\Blog::STATUS_LIST) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'tags_array')->widget(\kartik\select2\Select2::classname(), [
    'data' =>\yii\helpers\ArrayHelper::map(\medeyacom\Tag::find()->all(),'id','name'), 
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбрать tag...','multiple'=> true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags'=>true,
        'maximumInputLength'=> 10
    ],
]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


