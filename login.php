
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('home.php');

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

if($response == 'SUCC')
{

	if(($_GET["page"] == "home"))
	{
		$base = $_GET["base"];
		$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
		homepage($user, $base, $client);
	}
	if(($_GET["page"] == "profile"))
	{
		$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
		profile($user, $client);
	}
	if(($_GET["page"] == "trade"))
	{
		echo "trade";
	}


}

elseif($response == 'FAIL')
{
	echo "<h2>User or Password Incorrect :(</h2>";
}
else
{
	echo $response;
}
