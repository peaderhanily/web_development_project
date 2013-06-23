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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Us-United Limerick Rowing Federation</title>
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


<!--******This is the START of the wrapper*******-->
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
        <li> <a href="otherevents.php" title="Club Events" >Club Events</a></li>
        <li><a href="safety.php" title="Saftey Information" >Safety</a></li>
        <li> <a href="rowinglinks.php" title="Rowing Links" >Other Links</a></li>
        <li> <a href="index.php" title="Members Area" >Members</a></li>
        <li> <a href="gallery.php" title="Gallery">Gallery</a></li>
        <li> <a href="contactus.php" class="current" title="Contact Us">Contact</a></li>
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
    
    <p>| <a href="home.php">Home</a> | <a href="contactus.php">Contact Us</a> |</p>
    
    <hr />
    
    <h2>Get in Contact with Us <br />
    Your Message Was Sent Successfully</h2>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <FORM id="form2" name="form2" METHOD="POST" ACTION="http://msc36.cmsmotion.com/cgi-bin/cgiemail/emailtemplate.txt">
      <div class="form2">
        <p>
          <label for="name">Name:</label>
          <INPUT TYPE="text" NAME="name" ID="name" placeholder="Your Name" />
        </p>
        <p>&nbsp;</p>
        <p>
          <label for="email2">Email: </label> 
          
          <INPUT TYPE="text" NAME="email2" ID="email2" placeholder="Email Address" />
        </p>
        <p>&nbsp;</p>
        <p>
          <label for="subject">Subject:</label>
          <INPUT TYPE="text" NAME="subject" ID="subject" placeholder="Subject" />
        </p>
        <p>&nbsp;</p>
        <p><label for="comments">Comments:</label></p>
      </div>
      
      <div class="contactusphoto"><img src="images/contactus.jpg" width="300" height="173" alt="Contact Us Please" /></div>
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
      <div class="commentsarea">
        
        <textarea name="comments" id="comments" cols="45" rows="5" placeholder="Comments"></textarea>
      </div>
      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>
        <INPUT TYPE="hidden" NAME="success" VALUE="http://msc36.cmsmotion.com/contactussuccess.php">
      </p>
      <p>&nbsp;</p>
      <div class="submit">
        <p>
          <INPUT TYPE="submit" NAME="submit" ID="submit" value="Submit" />
        </p>
    </div>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
    
    
    <p><a href="#top">Back to top</a></p>
   
   <hr />
   
    
    <h2> <acronym title="United Limerick Rowing Federation">ULRF</acronym> Main Contacts </h2>
    
    <h3>Club Houses</h3>
    
    <ul>
    
    <li>St. Michaels Rowing Club, O'Callaghan Strand, Limerick.<br /> Located on northern side of the Shannon river and adjacent to the City Slipway.</li>
    
    <li>&nbsp;</li>
    
    <li>Castleconnell Boat Club, Worlds End, Castleconnell Village, County Limerick.</li>
    <li></li>
    </ul>
    <p><a href="#top">Back to top</a></p>
   <hr />
   
   <h3>New Members</h3>
   <p>&nbsp;</p>
   
   <p>To join St. Michaels Rowing Club please attend any Friday from 4pm-7pm.</p>
   <p>&nbsp;</p>
   <p>To join Athlunkard Boat Club please attend any Thursday from 4pm-7pm.</p>
   <p>&nbsp;</p>
   <p>To join Castleconnel Boat Club please attend any Saturday 11am-1pm</p>
   <p>&nbsp;</p>
   <p>To join Shannon Rowing Club please attend any Saturday 1pm-4pm</p>
   <p>&nbsp;</p>
   <p>To join the University of Limerick Club please contact the Student Union</p>
   <p>&nbsp;</p>
   <p>For any Members already in affiliated clubs ask your coach for more information</p>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <p><a href="#top">Back to top</a></p>
   
   <hr />
   
   <h3>Website or Club information</h3>
   <p>&nbsp;</p>
   
   <p> Site Admin: </p>
   <p><a href="mailto:ulrfederation@gmail.com">ulrfederation@gmail.com</a></p>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <p><a href="#top">Back to top</a></p>
   <hr />
   
   <h3>St. Michaels Rowing Club</h3>
   <p>&nbsp;</p>
   
   <p><iframe width="300" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=st+michaels+rowing+club+limerick+ireland&amp;sll=52.66337,-8.639717&amp;sspn=0.023894,0.077248&amp;ie=UTF8&amp;hq=st+michaels+rowing+club&amp;hnear=Limerick,+Co.+Limerick,+Ireland&amp;ll=52.665244,-8.634567&amp;spn=0.007808,0.012875&amp;t=h&amp;output=embed"></iframe></p>
   <br />
   <small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=st+michaels+rowing+club+limerick+ireland&amp;sll=52.66337,-8.639717&amp;sspn=0.023894,0.077248&amp;ie=UTF8&amp;hq=st+michaels+rowing+club&amp;hnear=Limerick,+Co.+Limerick,+Ireland&amp;ll=52.665244,-8.634567&amp;spn=0.007808,0.012875&amp;t=h" title="St.Michaels Rowing Club Boathouse Google Map">View Larger Map</a></small>
   
   <p><a href="#top">Back to top</a></p>
   
   <hr />
   
   <h3>Castleconnell Boat Club</h3>
   <p>&nbsp;</p>
   
   <p><iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=52.726579,-8.504749&amp;num=1&amp;t=h&amp;ie=UTF8&amp;ll=52.726572,-8.504448&amp;spn=0.001949,0.003219&amp;z=17&amp;output=embed"></iframe></p>
   <p>&nbsp;</p>
   <small><a href="https://maps.google.com/maps?q=52.726579,-8.504749&amp;num=1&amp;t=h&amp;ie=UTF8&amp;ll=52.726572,-8.504448&amp;spn=0.001949,0.003219&amp;z=17&amp;source=embed" title="Castleconnel Boat Club Google Map">View Larger Map</a></small>
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