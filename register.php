
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "register";
}

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
if($response == 'SUCC')
{
  echo "<h2>User has Successfully Registered!</h2>";
}
elseif($response == 'FAIL')
{
  echo "<h2>Username is Taken, sucks to suck :(</h2>";
}

echo "\n\n";

echo $argv[0].PHP_EOL;

