<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */

?>
<?php if($auth->isLogged()){?>
<?php if(@$data['comments']?->getUser() == $auth->getLoggedUserName()|| $auth->getLoggedRola() =='a'){?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 d-flex gap-4  flex-column">
            <h1>Edit your comment</h1>

            <?php require 'form.view.php' ?>

        </div>
    </div>
</div>
    <?php } else {?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 d-flex gap-4  flex-column">
                    <h1>You can not edit this since you are not owner or admin!!
                    </h1>



                </div>
            </div>
        </div>
    <?php }?>
<?php } else {?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 d-flex gap-4  flex-column">
                <h1>If you want to edit your comment, you need to be logged!!!
                    Please sign up.
                </h1>



            </div>
        </div>
    </div>
<?php }?>