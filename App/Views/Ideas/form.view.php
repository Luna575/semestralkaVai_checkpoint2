<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var Array $themes */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Themes $theme */

?>

<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<div class="message" role="alert" id="message">
</div>
<div class="message2" role="alert" id="message2">
</div>
<form method="post" action="<?= $link->url('ideas.save') ?>" enctype="multipart/form-data">
    <input type="hidden" name="path" value="<?= @$data['path'] ?>">
    <input type="hidden" name="s" value="<?= @$data['s'] ?>">
    <input type="hidden" name="id" value="<?= @$data['ideas']?->getId() ?>">
    <input type="hidden" name="user" value="<?= $auth->getLoggedUserName()?>">
    <label for="inputGroupFile02" class="form-label">Image file</label>
    <?php if (@$data['ideas']?->getPicture() != ""): ?>
        <div>Original file: <?= substr($data['ideas']->getPicture(), strpos($data['ideas']->getPicture(), '-') + 1)  ?></div>
    <?php endif; ?>
    <div class="input-group mb-3 has-validation">
        <input type="file" class="form-control " name="picture" id="inputGroupFile02" oninput="pictureExists(this.value.replace(/.*[\/\\]/, ''), <?=@$data['ideas']?->getId()?>)">
    </div>
    <label for="ideas-text" class="form-label">Text to describe idea</label>
    <div class="input-group has-validation mb-3 ">
        <textarea class="form-control" aria-label="With textarea" name="text" id="ideas-text"><?= @$data['ideas']?->getText() ?></textarea>
    </div>
    <label for="ideas-title" class="form-label">Title of idea</label>
    <div class="input-group has-validation mb-3 ">
        <textarea class="form-control" aria-label="With textarea" name="title" id="ideas-title" oninput="titleExists(this.value, <?=@$data['ideas']?->getId()?>)" required autofocus><?= @$data['ideas']?->getTitle() ?></textarea>
    </div>
    <label for="ideas-type" class="form-label">The type of idea</label>
    <div class="input-group has-validation mb-2 ">
        <label for="cars">Choose a theme:</label>
        <?php $themes= \App\Models\Themes::getAll()?>
        <?php if ($themes != null) {?>
            <select name="type" id="ideas-type" required autofocus>
        <?php foreach ($themes as $theme) :?>
        <?php if($theme->getText() != "" ){?>
                <?php if( @$data['ideas']?->getType() == $theme->getId()) {?>
                <option value="<?= $theme->getId()?>" selected="selected"><?=$theme->getText()?></option>
                <?php } else {?>
                <option value="<?= $theme->getId()?>"><?=$theme->getText()?></option>
                <?php }?>
        <?php }?>
        <?php endforeach;?>
            </select>
        <?php }?>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

