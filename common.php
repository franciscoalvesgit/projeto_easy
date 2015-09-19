<?php

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

$MYSQL_ERRNO = '';
$MYSQL_ERROR = '';

function parsedata($template, $value) {
global $settings;
$value[adminemail] = $settings[adminemail];
$fh = @fopen( "$template", 'r' ) or problems ("Can not open $template for reading");
while( !feof( $fh ) )                {$line .= fgets( $fh, 4096 );}
fclose( $fh );

while( list ($key, $val) = each ($value))
        { $val  = stripslashes($val);
          $line = str_replace("#%$key%#", "$val", $line);
        }
reset ($value);
$line = StripSlashes($line);
echo $line;
}

function parsehtml($template, $value) {
global $settings;
$value[adminemail] = $settings[adminemail];
$fh = @fopen( "$template", 'r' ) or problems ("Can not open $template for reading");
while( !feof( $fh ) )                {$line .= fgets( $fh, 4096 );}
fclose( $fh );

while( list ($key, $val) = each ($value))
        { $val  = stripslashes($val);
          $line = str_replace("#%$key%#", "$val", $line);
        }
reset ($value);
$line = StripSlashes($line);
return $line;
}
$l[a] = "zY3JpcHRzLmNvbS9lYXN5YmFubmVyLyI+UG";
function sendemail($template,$value) {
global $settings;
$fd = @fopen($template, 'r') or problems ("Can not open $template for reading");
while ($line = fgets($fd, 4096)) $emailtext .= $line;
fclose($fd);
$from = $value[from];
$to = $value[email];

eregi("Subject: +([^\n\r]+)", $emailtext, $regs);
$sub = $regs[1];
$emailtext = eregi_replace("Subject: +([^\n\r]+)[\r\n]+", '', $emailtext);
while (list($key, $val) = each ($value))
{        $val  = stripslashes($val);
    $emailtext = str_replace("#%$key%#", "$val", $emailtext);
}
reset ($value);
//echo "To: $to<br>From: $from<br>Sub: $sub<br>$emailtext<br><br><br>";
mail($to, $sub, $emailtext, "From: $from");
}
$l[b]="93ZXJlZCBieSBFYXN5IEJhbm5lcjwvYT4=";
function db_connect($dbname='') {
   global $settings;
   global $MYSQL_ERRNO, $MYSQL_ERROR;

   $link_id = mysql_connect($settings[dbhost], $settings[dbusername], $settings[dbpassword]);
   if(!$link_id) {
      $MYSQL_ERRNO = 0;
      $MYSQL_ERROR = "$errors[dbconnecterror] $settings[dbhost].";
      return 0;
   }
   else if(empty($dbname) && !mysql_select_db($settings[dbname])) {
      $MYSQL_ERRNO = mysql_errno();
      $MYSQL_ERROR = mysql_error();
      return 0;
   }
   else if(!empty($dbname) && !mysql_select_db($dbname)) {
      $MYSQL_ERRNO = mysql_errno();
      $MYSQL_ERROR = mysql_error();
      return 0;
   }
   else return $link_id;
}

function sql_error() {

   global $MYSQL_ERRNO, $MYSQL_ERROR;
   if(empty($MYSQL_ERROR)) {
      $MYSQL_ERRNO = mysql_errno();
      $MYSQL_ERROR = mysql_error();
   }
   return "$MYSQL_ERRNO: $MYSQL_ERROR";
}

function problems ($error) {
global $settings;
$pole[errortext] = $error;
$file = "$settings[phppath]/data/templates/error.html";
  parsedata($file, $pole);
  exit;
}

?>