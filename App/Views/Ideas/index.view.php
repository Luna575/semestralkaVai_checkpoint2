<?php

use App\Models\Favorites;

$layout = 'root';
/** @var Array $data */

/** @var \App\Models\Ideas $ideas */

/** @var \App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
/** @var int $pocet*/
?>

<div class="album py-5 bg-light">
    <div class="container-fluid">
       <?php $pocet = 0;?>
        <div class="row g-3 justify-content-center"">
        <?php foreach ($data['ideas'] as $ideas): ?>
                <?php if($ideas->getType() == $data['s']|| $data['s']==null) {?>
                <div class="d-md-block d-lg-block d-xl-block  col-md-12 col-lg-4 col-xl-3">
                        <?php $pocet++; ?>
                    <div class="card shadow-sm">
                        <img class="card-img" width="100%" height="350px" src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $ideas->getPicture()?>" alt="...">
                        <div class="card-body">
                            <p class="card-text">Created by:  <?=$ideas->getUser() ?></p>
                            <p class="card-text">Title: <?= $ideas->getTitle() ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-outline-secondary" href="<?= $link->url('ideas.view', ['id' => $ideas->getId()]) ?>" role="button" aria-disabled="false">View</a>
                                    <?php if($auth->isLogged()){?>
                                        <?php if($ideas->getUser() == $auth->getLoggedUserName() || $auth->getLoggedRola() =='a'){?>
                                            <a href="<?= $link->url('ideas.edit', ['id' => $ideas->getId()]) ?>" class="btn btn-primary">Edit</a>
                                            <a href="<?= $link->url('ideas.delete', ['id' => $ideas->getId()]) ?>" class="btn btn-danger">Delete</a>
                                        <?php }?>
                                        <?php $favorites = Favorites::getAll('`name` LIKE ? AND `idea` LIKE ? ', [$auth->getLoggedUserName(),$ideas->getId()]);?>
                                        <?php if($favorites == null){?>
                                            <a class="btn btn-outline-dark heart" href="<?= $link->url("favorites.add", ['user'=>$auth->getLoggedUserName(), 'idea'=> $ideas->getId(), 'path'=> "ideas.index",'par'=>$data['s']]) ?>"><i class="bi bi-heart"></i></a>
                                        <?php }else {?>
                                            <a class="btn btn-outline-dark heart" href="<?= $link->url("favorites.delete", ['user'=>$auth->getLoggedUserName(), 'idea'=> $ideas->getId(), 'path'=> "ideas.index", 'par'=>$data['s']]) ?>"><i class="bi bi-heart-fill"></i></a>
                                        <?php }?>
                                    <?php }?>
                                </div>
                                <small class="text-muted"><?= $ideas->getDate()?> </small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
        <?php endforeach; ?>
        <?php if ($pocet ==0) { ?>
        <div class="col-md-8 p-lg-5 mx-auto my-5">
        <div class="welcome"><h1>There is nothing in this category, sorry</h1></div>
        </div>
        <?php }?>
    </div>
</div>


