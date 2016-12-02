<?php


echo '<link rel="stylesheet" href="login.css">';
echo '<link rel="icon" href="/favicon.ico?v=2" type="image/x-icon"/>';

echo '<meta charset="utf-8">';
echo '<title>Spafin</title>';

// FONTS
echo '<script src="js/jquery-2.1.3.min.js"></script>';
echo '<script src="js/bootstrap.min.js"></script>';
echo '<script src="js/myScripts.js"></script>';

// CSS
echo '<link rel="stylesheet" href="css/normalize.css">';
echo '<link rel="stylesheet" href="css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="css/mystyle.css">';


// HEADER 
echo "  <nav id=\"header\" class=\"navbar navbar-default-blue navbar-fixed-top\">\n"; 
echo "    <div class=\"container-fluid\">\n"; 
echo "      <div class=\"navbar-header\">\n"; 
echo "        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">\n"; 
echo "          <span class=\"icon-bar\"></span>\n"; 
echo "          <span class=\"icon-bar\"></span>\n"; 
echo "          <span class=\"icon-bar\"></span>\n"; 
echo "        </button>\n"; 
echo "        <a class=\"navbar-brand nucleusFont myFade nucleuslogo\" href=\"#\">Spafin</a>\n"; 
echo "      </div>\n"; 

if(isset($_SESSION["USER"]))
{
	$user = $_SESSION["USER"];
	$page.= "<h3> Welcome " . $user . "</h3>";
}

echo "      <div class=\"collapse navbar-collapse navbar-right allowUnderline\" id=\"myNavbar\">\n"; 
echo "        <ul class=\"nav navbar-nav\">\n"; 
echo "          <li class=\"active\"><a class=\"myFade\" href=\"index.html\">About Us</a></li>\n"; 
echo "          <li><a class=\"myFade\" href=\"aboutus.html\">Dow Jones</a></li>\n"; 
echo "          <li><a class=\"myFade\" href=\"seniors.html\">NASDAQ</a></li>\n"; 
echo "          <li><a class=\"myFade\" href=\"organizations.html\">S&P 500</a></li>\n";  
echo "        </ul>\n"; 
echo "      </div>\n"; 
echo "    </div>\n"; 
echo "  </nav>\n";


// Primary Page Layout

echo "  <div class=\"skewContainer\">\n"; 
echo "    <div class=\"body-container\">\n"; 
echo "\n"; 
echo "      <div class=\"container text-center\">\n"; 
echo "        <img src=\"assets/img/revisedlogo01white.svg\" style=\"max-height: 250px;\"></img>\n"; 
echo "        <h1>Spafin</h1>\n"; 
echo "      </div>\n"; 
echo "    </div>\n"; 
echo "\n"; 
echo "    <div class=\"body-image\">\n"; 
echo "      <div class=\"container text-center\" style=\"padding: 100px\">\n"; 
echo "\n"; 
echo "      </div>\n"; 
echo "    </div>\n"; 
echo "\n"; 
echo "    <div class=\"info-container\">\n"; 
echo "        <div class=\"container text-center\">\n"; 
echo "          <div class=\"row\">\n"; 
echo "            <div class=\"col-md-4\">\n"; 
echo "              <h3>Login</h3>\n"; 
echo "              <img src=\"assets/img/registerforportraits.svg\"/>\n"; 
echo "              <br/><br/>\n"; 
echo "              <p>\n"; 

echo "              </p>\n"; 
echo "            </div>\n"; 
echo "            <div class=\"col-md-4\">\n"; 
echo "             <h3>Profile</h3>\n"; 
echo "             <img src=\"assets/img/buythebook.svg\"/>\n"; 
echo "             <br/><br/>\n"; 
echo "             <p>\n"; 

echo "             </p>\n"; 
echo "            </div>\n"; 
echo "            <div class=\"col-md-4\">\n"; 
echo "              <h3>Trade</h3>\n"; 
echo "              <img src=\"assets/img/uploadyourpictures.svg\"/>\n"; 
echo "              <br/><br/>\n"; 
echo "              <p>\n"; 


echo "              </p>\n"; 
echo "            </div>\n"; 
echo "          </div>\n"; 
echo "        </div>\n"; 
echo "    </div>\n"; 
echo "\n"; 
echo "    <div class=\"contactus-container\">\n"; 
echo "        <div class=\"container text-center\">\n"; 
echo "          <h2>\n"; 
echo "            Contact Us\n"; 
echo "          </h2>\n"; 
echo "\n"; 
echo "          <p>\n"; 
echo "            If you would like to get in touch regarding any inquiries that you may have,\n"; 
echo "            please fill in the form below and we will get back to you as soon as possible.\n"; 
echo "          </p>\n"; 
echo "\n"; 
echo "          <div class=\"inputarea\">\n"; 
echo "            <p>Email:</p>\n"; 
echo "            <input type=\"textfield\" class=\"custominputtext myFade\">\n"; 
echo "          </div>\n"; 
echo "          <div class=\"inputarea\">\n"; 
echo "            <p>Subject:</p>\n"; 
echo "            <input type=\"textfield\" class=\"custominputtext myFade\">\n"; 
echo "          </div>\n"; 
echo "          <div class=\"inputarea\">\n"; 
echo "            <p>Message:</p>\n"; 
echo "            <textarea class=\"custominputtext myFade descriptioninput\"></textarea>\n"; 
echo "          </div>\n"; 
echo "          <div class=\"inputarea\">\n"; 
echo "            <a href=\"\" onclick=\"\" class=\"inputsubmit\">Submit</a>\n"; 
echo "          </div>\n"; 
echo "        </div>\n"; 
echo "    </div>\n"; 
echo "  </div>\n"; 

//FOOTER
echo "  <div id=\"footer\" class=\"footer\">\n"; 
echo "    <p>Email: mrs63@njit.edu</p>\n"; 
echo "  </div>\n";

#--------------------------------------------

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

// $page .= "<h1> HOMEPAGE </h1> <br>";
session_start();

if(!isset($_SESSION["BASE"]))
{
	$_SESSION["BASE"] = "USD";
}


// if(isset($_SESSION["USER"]))
// {
// 	$user = $_SESSION["USER"];
// 	$page.= "<h3> Welcome " . $user . "</h3>";
// }

$base = $_SESSION["BASE"];
$homeReq['type'] = "get_ex_for_base";
$homeReq['base'] = $base;
$table = $client->send_request($homeReq);
$page.= "<hr>";


$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$listReq = array();
$listReq['type'] = "get_curr_list";
$list = $client->send_request($listReq);

$page.= "<select id='mySelect'>";
$page.= "<option selected disabled>Select Base Currency</option>";
$ind = 0;
foreach($list as $arr)
{
	$page.= "<option>$arr</option>";
	$ind++;
}
$page.= "</select>
<br><br>
<input type='button' onclick='postValue()' value='APPLY'>";

$page.= "<br><h3>Base: " . $base . "</h3><br>";
$page.= $table;
$page.= " <br><button onclick=\"location.href='login.html'\">LOGIN</button> ";
$page.= " <br><button onclick=\"location.href='profile.php'\">PROFILE</button> ";
$page.= " <br><button onclick=\"location.href='trade.html'\">TRADE</button> ";

echo $page;

?>