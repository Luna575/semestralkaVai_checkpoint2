<?php

$layout = 'auth';
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            You sing out. <br>
            You can <a href="<?= \App\Config\Configuration::LOGIN_URL ?>">sign in</a> again or return <a
                    href="<?= $link->url("home.index") ?>">back</a> to home page.
        </div>
    </div>
</div>
