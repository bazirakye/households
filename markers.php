<?php
$host = "localhost";
$user = "root";
$password = "helloworld";
$dbname = "sample";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$groupId = $_POST['groupId'];
$groupName = $_POST['groupName'];
$cbtName = $_POST['cbtName'];
$cbtPhone = $_POST['cbtPhone'];
$chairpersonName = $_POST['chairpersonName'];
$chairpersonPhone = $_POST['chairpersonPhone'];

$sql = "INSERT INTO markers (lat, lng , groupId , groupName, cbtName, cbtPhone, chairpersonName, chairpersonPhone ) VALUES ('$latitude', '$longitude', '$groupId', '$groupName', '$cbtName', '$cbtPhone' ,'$chairpersonName', '$chairpersonPhone')";
if (mysqli_query($conn,$sql)) {
  echo "New marker created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>