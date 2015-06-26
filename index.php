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

$total_order = 0;           // Переменная для подсчета общего количества товара

echo "<br>";

echo "<h3> Корзина: </h3>";
function parse_basket ($basket) 
{
    
    
    global $information,          
           $total,                  // Переменная для подсчета ИТОГО
           $flag,
           $product_name,           // массив для секции ИТОГО  
    
           $in_basket_0,
           $in_basket_1,
           $in_basket_2;
    
           $information = array();  // массив для сбора $information (Уведомлений)
           $total = 0;    
           $flag = false;

    $count = 0;      
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
            $product_name[$names] = $params['количество заказано'];
            }
        elseif ($params['осталось на складе']>0)                                                                                      
            {                                                            
            $discount = discount($params['цена'], $params['осталось на складе'], $params['diskont']);
            $information[] = 'Вы можете заказать "' . $names .'" - ' . $params['осталось на складе'] . ' шт.';
            $product_name[$names] = $params['осталось на складе'];
            }
        else 
            {
            $discount['skidka'] = '00';
            $discount['price'] = 0;
            $discount['price_total'] = 0;
            $information[] = 'К сожалению товара "' . $names  .  '" нет на складе.';
            }                               
                
        
        switch($count)  //создание массивов с данными по каждому товару
        {
            case 0 : $in_basket_0 = array($names, $params['цена'], $discount['skidka'], 
                $discount['price'], $params['количество заказано'], $params['осталось на складе'], $discount['price_total']);Break;
            case 1 : $in_basket_1 = array($names, $params['цена'], $discount['skidka'], 
                $discount['price'], $params['количество заказано'], $params['осталось на складе'], $discount['price_total']);Break;
            case 2 : $in_basket_2 = array($names, $params['цена'], $discount['skidka'],
                $discount['price'], $params['количество заказано'], $params['осталось на складе'], $discount['price_total']);Break; $count = 0;
        }
        $count++;
        
        $total += $discount['price_total'];
        
    }
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

parse_basket($bd);


$combined_in_basket = array();
$title = array('','Цена за единицу товара(руб):', 'Скидка: ', 'Цена со скидкой(руб): ', // массив с загловками для каждого
    'Количество заказано(шт): ', 'На складе(шт): ', 'Стоимость(руб): ' );               // ряда таблицы

function combined_in_basket($title,$in_basket_0, $in_basket_1, $in_basket_2)         // объединение массивов в один
                {
                    for ($i = 0; $i<count($in_basket_0); $i++)                    
                        {
                            $combined_in_basket[] = $title[$i];
                            $combined_in_basket[] = $in_basket_0[$i];
                            $combined_in_basket[] = $in_basket_1[$i];
                            $combined_in_basket[] = $in_basket_2[$i];
                        }
                        return $combined_in_basket;
                };
$combined_in_basket = combined_in_basket($title,$in_basket_0, $in_basket_1, $in_basket_2);
//var_dump($combined_in_basket);

echo "<br>";

$count = 0;

echo "<table border=1>";                                            
    
    for($i=0; $i < (count($combined_in_basket)/4); $i++ )           // вывод корзины ($combined_in_basket) в виде таблицы
        {
            echo "<tr>"; 
            
                for ($j=0; $j<4; $j++ )
                    {
                        
                        echo "<td text align = center>". $combined_in_basket[$count] . "</td>";
                        $count++;
                    }
            
            echo "</tr>"; 
        }

echo "</table>";

foreach($product_name as $value)  // Цикл для подсчета общего количества товара
    {
        $total_order += $value;
    }

echo "<h4> ИТОГО:</h4>";
    foreach($product_name as $key => $val)
            {
                echo 'Товара "' . $key . '" заказно - ' . $val . ' шт.' . "<br>";
            } 
            
 echo "<b>Общая сумма заказа:</b> $total руб." . "<br>" . 
                
        "<b>Общее количество товара:</b>  $total_order " .' шт.' . "<br>" ;
        


echo "<h3> Уведомления: </h3>"; 

foreach ($information as $value){
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


