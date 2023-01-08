<?php
  // Connect to the database
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "sample";

  $conn = mysqli_connect($host, $user, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Retrieve data from the database
  $sql = "SELECT * FROM markers ";
  $result = mysqli_query($conn, $sql);

  // Convert the result to an array and return it as JSON
  $data = array();
  while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
  }
  header('Content-Type: application/json');
  echo json_encode($data);

  // Close the connection
  mysqli_close($conn);
?>
