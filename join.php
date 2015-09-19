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

if ( $action == 'signup' ) { signup(); }
else { 
$result = ''; parsedata('./data/templates/join.html',$settings); $location = "PGEgaHJlZj0iaHR0cDovL3d3dy5waHB3ZWJ".$l[a].$l[b]; $c = base64_decode("$location"); echo "<center><br><br>$c"; }

function signup() {
global $form,$settings,$l;

if ($form[urlbanner]=='' OR $form[userid]=='' OR $form[userpass]=='' OR $form[email]=='' OR $form[siteurl]=='') problems ("Please come back and fill out all fields.") ;
$location = "PGEgaHJlZj0iaHR0cDovL3d3dy5waHB3ZWJ".$l[a].$l[b];
if (strlen ($form[userid]) > 8) problems ("Username is too long. Max of 8 characters.") ;
if (strlen ($form[userpass]) > 8) problems ("Password is too long. Max of 8 characters.") ;
if (strlen ($form[email]) > 70) problems ("Email address is too long. Max of 70 characters.") ;
if (strlen ($form[siteurl]) > 100) problems ("URL is too long. Max of 100 characters.") ;
if (strlen ($form[urlbanner]) > 100) problems ("Banner URL is too long. Max of 100 characters.") ;

// member exists
$result='';
$result = mysql_query("select count(*) from ebfmembers where userid like '$form[userid]'");
if(!$result) problems(sql_error());
$data = mysql_fetch_row($result);
if ($data[0]>0) problems ("This username is already in use. Please use another.") ;

$vysledek = mysql_query("select max(number) from ebfmembers");
$data = mysql_fetch_row($vysledek);
$number = $data[0]+1;

// kontrola chyb
$chyba = strpos($form[email],"@"); if (!$chyba) problems ("Wrong email address. Please try again.");
$chyba = strpos($form[email],"."); if (!$chyba)  problems ("Wrong email address. Please try again.");
$chyba1 = strpos($form[siteurl],"ttp://"); if (!$chyba1)  problems ("Wrong URL. Please try again.");
if (strlen($location) != 104) problems ("FATAL ERROR") ;

if (!$settings[uploadban])
{ $nic = eregi(".*gif$",$form[urlbanner],$hh);
  $nic = eregi(".*jpg$",$form[urlbanner],$hh);
  $nic = eregi(".*png$",$form[urlbanner],$hh);
if (!$hh[0]) problems ("Wrong banner image format. Please try again."); }

$chyba3 = strpos($form[userid]," ") ; if ($chyba3) problems ("Username should contain only letters and numbers. Please try again.");

$cas = time(); $datum = Date("Y-m-d");
$query = "insert into ebfmembers values('$form[userid]','$form[userpass]','$form[email]','$form[siteurl]','$form[urlbanner]','$location','0','$settings[ratio]','0','0','0','0','0','0','0','0','$datum','$cas','0','0','$number','0','0','0','0','1')";
$result = mysql_query($query);
if(!$result) problems(sql_error());

$form[memberfile] = "$settings[phpdirectory]/member.php";
$form[from] = $settings[adminemail];
$tisk=sendemail('./data/templates/email_join.txt',$form);

$form[adminfile] = "$settings[phpdirectory]/admin/admin.php";
$form[memberemail] = $form[email];
$form[email] = $settings[adminemail];
$tisk=sendemail('./data/templates/email_admin.txt',$form);

$result = '';
$result = mysql_query("select email,siteurl,urlbanner,userid,userpass from ebfmembers where userid like '$form[userid]' AND userpass like '$form[userpass]'");
if(!$result) problems(sql_error());
$form = mysql_fetch_array($result);

$form[workfile]="$settings[phpdirectory]/work.php?ID=$form[userid]";
$form[memberfile]="$settings[phpdirectory]/member.php";
$form[width]=$settings[bwidth];
$form[height]=$settings[bheight];

$form[html] = parsehtml('./data/templates/html.txt',$form);

$form[banner]="<img border=0 width=\"$settings[bwidth]\" height=\"$settings[bheight]\" src=\"$form[urlbanner]\">";

parsedata('./data/templates/join_success.html',$form);
$c = base64_decode("$location");
echo "<br><br>$c";
  }
mysql_close($linkid);

?>