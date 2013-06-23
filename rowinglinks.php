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
<title>Rowing Links- United Limerick Rowing Federation</title>
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
<!--***********This is the START of the wrapper***********-->

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
        <li><a href="regattacalender.php" title="Regatta calender">Competitive</a></li>
        <li><a href="results.php" title="Results Page" >Results</a></li>
        <li> <a href="otherevents.php" title="Club Events" >Club Events</a></li>
        <li><a href="safety.php" title="Saftey Information" >Safety</a></li>
        <li> <a href="rowinglinks.php" class="current" title="Rowing Links" >Other Links</a></li>
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
        <p>&gt;&gt;01 Dec Castleconnell Head of the River, O'Brian's Bridge</p>
        <p>&gt;&gt;05 Jan Kerry Head of the River, Kilorgran</p>
        <p>&gt;&gt;<a href="regattacalender.php">All Events</a></p>
      </div>
      <div class="newsboxheader">
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
        <a href="https://www.facebook.com/pages/United-Limerick-Rowing-Federation/368315433254464?ref=hl"><img src="images/facebookbutton1.jpg" width="145" height="100" alt="ULRF Facebook page" /></a>
       <a href="https://twitter.com/ULRFederation"> <img src="images/twitterbutton1.jpeg" width="145" height="100" alt="ULRF Twitter Page" /></a>
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
    
    <p>| <a href="home.php">Home</a> | <a href="rowinglinks.php">Rowing Links</a> |</p>
    
    <hr />
    <h2>Rowing Clubs</h2>
    <ul>
    
    	<li><a href="http://shannonrowingclub.com/">Shannon Rowing Club</a></li>
        <li><a href="http://athlunkard.blogspot.ie/">Atlunkard Boat Club</a></li>
        <li><a href="http://www.ulrowing.com/pages/index.php">University of Limerick Rowing Club</a></li>
        <li><a href="http://www.castleconnellbc.ie/website/">Castleconnel Boat Club</a></li>
        <li><a href="http://www.smrc.ie/index.php">St. Michaels Rowing Club</a></li>
        
    </ul>
    <p><a href="#top">Back to top</a></p>
    
   <hr />
   
   <h2>Governing Bodies</h2>
   
   <ul>
   
   <li><a href="http://www.iaru.ie/">The Irish Ametuer Rowing Union</a></li>
   <li><acronym title="Fédération Internationale des Sociétés d'Aviron"><a href="http://www.worldrowing.com/">FISA World Rowing</a></acronym></li>
   <li><a href="http://www.rowingireland.com/">Rowing Ireland High performance Team</a></li>
   
   </ul>
   
   <p><a href="#top">Back to top</a></p>
   
   <hr />
   
   <h2>Weather</h2>
   <ul>
   <li><a href="http://www.windguru.cz/int/">Wind-guru</a></li>
   <li><a href="http://www.met.ie/">Met Eireann</a></li>
   
   
   </ul>
   <p><a href="#top">Back to top</a></p>
   
   <hr />
   
      
   
   <h2>Equipment</h2>
   
   <ul>


<li><a href="http://www.concept2.com/us/default.asp" >Concept2</a></li>

<li><a href="http://www.empacher.com/index_e.html" >Empacher Boats</a></li>

<li><a href="http://www.filippiboats.it/" >Filippi Boats</a></li>

<li><a href="http://www.janousek.co.uk/">Janousek Boats</a></li>

<li><a href="http://www.oarsport.co.uk/products/" >Wintech Boats</a></li>

<li><a href="http://www.powerhousesport.com/store/comersus_index.asp" >Powerhouse Sports</a> - Hi-Tech Rowing Wear </li>

<li><a href="http://www.godfrey.co.uk/" >Godfrey Sports</a> - Hi-Tech Rowing Wear </li>

<li><a href="http://www.indespension.co.uk/b2c/jsp/ireland-limerick.jsp" >Indespension Trailors</a></li>

<li><a href="http://www.degraafftrailers.co.uk/">De Graff Trailors</a></li>

</ul>

<p><a href="#top">Back to top</a></p>

<hr />

<h2>MISC LINKS</h2>

<ul>

<li><a href="http://www.teamer.net/" >Teamer - sports team online managament system</a></li>

<li><a href="http://rowireland.proboards.com/index.cgi">Row Ireland - web forum</a></li>

<li><a href="http://www.aaireland.ie/routes/" >AA road route planning</a></li>

<li><a href="http://www.limerickcoordination.ie/">Limerick Co Ordination Office</a></li>
   
</ul>  

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
        <h2> <a href="limerickregatta.php" title="Limerick Regatta Information"> Limerick Regatta </a></h2>
      </div>
      <div class="newsbox">
        <h3>Overall club (Points)</h3>
        <p>>>1. St. Michaels Rowing Club Limerick (593)</p>
        <p>>>2. Castleconnell Boat Club Limerick (489) </p>
        <p>>>3. Shannon Rowing Club Limerick (359)</p>
        <p>>><a href="limerickregatta.php" title="Limerick Regatta Information">Overall Results </a></p>
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
 
 
 <li><a href="accessability.php" title="Accessiblity">Accessibility</a> </li>
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