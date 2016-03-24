<?php
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
    $project_root = __DIR__;

    require_once $project_root . "/dbsimple/config.php";
    require_once "DbSimple/Generic.php";


    // Подключаемся к БД.
    $db = DbSimple_Generic::connect('mysqli://test:123@localhost/test');

    // Устанавливаем обработчик ошибок.
    $db->setErrorHandler('databaseErrorHandler');
    // Код обработчика ошибок SQL.
    function databaseErrorHandler($message, $info){
        // Если использовалась @, ничего не делать.
        if (!error_reporting()) return;
        // Выводим подробную информацию об ошибке.
        echo "SQL Error: $message<br><pre>"; 
        print_r($info);
        echo "</pre>";
        exit();
    }
    
        
    require_once ($project_root.'/FirePHPCore/FirePHP.class.php');
    // инициализируем класс FirePHP
    $firePHP = FirePHP::getInstance(TRUE);
    // устанавливаем активность
    $firePHP ->setEnabled(true);
    
    $db->setLogger('myLogger');
    
    function myLogger($db, $sql, $caller){
        global $firePHP;
        if (isset($caller['file'])){
            $firePHP->group('at '.@$caller['file'].' line '.@$caller['line']);
        }
        $firePHP->log($sql);
        if (isset($caller['file'])){
        $firePHP->groupEnd();
        }
    }