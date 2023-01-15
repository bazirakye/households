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
  /*This query uses a subquery to get the most recent created_at for eac
  h groupId, and then joins the markers table to the subquery on the groupId and created_at 
  columns. It returns all columns from the markers table 
  for the rows that match the most recent created_at for each groupId in the current week. 
  Please note that you can use this query if created_at column is unique for each groupId.
  You can also use the order by created_at desc and limit 1 for each groupId.*/

  $sql = "SELECT * FROM markers WHERE WEEK(created_at, 3) = WEEK(CURDATE(), 3) AND YEAR(created_at) = YEAR(CURDATE()) group by groupId order by created_at desc limit 1";
  $result = mysqli_query($conn, $sql);

  $geojson = array(
    'type'      => 'FeatureCollection',
    'features'  => array()
 );
 while($row = mysqli_fetch_assoc($result)) {
    $feature = array(
       'type' => 'Feature',
       'geometry' => array(
          'type' => 'Point',
          'coordinates' => array(
             $row['lng'],
             $row['lat']
          )
       ),
       'properties' => array(
          'groupId' => $row['groupId'],
          'groupName' => $row['groupName'],
          'cbtName' => $row['cbtName'],
          'cbtPhone' => $row['cbtPhone'],
          'chairpersonName' => $row['chairpersonName'],
          'chairpersonPhone' => $row['chairpersonPhone']
       )
    );
    array_push($geojson['features'], $feature);
 }
 
  
  
  header('Content-type: application/json');
  echo json_encode($geojson);


  
  // Close the connection
  mysqli_close($conn);

  
?>
