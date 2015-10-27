<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');

    $cities = array('641780'=>'Новосибирск','641490'=>'Барабинск','641510'=>'Бердск', // массив для вывода в цикле foreach 
        '641600'=>'Искитим', '641630'=>'Колывань', '641680'=>'Краснообск',  
        '641710'=>'Куйбышев','641760'=>'Мошково', '641790'=>'Обь', 
        '641800'=>'Ордынское', '641970'=>'Черепаново', '0'=>'Выбрать другой...',  ); 

    $categories = array //массив 'секция' => array ('код категории' => 'название категории')
        ('Транспорт' => array('9' => 'Автомобили с пробегом', '109'=> 'Новые автомобили', '14' => 'Мотоциклы и мототехника', '81' => 'Грузовики и спецтехника', '11' => 'Водный транспорт', '10' => 'Запчасти и аксессуары' ),
        'Недвижимость' => array('24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома, дачи, коттеджи', '26' => 'Земельные участки', 
            '85' => 'Гаражи и машиноместа', '42' => 'Коммерческая недвижимость', '86' => 'Недвижимость за рубежом'),
        'Работа' => array('111' => 'Вакансии (поиск сотрудников)', '112' => 'Резюме (поиск работы)'), 
        'Услуги' => array('114' => 'Предложения услуг', '115' => 'Запросы на услуги'), 
        'Личные вещи' => array('27' => 'Одежда, обувь, аксессуары','29' => 'Детская одежда и обувь', '30' => 'Товары для детей и игрушки', 
            '28' => 'Часы и украшения', '88' => 'Красота и здоровье'), 
        'Для дома и дачи' => array('21' => 'Бытовая техника', '20' => 'Мебель и интерьер', '87' => 'Посуда и товары для кухни',
            '82' => 'Продукты питания', '19' => 'Ремонт и строительство', '106' => 'Растения'),
        'Бытовая техника' => array('32' => 'Аудио и видео', '97' => 'Игры, приставки и программы', 
            '31' => 'Настольные компьютеры', '98' => 'Ноутбуки', '99' => 'Оргтехника и расходники', '96' => 'Планшеты и электронные книги', '84' => 'Телефоны', 
            '101' => 'Товары для компьютера', '105' => 'Фототехника'),
        'Хобби' => array('33' => 'Билеты и путешествия', '34' => 'Велосипеды', '83' => 'Книги и журналы', 
            '36' => 'Коллекционирование', '38' => 'Музыкальные инструменты', '102' => 'Охота и рыбалка', 
            '39' => 'Спорт и отдых', '103' => 'Знакомства' ),
        'Животные' => array('89' => 'Собаки', '90' => 'Кошки', '91' => 'Птицы', '92' => 'Аквариум', '93' => 'Другие животные',
            '94' => 'Товары для животных'),
        'Для бизнеса' => array('116' => 'Готовый бизнес', '40' => 'Оборудование для бизнеса'));
    
    function prepareAD($data=null, $head=null, $button=null)
            {
                $out = array();
                $out['private'] = isset($data['private'])?$data['private']:'1';
                $out['seller_name'] = isset($data['seller_name'])?$data['seller_name']:'';
                $out['email'] = isset($data['email'])?$data['email']:'';
                $out['phone'] = isset($data['phone'])?$data['phone']:'';
                $out['location_id'] = isset($data['location_id'])?$data['location_id']:'';
                $out['checkbox'] = isset($data['checkbox'])?$data['checkbox']:'';
                $out['category_id'] = isset($data['category_id'])?$data['category_id']:'';
                $out['title'] = isset($data['title'])?$data['title']:'';
                $out['description'] = isset($data['description'])?$data['description']:'';
                $out['price'] = isset($data['price'])?$data['price']:'';
            
                if (isset($head))
                    {
                        $out['head'] = $head;
                    }
                
                 if (isset($button))
                    {
                        $out['button'] = $button;
                    }   
                    
                return $out;
            }
       
    $formParams = prepareAD($data=null, $head = 'Страница добавления объявления', $button = 'Далее');
     
    
   function display($ads) 
            {
            ksort($ads);
                echo '<table>';
                    foreach ($ads as $id => $idData)
                        {
                            echo '<tr>
                                <td> <a href = "dz7_2.php?id='. $id. '">'. $idData['title'] . '</a>' .' | '. '</td>'. //	При нажатии на «название объявления» на экран выводится шаблон объявления 
                                '<td>' . $idData['price'] .' руб.'. ' | '. '</td>' .
                                '<td>' . $idData['seller_name'] . ' | '. '</td>'.
                                '<td><a href = "dz7_2.php?del='.$id . '">удалить</a>' . "<br>". '</td>'. // При нажатии на «Удалить», объявление удаляется из файла
                             '</tr>'; 
                        }
                echo '</table>';
            }
            
            if(file_exists('ad.txt'))
                {
                    $handle = fopen('ad.txt', 'r');
                    $f_read = fread($handle, filesize('ad.txt'));
                    
                    $the_unserialized_array = unserialize($f_read);
                    
                    fclose($handle);
                }
          
    if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $for_form = $the_unserialized_array[$id];
            $formParams = prepareAD($for_form, $head = 'Страница редактирования', $button = 'Готово');
        }
    else 
        {   
            if (isset($_GET['del']))  //удаление объявления
                {
                    $filename = 'ad.txt';
                    $id_for_del = $_GET['del'];
                    $uns_for_delete = $the_unserialized_array;
                    unset($uns_for_delete[$id_for_del]);
                    $ser = serialize($uns_for_delete);
                    $handle = fopen($filename, 'w+');
                    if (fwrite($handle, $ser) === FALSE)
                        {
                            echo 'Удаление работает неправильно';
                        }
                    fclose($handle);
 
                    if(isset($GET['del']))
                        {
                            unset($GET['del']);
                        }
                        
                    header('Location: dz7_2.php');
                }
    
            if (isset($_POST['main_form_submit'])) //	Всё, что пришло из формы записать в файл 'ad.txt' 
                {                     
                        
                            $uns = isset($the_unserialized_array)?$the_unserialized_array:array();
                            $id = isset($_POST['hidden'])?$_POST['hidden']:'';
                              if (!is_numeric($id))
                                  {
                                    $uns[] = prepareAD($_POST);
                                    $the_unserialized_array = $uns;                                                                                           
                                  }
                               else
                                   {                                   
                                        $uns[$id] = prepareAD($_POST);
                                        $id = '';
                                        $the_unserialized_array = $uns;
                                    }
                                    
                                    $ser = serialize($uns);                              
                                    $handle = fopen('ad.txt', 'w+');
                                  if(fwrite($handle, $ser)===FALSE)
                                        {
                                            echo 'Не удалось сохранить в ad.txt';
                                        }
                                    fclose($handle);   
                        
                    unset($_POST);
                }
           }

require_once('form.php');

 if ($formParams['head'] == 'Страница редактирования')
        {
            echo '<a href="dz7_2.php">Назад</a>';
        }
   
    if (isset($the_unserialized_array) && $formParams['head'] == 'Страница добавления объявления') // вывод всех объявлений, содержащихся в файле
        {  
                  $ads = $the_unserialized_array;
                  display($ads);
        }
        
        if(isset($the_unserialized_array))
            {
                unset($the_unserialized_array);
            }