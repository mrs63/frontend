<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$homeReq = array();

$page = "<head>
<script src='http://code.jquery.com/jquery-1.11.0.min.js'></script>
<script>

function postValue() {

  	var val = document.getElementById('mySelect').options[document.getElementById('mySelect').selectedIndex].text;


 	var ajax_post = {baseVal:val};

	var jqxhr = $.ajax({
    type: 'POST',
    url: 'setSessBase.php',
    data: ajax_post,
	})
	.done(function() {
	    window.location.reload();
	});	

}
</script>
</head>";

$page .= "<h1> HOMEPAGE </h1> <br>";
session_start();

if(!isset($_SESSION["BASE"]))
{
	$_SESSION["BASE"] = "USD";
}


if(isset($_SESSION["USER"]))
{
	$user = $_SESSION["USER"];
	$page.= "<h3> Welcome " . $user . "</h3>";
}

$base = $_SESSION["BASE"];
$homeReq['type'] = "get_ex_for_base";
$homeReq['base'] = $base;
$table = $client->send_request($homeReq);
$page.= "<hr>";

$page.= "<select id='mySelect'>
  <option>USD</option>
  <option>EUR</option>
  <option>RUB</option>
  <option>AUD</option>
</select>
<br><br>
<input type='button' onclick='postValue()' value='APPLY'>";

$page.= "<h3> Base: $base </h3><br>";
$page.= $table;
$page.= " <br><button onclick=\"location.href='login.html'\">LOGIN</button> ";
$page.= " <br><button onclick=\"location.href='profile.php'\">PROFILE</button> ";
$page.= " <br><button onclick=\"location.href='trade.html'\">TRADE</button> ";

echo $page;


?>