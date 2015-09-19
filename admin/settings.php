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

include("../data/data.php");
include("../common.php");

$settings[head] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html><head>
<META http-equiv=Content-Type content=\"text/html; charset=windows-1250\">
<title>EasyBanner Free</title>\n</head>\n\n
<body bgcolor=\"#EAEAEA\" text=\"#000000\" link=\"#0000FF\" vlink=\"#0000FF\" alink=\"#FF0000\">";
$settings[footer] = "<br><center><FONT color=#0000FF size=2 face=\"Verdana,arial\"><a href=\"admin.php\">Back to admin home</a><br><br>
<a href=\"http://www.phpwebscripts.com/easybannerpro/\">Click here to upgrade to Easy Banner Pro and get lots of new advanced features.</a></font></center>
<br><br><br>\n</body></html>";

echo $settings[head];

if ($co=="ok") ok();
else form();

function form() {
global $settings;
$ratioprocent = $settings[ratio]*100;
$linkid = db_connect(); if (!$linkid) problems(sql_error());
?>

<div align="center">
<center>
<br>
<form method="POST" action="settings.php">
<input type="hidden" name="co" value="ok">
<table border="0" width="700" cellspacing="2" cellpadding="4" style="font-size: 10pt">
	<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center"><font size="2" color="#0000FF" face="Verdana,arial">
<b>Easy Banner Free - Configuration</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Mysql database host</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbhost]" value="<?PHP echo $settings[dbhost]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Your mysql database username</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbusername]" value="<?PHP echo $settings[dbusername]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Mysql database password</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbpassword]" value="<?PHP echo $settings[dbpassword]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Name of your mysql database</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbname]" value="<?PHP echo $settings[dbname]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Full path to the folder where the scripts live. No trailing slash.</font></td>
	<td align="left"><INPUT maxLength=100 size=50 name="form[phppath]" value="<?PHP echo $settings[phppath]; ?>"><br><font size=1 color="#000000" face="Verdana,arial">Sample: /htdocs/sites/user/html/easybanner</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">URL of your home page. Surfer gets this URL after clicking on your logo next of the member's banner.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">URL of the directory where your php scripts are installed. No trailing slash.</font></td>
	<td align="left"><INPUT maxLength=100 size=50 name="form[phpdirectory]" value="<?PHP echo $settings[phpdirectory]; ?>"><br><font size=1 color="#000000" face="Verdana,arial">Sample: http://www.yourdomain.com/bannerexchange/php</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">URL of your default banner. It is displayed only if no one account in the necessary category has credits.</td>
	<td align="left"><INPUT maxLength=100 size=50 name="form[defaultbanner]" value="<?PHP echo $settings[defaultbanner]; ?>"><br><font size=1 color="#000000" face="Verdana,arial">Sample: http://www.yourdomain.com/bannerexchange/banner.gif</font></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Alt tag of your default banner.</td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Default URL. It gets surfer after clicking on your default banner.</font></td>
	<td align="left"><INPUT maxLength=70 size=50 name="form[defaulturl]" value="<?PHP echo $settings[defaulturl]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Height of all banners in the banner exchange.</font></td>
	<td align="left"><INPUT maxLength=4 size=5 name="form[bheight]" value="<?PHP echo $settings[bheight]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Width of all banners in the banner exchange.</font></td>
	<td align="left"><INPUT maxLength=4 size=5 name="form[bwidth]" value="<?PHP echo $settings[bwidth]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF"><td colspan="2" align="center"><font size="2" color="#000000" face="Verdana,arial">
	Here you may set a logo which will be on the left all members banners. It may be useful to propagate your banner exchange.
	</font></td></tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">URL of your logo.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Width of the logo. If you haven't logo, write 0.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Number of free credits you want to give to every new account.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Number of free credits for reffering new member.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Exchange ratio. How many impressions get every member for showing 100 banners.</font></td>
	<td align="left"><INPUT maxLength=5 size=5 name="form[ratioprocent]" value="<?PHP echo $ratioprocent; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">In the admin area you can see members which have click ratio lower than specified number (in %). It usually indicates cheating. If you are not sure, 1 may be adequate number.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">How many days should the script wait until will mark some account as inactive? Inactive accounts should be deleted to save server resources.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Your email address.</font></td>
	<td align="left"><INPUT maxLength=70 size=50 name="form[adminemail]" value="<?PHP echo $settings[adminemail]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Categories separated by comma. Do not use these characters: " ' , ; \ > < $<br>Leave it blank for no categories.</td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">If you delete any account but the member leaves the banner exchange code online, should banners of other members be displayed in this space?</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Use cron to reset your weekly stats? Yes is recommended but needs little more settings.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Secret word - it is a "password" for your script 'cron.php' when resets your weekly stats. It may contain letters and numbers.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Upload members banners to your server? If you select yes, you will have better control over the banners.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Maximum size of members banners.<br><font size=1>Note: The banner size is checked only if banners are stored on your server.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Select where will open the link after a surfer clicks on banner.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Allow banners in flash (swf) format?<br>Please read note about flash banners in the Manual.</font></td>
	<td align="left"><font size="2" color="#000000" face="Verdana,arial">Not available in the Free version of Easy Banner.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="middle" width="100%" colSpan=2><INPUT type=submit value="Save" name=D1></font></TD>
</TR></TBODY></TABLE>
</FORM>
</center><br>
<?PHP
echo $settings[footer];
exit();
}


function ok() {
global $settings,$form;
echo $settings[head];
if (!$form[dbhost]) { chyba ("<center>Your mysql database host can't left blank."); $chyba=1;} else hlaseni ("<center>Your mysql database host: $form[dbhost] OK.");
if (!$form[dbusername]) { chyba ("Mysql database username is missing."); $chyba=1;} else hlaseni ("Mysql database username: $form[dbusername] OK.");
if (!$form[dbpassword]) { chyba ("Password to mysql database is missing."); $chyba=1;} else hlaseni ("Password to mysql database: $form[dbpassword] OK.");
if (!$form[dbname]) { chyba ("Missing name of your mysql database."); $chyba=1;} else hlaseni ("Name of your mysql database: $form[dbname] OK.");
if (!$form[phppath]) { chyba ("Full path to your php folder can't left blank."); $chyba=1;} else hlaseni ("Full path to php folder: $form[phppath] OK.");
if (!strpos($form[phpdirectory],"ttp://")) { chyba ("URL of your php directory must begin with 'http://'"); $chyba=1;} else hlaseni ("URL of your PHP directory: $form[phpdirectory] OK.");
if (!strpos($form[defaultbanner],"ttp://")) { chyba ("URL of your default banner must begin with 'http://'"); $chyba=1;} else hlaseni ("URL of default banner: $form[defaultbanner] OK.");
if (!strpos($form[defaulturl],"ttp://")) { chyba ("Your default URL must begin with 'http://'"); $chyba=1;} else hlaseni ("Your default URL: $form[defaulturl] OK.");
if (!$form[bheight]) { chyba ("You must fill in banner height."); $chyba=1;} else hlaseni ("Your banner height: $form[bheight] px OK.");
if (!$form[bwidth]) { chyba ("You must fill in banner width."); $chyba=1;} else hlaseni ("Your banner width: $form[bwidth] px OK.");
if (!$form[ratioprocent]) { chyba ("You must fill in an exchange ratio."); $chyba=1;} else hlaseni ("Your exchange ratio: $form[ratioprocent]% OK.");
if (!$form[adminemail]) { chyba ("You must fill in your email address."); $chyba=1;} else hlaseni ("Your email address: $form[email] OK.");
if ($chyba) { chyba ("<br>Can't continue. Please go back and try again."); exit();}

$form[ratio] = $form[ratioprocent]/100;
if (!$form[bannermaxsize]) $form[bannermaxsize]=0;

if (!$sb = fopen("$form[phppath]/data/data.php","w")) { chyba ("Can't write to file 'data.php' in your data directory. Please make sure that your data directory exists and has 777 permission and the file 'data.php' inside has permission 666. Can't continue."); exit(); }
$data = "<?PHP\n\n\$settings[dbhost] = \"$form[dbhost]\";\n";
$data .= "\$settings[dbusername] = \"$form[dbusername]\";\n";
$data .= "\$settings[dbpassword] = \"$form[dbpassword]\";\n";
$data .= "\$settings[dbname] = \"$form[dbname]\";\n";
$data .= "\$settings[htmldirectory] = \"$form[htmldirectory]\";\n";
$data .= "\$settings[phpdirectory] = \"$form[phpdirectory]\";\n";
$data .= "\$settings[phppath] = \"$form[phppath]\";\n";
$data .= "\$settings[defaultbanner] = \"$form[defaultbanner]\";\n";
$data .= "\$settings[defaulturl] = \"$form[defaulturl]\";\n";
$data .= "\$settings[bheight] = $form[bheight];\n";
$data .= "\$settings[bwidth] = $form[bwidth];\n";
$data .= "\$settings[ratio] = $form[ratio];\n";
$data .= "\$settings[adminemail] = \"$form[adminemail]\";\n";
$data .= "\n\n?>";
$zapis = fwrite ($sb, $data);
fclose($sb);
//chmod("$form[phppath]/data/data.php", 0666);
if (!$zapis)
{ echo "<br><br><font color=#FF0000 size=2 face=\"Verdana,arial\"><b>Can not write to file 'data.php'.<br>Please make sure that your data directory exists and has 777 permission and the file 'data.php' inside has permission 666. Can't continue.</b></font><br>"; exit();}
else
{ echo "<br><br><font color=#0000FF size=2 face=\"Verdana,arial\"><b>Your setting was successfully updated.</b></font><br><br><br><br>"; echo $settings[footer]; }

}



function chyba($text) {
echo "<font size=2 color=#FF0000 face=\"Verdana,arial\"><b>$text</b></font><br>";
}


function hlaseni($text) {
echo "<font size=2 color=#0000FF face=\"Verdana,arial\">$text</font><br>";
}



?>
