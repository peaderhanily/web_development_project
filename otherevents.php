<?php require_once('Connections/msc36_rowerreg.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "userlevel";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "logintake2.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_msc36_rowerreg, $msc36_rowerreg);
  	
  $LoginRS__query=sprintf("SELECT email, password, userlevel FROM users WHERE email=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $msc36_rowerreg) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'userlevel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Other Events-United Limerick Rowing Federation</title>
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


<!--******This is the START of the wrapper******-->
<div id="wrapper">

 <a name="top" id="top"></a>
  
   <div id="header" title="United Limerick Rowing Federation, 'Rowing together'"><h1>United Limerick Rowing Federation  
    "Rowing Together" </h1>
    </div>
  <!--This is the ENDd of the header section-->
  <!--This is the START of the Navbar-->
  <div id="navbar">
    <div id="navlinks">
      <ul>
        <li><a href="home.php" title="Hompage">Home</a></li>
        <li><a href="aboutus.php" title="About Us" >About Us</a></li>
        <li><a href="regattacalender.php" title="Regatta calender">Competitive</a></li>
        <li><a href="results.php" title="Results Page" >Results</a></li>
        <li> <a href="otherevents.php" class="current" title="Club Events" >Club Events</a></li>
        <li><a href="safety.php" title="Saftey Information" >Safety</a></li>
        <li> <a href="rowinglinks.php" title="Rowing Links" >Other Links</a></li>
        <li> <a href="index.php" title="Members Area" >Members</a></li>
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
        <p>&gt;&gt;<a href="regattacalender.php">All Events</a></p>
      </div>
      <div class="newsboxheader" >
        <h2> <a href="results.php" title="Results Page">Latest Results</a></h2>
      </div>
      <div class="newsbox">
        <p>>>05 Aug Carrick on Shannon sprint Regatta</p>
        <p>>>21 Jul Home International Regatta</p>
        <p>>>12 Jul Irish Rowing Championships 2012</p>
        <p>>>24 Jun Fermoy Regatta 2012</p>
        <p>>><a href="results.php">All Results</a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="contactus.php" title="Contact Us">Connect with us</a></h2>
      </div>
      <div class="newsbox">
        <a href="https://www.facebook.com/pages/United-Limerick-Rowing-Federation/368315433254464?ref=hl" title="Our Facebook Page"><img src="images/facebookbutton1.jpg" width="145" height="100" alt="ULRF Facebook page" /></a>
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
      <p>| <a href="home.php">Home</a> | <a href="otherevents.php">Other Events</a> |</p>
      <hr />
      <h2>World Rowing Tour</h2>
      <p>The 2013 World rowing tour will be hosted by St. Michaels Rowing Club Limerick. Starting in Carrick on Shannon County Leitrim and Finishing at the St. Michaels Clubhouse why not take part in it yourself. For more information please go to the, <br />
      <a href="http://www.smrc.ie/fisa.php">St. Michaels Club Website</a></p>
      <p>&nbsp;</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      
      <h2>Club BBQ</h2>
      <p>A big thank you to all our members, parents and friends who came to our Club BBQ, on the only fine day of summer! It was great to see so many familiar and new faces enjoying themselves. Good food and great company are the best recipe for a successful party.</p>
      <p>A big thanks also goes to everyone who helped out on the days leading up to the BBQ. From transporting tables and chairs, plates, cleaning, baking, cooking, sound production, transformation of gym, setting up the gazebo, and washing all those plates and cutlery. And of course the big clean up the following day! It was hard work but worth it.</p>
      <p>Thank you to all those who gave spot prizes for our raffle on the day, they were greatly appreciated.</p>
      <p>&nbsp;</p>
      <p><a href="#top">Back to top</a></p>

<hr />

<h2>Winter Boat Ball</h2>
<p> The Winter boat ball scheduled for the Saturday 22nd of December is now being organized if you would like to help out with this great occasion and funrasier your assistance would be greatly appreciated contact the <a href="mailto:ulrfederation@gmail.com">club secretary</a> to leave your details.</p>
<p>&nbsp;</p>
<p><a href="#top">Back to top</a></p>
<hr />
<h2>Limerick Regatta 2013</h2>

<p>Limerick Regatta is now being organized by the United Limerick Rowing Federation for the first time in its history. This prestigious events decorated history will now be carried into the 21st century by the new organization. We are still counting on the help of all the volunteers who made this event such a success in the past. If you would like to learn more about Limerick Regatta and volunteer to help us run it please click <a href="limerickregatta.php">here</a> for full details.</p>
<p>&nbsp;</p>
<p><a href="#top">Back to top</a></p>
<hr />

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
        <h2> <a href="index.php"> Members Area</a></h2>
      </div>
    <div class="newsbox"> 
    
    <?php 	if (isset($_SESSION['MM_Username'])) {
		
		
		echo("<p>Logged on as: ". $_SESSION['MM_Username']); ?> </p>
		
			
  
  
  
    <?php } 
	else { ?>

  
       
           
        <form id="form1" method="POST" action="<?php echo $loginFormAction; ?>">
          <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Email" />
          </p>
          <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" />
          </p>
          <p>&nbsp;</p>
          <p>
            <input type="submit" name="login" id="login" value="Login" />
          </p>
        </form>
        <p>&nbsp;</p>
    
  
        <?php } ?>
    
  </div> 
   
   
   
   
      <div class="newsboxheader">
        <h2> <a href="limerickregatta.php" title="Limerick Regatta"> Limerick Regatta </a></h2>
      </div>
      <div class="newsbox">
        <h3>Overall club (Points)</h3>
        <p>>>1. St. Michaels Rowing Club Limerick (593)</p>
        <p>>>2. Castleconnell Boat Club Limerick (489) </p>
        <p>>>3. Shannon Rowing Club Limerick (359)</p>
        <p>>><a href="limerickregatta.php">Overall Results </a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="otherevents.php" title="Club Events"> Fundraising</a></h2>
      </div>
      <div class="newsbox">
        <p>>>06 Nov,Pub Quiz, Jerry Flannerys Bar 8pm-11pm</p>
        <p>>>25 Dec, Sponsored Row, Shannon Bridge to the Snuff Box 10am-11am</p>
        <p>>><a href="otherevents.php">All Event</a></p>
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
 
 
 <li><a href="accessability.php" title="Accessability">Accessibility</a> </li>
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