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
<title>home-United Limerick Rowing Federation</title>
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
        <li><a href="home.php" class="current" title="Hompage">Home</a></li>
        <li><a href="aboutus.php" title="About Us" >About Us</a></li>
        <li><a href="regattacalender.php" title="Regatta calender">Competitive</a></li>
        <li><a href="results.php" title="Results Page" >Results</a></li>
        <li> <a href="otherevents.php" title="Club Events" >Club Events</a></li>
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
        <p>&gt;&gt;<a href="regattacalender.php" title="Regatta Calender">All Events</a></p>
      </div>
      <div class="newsboxheader">
        <h2> <a href="results.php" title="Results">Latest Results</a></h2>
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
        <a href="https://www.facebook.com/pages/United-Limerick-Rowing-Federation/368315433254464?ref=hl" title="Our facebook Page"><img src="images/facebookbutton1.jpg" width="145" height="100" alt="ULRF Facebook page" /></a>
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
      <p>| <a href="home.php">Home</a> |</p>
      <hr />
      <h2><acronym title="Annual General Meetings">AGM's</acronym></h2>
      <p>With the new Season about to begin many Limerick clubs are now holding there AGM's</p>
      <p> The United Limerick Rowing Federation Annual General Meeting will be held in St. Michael's Rowing Club on Thursday 15 November 2012. All paid up senior members will be entitled to vote. </p>
      <p> The AGM of St. Michael's Sporting Club will be held in the Rowing Club on Fri 16 Nov 2012. Notices of Motion to be sent to the Secretary, SMSC by 6pm on Wed 17 Oct 2012. Nominations for President to be sent to the Secretary, SMSC by 6pm Fri 2nd Nov 2012.All paid up senior members will be entitled to vote.</p>
      <p> Other AGM Dates for UL Rowing Club, Athlunkard Rowing Club,Shannon Rowing Club and Castleconnell Rowing Club will be added when known.</p>
      <p><a href="#top">Back to top</a></p>
      
      <hr />
      <h2><acronym title="Fédération Internationale des Sociétés d'Aviron also known as World Rowing"> FISA World Rowing Tour Ireland</acronym></h2>
      <p>FISA 2013 comes to Ireland and St. Michael's rowing club is proud to be selected to host this exciting event for recreational rowers.</p>
      <p>See the <a href="http://www.smrc.ie/fisa.php">information page</a> on the St. Michaels website for more details.</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <h2>Membership 2013 </h2>
      <p>Membership fee's are now due for the 2012-2013 season. This should be given to the Club Secretary or the Captain. Fee's are the same as last year with a new rate of &euro;50 for members living 100km from Limerick. It is hoped that this will encourage members who have moved away to keep in touch with the club by allowing them the use of facilities when back in Limerick</p>
      <p>For those seeking Membership please go to the <a href="contactus.php">Contact Us</a> page and e-mail the Club Secretary </p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <h2>Club Barbecue</h2>
      <p>The Annual Club Barbecue was held on the 15th of August in Shannon Rowing Club. Fine weather provided a perfect backdrop to an evening celebrating the achievements of the all the Limericks Rowers domestically and international</p>
      <p>. (<a href="results.php">Results</a>) </p>
      <p>A big thank you must go out to all the club committee's who put in a big effort to get everything organized and all the rowers and their families and friends who were in attendance. A great evening for all involved.</p>
      <p>More fundraising events will be happening see <a href="otherevents.php">Other Events</a> for details.</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <h2>Limerick Rower at Olympic Regatta</h2>
      <p>Best wishes to Sean O’Neill who strokes the New Zealand cox less four at the Olympic regatta in London next week. Sean is unique in that he competed in the same event in Beijing representing Ireland. Sean originally from Palaskenry can be sure of a support all the Limerick Oarsmen and Women.</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <h2>Worlds End Triathlon</h2>
      <p>Castleconnell are hosting a Triathlon from there Clubhouse in Worlds End more information can be found on the <a href="http://www.castleconnellbc.ie/website/">Castleconnell rowing club website</a>.</p>
      <p><a href="#top">Back to top</a></p>
      <hr />
      <h2>Summer Camps</h2>
      <p>Castleconnell are hosting a summer camp for teenagers. A great way to for young people to get involved in rowing before next season starts in September more information can be found on the <a href="http://www.castleconnellbc.ie/website/">Castleconnell Boat club website</a>.</p>
      <p>St. Michael's Rowing Club are hosting a summer camp aimed at both young people and adults of all ages (18+) more information can be found on the <a href="http://www.smrc.ie/">St. Michael's Rowing website</a>.</p>
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
        <h2> <a href="aboutus.php" title="About us"> Sponsors</a></h2>
      </div>
      <div class="newsbox">
        <a href="http://www.bettercallsaul.com/" title="Better Call Saul"> <img src="images/bettercallsaul1.jpg" width="145" height="100" alt="Sponser:Legal Services By Saul Goodman" /></a>
        <a href="http://greentrackstours.com/" title="Green Track tours"> <img src="images/greentracktours1.jpg" alt="Sponser: Green Track Tours"  /> </a>
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
