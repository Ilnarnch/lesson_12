<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
    require_once "dbsimple/config.php";
    require_once "dbsimple/DbSimple/Generic.php";
    
    require_once 'FirePHPCore/FirePHP.class.php'; //Подключаем библиотеку
    
    $firePHP=FirePHP::getInstance(true); //инициализируем класс FirePHP

    $firePHP->setEnabled(true); //Устанавливаем активность

    function db_connect($hostName, $userName, $dbPassword, $dbName)
        {
            // Подключаемся к БД.
            $dbc = DbSimple_Generic::connect('mysqli://'.$userName.':'.$dbPassword.'@'.$hostName.'/'.$dbName);
            $dbc->query('set names ?', 'utf8');
            return $dbc;
        } 
        
         $dbc=db_connect($hostName, $userName, $dbPassword, $dbName);
         
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
            
    function categories($dbc)
        {
            $result=$dbc->select('SELECT cat.category_number, cat.category_name, sec.section FROM category AS cat INNER JOIN sections AS sec  ON (cat.section_id=sec.section_id)');
            
            foreach($result as $value){
                $section=$value['section'];
                $categories[$section][$value['category_number']]=$value['category_name'];
            }       
            return $categories;
            
        }
        
    function cities($dbc)
        {
            $result=$dbc->select('SELECT * FROM cities');
        
            foreach($result as $value){
                $number=$value['number'];
                $city = $value['city'];
                $cities[$number] = $city;
            }
            
            return $cities;    
        }
    
    function adStore($dbc)
        {
            $adStore=array();
            
            $result=$dbc->select('SELECT * FROM adStore');
            
            foreach($result as $value){
                $adStore[$value['id']]=$value;
            }

            return $adStore;  
        }
        
    function postDb($adStore, $dbc) {
        $dbc->query('INSERT INTO adStore SET ?a', $adStore);
    }

    function updateDb ($ad_update, $id, $dbc) {
        $data_update = [];
        $query_update = '';
        foreach ($ad_update as $key => $value) {
            $data_update[$key] = $value;
        }
        $dbc->query('UPDATE adStore SET ?a WHERE id=?d', $data_update, $id);
    }
                    
    function del ($id_for_del, $dbc)
        {
        $dbc->query('DELETE FROM `adStore` WHERE `id` = ?d;', $id_for_del);
        }
    
    // Код обработчика ошибок SQL.
    function databaseErrorHandler($message, $info) {
        // Если использовалась @, ничего не делать.
        if (!error_reporting())
            return;
        // Выводим подробную информацию об ошибке.
        echo "SQL Error: $message<br><pre>";
        print_r($info);
        echo "</pre>";
        exit();
    }

    
    function myLogger($db, $sql, $caller) {
        global $firePHP;
        if (isset($caller['file'])) {
            $firePHP->group("at " . @$caller['file'] . ' line ' . @$caller['line']);
        }
        $firePHP->log($sql);
        if(isset($caller['file'])){
            $firePHP->groupEnd();
        }
    }
