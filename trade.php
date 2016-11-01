<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

$user = $_GET["user"];
$curr1 = $_GET["curr1"];
$amount = $_GET["amount"];
$curr2 = $_GET["curr2"];

$request = array();
$request['type'] = "make_trade";
$request['username'] = $user;
$request['curr1'] = $curr1;
$request['amount'] = $amount;
$request['curr2'] = $curr2;

$response = $client->send_request($request);

if($response == "SUCC")
{

	header("location: index.html");
	exit();
}
elseif($response == "IF")
{

	$out = "<h1>INSUFFICIENT FUNDS</h1><br><br>";
	$out.= "<button onclick=\"location.href='trade.html'\">Try Again</button><br>";
	$out.= "<button onclick=\"location.href='index.html'\">Go to Main</button><br>";
	echo $out;

}
elseif($response == "NU")
{
	$out = "<h1>NO USER: $user</h1><br><br>";
	$out.= "<button onclick=\"location.href='trade.html'\">Try Again</button><br>";
	$out.= "<button onclick=\"location.href='index.html'\">Go to Main</button><br>";
	echo $out;

}

?>