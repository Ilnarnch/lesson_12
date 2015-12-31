<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');

?>    

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        Host: <input type="text" name="hostName" value="<?php if(isset($_POST['hostName'])){echo $_POST['hostName'];} ?>"><br>
        Username: <input type="text" name="userName" value="<?php if(isset($_POST['userName'])){echo $_POST['userName'];} ?>"><br>
        Password: <input type="text" name="dbPassword" value="<?php if(isset($_POST['dbPassword'])){echo $_POST['dbPassword'];} ?>"><br>
        DbName: <input type="text" name="dbName" value="<?php if(isset($_POST['dbName'])){echo $_POST['dbName'];} ?>"><br>
        <input type="submit" value="Ok" name="ok" >
    </form>


<?php    
    
    if(isset($_POST['ok'])){
        $hostName=$_POST['hostName'];
        $userName=$_POST['userName'];
        $dbPassword=$_POST['dbPassword'];
        $dbName=$_POST['dbName'];        
        if(!empty($hostName) && !empty($userName) && !empty($dbPassword) && !empty($dbName))
            {
                $config_file='config.txt';                                        // Сохраняются поля формы в отдельный файл
                
                file_put_contents($config_file, "hostName=$hostName\n");
                file_put_contents($config_file, "userName=$userName\n", FILE_APPEND);
                file_put_contents($config_file, "dbPassword=$dbPassword\n", FILE_APPEND);
                file_put_contents($config_file, "dbName=$dbName", FILE_APPEND);
                
                   
                $mysql_dump_file = file_get_contents('dump_tabels_for_lesson_9.sql'); // Удаляются таблицы с такими именами, 
                                                                //которые хотим создать и заливаются новые таблицы(через 1 файл дампа)
                $dbc=mysql_connect($hostName, $userName, $dbPassword) or die('Не удалось подключиться к БД'). mysql_error();
                
                mysql_select_db($dbName) or die('Не удалось выбрать БД');
                $explode_array=explode(';',$mysql_dump_file); 
                
                foreach($explode_array as $query)
                    {
                        $result=mysql_query($query) or die ('Запрос не удался').mysql_error(); 
                    }
                mysql_close($dbc);
                
                echo '<a href="index.php">index.php</a>'; // Ссылка на index.php

            }
        else 
            {
                echo 'Введите все поля формы!';
            }    
        
    }
