<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
if($_POST){

// include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SwimmingEvent";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

try{

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM Users WHERE username = '$username' and password = '$password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  // output data of each row
  echo json_encode(array('result'=>'success'));
} else {
  echo json_encode(array('result'=>$query));
}
}
// show error
catch(PDOException $exception){
die('ERROR: ' . $exception->getMessage());
}
}

?>
