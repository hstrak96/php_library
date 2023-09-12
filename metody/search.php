<?php 
/*
include "metody/config";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, Nazev FROM kniha WHERE Nazev LIKE '%a%' ORDER BY Nazev ASC");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt->fetchAll() as $data) {
    
    
        $data['id'] = $row['id']; 
        $data['Name'] = $row['skill']; 
        array_push($skillData, $data); 
  }
} catch(PDOException $e) {
  //echo "Error: " . $e->getMessage();
}
$conn = null;
echo json_encode($skillData); 


        */





// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "straka07"; 
$dbPassword = "Gdep14.89*"; 
$dbName     = "straka07"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
} 

         $searchTerm = $_GET['term']
// Fetch matched data from the database 
$query = $db->query("SELECT id, Nazev FROM kniha WHERE Nazev LIKE '%a%' ORDER BY Nazev ASC LIMIT 10"); 
 
// Generate array with skills data 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['Nazev']; 
        array_push($skillData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 

?>