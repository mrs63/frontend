<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$base = 'USD';
$homeReq = array();
session_start();

$page = "<h1> HOMEPAGE </h1> <br>";

if(isset($_SESSION["USER"]))
{
	$user = $_SESSION["USER"];
	$page.= "<h3> Welcome " . $user . "</h3>";
}

$homeReq['type'] = "get_ex_for_base";
$homeReq['base'] = $base;
$table = $client->send_request($homeReq);

$page.= "<hr>";
$page.= "<h3> Base: $base </h3><br>";
$page.= $table;
$page.= " <br><button onclick=\"location.href='login.html'\">LOGIN</button> ";
$page.= " <br><button onclick=\"location.href='profile.php'\">PROFILE</button> ";
$page.= " <br><button onclick=\"location.href='trade.html'\">TRADE</button> ";

echo $page;


?>