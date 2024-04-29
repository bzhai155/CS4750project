<?php
require('connect_database.php');
//require('config.php')
require('request-db.php');
require('config.php');

$login_button = '';
if (isset($_GET["code"])) {
    //It will Attempt to exchange a code for an valid authentication token.
    // $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    // if (!isset($token['error'])) {
    //     //Set the access token used for requests
    //     $google_client->setAccessToken($token['access_token']);
    //     echo 'here';
    //     //Store "access_token" value in $_SESSION variable for future use.
    //     $_SESSION['access_token'] = $token['access_token'];

    //     //Create Object of Google Service OAuth 2 class
    //     $google_service = new Google_Service_Oauth2($google_client);

    //     //Get user profile data from google
    //     $data = $google_service->userinfo->get();

    //     //Below you can find Get profile data and store into $_SESSION variable
    //     if (!empty($data['given_name'])) {
    //         $_SESSION['user_first_name'] = $data['given_name'];
    //     }

    //     if (!empty($data['family_name'])) {
    //         $_SESSION['user_last_name'] = $data['family_name'];
    //     }

    //     if (!empty($data['email'])) {
    //         $_SESSION['user_email_address'] = $data['email'];
    //     }

    //     if (!empty($data['gender'])) {
    //         $_SESSION['user_gender'] = $data['gender'];
    //     }

    //     if (!empty($data['picture'])) {
    //         $_SESSION['user_image'] = $data['picture'];
    //     }
    // }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if (!isset($_SESSION['access_token'])) {
    //Create a URL to obtain user authorization
    $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" /></a>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')   // GET
{
    if (!empty($_POST['LoginBtn']))    // $_GET['....']
    {
        //addRequests($_POST['requestedDate'], $_POST['roomNo'], $_POST['requestedBy'], $_POST['requestDesc'], $_POST['priority_option']);
        //$list_of_requests = getAllRequests();
    }
}
function get_string_between($string){
    $string = ' ' . $string;
    $ini = strpos($string, '?user=');
    if ($ini == 0) return '';
    $ini += strlen('?user=');
    if(strpos($string, '?page') == false) {
        $len =  strlen($string) - $ini;
    }else{
        $len = strpos($string, "?page", $ini) - $ini;
    }
    return substr($string, $ini, $len);
}

$whole1 = @parse_url($_SERVER['REQUEST_URI'])['query'];
$user = get_string_between($whole1);

?>
<!-- 1. create HTML5 doctype -->
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
                        <?php
                        echo "<html>
                        <a class='navbar-brand' href='main.php??user=$user'>"
                             ?>
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
                                  <?php
                                      echo "<html>
                <a class='nav-link clickable' href='map.php??user=$user' style='color: white; border: 1px solid white; padding: 5px 10px; border-radius: 5px;'>Explore</a>
                "
                             ?>
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