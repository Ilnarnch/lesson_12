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

    foreach($basket as $names=> $params)
        {
        
        $information = 'Приятных покупок!';
        echo $names;
        echo "<br>\n";
//        print_r($params);
        
          if($names = 'игрушка детская велосипед')                   //если он заказал "игрушка детская велосипед" в количестве >=3 штук, 
                {                                                    //то на эту позицию ему автоматически дается скидка 30%
                if($params['количество заказано']>=3)
                    {
                    $params['diskont'] = 'diskont3'; 
                    }
                }
                
        if ($params['осталось на складе']>$params['количество заказано']) //извещение покупателя о том, что нужного количества товара не оказалось на складе
            {
            $discount = discount($params['цена'], $params['количество заказано'], $params['diskont']);  
            }
        else 
            {
            $discount['skidka'] = 0;
            $discount['price'] = 0;
            $discount['price_total'] = 0;
            $information = 'Вы не можете заказать товара больше чем есть на складе!';
            }  
          
        echo 'Цена за единицу товара: ' . $params['цена']. 'руб | Скидка: ' .$discount['skidka'] . 
                ' | Цена со скидкой: '. $discount['price'] . ' | Количество заказано: ' . $params['количество заказано'] . 
                ' | На складе: ' . $params['осталось на складе'] . ' | ИТОГО: ' . $discount['price_total'] ;
        echo "<br>";
        echo "<h4> Уведомления: </h4>" . $information; 
        echo "<br><br>";
        echo "<hr>";
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


echo "<h3> Скидки: </h3>";
echo 'При заказе "игрушка детская велосипед" в количестве >=3 штук, то на эту позицию дается скидка 30%';