<?php

require("connect_database.php");
require("request-db.php");

$whole1 = @parse_url($_SERVER['REQUEST_URI'])['query'];
$whatIWant = substr($whole, strpos($whole, "?") + 1);
if ($whole == 'rating.php') {
    echo 'wow';
} else if ($whole == 'rating.php/hi') {
    echo 'okay';
} else if ($whole == '/~blz4mv/CS4750/rating.php') {
    echo 'okay2';
}

$whole2 = str_replace("!",  " ", $whole1);

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
        //echo $_POST['submitfilter'];
        $list_of_restaurants = getFilteredRestaurants($_POST['submitfilter']);
    } else if (!empty($_POST['addreview'])) {
        //echo $_POST['submitfilter'];
        //$list_of_restaurants = getFilteredRestaurants($_POST['submitfilter']);
    }
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href='css/style.css'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Upsorn Praphamontripong">
    <meta name="description" content="Maintenance request form, a small/toy web app for ISP homework assignment, used by CS 3250 (Software Testing)">
    <meta name="keywords" content="CS 3250, Upsorn, Praphamontripong, Software Testing">
    <link rel="icon" href="https://www.cs.virginia.edu/~up3f/cs3250/images/st-icon.png" type="image/png" />
    <?php
    echo "<html>
      <head>
          <title> Rating $whole2 </title>";
    ?>
    <title>Rating </title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="maintenance-system.css">
</head>
<header class="headBlock">
    <div>
        <a href="main.php"> <img src="assets/pepper.png" class="d-inline-block ms-5 pb-2" style="width:30px; height:40px;" alt="Nookazaon 2.0" />
            <a href="main.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>VA food review</a>
            <a href="map.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>Explore</a>
            <?php if (!isset($_SESSION['token'])) { ?>
                <a href="redirect.php" class="a_links" style="margin-top: 3px; margin-right: 5px;"></i>Login</a>
            <?php } ?>
</header>

<body>
    <div class="container">
        <?php
        echo "<html>
        <head>
        <h3> $whole2 </h3>";
        ?>
        <!-- <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <h4 id='filter_header'> Filter: </h4>
            <input value='restaurant' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="All Locations" />
            <input value='dining_hall' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="Dining Hall Locations" />
            <input value='off_campus_dining' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="Off Campus Locations" />
            <input value='on_campus_dining' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="On Campus Locations" />
            </select>
        </form> -->
        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th><b>Name</b></th>
                        <th><b>Street</b></th>
                        <th><b>Zipcode</b></th>
                        <th><b>Rating</b></th>
                        <th><b>Status</b></th>
                    </tr>
                </thead>
                <!-- iterate array of results, display the existing requests -->
                <?php foreach ($singleres as $req_info) : ?>
                    <tr>
                        <td><?php echo $req_info['name']; ?></td>
                        <td><?php echo $req_info['street']; ?></td>
                        <td><?php echo $req_info['zipcode']; ?></td>
                        <td><?php echo $req_info['rating']; ?></td>
                        <td><?php echo $req_info['status']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th><b>username</b></th>
                        <th><b>Rating</b></th>
                        <th><b>Comment</b></th>
                        <th><b>date</b></th>
                    </tr>
                </thead>
                <!-- iterate array of results, display the existing requests -->
                <?php foreach ($allreviews as $req_info) : ?>
                    <tr>
                        <td><?php echo $req_info['username']; ?></td>
                        <td><?php echo $req_info['Rating']; ?></td>
                        <td><?php echo $req_info['Comment']; ?></td>
                        <td><?php echo $req_info['date']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>

        <h1> Add Review </h1>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return">
            <table style="width:98%">
                <tr>
                    <td width="50%">
                        <div class='mb-3'>
                            <input type='text' class='form-control' id='newreviewrating' name='newreviewrating' placeholder='0-5' value="" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class='mb-3'>
                            <input type='text' class='form-control' id='newreviewtext' name='newreviewtext' value="" placeholder='review:' />
                        </div>
                    </td>
                </tr>
            </table>

            <div class="row g-3 mx-auto">
                <div class="col-4 d-grid ">
                    <input type="submit" value="Add" id="addreview" name="addreview" class="btn btn-dark" title="Add a review" />
                </div>
            </div>
        </form>

        <br /><br />

        <?php include('footer.html') ?>

        <!-- <script src='maintenance-system.js'></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>