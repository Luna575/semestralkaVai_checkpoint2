<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
use App\Models\Favorites;
?>
<div class="position-relative d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end text-end">
        <ul class="heart">
<?php if($auth->isLogged()){?>
    <?php $favorites = Favorites::getAll('`name` LIKE ? AND `idea` LIKE ? ', [$auth->getLoggedUserName(),@$data['ideas']->getId()]);?>
    <?php if($favorites == null){?>
        <a class="btn btn-outline-dark heart" href="<?= $link->url("favorites.add", ['user'=>$auth->getLoggedUserName(), 'idea'=> @$data['ideas']->getId(), 'path'=> "ideas.view", 'par'=>['id'=>@$data['ideas']->getId()]]) ?>"><i class="bi bi-heart"></i></a>
    <?php }else {?>
        <a class="btn btn-outline-dark heart" href="<?= $link->url("favorites.delete", ['user'=>$auth->getLoggedUserName(), 'idea'=> @$data['ideas']->getId(), 'path'=> "ideas.view", 'par'=>['id'=>@$data['ideas']->getId()]]) ?>"><i class="bi bi-heart-fill"></i></a>
    <?php }?>
<?php }?>
        </ul>
</div>
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
        <div class="welcome"><h1><?=@$data['ideas']->getTitle() ?></h1></div>
    </div>
</div>

<div class="img-view">
    <img class="d-block w-100" src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' .@$data['ideas']->getPicture() ?>" alt="...">
</div>

<div class="position-relative p-3 p-md-5 m-md-3 d-md-block text-right">
    <h3><?=@$data['ideas']->getText() ?></h3>
    <h2>Created by: <?=@$data['ideas']->getUser() ?></h2>
</div>
<div class="album py-5 bg-light">
    <div class="container-fluid">
        <div class="row g-3 justify-content-center"">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end text-end">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("comments.add", ['idea'=>$data['ideas']->getId()]) ?>"><button type="button" class="btn btn-outline-dark me-2">+</button></a>
                </li>
            </ul>
        </div>
        <?php if($data['comments'] != null) {?>
            <div class="col-md-8 p-lg-5 mx-auto my-5">
                <div class="welcome"><h1>Comments:</h1></div>
            </div>
            <?php foreach ($data['comments'] as $comments): ?>
                <div class=" p-3 d-flex flex-wrap align-items-center justify-content-lg-start text-start">
                        <div class="head">
                            <p class="text comments">Created by:  <?=$comments->getUser() ?></p>
                            <p class="text comments" ><?= $comments->getText() ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="body">
                                <div class="btn-group">
                                    <?php if($auth->isLogged()){?>
                                        <?php if($comments->getUser() == $auth->getLoggedUserName() || $auth->getLoggedRola() =='a'){?>
                                            <a href="<?= $link->url('comments.edit', ['id' => $comments->getId()]) ?>" class="btn btn-primary">Edit</a>
                                            <a href="<?= $link->url('comments.delete', ['id' => $comments->getId()]) ?>" class="btn btn-danger">Delete</a>
                                        <?php }?>
                                    <?php }?>
                                </div>
                                <small class="text-muted"><?= $comments->getDate()?> </small>
                            </div>
                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
        <?php } else {?>
            <div class="col-md-8 p-lg-5 mx-auto my-5">
                <div class="welcome"><h1>There are no comments</h1></div>
            </div>
        <?php }?>
    </div>
</div>
