<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
<header class="p-3 bg-white text-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="public/images/logo_vaii.jpg" class="logo" alt="Responsive Image" >
        </a>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 mb-md-0">
                <li><a href="<?= $link->url("home.index.view")?>" class="nav-link text-secondary">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ideas</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= $link->url("ideas.index")?>"><i class="bi bi-book"></i> All</a></li>
                        <li><a class="dropdown-item" href="<?= $link->url("ideas.index")?>"><i class="bi bi-pencil"></i> Drawings</a></li>
                        <li><a class="dropdown-item" href="<?= $link->url("ideas.index")?>"><i class="bi bi-backpack2"></i> Activity</a></li>
                        <li><a class="dropdown-item" href="<?= $link->url("ideas.index")?>"><i class="bi bi-file-image"></i> Pictures</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</header>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
<footer class="mt-auto">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="home.html" class="nav-link px-2 text-secondary">Home</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">All</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">Drawings</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">Activity</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">Pictures</a></li>
    </ul>
</footer>
</body>
</html>
