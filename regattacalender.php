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
<title>Competitive- United Limerick Rowing Federation</title>
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


<!--******This is the START of the wrapper********-->

<div id="wrapper">
  <!--This is the START of the header section-->
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
        <li><a href="regattacalender.php" class="current" title="Regatta calender">Competitive</a></li>
        <li><a href="results.php" title="Results Page" >Results</a></li>
        <li> <a href="otherevents.php" title="Club Events" >Club Events</a></li>
        <li><a href="safety.php" title="Saftey Information" >Safety</a></li>
        <li> <a href="rowinglinks.php" title="Rowing Links" >Other Links</a></li>
        <li> <a href="index.php" title="Members Area" >Members</a></li>
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
        <p>&gt;&gt;<a href="regattacalender.php">All Events</a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="results.php" title="Results page">Latest Results</a></h2>
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
    
    <p>| <a href="home.php">Home</a> | <a href="regattacalender.php">Competitive</a> |</p>
    
    <hr />
    
    <h2> Domestic Event Calender </h2>
    
    <p> This is a list of events that Limerick Clubs will be competing at in the 2012-2013 season. Draws will be available 1 week before the event.</p>
    
    <ul> 
    	<li>20/10/12, Skibbereen Head of the River,National Rowing Centre Farran Wood Cork<br /></li>
        
       	<li>10/11/2012, Neptune Head of the River, Blessington Lakes Dublin<br /></li>
        
        <li>01/12/12, Castleconnel Head of the River, O'Brians Bridge Limerick<br /></li>
        
        <li>05/01/13, Kerrt Head of the river, Kilogran Kerry<br /></li>
        
      	<li>02/02/2013, St. Michaels Head of the River, O'Brien's Bridge Limerick<br /></li>
        
        <li>23/02/2013, Cork Head of the River, Marina Cork City<br /></li>
        
        <li>02/03/2013, Erne Head of the River, Enniskillen Fermanagh<br /></li>
        
        <li>16/03/2013, Tribesmen Head of the River, Galway<br /></li>
        
        <li>06/04/2013, Neptune Regatta, Islandbridge Dublin<br /></li>
        
        <li>13/04/2013, Irish University Championships, National Rowing Centre Farran Wood Cork<br /></li>
        
        <li>13/04/2013,Irish Schools Regatta,	 National Rowing Centre Farran Wood Cork<br /></li>
        
        <li>14/04/2013, Skibbereen Regatta, National Rowing Centre Farran Wood Cork<br /></li>
        
        <li>11/05/2013, Limerick Regatta, O'Brien's Bridge Limerick<br /></li>
        
        <li>01/06/2013, Carlow Regatta, Carlow<br /></li>
        
        <li>15/06/2013, Athlone Regatta, Coosan Point, Athlone<br /></li>
        
        <li>23/06/2013,Castleconnell Sprint Regatta, O'Brien's Bridge Limerick<br /></li>
        
        <li>29/06/2013, Cork Regatta, National Rowing Centre Farran Wood Cork<br /></li>
        
        <li>30/06/2013, Fermoy Sprint Regatta, Fermoy Cork<br /></li>
        
        <li>18/07/2013, Irish Rowing Championships, National Rowing Centre Farran Wood Cork<br /></li>
        
        <li>04/08/2013, Carrick-on-Shannon Sprint Regatta, Carrick-on-Shannon Leitrim<br /></li>
        
        
      
    </ul>
    <p><a href="#top">Back to top</a></p>
   
   <hr />
   
   <h2>International Event Calender</h2>
   
   <p>This is a list of events that Limerick Clubs will compete under the banner of the United Limerick Rowing Federation and also as part of Team Ireland</p>
   
   <ul>
   <li>13/10/12, <a href="http://www.pairshead.co.uk">Pairs Head of the River</a>, Thames London, As <acronym title="United Limerick Rowing Federation">ULRF</acronym><br /></li>
   
   <li>10/11/12, <a href="http://www.hor4s.org.uk">Fours Head of the River</a>, Thames London, As <acronym title="United Limerick Rowing Federation">ULRF</acronym><br /></li>
   
   <li>08/12/12, <a href="http://www.vestarowing.co.uk/">Vesta Scullers Head of the River</a>, Thames London, As <acronym title="United Limerick Rowing Federation">ULRF</acronym><br /></li>
   
   <li>09/03/13, <a href="http://www.wehorr.org">Womens 8's Head of the River</a>, Thames London, As <acronym title="United Limerick Rowing Federation">ULRF</acronym><br /></li>
   
   <li>23/03/13, <a href="http://www.horr.co.uk">The Head of the River Race</a> (Men's 8's Head), Thames London, As <acronym title="United Limerick Rowing Federation">ULRF</acronym><br /></li>
   
   <li>03/07/13 - 07/07/13, Henly Royal Regatta, Henly on Thames, As <acronym title="United Limerick Rowing Federation">ULRF</acronym><br /></li>
   
   <li>The Home International Regatta Date/Location:<acronym title="To be confirmed">TBC</acronym><br /></li>
   
   <li>The Coupe De la Junesse Date/Location:<acronym title="To be confirmed">TBC</acronym><br /></li>
   
   <li>The Junior World Rowing Championships Date/Location:<acronym title="To be confirmed">TBC</acronym><br /></li>
   
   <li>The Under 23 World Rowing Championshops Date/Location:<acronym title="To be confirmed">TBC</acronym></li>
    </ul>
   <br />
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
        <p>>>1. St.Michaels Rowing Club Limerick (593)</p>
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
        <h2> <a href="aboutus.php" title="About us"> Sponsors</a></h2>
      </div>
      <div class="newsbox">
        <a href="http://www.bettercallsaul.com/"> <img src="images/bettercallsaul1.jpg" width="145" height="100" alt="Sponser:Legal Services By Saul Goodman" /></a>
       <a href="http://greentrackstours.com/"> <img src="images/greentracktours1.jpg" alt="Sponser: Green Track Tours"  /> </a> 
      </div>
      <!--This is the end of subsetarea2 -->
    </div>
    
     <!--This is the START of footer-->
  <div id="footer">
  
  <div id="footerlinks">
 <ul>
 
 
 <li> <a href="sitemap.php" title="Sitemap">Site Map</a> </li>
 
 
 <li><a href="accessability.php" title="Accessibility">Accessibility</a> </li>
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