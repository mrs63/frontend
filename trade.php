<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

$curr1 = $_GET["curr1"];
$amount = $_GET["amount"];
$curr2 = $_GET["curr2"];

session_start();

if(isset($_SESSION["USER"]))
{
	$user = $_SESSION["USER"];
}
else
{
	header("location: login.html");
	exit("no user");
}

$request = array();
$request['type'] = "make_trade";
$request['username'] = $user;
$request['curr1'] = $curr1;
$request['amount'] = $amount;
$request['curr2'] = $curr2;

$response = $client->send_request($request);

if($response == "SUCC")
{

	header("location: profile.php");
	exit();
}
elseif($response == "IF")
{

	$out = "<h1>INSUFFICIENT FUNDS</h1><br><br>";
	$out.= "<button onclick=\"location.href='trade.html'\">TRY AGAIN</button><br>";
	$out.= "<button onclick=\"location.href='index.php'\">DASHBOARD</button><br>";
	$out.= "<button onclick=\"location.href='profile.php'\">PROFILE</button><br>";
	echo $out;

}

?>