<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors',1);
header('Content-type: text/html; charset=utf-8');

session_start();

//print_r($_SESSION);

  if (!empty($_GET['id'])) 
      {
        unset($_SESSION['ad'][$_GET['id']]); 
      }

$cities = array('641780'=>'Новосибирск','641490'=>'Барабинск','641510'=>'Бердск', // массив для вывода в цикле foreach 
    '641600'=>'Искитим', '641630'=>'Колывань', '641680'=>'Краснообск',  
    '641710'=>'Куйбышев','641760'=>'Мошково', '641790'=>'Обь', 
    '641800'=>'Ордынское', '641970'=>'Черепаново', '0'=>'Выбрать другой...',  ); 

$metro = array('2028'=>'Берёзовая роща', '2018'=>'Гагаринская', '2017'=>'Заельцовская', '2029'=>'Золотая Нива', '2019'=>'Красный проспект', '2027'=>'Маршала Покрышкина', 
    '2021'=>'Октябрьская', '2025' => 'Площадь Гарина-Михайловского', '2020'=>'Площадь Ленина', '2024'=>'Площадь Маркса', '2022'=>'Речной вокзал', '2026'=>'Сибирская', '2023'=>'Студенческая' );
        
?>
<form  method="post" action = "<?php $_SERVER['PHP_SELF'] ?>" name = "form_1 " >
    
    
    <div class="form-row-indented"> <label class="form-label-radio"><input type="radio" checked="" value="1" name="private">Частное лицо</label> <label class="form-label-radio"><input type="radio" value="0" name="private">Компания</label> </div>
    <div class="form-row"> <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
        <input type="text" maxlength="40" class="form-input-text" value="" name="seller_name" id="fld_seller_name">
    </div>
    
    <div class="form-row"> <label for="fld_email" class="form-label">Электронная почта</label>
        <input type="text" class="form-input-text" value="" name="email" id="fld_email">
    </div>
    
    
    <div class="form-row"> <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> <input type="text" class="form-input-text" value="" name="phone" id="fld_phone">
    </div>
    
    <div id="f_location_id" class="form-row form-row-required"> <label for="region" class="form-label">Город</label> 
        <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select">
            <option value="">-- Выберите город --</option>
            <option class="opt-group" disabled="disabled">-- Города --</option>
               <?php
                    foreach($cities as $number => $city)
                    {
                        echo '<option data-coords= ",," value="'. $number . '">'. $city . '</option>';
                    }
                ?>
        </select> 
     
        <div id="f_metro_id"> 
            <select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select"> 
                <option value="">-- Выберите станцию метро --</option>
                
                <?php
                    foreach($metro as $number => $station) 
                        {
                            echo '<option value"' . $number. '" >' . $station . '</option>';
                        }
                ?>
                
            </select> 
        </div> 
 </div>
            
    <div class="form-row"> <label for="fld_category_id" class="form-label">Категория</label> 
        <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
            <option value="">-- Выберите категорию --</option>
            <optgroup label="Транспорт">
                <option value="9">Автомобили с пробегом</option>
                <option value="109">Новые автомобили</option>
                <option value="14">Мотоциклы и мототехника</option>
                <option value="81">Грузовики и спецтехника</option>
                <option value="11">Водный транспорт</option>
                <option value="10">Запчасти и аксессуары</option>
            </optgroup>
            <optgroup label="Недвижимость">
                <option value="24">Квартиры</option>
                <option value="23">Комнаты</option>
                <option value="25">Дома, дачи, коттеджи</option>
                <option value="26">Земельные участки</option>
                <option value="85">Гаражи и машиноместа</option>
                <option value="42">Коммерческая недвижимость</option>
                <option value="86">Недвижимость за рубежом</option>
            </optgroup>
            <optgroup label="Работа">
                <option value="111">Вакансии (поиск сотрудников)</option>
                <option value="112">Резюме (поиск работы)</option>
            </optgroup>
            <optgroup label="Услуги">
                <option value="114">Предложения услуг</option>
                <option value="115">Запросы на услуги</option>
            </optgroup>
            <optgroup label="Личные вещи">
                <option value="27">Одежда, обувь, аксессуары</option>
                <option value="29">Детская одежда и обувь</option>
                <option value="30">Товары для детей и игрушки</option>
                <option value="28">Часы и украшения</option>
                <option value="88">Красота и здоровье</option>
            </optgroup>
            <optgroup label="Для дома и дачи">
                <option value="21">Бытовая техника</option>
                <option value="20">Мебель и интерьер</option>
                <option value="87">Посуда и товары для кухни</option>
                <option value="82">Продукты питания</option>
                <option value="19">Ремонт и строительство</option>
                <option value="106">Растения</option>
            </optgroup>
            <optgroup label="Бытовая электроника">
                <option value="32">Аудио и видео</option>
                <option value="97">Игры, приставки и программы</option>
                <option value="31">Настольные компьютеры</option>
                <option value="98">Ноутбуки</option>
                <option value="99">Оргтехника и расходники</option>
                <option value="96">Планшеты и электронные книги</option>
                <option value="84">Телефоны</option>
                <option value="101">Товары для компьютера</option>
                <option value="105">Фототехника</option>
            </optgroup>
            <optgroup label="Хобби и отдых">
                <option value="33">Билеты и путешествия</option>
                <option value="34">Велосипеды</option>
                <option value="83">Книги и журналы</option>
                <option value="36">Коллекционирование</option>
                <option value="38">Музыкальные инструменты</option>
                <option value="102">Охота и рыбалка</option>
                <option value="39">Спорт и отдых</option>
                <option value="103">Знакомства</option>
            </optgroup>
            <optgroup label="Животные">
                <option value="89">Собаки</option>
                <option value="90">Кошки</option>
                <option value="91">Птицы</option>
                <option value="92">Аквариум</option>
                <option value="93">Другие животные</option>
                <option value="94">Товары для животных</option>
            </optgroup>
            <optgroup label="Для бизнеса">
                <option value="116">Готовый бизнес</option>
                <option value="40">Оборудование для бизнеса</option>
            </optgroup>
        </select> 
    </div>
   
    <div id="f_title" class="form-row f_title"> <label for="fld_title" class="form-label">Название объявления</label> <input type="text" maxlength="50" class="form-input-text-long" value="" name="title" id="fld_title"> </div>
    
    <div class="form-row"> <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"></textarea> </div>
    
    <div id="price_rw" class="form-row rl"> <label id="price_lbl" for="fld_price" class="form-label">Цена</label> <input type="text" maxlength="9" class="form-input-text-short" value="0" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</div>

    <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
        <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="Далее" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
    </div>
</form>

<?php

if (!empty($_POST)) //	Всё что пришло из формы записать в $_SESSION 
    { 
        $_SESSION['ad'][uniqid(rand())] = array // вывод всех объявлений, содержащихся в сессии 
            (
                'private' => $_POST['private'], 'seller_name' => $_POST['seller_name'], 'email' => $_POST['email'],
                'phone'=> $_POST['phone'], 'location_id'=> $_POST['location_id'], 
                'metro_id' => $_POST['metro_id'], 'category_id'=> $_POST['category_id'], 
                'title'=> $_POST['title'], 'description'=> $_POST['description'], 'price'=> $_POST['price']
            );
    }
    
//    print_r($_POST);
    
//    echo "<br>";
    
//    print_r($_SESSION);
    

    
    echo "<br>";

if (!empty($_SESSION)) 
    {    
        foreach($_SESSION as $ad)
            {
                foreach ($ad as $date => $contents)
                    {
                    if (isset($date)){
                        foreach ($contents as $key => $value) // вывод всех объявлений, содержащихся в сессии 
                            {
                                if ($key == 'title') {echo '<a href = "http://xaver.loc/ad.php/?id='. $date. '">'. $value . '</a>' .' | ';} //	При нажатии на «название объявления» на экран выводится шаблон объявления 
                            }
                        foreach ($contents as $key => $value) 
                            {
                                if ($key == 'price') {echo $value .' руб.'. ' | ';}
                            }
                        foreach ($contents as $key => $value) 
                            {
                                if ($key == 'seller_name') {echo $value . ' | ';}
                            }
                        echo "<a href = " . "http://xaver.loc/" . $_SERVER['PHP_SELF']. "/?id=$date>удалить</a>" . "<br>"; // При нажатии на «Удалить», объявление удаляется из сессии
                    }
                    }
        }              
    }
    
//    print_r($_GET);
     
    echo "<br>";
    
//       print_r($_SESSION);
    
//unset($_SESSION['ad']);                    