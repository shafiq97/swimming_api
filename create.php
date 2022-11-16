<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
if($_POST){

// include database connection
include 'config/database.php';

try{

// insert query
// $query = "INSERT INTO Events SET name=:name, date=:date, venue=:venue, description=:description, imageURL=:imageURL";
$query = "INSERT INTO Events SET name=:name, venue=:venue, description=:description, imageURL=:imageURL, p_age=:p_age, p_name=:p_name";
// prepare query for execution
$stmt = $con->prepare($query);
// posted values
$name = $_POST['name'];
$date = $_POST['date'];
$venue = $_POST['venue'];
$description = $_POST['description'];
$imageURL = $_POST['imageURL'];
$p_name = $_POST['p_name'];
$p_age = $_POST['p_age'];
// bind the parameters
$stmt->bindParam(':name', $name);
// $stmt->bindParam(':date', $date);
$stmt->bindParam(':venue', $venue);
$stmt->bindParam(':description', $description);
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
// show error
catch(PDOException $exception){
die('ERROR: ' . $exception->getMessage());
}
}
?>
