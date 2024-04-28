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
