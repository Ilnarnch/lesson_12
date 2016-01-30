<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    

    $smarty_dir = './smarty/';

    // put full path to Smarty.class.php
    require($smarty_dir.'/libs/Smarty.class.php');
    $smarty = new Smarty();

    $smarty->template_dir = $smarty_dir . 'templates';
    $smarty->compile_dir = $smarty_dir . 'templates_c';
    $smarty->cache_dir = $smarty_dir . 'cache';
    $smarty->config_dir = $smarty_dir . 'configs';
         
    require_once('functions.php');
           
    $categories=getCategories();
    $cities=getCities();                                        
    $formParams = prepareAD($data=null);                  
    $adStore=adStore();
   
    
    $id = (isset($_GET['id']))?$_GET['id']:'';
          
    if (isset($_GET['id']))
        {
            $ad = $adStore[$id];
            $formParams = prepareAD($ad);
        }
    else 
        {   
            if (isset($_GET['del']))  //удаление объявления
                {             
                    $id_for_del = $_GET['del'];
                    del($id_for_del);
                    header('Location: index.php');
                }
                
            if (isset($_POST['main_form_submit'])) { //	всё, что пришло из формы записать в БД 

                $uns = isset($adStore) ? $adStore : array();
                $id = isset($_POST['hidden']) ? $_POST['hidden'] : '';

                if (!is_numeric($id)) {                        //добавление нового объявления
                    $adStore = prepareAD($_POST);
                    postDb($adStore);
                } else {
                    $ad_update = $adStore[$id] = prepareAD($_POST); // добавление отредактированного объявления
                    updateDb($ad_update, $id);
                }

                header('Location: index.php');
            }
        }         
           
    $for_radios = array( 
        1 => 'Частное лицо',
        0 => 'Компания'
    );
   
    $for_radios_checked=$formParams['private'];

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
    
