<?php
//this connects to the database
$conn = mysqli_connect("localhost","rhysbw","testPass", "attackinfo");

if (!$conn){
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
?>