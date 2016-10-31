<?php

function homepage($user, $base, $client){

	$homeReq = array();
	$homeReq['type'] = "get_ex_for_base";
	$homeReq['base'] = $base;
	$table = $client->send_request($homeReq);
	
	echo "<h1> HOMEPAGE </h1> <br>";
	echo "<h3> Welcome " . $user . "</h3> <br><br>";

	echo $table;

	echo "<br> <br>";
	echo "";#profile page button
	echo "";#logout button


}

?>
