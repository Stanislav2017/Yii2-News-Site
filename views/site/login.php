<?
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1>Login</h1>
        <hr>
        <? $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        <? ActiveForm::end(); ?>
    </div>
</div>
