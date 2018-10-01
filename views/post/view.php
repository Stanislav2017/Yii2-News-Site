<?

use yii\widgets\DetailView;

?>

<?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        'description:ntext',
        'user_id',
        'created_at',
    ],
]) ?>