
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

$user = $_GET["username"];
$pass = $_GET["password"];

$request = array();
$request['type'] = "register";
$request['username'] = $user;
$request['password'] = $pass;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

//echo "client received response: ".PHP_EOL;
//print_r($response);
if($response != 'FAIL')
{
 	header("location: login.html");
 	exit();
}
else
{
  echo "<h2>Username is Taken, sucks to suck :(</h2>";
}

echo "\n\n";

echo $argv[0].PHP_EOL;

