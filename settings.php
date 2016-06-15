<?php

    $project_root=__DIR__;
    $smarty_dir = $project_root.'/smarty/';

        // put full path to Smarty.class.php
    require($smarty_dir.'/libs/Smarty.class.php');
    
    $smarty = new Smarty();
    $smarty->compile_check = true;
    $smarty->debugging = false;
    
    $smarty->template_dir = $smarty_dir. 'templates';
    $smarty->compile_dir = $smarty_dir. 'templates_c';
    $smarty->cache_dir = $smarty_dir. 'cache';
    $smarty->config_dir = $smarty_dir. 'configs';
?>