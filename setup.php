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

$pathtofolder = dirname($PATH_TRANSLATED);

$form[success] = 0;

$head = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html><head>
<META http-equiv=Content-Type content=\"text/html; charset=windows-1250\">
<title>EasyBanner Free</title>\n</head>\n\n
<body bgcolor=\"#EAEAEA\" text=\"#000000\" link=\"#0000FF\" vlink=\"#0000FF\" alink=\"#FF0000\">";

if ($co=="ok") ok();
else form();

if ($form[success] == 1)
{
include("./data/data.php");
include("./common.php");

$MYSQL_ERRNO = '';
$MYSQL_ERROR = '';
$linkid = db_connect($dbname);
$location = "PGEgaHJlZj0iaHR0cDovL3d3dy5waHB3ZWJ".$l[a].$l[b];

if (!$linkid)
 { 
$noconnect = sql_error();
$noconnect = "<font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>$noconnect</b></font><br>";
  echo $noconnect;} 

$vysledek[2] = mysql_query("
CREATE TABLE ebfmembers (
   userid varchar(10) NOT NULL,
   userpass varchar(10) NOT NULL,
   email varchar(70) NOT NULL,
   siteurl varchar(100),
   urlbanner varchar(100),
   location varchar(255) DEFAULT '$location',
   name varchar(20),
   exratio decimal(3,2),
   freecredit int(11),
   weshow int(11),
   notused decimal(10,2),
   refcredit smallint(6),
   purchased int(11),
   clicks int(11),
   approved tinyint(4) NOT NULL,
   affiliate varchar(10),
   date date NOT NULL,
   time int(11) NOT NULL,
   meshows int(11) NOT NULL,
   earned decimal(12,2) NOT NULL,
   number int(11) NOT NULL,
   klikunej int(11),
   category tinyint(4) NULL,
   alt varchar(50) NOT NULL,
   flash tinyint(4) NOT NULL,
   enable tinyint(4) NOT NULL,
   PRIMARY KEY (userid))");
if (!$vysledek[2])
{ $inf[2] = mysql_error(); $infnum[2] = mysql_errno();
  $info[2] = "<font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">$inf[2].</font><br>";
  echo $info[2];
} 

if ($infnum[2]==1050)
echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">All necessary tables was already installed.</font><br>";
elseif (($vysledek[1]) OR ($vysledek[2]) OR ($vysledek[3]) OR ($vysledek[4]))
echo "<br><br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Setup was created all necessary tables.</font><br>";
else 
{ echo "<br><font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>There are any problems with mysql database. Please check your mysql settings. Can't continue.</b></font><br>"; exit(); }
echo "<br><br><table width=750 cellpadding=15 cellspacing=0><tr><td bgcolor=\"#FFFFFF\" align=\"center\"><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">EasyBanner has been successfully installed. If all will work fine, please delete 'setup.php' from your server.
<br><br><font color=\"#000000\">Now please continue to your <a href=\"admin/settings.php\">admin directory</a> and set all variables and options.<br>Use username \"admin\" and password \"admin\".</font><br><br>
<b>If the username and password are not accepted</b><br>
This indicates that the .htaccess or the .htpasswd file in the admin directory has not been properly configured. Double check that 
the full path to the folder where your scripts live is correct. If you are absolutely sure it is, you will need to contact your
server administrator for assistance with .htaccess on your server. If you want \"fast help\" you can delete both .htpasswd and .htaccess files
in the admin directory (but please download it first), so this directory will not be protected by password.<br><br>
<b>If you will not be asked for password</b><br>
This indicates that .htaccess is not enabled on your server, or the .htaccess file is not properly configured for your
server.  You will need to contact your server administrator for assistance with setting up .htaccess.
</font></td></tr></table><br><br><br><br>";
}




function form() {
global $data,$head,$pathtofolder;
$form[success] = 0;
echo $head;
?>
<div align="center">
<center>
<br>
<form method="POST" action="setup.php">
<input type="hidden" name="co" value="ok">
<table border="0" width="700" cellspacing="2" cellpadding="4" style="font-size: 10pt">
	<tr bgcolor="#FFFFFF">
	<td colspan=2 align="center"><font size="2" color="#0000FF" face="Verdana,arial,sans-serif"><b>Easy Banner Free</b><br>Please set these variables.<br>If you haven't mysql database, ask your server admin to create one for you.</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial,sans-serif">Mysql database host (try 'localhost' if you are not sure).</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbhost]"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial,sans-serif">Your mysql database username.</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbusername]"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial,sans-serif">Mysql database password.</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbpassword]"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial,sans-serif">Name of your mysql database.</font></td>
	<td align="left"><INPUT maxLength=30 size=30 name="form[dbname]"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial,sans-serif">Full path to the folder where the scripts live. It should be correct value so please don't change it if you are not 100% sure it is incorrect. No trailing slash.</font></td>
	<td align="left"><INPUT maxLength=100 size=50 name="form[phppath]" value="<?PHP echo $pathtofolder; ?>"><br><font size=1 color="#000000" face="Verdana,arial,sans-serif">Sample: /htdocs/sites/user/html/easybanner</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="left"><font size="2" color="#000000" face="Verdana,arial,sans-serif">URL of the directory where your php scripts are installed. No trailing slash.</font></td>
	<td align="left"><INPUT maxLength=100 size=50 name="form[phpdirectory]"><br><font size=1 color="#000000" face="Verdana,arial,sans-serif">Sample: http://www.yourdomain.com/bannerexchange/php</font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td align="middle" width="100%" colSpan=2><INPUT type=submit value="Save" name=D1></font></TD>
</TR></TBODY></TABLE></FORM>
</center><br>
<?PHP
exit();
}


function ok() {
global $settings,$form,$head;
$form[success] = 0;
echo $head;
if (!$form[dbhost]) { chyba ("<center>Your mysql database host can't left blank."); $chyba=1;} else hlaseni ("<center>Your mysql database host: $form[dbhost] OK.");
if (!$form[dbusername]) { chyba ("Mysql database username is missing."); $chyba=1;} else hlaseni ("Mysql database username: $form[dbusername] OK.");
if (!$form[dbpassword]) { chyba ("Password to mysql database is missing."); $chyba=1;} else hlaseni ("Password to mysql database: $form[dbpassword] OK.");
if (!$form[dbname]) { chyba ("Missing name of your mysql database."); $chyba=1;} else hlaseni ("Name of your mysql database: $form[dbname] OK.");
if (!$form[phppath]) { chyba ("Full path to your php folder can't left blank."); $chyba=1;} else hlaseni ("Full path to php folder: $form[phppath] OK.");
if (!strpos($form[phpdirectory],"ttp://")) { chyba ("URL of your php directory must begin with 'http://'"); $chyba=1;} else hlaseni ("URL of your PHP directory: $form[phpdirectory] OK.");
if ($chyba) { chyba ("<br>Can't continue. Please go back and try again."); exit();}

$form[ratio] = $form[ratioprocent]/100;
if (!$form[bannermaxsize]) $form[bannermaxsize]=0;

if (!$sb = fopen("$form[phppath]/data/data.php","w")) { chyba ("Can't make file 'data.php' in your data directory. Please make sure that your data directory exists and has 777 permission. Can't continue."); exit(); }
$data = "<?PHP\n\n\$settings[dbhost] = \"$form[dbhost]\";\n";
$data .= "\$settings[dbusername] = \"$form[dbusername]\";\n";
$data .= "\$settings[dbpassword] = \"$form[dbpassword]\";\n";
$data .= "\$settings[dbname] = \"$form[dbname]\";\n";
$data .= "\$settings[phpdirectory] = \"$form[phpdirectory]\";\n";
$data .= "\$settings[phppath] = \"$form[phppath]\";\n";
$data .= "\n?>";
$zapis = fwrite ($sb, $data);
fclose($sb);
chmod("$form[phppath]/data/data.php", 0666);
if (!$zapis)
{ echo "<br><br><font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>Can not write to file 'data.php'.<br>Please make sure that your data directory exists and has 777 permission. Can't continue.</b></font><br>"; exit();}
else
echo "<br><br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Setup was created file 'data.php' in your data directory.</font><br>";


$sb = 0; $zapis = 0; $chyba = 0;
if (file_exists("$form[phppath]/data/resettime"))
echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Your data directory already contains file 'resettime'. Skipping.</font><br>";
else
{ $cas = time();
  $sb = fopen("$form[phppath]/data/resettime","w");
  $zapis = fwrite ($sb, $cas);
  fclose($sb);
  chmod("$form[phppath]/data/resettime", 0666);
  if (!$zapis)
  { $chyba = 1;
  echo "<br><font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>Can not make file 'resettime'.<br>Please make sure that your data directory exists and has 777 permission.</b></font><br>"; }
  else
  echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Setup was created file 'resettime' in your data directory.</font><br>";
}


$sb = 0; $zapis = 0;
if (file_exists("$form[phppath]/admin/.htaccess"))
echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Your admin directory already contains file '.htaccess'. Skipping.</font><br>";
else
{ $htaccfile = "AuthName \"EasyBanner\"\nAuthType Basic\nAuthUserFile $form[phppath]/admin/.htpasswd\nAuthGroupFile /dev/null\n\nrequire valid-user\n\n";
  $sb = fopen("$form[phppath]/admin/.htaccess","w");
  $zapis = fwrite ($sb, $htaccfile);
  fclose($sb);
  chmod("$form[phppath]/admin/.htaccess", 0644);
  if (!$zapis)
  { $chyba = 1;
  echo "<br><font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>Can not make file '.htaccess'.<br>Please make sure that your admin directory exists and has 777 permission.</b></font><br>"; }
  else
  echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Setup was created file '.htaccess' in your admin directory.</font><br>";
}

$sb = 0; $zapis = 0;
if (file_exists("$form[phppath]/admin/.htpasswd"))
echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Your admin directory already contains file '.htpasswd'. Skipping.</font><br><br>";
else
{ $sb = fopen("$form[phppath]/admin/.htpasswd","w");
  $zapis = fwrite ($sb, 'admin:' . crypt('admin'));
  fclose($sb);
  chmod("$form[phppath]/admin/.htpasswd", 0666);
  if (!$zapis)
  { $chyba = 1;
  echo "<br><font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>Can not make file '.htpasswd'.<br>Please make sure that your admin directory exists and has 777 permission.</b></font><br><br>"; }
  else
  echo "<br><font color=#0000FF size=2 face=\"Verdana,arial,sans-serif\">Setup was created file '.htpasswd' in your admin directory.</font><br><br>";
}
if ($chyba == 1) { echo "<br><font color=#FF0000 size=2 face=\"Verdana,arial,sans-serif\"><b>An error has occured while making your files. Please check your settings and try again.</b></font><br><br>"; exit(); }
$form[success] = 1;
}


function chyba($text) {
echo "<font size=2 color=#FF0000 face=\"Verdana,arial,sans-serif\"><b>$text</b></font><br>";
}


function hlaseni($text) {
echo "<font size=2 color=#0000FF face=\"Verdana,arial,sans-serif\">$text</font><br>";
}



?>
