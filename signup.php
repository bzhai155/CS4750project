<?php
require('connect_database.php');
require('request-db.php');

$login_button = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')   // GET
{
  if (!empty($_POST['CreateUser']))    // $_GET['....']
  {
      addUser($_POST['NewUsername'], $_POST['NewPassword'], $_POST['NewEmail'], $_POST['NewFirstName'], $_POST['NewLastName']);
      header("Location: https://cs4740db-421701.uk.r.appspot.com/main.php");
      //$list_of_requests = getAllRequests();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UVA Food Review - Signup</title>
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
                        <h1 class="intro_title text-center"> <b style="color: orange;">Create New Account</b> </h1>
                        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return validateInput()">
                            <div class="mb-3">
                                <input type='text' class='form-control' id='NewUsername' name='NewUsername' placeholder='Enter new username' value="" />
                            </div>
                            <div class="mb-3">
                                <input type='text' class='form-control' id='NewPassword' name='NewPassword' placeholder='Enter new password' value="" />
                            </div>
                            <div class="mb-3">
                                <input type='text' class='form-control' id='NewEmail' name='NewEmail' placeholder='Enter new email address' value="" />
                            </div>
                            <div class="mb-3">
                                <input type='text' class='form-control' id='NewFirstName' name='NewFirstName' placeholder='Enter first name' value="" />
                            </div>
                            <div class="mb-3">
                                <input type='text' class='form-control' id='NewLastName' name='NewLastName' placeholder='Enter last name' value="" />
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Create Account" id="CreateUser" name="CreateUser" class="btn btn-primary" title="Create new user button" />
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            Already have an account? <a href="main.php" style="color: black;">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footerBlock fixed-bottom" style="background-color: orange;">
        <div class="container">
            <span style="font-size: 12px; color: white;">Copyright CS 4750 Spring 2024</span><br>
            <span style="font-size: 12px; color: white;">Bertram Zhai, Anna Pham, Betty Chen</span>
        </div>
    </footer>

</body>

</html>