<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header('Content-type: text/html; charset=utf-8');

//GET

$news = 'Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news = explode("\n", $news);


//print_r($news);

function display_all($news)  // функция вывода всего списка новостей
    {          
        foreach ($news as $value) 
            {
                echo $value . "<br>";
            }
    }

function display_the_one_news($id, $news) // функция вывода конкретной новости
        {     
            if ($id <= (count($news)-1))     //(1/3) Если новость присутствует
                {              
                    foreach ($news as $key => $value) 
                        {
                            if ($id == $key) 
                                {
                                    echo $value . "<br>";    //(2/3) - вывести ее на сайте
                                }   
                        }
                } 
            else 
                {
                    display_all($news);      
                }
        }
        
if (!empty($news))
    {
        if (count($_GET) == 0) 
            {
                display_all($news);
            } 
    
        else
            {
                if (key($_GET) == 'id' && is_numeric($_GET['id']))  
                    {
                        $id = $_GET['id'];        
                        display_the_one_news($id, $news);
                    } 
                else 
                    {
                        header("HTTP/1.0 404 Not Found");
                        echo "Страница не найдена";
                    }
            }
     }
else 
    {
        echo 'Список новостей пуст';
    }