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
$MM_authorizedUsers = "1,2";
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

$MM_restrictGoTo = "viewmemberdetails.php";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE users SET username=%s, password=%s, userlevel=%s, email=%s, agestatus=%s, scullstatus=%s, sweepstatus=%s, club=%s WHERE userid=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['userlevel'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['agestatus'], "int"),
                       GetSQLValueString($_POST['scullstatus'], "int"),
                       GetSQLValueString($_POST['sweepstatus'], "int"),
                       GetSQLValueString($_POST['club'], "int"),
                       GetSQLValueString($_POST['userid'], "int"));

  mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
  $Result1 = mysql_query($updateSQL, $msc36_rowerreg) or die(mysql_error());

  $updateGoTo = "viewmemberdetails.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstage = "SELECT * FROM agestatus";
$rstage = mysql_query($query_rstage, $msc36_rowerreg) or die(mysql_error());
$row_rstage = mysql_fetch_assoc($rstage);
$totalRows_rstage = mysql_num_rows($rstage);

mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstuserlev = "SELECT * FROM userlevel";
$rstuserlev = mysql_query($query_rstuserlev, $msc36_rowerreg) or die(mysql_error());
$row_rstuserlev = mysql_fetch_assoc($rstuserlev);
$totalRows_rstuserlev = mysql_num_rows($rstuserlev);

mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstclub = "SELECT * FROM club";
$rstclub = mysql_query($query_rstclub, $msc36_rowerreg) or die(mysql_error());
$row_rstclub = mysql_fetch_assoc($rstclub);
$totalRows_rstclub = mysql_num_rows($rstclub);

mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstscull = "SELECT * FROM scullstatus";
$rstscull = mysql_query($query_rstscull, $msc36_rowerreg) or die(mysql_error());
$row_rstscull = mysql_fetch_assoc($rstscull);
$totalRows_rstscull = mysql_num_rows($rstscull);

mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_rstsweep = "SELECT * FROM sweepstatus";
$rstsweep = mysql_query($query_rstsweep, $msc36_rowerreg) or die(mysql_error());
$row_rstsweep = mysql_fetch_assoc($rstsweep);
$totalRows_rstsweep = mysql_num_rows($rstsweep);

$colname_Recordset1 = "-1";
if (isset($_GET['userid'])) {
  $colname_Recordset1 = $_GET['userid'];
}
mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
$query_Recordset1 = sprintf("SELECT * FROM users WHERE userid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $msc36_rowerreg) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Members Area Edit Member Details -United Limerick Rowing Federation</title>
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
        <li> <a href="contactus.php" title="Contact Us">Contact</a></li>
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
        <a href="https://www.facebook.com/pages/United-Limerick-Rowing-Federation/368315433254464?ref=hl" title="Our Facebook Page"><img src="images/facebookbutton1.jpg" width="145" height="100" alt="ULRF Facebook page" /></a>
        <a href="https://twitter.com/ULRFederation"> <img src="images/twitterbutton1.jpeg" width="145" height="100" alt="ULRF Twitter Page" title="Our Twitter Page" /></a>
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
      <p>| <a href="home.php">Home</a> | <a href="index.php">Members Area</a> | <a href="viewmemberdetails.php">View Member Details</a> | Edit Member Records |</p>
      <hr />
      <p>&nbsp;</p>
      <p>Please Select the Fields you need to edit.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div class="tablecenter">
      <form action="<?php echo $editFormAction; ?>" method="post" id="form1">
        <table align="center">
          <tr valign="baseline">
            <td align="right">Name:</td>
            <td><input type="text" name="username" value="<?php echo htmlentities($row_Recordset1['username'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="First and Last Name" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right">Email:</td>
            <td><input type="text" name="email" value="<?php echo htmlentities($row_Recordset1['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Email Address" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right">Age Status:</td>
            <td><select name="agestatus">
              <?php 
do {  
?>
              <option value="<?php echo $row_rstage['agestatusid']?>" <?php if (!(strcmp($row_rstage['agestatusid'], htmlentities($row_Recordset1['agestatus'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rstage['agestatus']?></option>
              <?php
} while ($row_rstage = mysql_fetch_assoc($rstage));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td align="right">Scull Status:</td>
            <td><select name="scullstatus">
              <?php 
do {  
?>
              <option value="<?php echo $row_rstscull['scullstatusid']?>" <?php if (!(strcmp($row_rstscull['scullstatusid'], htmlentities($row_Recordset1['scullstatus'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rstscull['scullstatus']?></option>
              <?php
} while ($row_rstscull = mysql_fetch_assoc($rstscull));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td align="right">Sweep Status:</td>
            <td><select name="sweepstatus">
              <?php 
do {  
?>
              <option value="<?php echo $row_rstsweep['sweepstatusid']?>" <?php if (!(strcmp($row_rstsweep['sweepstatusid'], htmlentities($row_Recordset1['sweepstatus'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rstsweep['sweepstatus']?></option>
              <?php
} while ($row_rstsweep = mysql_fetch_assoc($rstsweep));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td align="right">Club:</td>
            <td><select name="club">
              <?php 
do {  
?>
              <option value="<?php echo $row_rstclub['clubid']?>" <?php if (!(strcmp($row_rstclub['clubid'], htmlentities($row_Recordset1['club'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rstclub['club']?></option>
              <?php
} while ($row_rstclub = mysql_fetch_assoc($rstclub));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
          </tr>
        </table>
        <input type="hidden" name="userid" value="<?php echo $row_Recordset1['userid']; ?>" />
        <input type="hidden" name="password" value="<?php echo htmlentities($row_Recordset1['password'], ENT_COMPAT, 'utf-8'); ?>" />
        <input type="hidden" name="userlevel" value="<?php echo htmlentities($row_Recordset1['userlevel'], ENT_COMPAT, 'utf-8'); ?>" />
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="userid" value="<?php echo $row_Recordset1['userid']; ?>" />
      </form>
      </div>
      <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
      <p>&nbsp;<a href="<?php echo $logoutAction ?>">Log out</a></p>
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
        <h2> <a href="aboutus.php" title="About Us Page"> Sponsors</a></h2>
      </div>
      <div class="newsbox">
      <a href="http://www.bettercallsaul.com/"> <img src="images/bettercallsaul1.jpg" width="145" height="100" alt="Sponser:Legal Services By Saul Goodman" title="Better Call saul" /></a>
      
       <a href="http://greentrackstours.com/"> <img src="images/greentracktours1.jpg" alt="Sponser: Green Track Tours" title="Green Track Tours"  /> </a>
      </div>
      <!--This is the end of subsetarea2 -->
    </div>
    
     <!--This is the START of footer-->
  <div id="footer">
  
  <div id="footerlinks">
 <ul>
 
 
 <li> <a href="sitemap.php">Site Map</a> </li>
 
 
 <li><a href="accessability.php">Accessibility</a> </li>
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
mysql_free_result($rstage);

mysql_free_result($rstuserlev);

mysql_free_result($rstclub);

mysql_free_result($rstscull);

mysql_free_result($rstsweep);

mysql_free_result($Recordset1);
?>
