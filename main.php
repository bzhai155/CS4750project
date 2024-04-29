<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UVA Food Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manjari&display=swap">
    <style>
        body {
            font-family: 'Manjari', sans-serif;
        }
    </style>
</head>

<body>
    <header class="headBlock">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: orange;">
                <div class="container">
                    <a class="navbar-brand" href="main.php">
                        <img src="assets/pepper.png" class="d-inline-block align-top" style="width:30px; height:40px;" alt="Nookazaon 2.0">
                        <span class="clickable">VA Food Review</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link clickable" href="map.php" style="color: white; border: 1px solid white; padding: 5px 10px; border-radius: 5px;">Explore</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    <h1 class="intro_title text-center"> <b style="color: orange;">UVA FOOD REVIEW</b> </h1>
                    <h2 class="intro_position text-center"> Welcome Hoos! </h2>
                    <h5 class="text-center"> Login to Begin: </h5>

                        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="mb-3">
                                <label for="requestedUsername" class="form-label">Username or Email Address</label>
                                <input type="text" class="form-control" id="requestedUsername"
                                    name="requestedUsername" placeholder="Enter username or email address" required>
                            </div>
                            <div class="mb-3">
                                <label for="RequestPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="RequestPassword"
                                    name="RequestPassword" placeholder="Enter password" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" id="LoginBtn" name="LoginBtn" style="color: white;">Sign In</button>
                            </div>

                            <div class="text-center mt-3">
                                Are you a new user? <a href="signup.php" style="color: black;">Create an account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<footer class="footerBlock fixed-bottom" style="background-color: orange;">
    <div class="container">
        <span style="font-size: 12px; color: white;">Copyright CS 4750 Spring 2024</span><br>
        <span style="font-size: 12px; color: white;">Bertram Zhai, Anna Pham, Betty Chen</span>
    </div>
</footer>

</html>