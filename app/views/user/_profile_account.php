<?php

use app\helpers\Icon;
use app\widgets\ActiveForm;
use app\widgets\InputGroup;
use app\widgets\Pjax;
use yii\bootstrap\Button;

/** @var $this yii\web\View */
/** @var $form app\widgets\ActiveForm */
/** @var $model app\forms\user\Profile */
/** @var $emailId string */

$emailId = \yii\helpers\Html::getInputId($model, 'email');
?>
<?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin([
        'id' => 'user-profile-form',
        'pjax' => true,
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'wrapper' => 'col-sm-10',
            ],
        ],
    ]) ?>

        <?= $form->field($model, 'email')->widget(InputGroup::className(), [
            'inputOptions' => [
                'class' => 'form-control',
                'disabled' => 'disabled',
            ],
            'button' => true,
            'addon' => Button::widget([
                'label' => Icon::icon('glyphicon glyphicon-copy'),
                'encodeLabel' => false,
                'options' => ['class' => 'btn btn-default btn-flat'],
                'clientEvents' => [
                    'click' => new yii\web\JsExpression("function (ev) {
                        ev.preventDefault();
                        $('#{$emailId}').removeAttr('disabled').select();
                        document.execCommand('copy');
                        $('#{$emailId}').attr('disabled', 'disabled');
                    }"),
                ],
            ]),
        ]) ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <?php ActiveForm::endWithActions([
        'cancel' => false,
    ]) ?>        
<?php Pjax::end() ?>
