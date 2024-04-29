<?php
require("connect_database.php");
require("request-db.php");

$list_of_restaurants = getAllRestaurants();
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

<!DOCTYPE html>
<html>
<link rel="stylesheet" href='css/style.css'>
<head>
    <meta charset="UTF-8">
    <title>UVA Food Review - Map</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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

<body>
    <div class="container" style="padding-top: 20px;">
        <div class="row">

            <!-- filter -->
            <div class="col-md-3">
                <div class="card shadow" style="width: fit-content;">
                    <div class="card-body">
                        <h5 id='filter_header'>Select a Filter:</h5>
                        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="mb-2">
                                <button value='restaurant' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="All Locations"></button> All Restaurants
                            </div>
                            <div class="mb-2">
                                <button value='dining_hall' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="Dining Hall Locations"></button> Dining Hall Locations
                            </div>
                            <div class="mb-2">
                                <button value='off_campus_dining' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="Off Campus Locations"></button> Off Campus Locations
                            </div>
                            <div class="mb-2">
                                <button value='on_campus_dining' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="On Campus Locations"></button> On Campus Locations
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Restaurants Table Section -->
            <div class="col-md-9">

                <div class="text-center">
                    <h1>LIST OF RESTAURANTS</h1>
                </div>

                <div class="row justify-content-center">
                    <table class="table table-bordered table-striped shadow">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Street</th>
                                <th>Zipcode</th>
                                <th>Rating</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- iterate array of results, display the existing requests -->
                            <?php foreach ($list_of_restaurants as $req_info) : ?>
                                <tr>
                                    <td>
                                        <?php
                                        $helper =  str_replace(" ",  "!", $req_info['name']);
                                        $heler1 = $req_info['name'];
                                        echo "<a href='rating.php??user=$user?page$helper' class='a_links'>$heler1</a>"
                                        ?>
                                    </td>
                                    <td><?php echo $req_info['street']; ?></td>
                                    <td><?php echo $req_info['zipcode']; ?></td>
                                    <td><?php echo $req_info['rating']; ?></td>
                                    <td><?php echo $req_info['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            
        </div>

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