<?php

$layout = 'root';
/** @var Array $data */

/** @var \App\Models\Ideas $ideas */

/** @var \App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<div class="album py-5 bg-light">
    <div class="container-fluid">
        <div class="row g-3 justify-content-center">
            <?php foreach ($data['posts'] as $ideas): ?>
            <div class="d-md-block d-lg-block d-xl-block  col-md-12 col-lg-4 col-xl-3">
                <div class="card shadow-sm">
                    <img src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $ideas->getPicture()?>" class="img-fluid">
                    <div class="card-body">
                        <p class="card-text"> <?= $ideas->getText() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-sm btn-outline-secondary" href="view.html" role="button" aria-disabled="false">View</a>
                                <a href="<?= $link->url('post.edit', ['id' => $ideas->getId()]) ?>" class="btn btn-primary">Edit</a>
                                <a href="<?= $link->url('post.delete', ['id' => $ideas->getId()]) ?>" class="btn btn-danger">Delete</a>
                            </div>
                            <small class="text-muted"><?= $ideas->getDate()?></small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</footer>
</body>
</html>
