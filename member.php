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

if (!$form[userid])
{ $result = mysql_query("select location from ebfmembers where number = '1'");
  if(!$result) problems(sql_error());
  $ab = mysql_fetch_row($result);
  if ((strlen($ab[0])) != 104) problems ("FATAL ERROR");
  parsedata('./data/templates/member_login.html',$settings); 
  $c = base64_decode($ab[0]);
  echo "<center><br><br>$c";
  exit; }

 // existuje ten clen?
$result = mysql_query("select userpass,location from ebfmembers where userid like '$form[userid]'");
if(!$result) problems(sql_error());
$data = mysql_fetch_row($result);
if (!$data[0]) problems ("This username does not exist.");
if ((strlen($data[1])) != 104) problems ("FATAL ERROR");
$c = base64_decode($data[1]);
$settings[htm] = $c;
 //kontrola hesla
if (trim($data[0]) != trim($form[userpass])) problems ("Wrong password. Please try again.");
$form[cisloclena] = $form[userid];


if (!$action) 
{ $settings[userid] = $form[userid]; $settings[userpass] = $form[userpass];
  $tisk = parsedata("./data/templates/member_action.html",$settings); 
  echo "<center><br><br>$c"; }


if ( $action == 'edited' ) {edited();}
if ( $action == 'html' ) { html(); }
if ( $action == 'stats' ) { stats(); }
if ( $action == 'edit' ) { edit(); }



function edit() {
global $form,$settings;
$result = '';
$result = mysql_query("select userid,userpass,email,siteurl,urlbanner from ebfmembers where userid like '$form[userid]'");
if(!$result) problems(sql_error());
$data = mysql_fetch_array($result);

$data[bwidth] = $settings[bwidth]; $data[bheight] = $settings[bheight];
$data[banner]="<img border=0 width=\"$settings[bwidth]\" height=\"$settings[bheight]\" src=\"$data[urlbanner]\">";

parsedata('./data/templates/member_edit.html',$data);
echo "<center><br><br>$settings[htm]";
exit;
}



function edited() {
global $form,$settings;
// neco zustalo prazdne?
if ( $form[urlbanner]=='' OR $form[newpass]=='' OR $form[email]=='' OR $form[siteurl]=='' ) problems ("Please come back and fill out all fields.");
if (strlen ($form[newpass]) > 8) problems ("Password too long. Max of 8 characters.");
if (strlen ($form[email]) > 70) problems ("Email address too long. Max of 70 characters.");
if (strlen ($form[siteurl]) > 100) problems ("URL too long. Max of 100 characters.");
if (strlen ($form[urlbanner]) > 100) problems ("Banner URL too long. Max of 100 characters.");

// kontrola chyb
$chyba = strpos($form[email],"@"); if (!$chyba) problems ("Wrong email address. Please try again.");
$chyba = strpos($form[email],"."); if (!$chyba) problems ("Wrong email address. Please try again.");
$chyba1 = strpos($form[siteurl],"ttp://"); if (!$chyba1) problems ("Wrong URL. Please try again.");

$chyba3 = strpos($form[newpass]," ") ; if ($chyba3)  problems ("Password should contain only letters and numbers. Please try again.");

$nic = eregi(".*gif$",$form[urlbanner],$hh);
$nic = eregi(".*jpg$",$form[urlbanner],$hh);
$nic = eregi(".*png$",$form[urlbanner],$hh);
if (!$hh[0])  problems ("Wrong banner image format. Please try again.");

$result = '';
$result = mysql_query("select email,siteurl,urlbanner from ebfmembers where userid like '$form[userid]' AND userpass like '$form[userpass]'");
if(!$result) problems(sql_error());
$data = mysql_fetch_row($result);

$result = '';
$result = mysql_query("update ebfmembers set userpass='$form[newpass]',email='$form[email]',siteurl='$form[siteurl]',urlbanner='$form[urlbanner]',location='PGEgaHJlZj0iaHR0cDovL3d3dy5waHB3ZWJzY3JpcHRzLmNvbS9lYXN5YmFubmVyLyI+UG93ZXJlZCBieSBFYXN5IEJhbm5lcjwvYT4=' where userid like '$form[userid]'");
if(!$result) problems(sql_error());

$result = '';
$result = mysql_query("select email,siteurl,urlbanner,userid,userpass,location from ebfmembers where userid like '$form[userid]' AND userpass like '$form[newpass]'");
if(!$result) problems(sql_error());
$form = mysql_fetch_array($result);

if ((strlen($form[location])) != 104) problems ("FATAL ERROR");
$c = base64_decode($form[location]);
$form[bwidth] = $settings[bwidth]; $form[bheight] = $settings[bheight];
$settings[htm] = $c;
$form[banner]="<img border=0 width=\"$settings[bwidth]\" height=\"$settings[bheight]\" src=\"$form[urlbanner]\">";

parsedata('./data/templates/member_edited.html',$form);
echo "<center><br><br>$settings[htm]";
exit;
}


function stats() {
global $form,$settings;
$result = '';
$result = mysql_query("select userid,meshows,earned,notused,weshow from ebfmembers where userid like '$form[userid]'");
if(!$result) problems(sql_error());
$data = mysql_fetch_array($result);
parsedata('./data/templates/member_stats.html',$data);
echo "<center><br><br>$settings[htm]";
exit;
}


function html()
{
global $form, $settings;
$form[workfile]="$settings[phpdirectory]/work.php?ID=$form[userid]";
$form[width]=$settings[bwidth];
$form[height]=$settings[bheight];

$form[html] = parsehtml('./data/templates/html.txt',$form);
parsedata('./data/templates/member_html.html',$form);
echo "<center><br><br>$settings[htm]";
exit;
}

?>