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

  $features = array();
  while ($row = $result->fetch_assoc()) {
      $feature = array(
          'type' => 'Feature',
          'geometry' => array(
              'type' => 'Point',
              'coordinates' => array((float)$row['lng'], (float)$row['lat'])
          ),
          'properties' => array(
              'id' => $row['id'],
              'name' => $row['name']
          )
      );
      array_push($features, $feature);
  }
  
  $geojson = array(
      'type' => 'FeatureCollection',
      'features' => $features
  );
  
  
  header('Content-type: application/json');
  echo json_encode($geojson);


  
  // Close the connection
  mysqli_close($conn);

  
?>
