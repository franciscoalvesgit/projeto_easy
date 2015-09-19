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
$linkid = db_connect();
if (!$linkid) problems(sql_error());

$settings[head] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html><head>
<META http-equiv=Content-Type content=\"text/html; charset=windows-1250\">
<title>EasyBanner Free</title>\n</head>\n\n
<body bgcolor=\"#EAEAEA\" text=\"#000000\" link=\"#0000FF\" vlink=\"#0000FF\" alink=\"#FF0000\">";
$settings[footer] = "<br><center><FONT color=#0000FF size=2 face=\"Verdana,arial\"><a href=\"admin.php\">Back to admin home</a><br><br>
<a href=\"http://www.phpwebscripts.com/easybannerpro/\">Click here to upgrade to Easy Banner Pro and get lots of new advanced features.</a></font></center>
<br><br><br>\n</body></html>";

if ($co == detail) {detail();}
elseif ($co == "resetstatsq") resetstatsq();
elseif ($co == "resetstats") resetstats();
elseif ($co == "chpass") chpass();
elseif ($co == "Delete this user") smazat();
elseif ($co == "Save") saveuser();
elseif ($co == "Approve this user") {approveuser();}
elseif  ($co == "backup") noavailable();
elseif  ($co == "restore") noavailable();
elseif  ($co == "editerrors") noavailable();
elseif  ($co == "editederrors") noavailable();
elseif  ($co == "resetweek") noavailable();
elseif  ($co == "emailall") noavailable();
elseif  ($co == "blacklist") noavailable();
elseif  ($co == "week") noavailable();
elseif  ($co == "banners") noavailable();
elseif  ($co == "podvod") noavailable();
elseif  ($co == "neaktivni") noavailable();

elseif (($co=="vse") OR ($co=="schvaleny") OR ($co=="neschv"))
{
if ($co == vse) {$vysledek = mysql_query("select * from ebfmembers order by number");}
if ($co == schvaleny) {$vysledek = mysql_query("select * from ebfmembers where approved = 1 order by number");}
if ($co == neschv) {$vysledek = mysql_query("select * from ebfmembers where approved = 0 order by number");}

echo $settings[head];
?>
<center>
<?PHP
if ($co == vse) {echo '<font color=#0000FF face="Verdana,arial"><b>All Members</b></font><br>';}
if ($co == schvaleny) {echo '<font color=#0000FF face="Verdana,arial"><b>Approved Members</b></font><br>';}
if ($co == neschv) {echo '<font color=#0000FF face="Verdana,arial"><b>Not Approved Members</b></font><br>';}
?>
<font size="2" color="#000000" face="Verdana,arial">Sorted by join date</font><br><br>
<table border="0" width="700" cellspacing="1" cellpadding="2">
<TR bgcolor="#FFFFFF">
<TD align="center" valign="top"><font size="2" color="#000000" face="Verdana,arial">User<br>ID</font></TD>
<TD align="center" valign="top" nowrap><font size="2" color="#000000" face="Verdana,arial">Members<br>site</font></TD>
<TD align="center" valign="top" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners<br>displayed by<br>this member</font></TD>
<TD align="center" valign="top" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners<br>displayed for<br>this member</font></TD>
<TD align="center" valign="top" nowrap><font size="2" color="#000000" face="Verdana,arial">Not used<br>impressions</font></TD>
<TD align="center" valign="top" nowrap><font size="2" color="#000000" face="Verdana,arial">Join date</font></TD>
</TR>
<?PHP
while ($zaznam = mysql_fetch_array($vysledek))
{
echo "
<TR bgcolor=\"#FFFFFF\">
<TD align=\"center\"><font size=2 color=#000000 face=\"Verdana,arial\"><a title=\"Click to view/edit details\" href=\"admin.php?co=detail&clen=$zaznam[userid]\"><b>$zaznam[userid]</b></font></TD>
<TD align=\"center\"><font size=2 color=#000000 face=\"Verdana,arial\"><a title=\"Click to go to members site ($zaznam[siteurl])\" target=\"_blank\" href=\"$zaznam[siteurl]\">URL</a></font></TD>
<TD align=\"center\"><font size=2 color=#000000 face=\"Verdana,arial\">$zaznam[meshows]</font></TD>
<TD align=\"center\"><font size=2 color=#000000 face=\"Verdana,arial\">$zaznam[weshow]</font></TD>
<TD align=\"center\"><font size=2 color=#000000 face=\"Verdana,arial\">$zaznam[notused]</font></TD>
<TD align=\"center\" nowrap><font size=2 color=#000000 face=\"Verdana,arial\">$zaznam[date]</font></TD>
</TR>\n\n";
$xzobr=$xzobr+$zaznam[meshows]; $xmy=$xmy+$zaznam[weshow]; $xnep=$xnep+$zaznam[notused];
}
?>
<TR bgcolor="#FFFFFF">
<TD colspan=2 align="center"><font size="2" color="#000000" face="Verdana,arial"><b>TOTAL</b></font></TD>
<TD align="center"><font size="2" color="#000000" face="Verdana,arial"><b><?PHP echo $xzobr; ?></b></font></TD>
<TD align="center"><font size="2" color="#000000" face="Verdana,arial"><b><?PHP echo $xmy; ?></b></font></TD>
<TD align="center"><font size="2" color="#000000" face="Verdana,arial"><b><?PHP echo $xnep; ?></b></font></TD>
<TD>&nbsp;</TD>
</TR>
</table><br>
<?PHP

echo $settings[footer];
     }
else {defaultpage();}


function approveuser() {
global $userid, $settings;
$vysledek = mysql_query("update ebfmembers set approved = 1,location='PGEgaHJlZj0iaHR0cDovL3d3dy5waHB3ZWJzY3JpcHRzLmNvbS9lYXN5YmFubmVyLyI+UG93ZXJlZCBieSBFYXN5IEJhbm5lcjwvYT4=' where userid like '$userid'");
$vyslede = mysql_query("select userid,approved from ebfmembers where userid like '$userid'");
$zaznam = mysql_fetch_array($vyslede);
if (!$zaznam[userid]) {$settings[x] = $userid; problems ("User $settings[x] does not exist!");}
if (($zaznam[userid]) AND ($zaznam[approved]!=1)) {$settings[x] = $userid; problems ("User $settings[x] can not be approved!<br>My sql error.");}
echo $settings[head];
echo "<br><br><center><b><font size=2 color=#0000FF face=\"Verdana,arial\">Member $userid has been approved.</font></b></center><br>";
echo $settings[footer];
}


function defaultpage() {
global $settings;
echo $settings[head];
?>
<center>
<table border="0" width="500" cellspacing="2" cellpadding="4">
<form method="POST" action="admin.php">
<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center" nowrap><b><font size="2" color="#0000FF" face="Verdana,arial">Please select function.</b></font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="vse" checked name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View all members</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="schvaleny" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View approved members</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="neschv" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View no approved members</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="neaktivni" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View members who are not active longer than 14 days</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="banners" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View all user's banners</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="week" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View stats for this week</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="podvod" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View members with low click ratio</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="detail" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View/edit member with ID <input name="clen" size=10 maxlength=10></font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="backup" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Backup database to file <input name="backupto" size=15 maxlength=15 value="backup.txt"></font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="restore" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Restore database from file <input name="backupfrom" size=15 maxlength=15 value="backup.txt"> in the data directory</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="blacklist" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">View/update blacklist</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="emailall" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Email all members</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="editerrors" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Edit error messages </font>
<select size=1 name="tmpl"><option value="common.php">General messages used in several scripts</option>
<option value="join.php">For script join.php</option><option value="member.php">For script member.php</option>
</select></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="chpass" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Change admin username and/or password</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="resetweek" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Reset weekly stats to zero</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left"><input type="radio" value="resetstatsq" name="co"></td>
	<td width="490" align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Reset all stats to zero</font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td width="10" align="left">&nbsp;</td>
	<td align="left" nowrap><font size="2" color="#0000FF" face="Verdana,arial">&nbsp;<a href="settings.php">Click here to configure Easy Banner Free.</a></font></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center"><input type="submit" value="Submit" name="B1"></td>
</tr>
</form>
</table></center>
<?PHP
echo $settings[footer];
}


function saveuser() {
global $clen, $siteurl, $email, $userpass, $notused, $meshows, $urlbanner;
global $settings;
$lc = "PGEgaHJlZj0iaHR0cDovL3d3dy5waHB3ZWJzY3JpcHRzLmNvbS9lYXN5YmFubmVyLyI+UG93ZXJlZCBieSBFYXN5IEJhbm5lcjwvYT4=";
$vysledek = mysql_query("update ebfmembers set siteurl = '$siteurl',urlbanner = '$urlbanner',email = '$email',location='$lc',userpass = '$userpass' where userid like '$clen'");
$vysledek = mysql_query("select * from ebfmembers where userid like '$clen'");
$zaznam = mysql_fetch_array($vysledek);
echo $settings[head];
?>
<center>
<table border="0" width="500" cellspacing="2" cellpadding="4" style="font-size: 10pt">
	<tr>
	<td colspan=2 align="center">
	<b><font size="2" color="#0000FF" face="Verdana,arial">Changes for user <?PHP echo $zaznam[userid]; ?> has been saved.</b></font><br><br></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">URL </font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial"><a target="_blank" href="<?PHP echo "$zaznam[siteurl]\">$zaznam[siteurl]"; ?></a></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Location of banner exchange code</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Category</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Email</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial"><a href="mailto:<?PHP echo "$zaznam[email]\">$zaznam[email]"; ?></a></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Password</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[userpass]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Date joined</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[date]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Name</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>

	<tr bgcolor="#FFFFFF">
	<td colspan="2" nowrap align="center"><font size="2" color="#000000" face="Verdana,arial">Banner</font><br>
<?PHP echo "<img width=\"$settings[bwidth]\" height=\"$settings[bheight]\" src=\"$zaznam[urlbanner]\">"; ?>
	</td></tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Banner alt tag</font></td>
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
</table>
<br>
<table border="0" width="500" cellspacing="2" cellpadding="4" style="font-size: 10pt">
	<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center"><font size="2" color="#0000FF" face="Verdana,arial"><b>Statistic for this user</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners displayed on pages of this user </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[meshows]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Credits earned </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[earned]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners displayed for this user on pages of other users </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[weshow]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Number of clicks on banner of this user </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Unused credits </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[notused]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Free credits </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Free credits for referrals. </font></td>
	<td nowrap align="left"><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td nowrap><font size="2" color="#000000" face="Verdana,arial">Purchased credits </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
</table><br>
<?PHP
echo $settings[footer];
}


function smazat() {
global $clen, $settings;
$vysledek = mysql_query("delete from ebfmembers where userid like '$clen'");
echo $settings[head];
echo "<br><br><br><center><font size=2 color=#FF0000 face=\"Verdana,arial\"><b>Member $clen has been deleted.</b></center><br><br>";
echo $settings[footer];
}


function detail() {
global $clen,$settings;
$vysledek = mysql_query("select * from ebfmembers where userid like '$clen'");
$zaznam = mysql_fetch_array($vysledek);
if ($zaznam[approved] == 1) {$jeschvaleny = 'approved';}
else {	$jeschvaleny = 'not approved';
$schvalbutton = "<form METHOD=\"post\" action=\"admin.php\">
<input type=\"hidden\" name=\"userid\" value=\"$clen\">
<input type=\"submit\" name=\"co\" value=\"Approve this user\"> 
</form>";	}
if ($zaznam[userid] == '') {$settings[x] = $clen; problems ("User $settings[x] does not exist!");}

$cas = date ("Y-m-j, H:i:s");

echo $settings[head];
?>
<div align="center">
<center>
<b><font color=#0000FF size=3 face="Verdana,arial">User <?PHP echo "$zaznam[userid]</font></b><br><font color=#000000 size=2 face=\"Verdana,arial\">(This user is $jeschvaleny)</font><br>
$schvalbutton"; ?><br>
<table border="0" width="500" cellspacing="2" cellpadding="4">
	<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center">
	<font size="2" color="#0000FF" face="Verdana,arial"><b>User's Details</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">URL</font></td>
	<td align="left" nowrap><font size="2" face="Verdana,arial"><a target="_blank" href="<?PHP echo "$zaznam[siteurl]\">$zaznam[siteurl]"; ?></a></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Location of banner exchange code</font></td>
	<td align="left" nowrap><font size="2" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Category</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Email</font></td>
	<td align="left" nowrap><font size="2" face="Verdana,arial"><a href="mailto:<?PHP echo "$zaznam[email]\">$zaznam[email]"; ?></a></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Password</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[userpass]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Date joined</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[date]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Last banner impression by this member</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Name</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Referred by</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td colspan="2" nowrap align="center"><font size="2" color="#000000" face="Verdana,arial">Banner</font><br>
<?PHP echo "<img width=\"$settings[bwidth]\" height=\"$settings[bheight]\" src=\"$zaznam[urlbanner]\">"; ?>
	</td></tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Banner alt tag</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
</table>
<br>
<table border="0" width="500" cellspacing="2" cellpadding="4">
	<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center">
	<font size="2" color="#0000FF" face="Verdana,arial"><b>Statistic for this user</b></font>
	</td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners displayed on pages of this user </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[meshows]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of clicks on pages of this user </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Credits earned </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[earned]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners displayed for this user on pages of other users </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[weshow]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of clicks on banner of this user </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Unused credits </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[notused]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Free credits </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Free credits for referrals </font></td>
	<td nowrap align="left"><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Purchased credits </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
</table>
<br>
<table border="0" width="500" cellspacing="2" cellpadding="4">
	<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center">
	<font size="2" color="#0000FF" face="Verdana,arial"><b>Statistic for this week</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners displayed on pages of this user </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of clicks on pages of this user </td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of banners displayed for this user on pages of other users </font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Number of clicks on banner of this user </td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
</table>
<br>
<form method="POST" action="admin.php">
<input type="hidden" name="co" value="signup">
<input type="hidden" name="clen" value="<?PHP echo $zaznam[userid]; ?>">
<table border="0" width="500" cellspacing="2" cellpadding="4" style="font-size: 10pt">
	<tr bgcolor="#FFFFFF">
	<td nowrap colspan=2 align="center"><font size="2" color="#0000FF" face="Verdana,arial"><b>Here you can change user's details.</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">URL</font></td>
	<td align="left" nowrap><INPUT maxLength=100 size=50 name="siteurl" value="<?PHP echo $zaznam[siteurl]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Location of banner exchange code</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Banner URL</font></td>
	<td align="left" nowrap><INPUT maxLength=100 size=50 name="urlbanner" value="<?PHP echo $zaznam[urlbanner]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Banner alt tag</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr align="left" bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Category</font></TD>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></TD>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Email</font></td>
	<td align="left" nowrap><INPUT maxLength=70 size=50 name="email" value="<?PHP echo $zaznam[email]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Password</font></td>
	<td align="left" nowrap><INPUT maxLength=8 size=10 name="userpass" value="<?PHP echo $zaznam[userpass]; ?>"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Add or take credits</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Unused credits</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial"><?PHP echo $zaznam[notused]; ?></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Free credits</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">Credits purchased</font></td>
	<td align="left" nowrap><font size="2" color="#000000" face="Verdana,arial">No available in the free version</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="middle" width="100%" colSpan=2><INPUT type=submit value="Save" name=co> <INPUT type=submit value="Delete this user" name=co></font></TD>
</TR></TBODY></TABLE></FORM>
</center><br>
<?PHP
echo $settings[footer];
exit();
}


function resetstats() {
global $settings;
$vysledek = mysql_query("update ebfmembers set freecredit = 0, weshow = 0, notused  = 0, refcredit = 0, purchased = 0, clicks = 0, meshows = 0, earned = 0, klikunej = 0");
$cas = time();
$a = fopen("$settings[phppath]/data/resettime","w");
fwrite ($a,$cas);
fclose ($a);
echo $settings[head];
echo "<br><br><center><font color=#0000FF size=2 face=\"Verdana,arial\"><b>All stats has been reseted to zero.</b></font></center><br>";
echo $settings[footer];
exit;
}

function resetstatsq() {
global $settings;
echo $settings[head];
echo "<br><br><center><font color=#FF0000 size=3 face=\"Verdana,arial\"><b>This function resets all stats to zero. Are you sure?</b></font>
<form action=admin.php method=post>
<input type=hidden name=co value=resetstats>
<input type=submit name=xx value=\"Yes, reset it\"></form>";
echo $settings[footer];
exit;
}



function chpass() {
global $settings;
echo $settings[head];
global $newuser,$newpass,$settings;
if (($newuser) AND ($newpass))
{	$sb = fopen(".htpasswd","w");
	$zapis = fwrite ($sb, "$newuser:" . crypt($newpass));
	fclose($sb);
//chmod(".htpasswd", 0666);
if (!$zapis) problems ("Can not write to the .htpasswd file. Please make sure that the admin directory has 777 permission and the .htaccess file has 666 permission. Contact your server administrator if you need assistance.");
echo "<br><br><center><font color=#0000FF size=2 face=\"Verdana,arial\"><b>Admin username and password has been updated.</b></font><br><br>";
echo $settings[footer]; exit();
}
if (($newuser) OR ($newpass))
echo "<div align=center><center>
<br><font color=#FF0000 size=2 face=\"Verdana,arial\"><b>Both fields are required.</b></font><br><br>";
?>
<div align="center"><center>
<br><font color=#0000FF size=2 face="Verdana,arial"><b>Change your admin username/password</b></font><br><br>
<table border="0" width="200" cellspacing="1" cellpadding="2">
<form action="admin.php" method="post">
<input type="hidden" name="co" value="chpass">
<TR bgcolor="#FFFFFF" nowrap>
<td align="left" nowrap><font color=#000000 size=2 face="Verdana,arial">New username </font></td>
<td align="right"><input type="text" size="10" name="newuser" value=<?PHP echo $newuser; ?>></td>
</tr>
<TR bgcolor="#FFFFFF">
<td align="left" nowrap><font color=#000000 size=2 face="Verdana,arial">New password </font></td>
<td align="right"><input type="text" size="10" name="newpass" value=<?PHP echo $newpass; ?>></td>
</tr>
<TR bgcolor="#FFFFFF"><td align="center" colspan=2><input type="submit" name="A1" value="Submit"></td></tr>
</table></center></div>
<?PHP
echo $settings[footer];
exit;
}


function noavailable() {
global $settings;
echo $settings[head];
echo "<br><br><br><center><font size=2 color=#FF0000 face=\"Verdana,arial\"><b>This function is Not available in the Free version of Easy Banner.<br><br>
<a href=\"http://www.phpwebscripts.com/easybannerpro/buynow.html\">Click here to upgrade to Easy Banner Pro.</a></b></center><br><br>";
if ($fd = fopen ("http://www.phpwebscripts.com/easybanner/compare.txt", "r"))
$contents = fread ($fd, 100000);
echo $contents;
exit;
}


?>



