<?php
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
    require_once "settings.php";
    require_once "connect_mysql.php";
    require_once "function.php";
    require_once "classes.php";
    
    if(isset($_POST['back'])){
        header("Location: $_SERVER[SCRIPT_NAME]");
    }
    elseif(!empty($_POST['id_c'])){
        $ad_r = new Ads($_POST);
        $ad_r->editAd();
        header('Location: index.php');
    }
    elseif(isset($_POST['name']) && isset($_POST['desc'])){    //сохранение объявления
        $ad = new Ads($_POST);
        $ad->save();
        header('Location: index.php');
    }
    
    if(isset($_GET['id'])){  // удаление объявления
        $ad_d = new Ads($_GET);
        $ad_d->delete();
        header('Location: index.php');
    }
    
    if(isset($_GET['id_c'])){   // подготовка к выводу объявления для редактирования 
     $id_c = $_GET['id_c'];
    $ad_c = new Ads($_GET);  // объект создаю, чтобы извлечь объявление для редактирования из БД
    echo '<br>';
    $ad_g = $ad_c->getAd();
    $ad_c = new Ads($ad_g);  // объект - объявление(редактируемое) для вывода в Smarty 
    $smarty->assign('ad_c', $ad_c);
    }
    else{                                // чтобы не было ошибки в шаблоне Smarty при выводе атрибута "value="
        $ad_c = new Ads($_GET);
        $smarty->assign('ad_c', $ad_c);
    } 
    
    AdsStore::instance()->getAllAdsFromDb()->prepareForOut()->display();

