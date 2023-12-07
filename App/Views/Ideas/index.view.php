<?php

$layout = 'root';
/** @var Array $data */

/** @var \App\Models\Post $post */

/** @var \App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<div class="album py-5 bg-light">
    <div class="container-fluid">
        <div class="row g-3 justify-content-center">
            <?php foreach ($data['posts'] as $post): ?>
            <div class="d-md-block d-lg-block d-xl-block  col-md-12 col-lg-4 col-xl-3">
                <div class="card shadow-sm">
                    <img src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $post->getPicture()?>" class="img-fluid">
                    <div class="card-body">
                        <p class="card-text"> <?= $post->getText() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-sm btn-outline-secondary" href="view.html" role="button" aria-disabled="false">View</a>
                                <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" class="btn btn-primary">Upraviť</a>
                                <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>"  class="btn btn-danger">Zmazať</a>
                            </div>
                            <small class="text-muted">9 mins</small>
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
