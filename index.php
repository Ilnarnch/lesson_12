<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    

    
    require_once('oop.php');                        // подключаем функциями
    require_once('settings.php');                   // подключаем настройки smarty
    require_once('connect_mysql.php');              // подключаем соединение с mysql
   
    
    if (isset($_POST['confirm_add'])) {             // если нажата кнопка добавить/сохранить
        if (is_numeric($_POST['id_r'])) {           // если присутствует метка id_r то сохраняем редактируемое объявление
            $sql->editAd($db, new ad($_POST));
        } 
        else {                                      // иначе добавляем новое объявление
            $sql->addAd($db, new ad($_POST)); 
        }   
       $display->restart();
    }
    
    elseif(isset($_GET['clear_form']) || isset($_GET['back'])){ // кнопки очистить форму и назад вызывают restart();
        $display->restart();
    }
    
    elseif(isset($_GET['clear_base'])){             // по кнопке очистить базу, удаляем все строки из таблицы ads
        $sql->clearDB($db);
        $display->restart();
    }
    
    elseif(isset($_GET['del_ad'])) {                 // ловим ключ del_ad в массиве $_GET - нажата ссылка Удалить
        if ($sql->getAd($db, (int) ($_GET['del_ad']))){  // если существует объявление с таким ключом удаляем его
            $sql->delAd($db, (int) ($_GET['del_ad']));
            $display->restart(); 
        }
        else{
            $display->error();                      // иначе выводим ошибку
        }
       
    }
    
    elseif (isset($_GET['click_id'])){             // действие по клику на объявление
            if($sql->getAd($db, (int) $_GET['click_id'])){   // если объявление с запрашиваемым номером существует
                $display->displayForm($db, $smarty, $sql, (int) $_GET['click_id']);         // выводим объявление в форму
            }
            else{                                 // иначе выводим сообщение о его отсутствии
                $display->error();
            }
    }
    
    else{
            $display->displayForm($db, $smarty, $sql);
    }    
?>