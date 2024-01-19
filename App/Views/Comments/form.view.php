<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var Array $themes */
/** @var \App\Core\IAuthenticator $auth */

?>

<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<form method="post" action="<?= $link->url('comments.save') ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= @$data['comments']?->getId() ?>">
    <?php if($data['idea'] == null){ ?>
    <input type="hidden" name="idea" value="<?= @$data['comments']?->getIdea() ?>">
    <?php } else{ ?>
    <input type="hidden" name="idea" value="<?= @$data['idea']?>">
    <?php }  ?>
    <input type="hidden" name="user" value="<?= $auth->getLoggedUserName()?>">
    <label for="ideas-text" class="form-label"> Write the text of your comment here:</label>
    <div class="input-group has-validation mb-3 ">
        <textarea class="form-control" aria-label="With textarea" name="text" id="ideas-text"><?= @$data['comments']?->getText() ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
