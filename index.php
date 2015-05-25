
<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors',1);

$date = array(
    mt_rand(1, time()),
    mt_rand(1, time()),
    mt_rand(1, time()),
    mt_rand(1, time()),
    mt_rand(1, time())
    );


  //print_r($date);

echo 'Наименьший день: ';
$min_j = date("j", $date[0]);
foreach ($date as $value) {
    if ($min_j > (date("j", $value)))
        $min_j = (date("j", $value));
}
echo $min_j;

echo "<br>";

//echo 'Наименьший день: '. min(date("j",$date[0]), date("j",$date[1]), date("j",$date[2]), date("j",$date[3]), date("j", $date[4])). "<br>";

echo "Наибольший месяц: ";
$min_m = date("m", $date[0]);
foreach ($date as $value) {
    if ($min_m < date("m", $value))
        $min_m = date("m", $value);
};
echo $min_m ;

echo "<br>";

//echo 'Наибольший месяц: '. max(date("m", $date[0]), date("m", $date[1]), date("m", $date[2]), date("m", $date[3]), date("m", $date[4])). "<br>";

sort($date);
  //print_r($date);

echo $selected = array_pop($date);
echo "<br>";
echo date("d.m.y H:i:s",$selected);
echo "<br>";
date_default_timezone_set("America/New_York");
echo "<br>";
echo date_default_timezone_get();
