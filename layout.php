<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
    
        require_once ('form.php');

     if ($formParams['head'] == 'Страница редактирования')
        {
            echo '<a href="'.$_SERVER['PHP_SELF'].'">Назад</a>';
        }
       if (!empty($adStore) && $formParams['head'] == 'Страница добавления объявления')  // вывод всех объявлений, содержащихся в куки 
        {    
            require_once('table.php');
        }
 

