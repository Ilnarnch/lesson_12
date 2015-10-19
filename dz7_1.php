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
    
    $formParams = array 
        (
            'head' => 'Страница добавления объявления',
            'private' => '1',
            'seller_name' => '',
            'email' => '',
            'phone' => '',
            'location_id' => '',
            'checkbox' => '',
            'category_id' => '',
            'title' => '',
            'description' => '',
            'price' => '',
            'button' => 'Далее'
        );
    
    
    function uns ($uns,$id = '')
                                {
                                  if ($id == '')
                                    {
                                      $uns[] = array 
                                            (   
                                                'private' => $_POST['private'], 'seller_name' => $_POST['seller_name'], 'email' => $_POST['email'],
                                                'phone'=> $_POST['phone'], 'location_id'=> $_POST['location_id'], 
                                                'checkbox' => $_POST['checkbox'], 'category_id'=> $_POST['category_id'], 
                                                'title'=> $_POST['title'], 'description'=> $_POST['description'], 'price'=> $_POST['price']
                                            );
                                    }
                                  else
                                    {
                                      $uns[$id] = array 
                                        (   
                                            'private' => $_POST['private'], 'seller_name' => $_POST['seller_name'], 'email' => $_POST['email'], // создание отредактированного объявления
                                            'phone'=> $_POST['phone'], 'location_id'=> $_POST['location_id'], 
                                            'checkbox' => $_POST['checkbox'], 'category_id'=> $_POST['category_id'], 
                                            'title'=> $_POST['title'], 'description'=> $_POST['description'], 'price'=> $_POST['price']
                                        );
                                    }
                                    return $uns;
                                }
    


   function display($ads) 
            {
            ksort($ads);
                echo '<table>';
                    foreach ($ads as $id => $idData)
                        {
                            echo '<tr>
                                <td> <a href = "dz7_1.php?id='. $id. '">'. $idData['title'] . '</a>' .' | '. '</td>'. //	При нажатии на «название объявления» на экран выводится шаблон объявления 
                                '<td>' . $idData['price'] .' руб.'. ' | '. '</td>' .
                                '<td>' . $idData['seller_name'] . ' | '. '</td>'.
                                '<td><a href = "dz7_1.php?del='.$id . '">удалить</a>' . "<br>". '</td>'. // При нажатии на «Удалить», объявление удаляется из куки
                             '</tr>'; 
                        }
                echo '</table>';
            }

            if(isset($_COOKIE['ad']))
                {
                    $the_unserialized_array = unserialize($_COOKIE['ad']);
                }


    if (isset($_GET['id']))
        {
            $id = $_GET['id'];
        
            $for_form = $the_unserialized_array[$id];
            $formParams = array 
                (
                    'head' => 'Страница редактирования',
                    'private' => $for_form['private'],
                    'seller_name' => $for_form['seller_name'],
                    'email' => $for_form['email'],
                    'phone' => $for_form['phone'],
                    'location_id' => $for_form['location_id'],
                    'checkbox' => $for_form['checkbox'],
                    'category_id' => $for_form['category_id'],
                    'title' => $for_form['title'],
                    'description' => $for_form['description'],
                    'price' => $for_form['price'],
                    'button' => 'Готово'
                );
        
        }
    else 
        { 
            if (isset($_POST['hidden']))
                {
                     $id = $_POST['hidden'];
                }
            else
                {
                     $id = '';
                }
           
            if (isset($_POST['main_form_submit']) && !empty($_POST['hidden'])) // если id редактироемого объявления был создан(при нажатии на "Названии объявления")
                {   
                                                                                    // и была нажато кнопка "Готово" (удаление объявления которое было до редактирования)
                            $id_for_del = $_POST['hidden'];
                                                       
                            $uns_for_correct = $the_unserialized_array;
                            unset($uns_for_correct[$id_for_del]);
                            $_COOKIE['ad'] = serialize($uns_for_correct);
                            setcookie('ad', $_COOKIE['ad']);
                            
                            unset($_POST['hidden']);
                        
                }
              
            if (isset($_GET['del']))  //удаление объявления
                {
                    $uns_for_del = $the_unserialized_array;
                    
                    unset($uns_for_del[$_GET['del']]);
                    $_COOKIE['ad'] = serialize($uns_for_del);
                    
                    setcookie('ad', $_COOKIE['ad']);
                }
    
            if (!empty($_POST)) //	Всё, что пришло из формы записать в $_COOKIE 
                {
                    if(!isset($_COOKIE['ad']))
                        {
                            $for_cookie_array[] = array 
                                (   
                                    'private' => $_POST['private'], 'seller_name' => $_POST['seller_name'], 'email' => $_POST['email'],
                                    'phone'=> $_POST['phone'], 'location_id'=> $_POST['location_id'], 
                                    'checkbox' => $_POST['checkbox'], 'category_id'=> $_POST['category_id'], 
                                    'title'=> $_POST['title'], 'description'=> $_POST['description'], 'price'=> $_POST['price']
                                );
                            setcookie('ad', serialize($for_cookie_array));
                        }
                    else
                        {
                              $uns = $the_unserialized_array;
                                       
                              if ($id == '')
                                  {
                                    $uns = uns($uns,$id);                      
                                  }
                               else
                                    {
                                        $uns = uns($uns,$id);
                                        $id = '';
                                    }
                                $ser = serialize($uns);
                                setcookie('ad', $ser);
                        }
                    unset($_POST);
                }
           }
?>
    <form  method="post" action = "<?php echo $_SERVER['PHP_SELF'] ?>" name = "form_1">
        <h2><?php echo $formParams['head'] ?> </h2>
            <div class="form-row-indented"> 
                <label class="form-label-radio">
                    <input type="radio"
                        <?php
                            if ($formParams['private'] == 1)
                                { 
                                    echo 'checked=""';
                                } 
                        ?> 
                        value="1" name="private">Частное лицо</label>
                <label class="form-label-radio">
                    <input type="radio" 
                        <?php 
                            if ($formParams['private'] == 0)
                                {
                                    echo 'checked=""';
                                }  
                         ?>  
                        value="0" name="private">Компания</label> 
            </div>
            <div class="form-row"> <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="form-input-text" value="<?php echo $formParams['seller_name'] ?>" name="seller_name" id="fld_seller_name">
        </div>
   
        <div class="form-row"> <label for="fld_email" class="form-label">Электронная почта</label>
            <input type="text" class="form-input-text" value="<?php echo $formParams['email'] ?>" name="email" id="fld_email">
        </div>

    
        <div class="form-row"> <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> 
            <input type="text" class="form-input-text" value="<?php echo $formParams['phone'] ?>" name="phone" id="fld_phone">
        </div>
    
     
        <div id="f_location_id" class="form-row form-row-required"> <label for="region" class="form-label">Город</label> 
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select">
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>
                    <?php
                        foreach ($cities as $number => $city)
                            {
                                echo '<option data-coords= ",," value="' . $number . '"';
                                    if ($city == $formParams['location_id'])
                                        {
                                            echo 'selected';
                                        }
                                    echo '>' . $city . '</option>';
                            }
                    ?>
           
            </select>
   
            <div id="f_checkbox"> 
                <p> Получать рассылку? </p>
                <p><input type = "checkbox" name="checkbox" value="Yes"<?php if ($formParams['checkbox'] == 'Yes'){ echo 'checked';}?>> Да</p>
                <p><input type = "checkbox" name="checkbox" value="No"<?php if ($formParams['checkbox'] == 'No'){ echo 'checked';}?>> Нет</p>
            </div> 
        </div>

        <div class="form-row"> <label for="fld_category_id" class="form-label">Категория</label> 
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                <option value="">-- Выберите категорию --</option>
                    <?php
                        foreach ($categories as $section => $category)
                            {
                                echo '<optgroup label = "'. $section .'">';
                    
                                    foreach ($category as $number => $value)
                                        {
                                            echo '<option value="' . $number . '"';
                                                if ($number == $formParams['category_id'])
                                                    {
                                                        echo 'selected';
                                                    }
                                                echo '>' . $value . '</option>';
                                        }
                                    echo                   
                                        '</optgroup>';
                            }
                    ?>
            </select> 
        </div>

        <div id="f_title" class="form-row f_title"> 
            <label for="fld_title" class="form-label">Название объявления</label> 
            <input type="text" maxlength="50" class="form-input-text-long" value="<?php echo $formParams['title']?>" name="title" id="fld_title"> 
        </div>

        <div class="form-row"> 
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
            <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"><?php echo $formParams['description'] ?></textarea> 
        </div>

        <div id="price_rw" class="form-row rl"> 
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label> 
            <input type="text" maxlength="9" class="form-input-text-short" value="<?php echo $formParams['price'] ?>" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.
        </div>

        <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
            <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="<?php echo $formParams['button'] ?>" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
        </div>
        <input type="hidden" name="hidden" value="<?php echo $id ?>">
    </form>

    <?php if ($id <> '')
        {
            echo '<a href="dz7_1.php">Назад</a>';
        }
        
    if (!empty($_COOKIE['ad']) && $formParams['head'] == 'Страница добавления объявления')  // вывод всех объявлений, содержащихся в куки 
        {    
            $ads = $the_unserialized_array;
            display($ads);
        }
       
    if(isset($the_unserialized_array))
        {
            unset($the_unserialized_array);
        }    