<?php
//this connects to the database
$conn = mysqli_connect("localhost","rhysbw","testPass", "attackinfo");

if (!$conn){
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
/*
$sql = "SELECT * FROM victim WHERE";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['UserName'];
    }
} else {
    echo "0 results";
}
$conn->close();
*/
?>