<? if (count($model) > 0) : ?>
    <? foreach ($model as $item) : ?>
        <div class="well">
            <h3><?= $item->title ?></h3>
            <p><?= $item->description ?></p>
            <a href="<?= Yii::$app->urlManager->createUrl('post/view', $item->id) ?>">Detail...</a>
        </div>
    <? endforeach ?>
<? endif ?>
