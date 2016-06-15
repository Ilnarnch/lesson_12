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
    $db->query('SET NAMES UTF8');