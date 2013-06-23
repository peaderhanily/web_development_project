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
<title>Accessability-United Limerick Rowing Federation</title>
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


<!--***************This is the START of the wrapper***********-->

<div id="wrapper">
  <!--This is the START of the header section-->
  <a name="top" id="top"></a>
  
  <div id="header" title="United Limerick Rowing Federation, 'Rowing together'"><h1>United Limerick Rowing Federation  
    "Rowing Together"</h1>
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
        <p>&gt;&gt;<a href="regattacalender.php" title="regatta calender">All Events</a></p>
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
        <a href="https://www.facebook.com/pages/United-Limerick-Rowing-Federation/368315433254464?ref=hl" title="Our facebook Page"><img src="images/facebookbutton1.jpg" width="145" height="100" alt="ULRF Facebook page" /></a>
        <a href="https://twitter.com/ULRFederation" title="Our twitter Page"> <img src="images/twitterbutton1.jpeg" width="145" height="100" alt="ULRF Twitter Page" /></a>
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
    
      <p>| <a href="home.php">Home</a> | <a href="accessability.php">Accessibility</a> |</p>
      <hr />
      <p>We've tried to make this website as user friendly and accessible as possible. If you experience any problems or notice something that could be improved, please email us at <a href="mailto:ulrfederation@gmail.com">ulrfederation@gmail.com</a></p>
      <p>&nbsp;</p>
      <p><a name="helpmenu" id="helpmenu"></a></p>
      <p>| <a href="#openfont">Open Dyslexic font</a> ----<a href="#gettingaround"> Getting Around </a>----<a href="#landi"> Links And Images</a> ---- <a href="#resize">Resize Text</a> ----<a href="#java"> Enabling Java Script</a><a href="#priv"></a> |
      
      
      <hr />
      <p>&nbsp;</p>
      <h2><a name="openfont" id="openfont"></a>Dyslexic Font</h2>
      <p>&nbsp;</p>
      <p>PLEASE NOTE: This option does not work with Internet Explorer Please use another Browser to avail of this option</p>
      <p>&nbsp;</p>
      <p>We have given users of this website the option of using a font type specifically designed for dyslexic people.</p>
      <p>This is used in order to benefit there web browsing experience. It has been internationally recognized as being of benefit.</p>
      <p>If you would like to find out more about this type face and the Open Source Dyslexic Font Community please click </p>
      <p><a href="http://dyslexicfonts.com/">here</a>.</p>
      <p>&nbsp;</p>
      <p>The following has been taken from the Open Dyslexic font website</p>
      <p>&nbsp;</p>
      <p>&quot;Open Dyslexic is a new open sourced font created to increase readability for readers with dyslexia<strong>.</strong> The typeface includes regular<strong>,</strong> bold<strong>,</strong> italic and bold<strong>-</strong>italic styles<strong>.</strong> It is being updated continually and improved based on input from dyslexic users<strong>.</strong>&quot;</p>
      <p>&nbsp;</p>
      <p>&quot;Your brain can sometimes do funny things to letters<strong>.</strong>OpenDyslexic tries to help prevent some of these things from happening<strong>.</strong> Letters have heavy weighted bottoms to add a kind of <strong>&quot;</strong>gravity<strong>&quot;</strong> to each letter<strong>,</strong>helping to keep your brain from rotating them around in ways that can make them look like other letters<strong>.</strong>&quot;</p>
      <p>&nbsp;</p>
      <p><strong>&quot;</strong>Consistently weighted bottoms can also help reinforce the line of text<strong>.</strong> The unique shapes of each letter can help prevent flipping and swapping<strong>.</strong>&quot;</p>
      <p>&nbsp;</p>
     <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <hr />
      <p>&nbsp;</p>
      <h2><a name="gettingaround" id="gettingaround"></a>Getting Around</h2>
      <p>&nbsp;</p>
      <p>This website does not rely on the use of a mouse to navigate and is designed to be operable using a keyboard, switching device, joystick or gesture-recognition device. A logical tab order is used to step through the links on each page using TAB to move down and Shift TAB to move back up through the links.</p>
      <p>&nbsp;</p>
      <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <hr />
      <p>&nbsp;</p>
      <h2><a name="landi" id="landi"></a>Links and Images</h2>
      <h3>Links</h3>
      <p>We've tried to make text links as descriptive as possible, or they are written so as to make contextual sense.</p>
      <p> However, where additional information about a link might be useful, we've used 'title' attributes to describe the link in greater detail.</p>
      <p> This additional information is visible when the mouse cursor is held over the link or the link receives focus from an input device such as a keyboard. </p>
      <p>Users of assistive technology may also set screen reader options to take advantage of this feature.      </p>
      <p>&nbsp;</p>
      <h3>Images</h3>
      <p id="images">For users using text-only browsers, or visual browsers with images disabled, all non-decorative images used in this website include a descriptive <abbr title="Alternate">'alt'</abbr> attribute to provide a short text replacement for the image.</p>
      <p> Any images that are decorative and are not critical to site content have a null <abbr title="Alternate">'alt'</abbr> attribute and should not add to screen reader &quot;noise pollution&quot;.</p>
      <p>&nbsp;</p>
  <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <hr />
      <p>&nbsp;</p>
      <h2><a name="resize" id="resize"></a>Resize Text</h2>
      <p>&nbsp;</p>
      <p>If you have difficulty reading text because it's too small you can increase the default text size for your browser.</p>
      <p>&nbsp;</p>
      <p> In most modern browsers,</p>
      <p> simply holding down the <acronym title="Control">CTRL</acronym> key and pressing the + (PLUS sign) key will increase the default text size or magnify the page.</p>
      <p>&nbsp;</p>
      <p> Pressing the + (PLUS sign) key again will further increase the text size.</p>
      <p>&nbsp;</p>
      
      <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <hr />
      <p>&nbsp;</p>
      <h2><a name="java" id="java"></a>Enabling Java Script</h2>
      <p>&nbsp;</p>
      <p>This website uses Java-script and to better experience this and other websites your browser should have Java-script enabled if possible.</p>
      <p> However Java-script is only used for enhancements on this website and all content is available without it.</p>
      <p>&nbsp;</p>
      <p> For information about how to enable Java-script, please select your browser from the following options:</p>
      <p>&nbsp;</p>
         <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <p>&nbsp;</p>
      <h3>Firefox</h3>
      
      <ul>
        <li>Keyboard shortcut ALT T O N ENTER</li>
        <li>Or using a mouse: from the main menu select Tools then Options.</li>
        <li>Select Content tab from the top row of options.</li>
        <li>Tick Enable Java-script box.</li>
        <li>Note: You may wish to install the No-script extension for Firefox to control which sites can run Java-script.</li>
      </ul>
      <p>&nbsp;</p>
         <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <p>&nbsp;</p>
      <h3>Internet Explorer</h3>
      <ul>
        <li>
          Using mouse or keyboard: from the main menu select Tools then Options.</li>
        <li>Change to the Security tab at the top of the Internet Options window that pops up.</li>
        <li>From the list of Zones at the top of the Security options select the Internet icon.</li>
        <li>Select the button near the bottom that reads Custom Level.</li>
        <li>In the new window that pops up, scroll down to the item that reads Active Scripting.</li>
        <li>Select the option marked Enable.</li>
      </ul>
      <p>&nbsp;</p>
         <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <p>&nbsp;</p>
      <h3>Safari</h3>
      <ul>
        <li>
          Using mouse or keyboard: from the main menu select Edit then Preferences.</li>
        <li>Select Security tab from the top row of options.</li>
        <li>Tick Enable Java-script box.</li>
      </ul>
      <p>&nbsp;</p>
         <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <p>&nbsp;</p>
      <h3>Opera</h3>
      <ul>
        <li>
          Using mouse or keyboard: from the main menu select Tools then Preferences.</li>
        <li>Select Advanced tab from the top row of options.</li>
        <li>Select Content from the left column of options.</li>
        <li>Tick Enable Java-script box.</li>
      </ul>
      <p>&nbsp;</p>
         <p><a href="#top">Back to top</a></p>
     <p>&nbsp;</p>
     <p> <a href="#helpmenu">Help Menu</a></p>
      <hr />
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
 
 
 <li> <a href="sitemap.php" title="Sitemap Page">Site Map</a> </li>
 
 
 <li><a href="accessability.php" class="current" title="Accessability Page">Accessibility</a> </li>
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
