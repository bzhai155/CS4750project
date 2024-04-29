<?php
function addRequests($reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
    global $db;   
    $reqDate = date('Y-m-d');      // ensure proper data type before inserting it into a db
    
    // $query = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES ('2024-03-18', 'CCC', 'Someone', 'fix light', 'medium')";
    // $query = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES ('" . $reqDate . "', '" . $roomNumber . "', '" . $reqBy . "', '" . $repairDesc . "', '" . $reqPriority . "')";  
     
    $query = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES (:reqDate, :roomNumber, :reqBy, :repairDesc, :reqPriority)";  
    
    try { 
       // $statement = $db->query($query);   // compile & exe
 
       // prepared statement
       // pre-compile
       $statement = $db->prepare($query);
 
       // fill in the value
       $statement->bindValue(':reqDate', $reqDate);
       $statement->bindValue(':roomNumber', $roomNumber);
       $statement->bindValue(':reqBy',$reqBy);
       $statement->bindValue(':repairDesc', $repairDesc);
       $statement->bindValue(':reqPriority', $reqPriority);
 
       // exe
       $statement->execute();
       $statement->closeCursor();
    } catch (PDOException $e)
    {
       $e->getMessage();   // consider a generic message
    } catch (Exception $e) 
    {
       $e->getMessage();   // consider a generic message
    }

}
function addReview($newreviewrating, $newreviewtext, $user, $date, $restname)
{
    global $db;  
    $query1 = "SELECT u.userID
    FROM user_email AS ue, user AS u
    WHERE  ue.username =:user
    AND ue.email = u.email;";
    
    $statement = $db->prepare($query1);
 
    // fill in the value
    $statement->bindValue(':user', $user);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    $query = "INSERT INTO review (userID, Rating, Comment, date) VALUES (:userID, :newreviewrating, :newreviewtext, :dates);";
    $statement1 = $db->prepare($query);
 
       // fill in the value
       $statement1->bindValue(':userID', $result[0]['userID']);
       $statement1->bindValue(':newreviewrating', $newreviewrating);
       $statement1->bindValue(':newreviewtext',$newreviewtext);
       $statement1->bindValue(':dates', $date);
 
       // exe
       $statement1->execute();
       $statement1->closeCursor();

    $query12 = "SELECT @@IDENTITY;";
    $statement12 = $db->prepare($query12);
    $statement12->execute();
    $result12 = $statement12->fetchAll();
    $statement12->closeCursor();

    $query3 = "SELECT r.restaurantID
    FROM restaurant AS r
    WHERE  r.name  =:restname";
        $statement2 = $db->prepare($query3);
 
    // fill in the value
        $statement2->bindValue(':restname', $restname);
        $statement2->execute();
        $result2 = $statement2->fetchAll();
        $statement->closeCursor();
        echo  $result2[0]['restaurantID'];

        $query4 = "INSERT INTO reviews (restaurantID, reviewID) VALUES (:restid, :reviewid)";
        $statement4 = $db->prepare($query4);
     
           // fill in the value
           $statement4->bindValue(':reviewid', $result12[0]['@@IDENTITY']);
           $statement4->bindValue(':restid', $result2[0]['restaurantID']);
     
           // exe
           $statement4->execute();
           $statement4->closeCursor();
}



function getAllRequests()
{
    global $db;
    $query = "select * from requests";    
    $statement = $db->prepare($query);    // compile
    $statement->execute();
    $result = $statement->fetchAll();     // fetch()
    $statement->closeCursor();
 
    return $result;
}

function getAllRestaurants()
{
    global $db;
    $query = "select * from restaurant";    
    $statement = $db->prepare($query);    // compile
    $statement->execute();
    $result = $statement->fetchAll();     // fetch()
    $statement->closeCursor();
 
    return $result;
}

function getFilteredRestaurants($filter)
{
    global $db;
    $query = "";
    if ($filter == "restaurant"){
        $query = "select * from restaurant";  
    }else if ($filter == "dining_hall"){
        $query = "SELECT DISTINCT r.restaurantID, r.name, r.street, r.zipcode, r.zipcode, r.status
        FROM dining_hall d, restaurant r
        WHERE d.restaurantID = r.restaurantID;";
    }else if ($filter == "off_campus_dining"){
        $query = "SELECT DISTINCT r.restaurantID, r.name, r.street, r.zipcode, r.zipcode, r.status
        FROM off_campus_dining d, restaurant r
        WHERE d.restaurantID = r.restaurantID;";
    }else if ($filter == "on_campus_dining"){
        $query = "SELECT DISTINCT r.restaurantID, r.name, r.street, r.zipcode, r.zipcode, r.status
        FROM on_campus_dining d, restaurant r
        WHERE d.restaurantID = r.restaurantID;";
    }
    $statement = $db->prepare($query);    // compile
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getRequestById($id)  
{
    global $db;
    $query = "select * from requests where reqId=:reqId"; 
    $statement = $db->prepare($query);    // compile
    $statement->bindValue(':reqId', $id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
 
    return $result;

}
function getRatingRestaurants($name)  
{
    global $db;
    $query = "select * from restaurant where name=:reqId"; 
    $statement = $db->prepare($query);    // compile
    $statement->bindValue(':reqId', $name);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
 
    return $result;

}
function getReviews($name)  
{
    global $db;
    $query = "SELECT ue.username, rev.Rating, rev.Comment, rev.date, rev.reviewID
    From review AS rev, 
    (SELECT ri.restaurantID, ri.reviewID
    FROM reviews ri, restaurant r 
    WHERE r.name = :reqId
    AND ri.restaurantID = r.restaurantID) AS E1,
    user AS u, user_email as ue
    WHERE rev.reviewID = E1.reviewID
    AND rev.userID = u.userID
    AND u.email  = ue.email;";
    $statement = $db->prepare($query);    // compile
    $statement->bindValue(':reqId', $name);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
 
    return $result;

}

function login($username, $password)  
{
    global $db;
    $query = "SELECT ue.username
    FROM user_email as ue
    WHERE ue.username = :username OR ue.email = :username
    AND ue.password = :pass";
    $statement = $db->prepare($query);    // compile
    $statement->bindValue(':username', $username);
    $statement->bindValue(':pass', $password);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
 
    return $result;
}

function updateRequest($reqId, $reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
    global $db;
    $query = "update requests set reqDate=:reqDate, roomNumber=:roomNumber, 
    reqBy=:reqBy, repairDesc=:repairDesc, reqPriority=:reqPriority where reqId=:reqId" ; 
 
    $statement = $db->prepare($query);
    $statement->bindValue(':reqId', $reqId);
    $statement->bindValue(':reqDate', $reqDate);
    $statement->bindValue(':roomNumber', $roomNumber);
    $statement->bindValue(':reqBy',$reqBy);
    $statement->bindValue(':repairDesc', $repairDesc);
    $statement->bindValue(':reqPriority', $reqPriority);
 
    $statement->execute();
    $statement->closeCursor();

}

function deleteRequest($reqId)
{
    global $db;
    $query = "delete from requests where reqId=:reqId";
    $statement = $db->prepare($query);
    $statement->bindValue(':reqId', $reqId);
    $statement->execute();
    $statement->closeCursor();
    
}

function deleteReview($reviewId)
{
    global $db;
    $query = "delete from reviews where reviewID=:reqId;
    delete from review where reviewID=:reqId";
    $statement = $db->prepare($query);
    $statement->bindValue(':reqId', $reviewId);
    $statement->execute();
    $statement->closeCursor();
    
}

function addUser($NewUsername, $NewPassword, $NewEmail, $NewFirst_name, $NewLast_name)
{
    global $db;   
    // $query = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES ('2024-03-18', 'CCC', 'Someone', 'fix light', 'medium')";
    // $query = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES ('" . $reqDate . "', '" . $roomNumber . "', '" . $reqBy . "', '" . $repairDesc . "', '" . $reqPriority . "')";  
     
    $query1 = "INSERT INTO user (email) VALUES (:email1); 
    INSERT INTO user_email (email, username, password) VALUES (:email2, :username1, :password); 
    INSERT INTO user_info (username, first_name, last_name) VALUES (:username2, :first_name, :last_name)";  
    try { 
       // $statement = $db->query($query);   // compile & exe
 
       // prepared statement
       // pre-compile
       $statement1 = $db->prepare($query1);
 
       // fill in the value
       $statement1->bindValue(':email1', $NewEmail); 
       $statement1->bindValue(':email2', $NewEmail); 
       $statement1->bindValue(':username1', $NewUsername); 
       $statement1->bindValue(':password', $NewPassword); 
       $statement1->bindValue(':username2', $NewUsername); 
       $statement1->bindValue(':first_name', $NewFirst_name); 
       $statement1->bindValue(':last_name', $NewLast_name); 
       // exe
       $statement1->execute();
       $statement1->closeCursor();
    } catch (PDOException $e)
    {
       $e->getMessage();   // consider a generic message
    } catch (Exception $e) 
    {
       $e->getMessage();   // consider a generic message
    }

}


?>
