<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$profReq = array();
session_start();

$page = "<h1> PROFILE </h1> <br>";

if(isset($_SESSION["USER"]))
{
	$user = $_SESSION["USER"];
	$page.= "<h3> Welcome " . $user . "</h3>";
}
else
{
	header("location: login.html");
	exit();
}

$profReq['type'] = "get_user_pos";
$profReq['username'] = $user;
$table = $client->send_request($profReq);

$page = "<h1> Profile </h1> <br>";
$page.= "<hr>";
$page.= "<h3> $user" . "'s Positions </h3> <br><br>";
$page.= $table;
$page.= "<br><button onclick=\"location.href='index.php'\">DASHBOARD</button> ";
$page.= "<br><button onclick=\"location.href='trade.html'\">TRADE</button> ";


echo $page;


?>