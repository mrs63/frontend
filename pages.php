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
	
	$page.= " <button onclick=\"location.href='mainmenu.html'\">Go to Main Menu</button> ";

	echo $page;
}

?>
