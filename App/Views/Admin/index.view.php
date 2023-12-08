<?php

/** @var \App\Core\IAuthenticator $auth */ ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div>
                Welcome, <strong><?= $auth->getLoggedUserName() ?></strong>!<br><br>
                This part is visible only when you are logged in.
            </div>
        </div>
    </div>
</div>