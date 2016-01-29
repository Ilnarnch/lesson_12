<?php

    $str=file_get_contents('config.txt'); 
    
    $config = parse_ini_string($str, true); // возвращаем файл config.txt в виде массива
    
    $hostName=$config['hostName'];
    $userName=$config['userName'];
    $dbPassword=$config['dbPassword'];
    $dbName=$config['dbName'];
    $dbc=db_connect($hostName, $userName, $dbPassword, $dbName);
    
    $dbc->setLogger('myLogger'); //Логирование запросов
    $dbc->setErrorHandler('databaseErrorHandler');  // Устанавливаем обработчик ошибок.

    
