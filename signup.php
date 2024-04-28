<?php
require('connect_database.php');
require('request-db.php');

$login_button = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')   // GET
{
  if (!empty($_POST['CreateUser']))    // $_GET['....']
  {
      addUser($_POST['NewUsername'], $_POST['NewPassword'], $_POST['NewEmail'], $_POST['NewFirstName'], $_POST['NewLastName']);
      //$list_of_requests = getAllRequests();
  }
}

?>
<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Signup below</title>

    <!-- 3. link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>
    <header class="headBlock">
        <div>
            <a href="index.php"> <img src="assets/pepper.png" class="d-inline-block ms-5 pb-2" style="width:30px; height:40px;" alt="Nookazaon 2.0" />
                <a href="index.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>UVA food review</a>
                <?php if (!isset($_SESSION['token'])) {  ?>
                    <a href="redirect.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>Login</a>
                <?php } ?>
    </header>

    <body>
        <div class="page_intro intro">
            <div class="intro_container container">
                <div class="intro_body">
                    <div class="intro_content" style="margin-top: 10%;">
                        <h1 class="intro_title"> <b style="color: #ad8751;">Create User Below </h1>
                        <div class="container">
                            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return validateInput()">
                                <table style="width:98%">
                                    <tr>
                                        <td width="50%">
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='NewUsername' name='NewUsername' placeholder='Enter username' value="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='NewPassword' name='NewPassword' placeholder='Enter password' value="" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='NewEmail' name='NewEmail' placeholder='Enter email address' value="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='NewFirstName' name='NewFirstName' placeholder='Enter first name' value="" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class='mb-3'>
                                                <input type='text' class='form-control' id='NewLastName' name='NewLastName' placeholder='Enter last name' value="" />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-4 d-grid ">
                                    <input type="submit" value="Create account" id="CreateUser" name="CreateUser" class="btn btn-dark" title="Create new user button" />
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