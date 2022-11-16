<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
 
// check if form was submitted
if($_POST){
    include 'config/database.php';
    try{
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE Events
                    SET name=:name, description=:description, venue=:venue, imageURL=:imageURL, p_name=:p_name, p_age=:p_age
                    WHERE event_id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $venue = $_POST['venue'];
        $imageURL = $_POST['imageURL'];
        $p_name = $_POST['p_name'];
        $p_age = $_POST['p_age'];
 
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':venue', $venue);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imageURL', $imageURL);
        $stmt->bindParam(':p_name', $p_name);
        $stmt->bindParam(':p_age', $p_age);
         
        // Execute the query
        if($stmt->execute()){
            echo json_encode(array('result'=>'success'));
        }else{
            echo json_encode(array('result'=>'fail'));
        }
         
    }
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}else{
  echo json_encode(array('result'=>'not post'));
}
?>