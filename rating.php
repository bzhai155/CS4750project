<?php

require("connect_database.php");
require("request-db.php");
function get_string_between($string)
{
    $string = ' ' . $string;
    $ini = strpos($string, '?user=');
    if ($ini == 0) return '';
    $ini += strlen('?user=');
    if (strpos($string, '?page') == false) {
        $len =  strlen($string) - $ini;
    } else {
        $len = strpos($string, "?page", $ini) - $ini;
    }
    return substr($string, $ini, $len);
}

$whole1 = @parse_url($_SERVER['REQUEST_URI'])['query'];
$user = get_string_between($whole1);
$whatIWant = substr($whole1, strpos($whole1, '?page') + 5);

$whole2 = str_replace("!",  " ", $whatIWant);

$list_of_restaurants = getAllRestaurants();

$singleres = getRatingRestaurants($whole2);

$allreviews = getReviews($whole2);

// var_dump($list_of_requests);   // debug

if ($_SERVER['REQUEST_METHOD'] == 'POST')   // GET
{
    if (!empty($_POST['addBtn']))    // $_GET['....']
    {
        addRequests($_POST['requestedDate'], $_POST['roomNo'], $_POST['requestedBy'], $_POST['requestDesc'], $_POST['priority_option']);
        $list_of_requests = getAllRequests();
    } else if (!empty($_POST['updateBtn'])) {
        // get reqId
        $request_to_update = getRequestById($_POST['reqId']);
        var_dump($request_to_update);
    } else if (!empty($_POST['cofmBtn'])) {
        echo $_POST['cofm_reqId'] . ", " . $_POST['requestedDate'] . ", " . $_POST['roomNo'] . ", " . $_POST['requestedBy'] . ", " . $_POST['requestDesc'] . ", " . $_POST['priority_option'];
        updateRequest($_POST['cofm_reqId'], $_POST['requestedDate'], $_POST['roomNo'], $_POST['requestedBy'], $_POST['requestDesc'], $_POST['priority_option']);
        $list_of_requests = getAllRequests();
    } else if (!empty($_POST['deleteBtn'])) {
        echo "hello" . $_POST['reqId'];
        deleteRequest($_POST['reqId']);
        $list_of_requests = getAllRequests();
    } else if (!empty($_POST['submitfilter'])) {

        $list_of_restaurants = getFilteredRestaurants($_POST['submitfilter']);
    } else if (!empty($_POST['addreview'])) {
        addReview($_POST['newreviewrating'], $_POST['newreviewtext'], $user, date("Y-m-d"), $whole2);
        $allreviews = getReviews($whole2);
    } else if (!empty($_POST['deleteReview'])) {
        deleteReview($_POST['reviewID']);
        $allreviews = getReviews($whole2);
    }else if (!empty($_POST['updatestatus'])) {
        updateStatus($whole2, $_POST['updatestatus']);
        header("Refresh:0");
    }
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href='css/style.css'>

<head>
    <meta charset="UTF-8">
    <title>UVA Food Review - Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manjari&display=swap">
    <style>
        body {
            font-family: 'Manjari', sans-serif;
        }
    </style>
</head>

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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <?php
                            echo "<html>
                <a class='nav-link clickable' href='map.php??user=$user' style='color: white; border: 1px solid white; padding: 5px 10px; border-radius: 5px;'>Explore</a>"
                            ?>
                        </li>
                    </ul>
                    <li class="nav-item">
                        <?php
                        echo "<html>
                            <span class='clickable' text='#ffffff' >$user</span>"
                        ?>
                    </li>
                </div>
            </div>
        </nav>
    </div>
</header>

<body>
    <div class="container">
        <?php
        echo "<html>
        <head>
        <div class='text-center mt-3'>
        <h2 class='text-uppercase'> $whole2 </h2>
        </div>";
        ?>

        <div class="row">

            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class='text-center fw-bold'>Basic Information</h4>
                        <!-- iterate array of results, display the existing requests -->
                        <?php foreach ($singleres as $req_info) : ?>
                            <div class="mb-3">
                                <p class="mb-1">Street: <?php echo $req_info['street']; ?></p>
                                <p class="mb-1">Zipcode: <?php echo $req_info['zipcode']; ?></p>
                                <p class="mb-1">Rating: <?php echo $req_info['rating']; ?></p>
                                <p class="mb-1">Status: <?php echo $req_info['status']; ?></p>
                                <?php if ($user != '') : ?>
                                    <h5 id='filter_header'>Change status</h5>
                                    <form method="post">
                                        <div class="mb-2">
                                            <button value='busy' type="submit" class="btn btn-primary" name="updatestatus" id="updatestatus" title="busy"></button> busy
                                        </div>
                                        <div class="mb-2">
                                            <button value='not busy' type="submit" class="btn btn-primary" name="updatestatus" id="updatestatus" title="not busy"></button> not busy
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center fw-bold">User Reviews</h4>
                        <?php foreach ($allreviews as $req_info) : ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="card-text">
                                        User <span class="fw-bold" style="color: orange;"><?php echo $req_info['username']; ?></span> rates this restaurant a
                                        <span class="fw-bold" style="color: orange;"><?php echo $req_info['Rating']; ?></span>/5
                                    </p>
                                    <p class="card-text">"<?php echo $req_info['Comment']; ?>"</p>
                                    <p class="card-text"><small class="text-muted"><?php echo $req_info['date']; ?></small></p>
                                    <?php if ($user == $req_info['username']) : ?>
                                        <form method="post">
                                            <input type="submit" value="Delete" name="deleteReview" class="btn btn-danger" />
                                            <input type="hidden" name="reviewID" value="<?php echo $req_info['reviewID']; ?>" />
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>

        <br><br>
        <?php if ($user != "") : ?>
            <div class="row">
                <h4> Add A Review </h4>

                <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return">

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="newreviewrating" class="form-label">Rating:</label>
                            <select class="form-select form-select-sm" id="newreviewrating" name="newreviewrating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="newreviewtext" class="form-label">Review:</label>
                            <input type="text" class="form-control" id="newreviewtext" name="newreviewtext" placeholder="Enter your review">
                        </div>
                    </div>

                    <div class="row g-3 mx-auto">
                        <div class="col-1 d-grid">
                            <button type="submit" value="Add" id="addreview" name="addreview" class="btn btn-primary" title="Add a review">Submit</button>
                        </div>
                    </div>

                </form>

            </div>
        <?php endif; ?>




        <br /><br />

        <!-- <script src='maintenance-system.js'></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

<footer class="footerBlock fixed-bottom" style="background-color: orange;">
    <div class="container">
        <span style="font-size: 12px; color: white;">Copyright CS 4750 Spring 2024</span><br>
        <span style="font-size: 12px; color: white;">Bertram Zhai, Anna Pham, Betty Chen</span>
    </div>
</footer>

</html>