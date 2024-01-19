<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 d-flex gap-4  flex-column">
            <h1>Sign up</h1>
            <?php if (!is_null(@$data['errors'])): ?>
                <?php foreach ($data['errors'] as $error): ?>
                    <div class="alert alert-danger" role="alert" >
                        <?= $error ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="message" role="alert" id="message">
            </div>
            <form method="post" action="<?= $link->url('users.index') ?>" enctype="multipart/form-data">

                <div class="form-label-group mb-3">
                    <input name="name" type="text" id="name" class="form-control" placeholder="Name" oninput="userExists(this.value)"
                           aria-label="" required autofocus>
                </div>
                <div class="form-label-group mb-3">
                    <input name="password" type="password" id="password" class="form-control"
                           aria-label="" placeholder="Password" required>
                </div>
                <div class="form-label-group mb-3">
                    <input name="verify_password" type="password" id="verify_password" class="form-control"
                          aria-label="" placeholder="Verify password" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>


        </div>
    </div>
</div>