<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sample";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$sql = "INSERT INTO markers (lat, lng) VALUES ($latitude, $longitude)";

if (mysqli_query($conn,$sql)) {
  echo "New marker created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>