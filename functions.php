<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
    function db_connect($hostName, $userName, $dbPassword, $dbName)
        {
            $dbc=mysql_connect($hostName, $userName, $dbPassword) or die('Не удалось подключиться к БД') . mysql_error();
            mysql_select_db($dbName) or die('Не удалось выбрать БД') . mysql_error();
            mysql_query('set names utf8') or die('Не удалось установить кодировку utf8'). mysql_error();
        }    
    
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
            
    function categories()
        {
            $query = "SELECT cat.category_number, cat.category_name, sec.section FROM category AS cat INNER JOIN sections AS sec  ON (cat.section_id=sec.section_id)";

            $result = mysqlQuery($query);

            while($row = mysql_fetch_assoc($result))
                {
                    $section = $row['section'];
                    $categories[$section][$row['category_number']]=$row['category_name'];
                }
            return $categories;
        }
        
    function cities()
        {
            $query = "SELECT * FROM cities";
    
            $result=mysqlQuery($query);

            while($row = mysql_fetch_assoc($result))
                {
                    $number = $row['number'];
                    $city = $row['city'];
                    $cities[$number] = $city;
                }
            return $cities;    
        }
    
    function adStore()
        {
            $adStore=array();
            $query = "SELECT * FROM adStore";
            $result=mysqlQuery($query);

            while($row=mysql_fetch_assoc($result))
                {
                    $adStore[$row['id']]=$row;
                }
            return $adStore;  
        }    
            
     function save ($data,$id)     //функция запросов к БД
            {   $out='';
                if(!is_numeric($id))
                    {
                        $query="INSERT INTO `adStore` (`private`, `seller_name`, `email`, `phone`, `location_id`, `checkbox`, `category_id`, 
                            `title`, `description`, `price`, `main_form_submit`, `hidden`)
                                VALUES ('".$data['private']."'," . "'".$data['seller_name']."',". "'". $data['email']."'," . "'".$data['phone']."'," . "'".$data['location_id']."'," . "'".$checkbox=$data['checkbox']."'," 
                                    . "'".$data['category_id']."',". "'". $data['title']."'," . "'".$data['description']."',". "'".$data['price']."'," . "'".$data['main_form_submit']."',". "'".$data['hidden']. "');";
                    }
                else 
                    {
                        $query="UPDATE `adStore` SET
                                        `private` = '".$data[$id]['private']."',
                                        `seller_name` = '".$data[$id]['seller_name']."',
                                        `email` = '".$data[$id]['email']."',
                                        `phone` = '".$data[$id]['phone']."',
                                        `location_id` = '".$data[$id]['location_id']."',
                                        `checkbox` = '".$data[$id]['checkbox']."',
                                        `category_id` = '".$data[$id]['category_id']."',
                                        `title` = '".$data[$id]['title']."',
                                       `description` = '".$data[$id]['description']."',
                                        `price` = '".$data[$id]['price']."',
                                        `main_form_submit` = '".$main_form_submit=isset($data[$id]['main_form_submit'])?$data[$id]['main_form_submit']:''."',
                                        `hidden` = '".$hidden=isset($data[$id]['hidden'])?$data[$id]['hidden']:''."'
                                         WHERE `id` = '".$id."';";
                    }    
                $result=mysqlQuery($query);
            }            

    function del ($id_for_del)
        {
            $query="DELETE FROM `adStore`
                WHERE ((`id` = '".$id_for_del."'));";
            $result=mysqlQuery($query);
        }
    
    function mysqlQuery ($q)
        {
             $resault=mysql_query($q) or die ('Запрос не удался: ') . mysql_error();
             return $resault;
        }    