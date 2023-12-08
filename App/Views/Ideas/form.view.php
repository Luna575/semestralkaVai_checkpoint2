<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */

?>
<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<form method="post" action="<?= $link->url('ideas.save') ?>" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= @$data['ideas']?->getId() ?>">

    <label for="inputGroupFile02" class="form-label">Image file</label>
    <?php if (@$data['ideas']?->getPicture() != ""): ?>
        <div>Original file: <?= substr($data['ideas']->getPicture(), strpos($data['ideas']->getPicture(), '-') + 1)  ?></div>
    <?php endif; ?>
    <div class="input-group mb-3 has-validation">
        <input type="file" class="form-control " name="picture" id="inputGroupFile02">

    </div>
    <label for="ideas-text" class="form-label">Text to describe idea</label>
    <div class="input-group has-validation mb-3 ">
        <textarea class="form-control" aria-label="With textarea" name="text" id="ideas-text"><?= @$data['ideas']?->getText() ?></textarea>
    </div>
    <label for="ideas-text" class="form-label">The subject of idea</label>
    <div class="input-group has-validation mb-3 ">
        <textarea class="form-control" aria-label="With textarea" name="theme" id="ideas-theme" required autofocus><?= @$data['ideas']?->getTheme() ?></textarea>
    </div>
    <label for="ideas-text" class="form-label">The type of idea</label>
    <div class="input-group has-validation mb-3 ">
        <textarea class="form-control" aria-label="With textarea" name="type" id="ideas-type" required autofocus><?= @$data['ideas']?->getType() ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
