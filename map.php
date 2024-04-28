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

    <title>Maintenance Services</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="maintenance-system.css">
</head>

<body>
    <div class="container">
        <h3>List of restaurants</h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <h4 id='filter_header'> Filter: </h4>
            <input value='restaurant' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="All Locations" />
            <input value='dining_hall' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="Dining Hall Locations" />
            <input value='off_campus_dining' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="Off Campus Locations" />
            <input value='on_campus_dining' type="submit" class="btn btn-primary" name="submitfilter" id="submitfilter" title="On Campus Locations" />
            </select>
        </form>
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
                <?php foreach ($list_of_restaurants as $req_info) : ?>
                    <tr>
                        <td>
                            <?php
                            $helper =  str_replace(" ",  "!",$req_info['name']);
                            $heler1 = $req_info['name'];
                            echo "<html>
                                <a href='rating.php?$helper' class='a_links' style='margin-top: 3px; margin-right: 5px;'></i> $heler1  </a>"
                            ?>
                        </td>
                        <td><?php echo $req_info['street']; ?></td>
                        <td><?php echo $req_info['zipcode']; ?></td>
                        <td><?php echo $req_info['rating']; ?></td>
                        <td><?php echo $req_info['status']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>


        <br /><br />

        <?php include('footer.html') ?>

        <!-- <script src='maintenance-system.js'></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>