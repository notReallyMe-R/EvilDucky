<html>
<pre>
<?php

switch ($_POST['attack']){
    case "keylog":
        echo(shell_exec('ls'));
        break;
    default:
        throw new \Exception('Unexpected value');
}

?>
</pre>
</html>