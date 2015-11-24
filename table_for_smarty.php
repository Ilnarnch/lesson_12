<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);  
    
    ksort($adStore);
                echo '<table>';
                    foreach ($adStore as $id => $idData)
                        {
                            echo '<tr>
                                <td> <a href = "'.$_SERVER['PHP_SELF'].'?id='. $id. '">'. $idData['title'] . '</a>' .' | '. '</td>'. //	При нажатии на «название объявления» на экран выводится шаблон объявления 
                                '<td>' . $idData['price'] .' руб.'. ' | '. '</td>' .
                                '<td>' . $idData['seller_name'] . ' | '. '</td>'.
                                '<td><a href = "'.$_SERVER['PHP_SELF'].'?del='.$id . '">удалить</a>' . "<br>". '</td>'. // При нажатии на «Удалить», объявление удаляется из куки
                             '</tr>'; 
                        }
                echo '</table>';

