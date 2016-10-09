
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
  $msg = "test message";
}

$user = $_GET["username"];
$pass = $_GET["password"];

$request = array();
$request['type'] = "login";
$request['username'] = $user;
$request['password'] = $pass;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

//echo "client received response: ".PHP_EOL;
//print_r($response);

if($response == TRUE)
{
  echo "<h2>User has Successfully Logged In!</h2>";
}
elseif($response == FALSE)
{
  echo "<h2>User Not Registered:(</h2>";
}
else
{
  echo $response;
}
echo "\n\n";

echo $argv[0].PHP_EOL;

