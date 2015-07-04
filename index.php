<?php

error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors',1);
header('Content-type: text/html; charset=utf-8');

$ini_string='
[игрушка мягкая мишка белый]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[одежда детская куртка синяя синтепон]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[игрушка детская велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';

';

//echo $ini_string;

$bd=  parse_ini_string($ini_string, true);
//print_r($bd);


echo "<br>";

echo "<h3> Корзина: </h3>";
function parse_basket ($basket) 
{
    
    
    global  $flag;
    
           $information = '';                    // переменная для Уведомлений          
           $total = '';                         // переменная для подсчета Стоимость
           $combined_in_basket_f = array();    // массив с данными, который выводится в виде таблицы
           $information = array();            // массив для сбора $information (Уведомлений) 
           $shipped = array();               // сколько отгружено(отправлено клиенту)
           
           $flag = false;
           

    
    $title = array('','Цена за единицу товара(руб)', 'Скидка', 'Цена со скидкой(руб)', // массив с загловками для каждой
        'Количество заказано(шт)', 'На складе(шт)', 'Стоимость(руб)' );               // колонки таблицы
    $combined_in_basket_f = array(0 => $title);  
    
    $count = 1;     // ключ массива $combined_in_basket_f
    
    foreach($basket as $names=> $params)
        {             

          if($names == 'игрушка детская велосипед')          //если он заказал "игрушка детская велосипед" в количестве >=3 штук, 
                {                                           //то на эту позицию ему автоматически дается скидка 30%
                if($params['количество заказано']>=3)
                    {
                    $params['diskont'] = 'diskont3';
                    $flag = true;
                    }
                }
                
        if ($params['осталось на складе']>=$params['количество заказано']) 
            {                                                            
            $discount = discount($params['цена'], $params['количество заказано'], $params['diskont']);
            $params['осталось на складе'] = $params['количество заказано']; 
            $shipped[$names] = $params['количество заказано'];
            }
        elseif ($params['осталось на складе']>0)                                                                                      
            {                                                            
            $discount = discount($params['цена'], $params['осталось на складе'], $params['diskont']);
            $information[] = 'Вы можете заказать "' . $names .'" - ' . $params['осталось на складе'] . ' шт.';
            $shipped[$names] = $params['осталось на складе'];
            }
        else 
            {
            $discount['skidka'] = '00';
            $discount['price'] = 0;
            $discount['price_total'] = 0;
            $information[] = 'К сожалению товара "' . $names  .  '" нет на складе.';
            }                               
                


$combined_in_basket_f[$count] = array($names, $params['цена'], $discount['skidka'], 
                $discount['price'], $params['количество заказано'], $params['осталось на складе'], $discount['price_total']);
        $count++;
        
        $total += $discount['price_total'];
        
    }
    
    $parse_basket_f = array();  // массив который возвращает функция parse_basket();
    
    $parse_basket_f['shipped'] = $shipped;  
    $parse_basket_f['total'] = $total;
    $parse_basket_f['information'] = $information;
    $parse_basket_f['combined_in_basket_f'] = $combined_in_basket_f;
     
        return $parse_basket_f;
}


function discount($price, $amount, $diskont)
{
   $skidka = substr($diskont,7,1);
   $price_with_diskont_per_item =$price - ($price * ($skidka *10) / 100);
   $total_price_all_items_with_diskont = $amount * $price_with_diskont_per_item;
   return array ('skidka' => $skidka."0%",
                 'price' => $price_with_diskont_per_item ,
                'price_total' => $total_price_all_items_with_diskont);
}


$parse_basket = parse_basket($bd);


echo "<br>";

$combined_in_basket = $parse_basket['combined_in_basket_f'];

echo "<table border=1>";                                            
    
    for($i=0; $i < (count($combined_in_basket)); $i++ )           // вывод переменной $combined_in_basket в виде таблицы
        {
            echo "<tr>"; 
                $combined_in_basket_i = $combined_in_basket[$i];
                for ($j=0; $j < count($combined_in_basket_i); $j++ )
                    {
                        
                        echo "<td text align = center>". $combined_in_basket_i[$j] . "</td>";
                       
                    }
            
            echo "</tr>"; 
        }

echo "</table>";

$total_order = 0;           // Переменная для подсчета общего количества товара
foreach($parse_basket['shipped'] as $value)  // Цикл для подсчета общего количества товара
    {
        $total_order += $value;
    }

echo "<h4> ИТОГО:</h4>";
    foreach($parse_basket['shipped'] as $key => $val)
            {
                echo 'Товара "' . $key . '" заказно - ' . $val . ' шт.' . "<br>";
            } 
            
 echo '<b>Общая сумма заказа:</b> ' . $parse_basket['total'] . ' руб.' . "<br>" . 
                
        "<b>Общее количество товара:</b>  $total_order " .' шт.' . "<br>" ;
        


echo "<h3> Уведомления: </h3>"; 

foreach ($parse_basket['information'] as $value){
    if($value <> '') 
        {
        echo $value . "<br>";
        }
}

if ($flag)
    {
        echo "<h3> Скидки: </h3>" . 'При заказе "игрушка детская велосипед" от 3 штук на эту позицию дается скидка 30%</p>';
    }
    
echo "<br>";


