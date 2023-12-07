
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex flex-column min-vh-100">
<header class="p-3 bg-white text-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo_vaii.jpg" class="logo" alt="Responsive Image" >
        </a>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 mb-md-0">
                <li><a href="home.html" class="nav-link text-dark">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-secondary" href="ideas.html" data-bs-toggle="dropdown" aria-expanded="false">Ideas</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ideas.html"><i class="bi bi-book"></i> All</a></li>
                        <li><a class="dropdown-item" href="ideas.html"><i class="bi bi-pencil"></i> Drawings</a></li>
                        <li><a class="dropdown-item" href="ideas.html"><i class="bi bi-backpack2"></i> Activity</a></li>
                        <li><a class="dropdown-item" href="ideas.html"><i class="bi bi-file-image"></i> Pictures</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-link text-dark">About</a></li>
            </ul>

            <div class="text-end">
                <button type="button" class="btn btn-outline-dark me-2">Login</button>
                <button type="button" class="btn btn-dark">Sign-up</button>
            </div>
        </div>
    </div>
</header>
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
        <div class="welcome"><h1>Here will be Title</h1></div>
    </div>
</div>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators bg-dark">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="images/camera-1867296_640.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/girl-1641215_640.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/analysis-4402809_640.jpg" alt="Third slide">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class=" d-none d-md-block">
    <h3>Description</h3>
    <h2>This will contain description of the picture, drawing or activity after the 'View' button was pressed.</h2>
</div>
<footer class="mt-auto">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="home.html" class="nav-link px-2 text-secondary">Home</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">All</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">Drawings</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">Activity</a></li>
        <li class="nav-item"><a href="ideas.html" class="nav-link px-2 text-secondary">Pictures</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">About</a></li>
    </ul>
</footer>
</body>
</html>