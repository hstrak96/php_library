<?php

  // $mess = "http://195.113.207.163/~straka07/BP/verify.php?email=" . $to . "&hash=" . $hash . "";
    
$to="honza.otrocice@seznam.cz";
$subject="TEST";
$message="Tohle je pokus";
   send_mail($to, $subject, $message);
function send_mail($to, $subject, $message){

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <knihovna.borovnice@gmail.com>' . "\r\n";


mail($to, $subject, $message, $headers);




}


?>