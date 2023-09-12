<?php
include ("send_mail.php");
include ("config.php");



$data['jmeno'] = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['formdata'][0]);
$data['telefon'] = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['formdata'][1]);
$data['adresa'] = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['formdata'][2]);
$data['datumnarozeni'] = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['formdata'][3]);
$data['id'] = preg_replace('/[^0-9]/', '',  $_POST['formdata'][4]);
$data['prijmeni'] = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['formdata'][5]);



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE `users` SET first_name=:jmeno WHERE id=:id";

  // Prepare statement
  $stmt = $conn->prepare($sql);


  $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
  $stmt->bindParam(':jmeno', $data['jmeno']);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";
  
                  $to="honza.otrocice@seznam.cz";
                  $subject="Test";
                  $message="records UPDATED successfully";
          send_mail($to, $subject, $message);
  
  
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
