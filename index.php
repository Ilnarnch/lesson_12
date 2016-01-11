<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
//    $project_root = $_SERVER['DOCUMENT_ROOT'];
    $smarty_dir = /*$_SERVER['DOCUMENT_ROOT'].*/'./smarty/';

    // put full path to Smarty.class.php
    require($smarty_dir.'/libs/Smarty.class.php');
    $smarty = new Smarty();

    $smarty->template_dir = $smarty_dir . 'templates';
    $smarty->compile_dir = $smarty_dir . 'templates_c';
    $smarty->cache_dir = $smarty_dir . 'cache';
    $smarty->config_dir = $smarty_dir . 'configs';
        
    
    $str=file_get_contents('config.txt');
    
    $config = parse_ini_string($str, true); // возвращаем файл config.txt в виде массива
    
        $hostName=$config['hostName'];
        $userName=$config['userName'];
        $dbPassword=$config['dbPassword'];
        $dbName=$config['dbName']; 
        
    require_once('functions.php');
    db_connect($hostName, $userName, $dbPassword, $dbName);
    $categories=categories();
    $cities=cities();                                        
    $formParams = prepareAD($data=null, $head = 'Страница добавления объявления', $button = 'Далее');                  
    $adStore=adStore();
   
    
    $id = (isset($_GET['id']))?$_GET['id']:'';
          
    if (isset($_GET['id']))
        {
            $ad = $adStore[$id];
            $formParams = prepareAD($ad, $head = 'Страница редактирования', $button = 'Готово');
        }
    else 
        {   
            if (isset($_GET['del']))  //удаление объявления
                {             
                    $id_for_del = $_GET['del'];
                    del($id_for_del);
                    header('Location: index.php');
                }
                
            if (isset($_POST['main_form_submit'])) //	всё, что пришло из формы записать в БД 
                {                     
                        
                            $uns = isset($adStore)?$adStore:array();
                            $id = isset($_POST['hidden'])?$_POST['hidden']:'';
                              if (!is_numeric($id))                        //добавление нового объявления
                                  {
                                    $adStore = prepareAD($_POST);
                                    save($adStore, $id);                                    
                                    header('Location: index.php');
                                    
                                   
                                  }
                               else
                                   {                                                                             
                                        $adStore[$id] = prepareAD($_POST); // добавление отредактированного объявления                                       
                                        save($adStore,$id);
                                        $id = '';                                        
                                    }
                        
                    unset($_POST);
                }
           }
           mysql_close();          
           
    $for_radios = array( 
        1 => 'Частное лицо',
        0 => 'Компания'
    );

    if ($formParams['private'] == 1)
        { 
            $for_radios_checked = 1;
        } 
    elseif($formParams['private'] == 0) 
        {
            $for_radios_checked = 0;
        }

    $id=(isset($id))?$id:'';                 // условие, чтобы не было ошибки после редактирования объявления
    
    $smartyParams = array(                   
        'formParams' =>$formParams,
        'adStore' => $adStore,
        'id' => $id,
        'cities' => $cities,
        'categories' => $categories,
        'for_radios' => $for_radios,
        'for_radios_checked' => $for_radios_checked
        
    );
    
    $smarty->assign('smartyParams', $smartyParams);
     
    $smarty->display('mysql_index_for_smarty.tpl');