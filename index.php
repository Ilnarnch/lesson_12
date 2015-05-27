
<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors',1);

for($i=0; $i<5; $i++)
 $date[] = mt_rand(1, time()); // Заполнение исходного массива циклом

//var_dump($date);



foreach($date as $value){ 
    $min_j[]=date("j",$value);  // Создание вспомогательного массива из дней
}
//var_dump($min_j);

echo 'Наименьший день: '. min($min_j)."<br>";

//echo 'Наименьший день: '. min(date("j",$date[0]), date("j",$date[1]), date("j",$date[2]), date("j",$date[3]), date("j", $date[4])). "<br>";

foreach($date as $value){
    $max_m[] = date("m", $value); // Создание вспомогательного массива из месяцев
}
//var_dump($max_m);

echo 'Наибольший месяц: '. max($max_m). "<br>";

//echo 'Наибольший месяц: '. max(date("m", $date[0]), date("m", $date[1]), date("m", $date[2]), date("m", $date[3]), date("m", $date[4])). "<br>";

sort($date);

// var_dump($date);

echo $selected = array_pop($date);
echo "<br>";
echo date("d.m.y H:i:s",$selected);
echo "<br>";
date_default_timezone_set("America/New_York");
echo "<br>";
echo date_default_timezone_get();
