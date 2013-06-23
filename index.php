<?php require_once('Connections/msc36_rowerreg.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "home.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2,3";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$colname_rstusers = "-1";
if (isset($_SESSION['Var_user'])) {
  $colname_rstusers = $_SESSION['Var_user'];
}
mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstusers = sprintf("SELECT * FROM users WHERE email = %s", GetSQLValueString($colname_rstusers, "text"));
$rstusers = mysql_query($query_rstusers, $msc36_rowerreg) or die(mysql_error());
$row_rstusers = mysql_fetch_assoc($rstusers);
$colname_rstusers = "-1";
if (isset($_SESSION['Var_email'])) {
  $colname_rstusers = $_SESSION['Var_email'];
}
mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstusers = sprintf("SELECT * FROM users WHERE email = %s", GetSQLValueString($colname_rstusers, "text"));
$rstusers = mysql_query($query_rstusers, $msc36_rowerreg) or die(mysql_error());
$row_rstusers = mysql_fetch_assoc($rstusers);
$maxRows_rstusers = 2;
$pageNum_rstusers = 0;
if (isset($_GET['pageNum_rstusers'])) {
  $pageNum_rstusers = $_GET['pageNum_rstusers'];
}
$startRow_rstusers = $pageNum_rstusers * $maxRows_rstusers;

$colname_rstusers = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rstusers = $_SESSION['MM_Username'];
}
mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstusers = sprintf("SELECT * FROM users WHERE email = %s ORDER BY username ASC", GetSQLValueString($colname_rstusers, "text"));
$query_limit_rstusers = sprintf("%s LIMIT %d, %d", $query_rstusers, $startRow_rstusers, $maxRows_rstusers);
$rstusers = mysql_query($query_limit_rstusers, $msc36_rowerreg) or die(mysql_error());
$row_rstusers = mysql_fetch_assoc($rstusers);

if (isset($_GET['totalRows_rstusers'])) {
  $totalRows_rstusers = $_GET['totalRows_rstusers'];
} else {
  $all_rstusers = mysql_query($query_rstusers);
  $totalRows_rstusers = mysql_num_rows($all_rstusers);
}
$totalPages_rstusers = ceil($totalRows_rstusers/$maxRows_rstusers)-1;

$queryString_rstusers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rstusers") == false && 
        stristr($param, "totalRows_rstusers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rstusers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rstusers = sprintf("&totalRows_rstusers=%d%s", $totalRows_rstusers, $queryString_rstusers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Members Area User Page -United Limerick Rowing Federation</title>
<link rel="icon" type="image/ico" href="images/rowingfavicon.ico"/>

<link href="css-base1.2.css" rel="stylesheet" type="text/css" title="default" />

<link href="css-base-opendyslexic.css" rel="stylesheet" type="text/css" title="opendyslexic" />

<script src="styleswitch.js" language="JavaScript" type="text/javascript"></script>

</head>


<body onload="set_style_from_cookie()">


<form action="styleswitch.js" >
<input type="submit" onclick="switch_style('default'); return false;" name="default" value="Default view" id="default" />
<input type="submit" onclick="switch_style('opendyslexic'); return false;" name="opendyslexic" value="Dyslexic Aid" id="opendyslexic" />			
</form>
<p><a href="accessability.php">Need Help ?</a></p>


<!--********This is the START of the wrapper************-->

<div id="wrapper">
  <!--This is the START of the header section-->
   <a name="top" id="top"></a>
  
  <div id="header" title="United Limerick Rowing Federation, 'Rowing together'"><h1>United Limerick Rowing Federation  
    "Rowing Together" </h1>
    </div>
  
  <!--This is the END of the header section-->
  <!--This is the START of the Navbar-->
  <div id="navbar">
    <div id="navlinks">
      <ul>
        <li><a href="home.php" title="Hompage">Home</a></li>
        <li><a href="aboutus.php" title="About Us" >About Us</a></li>
        <li><a href="regattacalender.php" title="Regatta calender">Competitive</a></li>
        <li><a href="results.php" title="Results Page" >Results</a></li>
        <li> <a href="otherevents.php" title="Club Events" >Club Events</a></li>
        <li><a href="safety.php" title="Saftey Information" >Safety</a></li>
        <li> <a href="rowinglinks.php" title="Rowing Links" >Other Links</a></li>
        <li> <a href="index.php" class="current" title="Members Area" >Members</a></li>
        <li> <a href="gallery.php" title="Gallery">Gallery</a></li>
        <li> <a href="contactus.php"  title="Contact Us">Contact</a></li>
      </ul>
    </div>
  </div>
  <!--This is the END of the navbar-->
  <!--This is the START of the innerwrapper-->
  <div id="innerwrapper">
    <!--This is the START of the subsetarea1-->
    <div id="subsetarea1">
      <div class="newsboxheader">
        <h2><a href="regattacalender.php" title="Regatta Calender">Upcoming Events</a></h2>
      </div>
      <div class="newsbox">
        <p>>>20 Oct Skibbereen Head of the River,NRC</p>
        <p>&gt;&gt;10 Nov Neptune Head of the River, Blessington</p>
        <p>&gt;&gt;01 Dec Castleconnell Head of the River, Obrians Bridge</p>
        <p>&gt;&gt;05 Jan Kerry Head of the River, Kilorgran</p>
        <p>&gt;&gt;<a href="regattacalender.php" title="Regatta Calender">All Events</a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="results.php" title="Results Page">Latest Results</a></h2>
      </div>
      <div class="newsbox">
        <p>>>05 Aug Carrick on Shannon sprint Regatta</p>
        <p>>>21 Jul Home International Regatta</p>
        <p>>>12 Jul Irish Rowing Championships 2012</p>
        <p>>>24 Jun Fermoy Regatta 2012</p>
        <p>>><a href="results.php" title="Results Page">All Results</a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="contactus.php" title="Contact Us">Connect with us</a></h2>
      </div>
      <div class="newsbox">
        <a href="https://www.facebook.com/pages/United-Limerick-Rowing-Federation/368315433254464?ref=hl" title="Our Facbook Page"><img src="images/facebookbutton1.jpg" width="145" height="100" alt="ULRF Facebook page" /></a>
       <a href="https://twitter.com/ULRFederation" title="Our Twitter Page"> <img src="images/twitterbutton1.jpeg" width="145" height="100" alt="ULRF Twitter Page" /></a>
       </div>
       
        <div class="newsboxheader">
        <h2> <a href="gallery.php" title="Gallery"> Random Image </a></h2>
      </div>
     
      <div class="newsbox">
      <img src="otherimages/<?php echo rand(1,12);?>.jpg" alt="Random Image from the Gallery" width="145" height="100" />
            </div>
        <!--this is the END of subsetarea1-->
      
    </div>
    <!-- this is the start of the main area-->
    <div id="mainarea">
      <p>| <a href="home.php">Home</a> | <a href="index.php">Members area</a> | </p>
      <hr />
      
      <h2>Welcome <?php echo $row_rstusers['username']; ?></h2>
      <p>&nbsp;</p>
            <p><a href="<?php echo $logoutAction ?>">Log out</a></p>

      <p>&nbsp;</p>
      <p>Please Click on the appropriate Link</p>
      <p>&nbsp;</p>
      <div class="accesslinkbox">
        <h3>Click Here to view Member Records </h3>
        <p>&nbsp;</p>
        <p><a href="viewmemberdetails.php">View Member Details</a></p>
        <p>&nbsp;</p>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div class="accesslinkbox">
        <h3>This is for Admin and Coaches Only!</h3>
        <p>&nbsp;</p>
        <p>All other users will be unable to access this page</p>
        <p>&nbsp;</p>
        <p><a href="addmembers.php">Add Members</a></p>
      </div>
      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <p>&nbsp;</p>
      <h2>Coming soon</h2>
      <p>&nbsp;</p>
      <p>A Members only forum</p>
      <p>&nbsp;</p>
      <p>A Online Boat Schedule</p>
      <p>&nbsp;</p>
      <p>Other amazing features !</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Let us know what you want </p>
      <p>&nbsp;</p>
      <p><a href="contactus.php">Here</a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <!--This is the end of the main area-->
    </div>
    <!-- This is the start of subsetarea2-->
    <div id="subsetarea2">
     
      <div class="newsboxheader">
        <h2> <a href="limerickregatta.php" title="Limerick Regatta"> Limerick Regatta </a></h2>
      </div>
      <div class="newsbox">
        <h3>Overall club (Points)</h3>
        <p>>>1. St. Michaels Rowing Club Limerick (593)</p>
        <p>>>2. Castleconnell Boat Club Limerick (489) </p>
        <p>>>3. Shannon Rowing Club Limerick (359)</p>
        <p>>><a href="limerickregatta.php" title="Limerick Regatta">Overall Results </a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="otherevents.php" title="Club Events"> Fundraising</a></h2>
      </div>
      <div class="newsbox">
        <p>>>06 Nov,Pub Quiz, Jerry Flannerys Bar 8pm-11pm</p>
        <p>>>25 Dec, Sponsored Row, Shannon Bridge to the Snuff Box 10am-11am</p>
        <p>>><a href="otherevents.php" title="Club Events">All Event</a></p>
      </div>
      <!-- this is the start of the sponsers section-->
      <div class="newsboxheader">
        <h2> <a href="aboutus.php" title="About Us"> Sponsors</a></h2>
      </div>
      <div class="newsbox">
        <a href="http://www.bettercallsaul.com/" title="Better Call Saul"> <img src="images/bettercallsaul1.jpg" width="145" height="100" alt="Sponser:Legal Services By Saul Goodman" /></a>
        <a href="http://greentrackstours.com/" title="Green Track Tours"> <img src="images/greentracktours1.jpg" alt="Sponser: Green Track Tours"  /> </a>
      </div>
      <!--This is the end of subsetarea2 -->
    </div>
    
     <!--This is the START of footer-->
  <div id="footer">
  
  <div id="footerlinks">
 <ul>
 
 
 <li> <a href="sitemap.php" title="Sitemap">Site Map</a> </li>
 
 
 <li><a href="accessability.php" title="Accessability Page">Accessibility</a> </li>
 </ul>
 </div>
  </div>
  <!-- this is the END of the footer-->
  
    
  </div>
  <!-- this is he END of the inner wrapper-->
  
  
</div>
 <!-- This is the END of the wrapper-->
</body>
</html>
<?php
mysql_free_result($rstusers);
?>
