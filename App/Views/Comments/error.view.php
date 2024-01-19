<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */

?>
<?php if($auth->isLogged()){?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 d-flex gap-4  flex-column">
            <h1>There was an error</h1>

            <?php require 'form.view.php' ?>

        </div>
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