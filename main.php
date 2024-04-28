<?php
require ('connect_database.php');
//require('config.php');
require ('request-db.php');

$login_button = '';

// if (isset($_GET["code"])) {
//     //It will Attempt to exchange a code for an valid authentication token.
//     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

//     //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
//     if (!isset($token['error'])) {
//         //Set the access token used for requests
//         $google_client->setAccessToken($token['access_token']);

//         //Store "access_token" value in $_SESSION variable for future use.
//         $_SESSION['access_token'] = $token['access_token'];

//         //Create Object of Google Service OAuth 2 class
//         $google_service = new Google_Service_Oauth2($google_client);

//         //Get user profile data from google
//         $data = $google_service->userinfo->get();

//         //Below you can find Get profile data and store into $_SESSION variable
//         if (!empty($data['given_name'])) {
//             $_SESSION['user_first_name'] = $data['given_name'];
//         }

//         if (!empty($data['family_name'])) {
//             $_SESSION['user_last_name'] = $data['family_name'];
//         }

//         if (!empty($data['email'])) {
//             $_SESSION['user_email_address'] = $data['email'];
//         }

//         if (!empty($data['gender'])) {
//             $_SESSION['user_gender'] = $data['gender'];
//         }

//         if (!empty($data['picture'])) {
//             $_SESSION['user_image'] = $data['picture'];
//         }
//     }
// }

// //This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
// if (!isset($_SESSION['access_token'])) {
//     //Create a URL to obtain user authorization
//     $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" /></a>';
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST')   // GET
{
    if (!empty($_POST['LoginBtn']))    // $_GET['....']
    {
        //addRequests($_POST['requestedDate'], $_POST['roomNo'], $_POST['requestedBy'], $_POST['requestDesc'], $_POST['priority_option']);
        //$list_of_requests = getAllRequests();
    }
}
?>
<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <title>UVA Food Review</title>

    <!-- 3. link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <header class="headBlock">
        <div>
            <a href="index.php"> <img src="assets/pepper.png" class="d-inline-block ms-5 pb-2"
                    style="width:30px; height:40px;" alt="Nookazaon 2.0" />
                <a href="index.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>UVA food review</a>
                <?php if (!isset($_SESSION['token'])) { ?>
                    <a href="redirect.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>Login</a>
                <?php } ?>
    </header>

    <body>
        <div class="page_intro intro">
            <div class="intro_container container">
                <div class="intro_body">
                    <div class="intro_content" style="margin-top: 10%;">
                        <h1 class="intro_title"> <b style="color: #ad8751;">UVA food review</b>
                            <h2 class="intro_position" style="color: #ad8751;"> welcome hoos! login to begin
                        </h1>

                        <div class="container">
                            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>"
                                onsubmit="return validateInput()">
                                <table style="width:98%">
                                    <tr>
                                        <td width="50%">
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='requestedUsername'
                                                    name='requestedUsername'
                                                    placeholder='Enter username or email address' value="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='RequestPassword'
                                                    name='RequestPassword' placeholder='Enter password' value="" />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-4 d-grid ">
                                    <input type="submit" value="Login" id="LoginBtn" name="LoginBtn"
                                        class="btn btn-dark" title="Submit Login info" />
                                </div>
                                <div class="col-4 d-grid ">
                                    <a href="signup.php" class="a_links"
                                        style="margin-top: 3px; margin-right: 5px;"></i>signup</a>
                                </div>
                                <div>
                                </div>
                            </form>
                        </div>
                        <br1>
                    </div>
                </div>
            </div>
            <!-- <div class="panel panel-default">
                <?php
                if ($login_button == '') {
                    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
                    echo '<img src="' . $_SESSION["user_image"] . '" class="img-responsive img-circle img-thumbnail" />';
                    echo '<h3><b>Name :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
                    echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . '</h3>';
                    echo '<h3><a href="logout.php">Logout</h3></div>';
                } else {
                    echo '<div align="center">' . $login_button . '</div>';
                }
                ?>
            </div> -->
    </body>
    </div>
    </div>
</body>

</html>