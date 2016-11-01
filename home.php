<?php

function homepage($user, $base, $client){

	$homeReq = array();
	$homeReq['type'] = "get_ex_for_base";
	$homeReq['base'] = $base;
	$table = $client->send_request($homeReq);
		
	$page = "<h1> HOMEPAGE </h1> <br>";

	$page.= "<h3> Welcome " . $user . "</h3> <br><br>";

	$page.= $table;

	$page.= "<br> <br>";
	
	$page.= " <button onclick=\"location.href='index.html'\">Go to Main</button> ";

	echo $page;
}

function profile($user, $client){

	$profReq = array();
	$profReq['type'] = "get_user_pos";
	$profReq['username'] = $user;

	$table = $client->send_request($profReq);

	$page = "<h1> Profile </h1> <br>";

	$page.= "<h3> $user" . "'s Positions </h3> <br><br>";

	$page.= $table;

	$page.= "<br> <br>";
	
	$page.= " <button onclick=\"location.href='index.html'\">Go to Main</button> ";

	echo $page;
}
?>
