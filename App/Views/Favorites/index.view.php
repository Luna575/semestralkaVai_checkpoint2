<?php

use App\Models\Favorites;

$layout = 'root';
/** @var Array $data */

/** @var \App\Models\Ideas $idea */

/** @var \App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
/** @var int $pocet*/
?>
<?php if($auth->isLogged()){?>
<div class="album py-5 bg-light">
    <div class="container-fluid">
        <?php $pocet = 0;?>
        <div class="row g-3 justify-content-center"">
        <?php foreach ($data['favorites'] as $favorite): ?>
        <?php if($favorite->getName() == $auth->getLoggedUserName()) {?>
        <?php $idea = \App\Models\Ideas::getOne($favorite->getIdea())?>
            <div class="d-md-block d-lg-block d-xl-block  col-md-12 col-lg-4 col-xl-3">
                    <?php $pocet++; ?>
                    <div class="card shadow-sm">
                        <img class="card-img" width="100%" height="350px" src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $idea->getPicture()?>" alt="...">
                        <div class="card-body">
                            <p class="card-text">Created by:  <?=$idea->getUser() ?></p>
                            <p class="card-text">Title: <?= $idea->getTitle() ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-outline-secondary" href="<?= $link->url('ideas.view', ['id' => $idea->getId()]) ?>" role="button" aria-disabled="false">View</a>
                                        <?php if($idea->getUser() == $auth->getLoggedUserName() || $auth->getLoggedRola() =='a'){?>
                                            <a href="<?= $link->url('ideas.edit', ['id' => $idea->getId()]) ?>" class="btn btn-primary">Edit</a>
                                            <a href="<?= $link->url('ideas.delete', ['id' => $idea->getId()]) ?>" class="btn btn-danger">Delete</a>
                                        <?php }?>
                                    <a class="btn btn-outline-dark heart" href="<?= $link->url("favorites.delete", ['user'=>$auth->getLoggedUserName(), 'idea'=> $idea->getId(), 'path'=> "favorites.index"]) ?>"><i class="bi bi-heart-fill"></i></a>
                                </div>
                                <small class="text-muted"><?= $idea->getDate()?> </small>
                            </div>
                        </div>
                    </div>
            </div>
        <?php }?>
        <?php endforeach; ?>
        <?php if ($pocet ==0) { ?>
            <div class="col-md-8 p-lg-5 mx-auto my-5">
                <div class="welcome"><h1>Your favorite list is empty</h1></div>
            </div>
        <?php }?>
    </div>
</div>
<?php } else {?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 d-flex gap-4  flex-column">
                <h1>You need to be logged to see this page!!!
                    Please sign up.
                </h1>



            </div>
        </div>
    </div>
<?php }?>


