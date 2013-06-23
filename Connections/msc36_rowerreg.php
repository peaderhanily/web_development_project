<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_msc36_rowerreg = "msc36.cmsmotion.com";
$database_msc36_rowerreg = "msc36cms_rowerreg";
$username_msc36_rowerreg = "msc36cms";
$password_msc36_rowerreg = "rower12252788!";
$msc36_rowerreg = mysql_pconnect($hostname_msc36_rowerreg, $username_msc36_rowerreg, $password_msc36_rowerreg) or trigger_error(mysql_error(),E_USER_ERROR); 
?>