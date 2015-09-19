<?PHP

#####################################################################
##                                                                 ##
##                       Easy Banner Free                          ##
##           http://www.phpwebscripts.com/easybanner/              ##
##                 e-mail: info@phpwebscripts.com                  ##
##                                                                 ##
##                                                                 ##
##                       copyright (c) 2002                        ##
##                                                                 ##
##                    This script is freeware                      ##
##                                                                 ##
##                You may distribute it by any way                 ##
##                   BUT! You may not modify it!                   ##
## Removing the link to PHPWebScripts.com is a copyright violation.##
##   Altering or removing any of the code that is responsible, in  ##
##   any way, for generating that link is strictly forbidden.      ##
##   Anyone violating the above policy will have their license     ##
##   terminated on the spot.  Do not remove that link - ever.      ##
##                                                                 ##
#####################################################################

include("./data/data.php");
include("./common.php");

$linkid = db_connect();
if (!$linkid) problems(sql_error());
$zkouska = mysql_query("select userid from ebfmembers where userid like '$ID'");
$exist = mysql_fetch_row($zkouska);
if ($exist[0]) 
{
$vysledek = mysql_query("update ebfmembers set meshows = meshows+1,earned = (meshows*$settings[ratio]),notused = (notused+$settings[ratio]) where userid like '$ID'");
}

$vysledek=""; $vysledek = mysql_query("select max(number) from ebfmembers");
$data = mysql_fetch_row($vysledek);
list($usec, $sec) = explode(' ', microtime()); srand( (float) ($sec + ($usec * 100000)));
$i=rand(0,"$data[0]");
$vysledek="";
$vysledek = mysql_query("select * from ebfmembers where number > '$i' AND approved=1 AND notused >= 1 AND NOT(userid like '$ID') ORDER BY number LIMIT 1");
if ($vysledek) $data1 = mysql_fetch_array($vysledek); 
if (!($data1[userid]))
{ $i=0;
  $vysledek = mysql_query("select * from ebfmembers where number > '$i' AND approved=1 AND notused >= 1 AND NOT(userid like '$ID') ORDER BY number LIMIT 1");
  if ($vysledek) $data1 = mysql_fetch_array($vysledek); 
}
if ($data1[userid]) $find = 1;

if ($find == 1)
{ $banner = "";
  $banner = stripslashes($banner); }

if ($find == 1) {
 echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<HTML><HEAD><TITLE>Banner Exchange</TITLE>
 <META http-equiv=Content-Type content=\"text/html;\"></HEAD>
 <BODY><table border=0 cellpadding=0 cellspacing=0 width=$settings[bwidth]><tr>
 <td width=$settings[bwidth] valign=\"top\" align=\"left\"><a target=\"_top\" href=\"$data1[siteurl]\"><img border=0 src=\"$data1[urlbanner]\" width=$settings[bwidth] height=$settings[bheight]></a>
 </td></tr></table></BODY>\n";
 $vysledek = mysql_query("update ebfmembers set notused = notused-1,weshow = weshow+1 where userid like '$data1[userid]'");
}
else {
 echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<HTML><HEAD><TITLE>Banner Exchange</TITLE>
 <META http-equiv=Content-Type content=\"text/html;\"></HEAD>
 <BODY><table border=0 cellpadding=0 cellspacing=0 width=$settings[bwidth]><tr>
 <td width=$settings[bwidth] valign=\"top\" align=\"left\"><a target=\"_top\" href=\"$settings[defaulturl]\"><img border=0 src=\"$settings[defaultbanner]\" width=$settings[bwidth] height=$settings[bheight]></a>
 </td></tr></table></BODY>\n";
}

exit;
?>


