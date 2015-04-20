
<?php
header('Content-type: text/html; charset=utf-8');
$name = "Ильнар";
$age = 28;
echo 'Меня зовут '.$name.'. Мне '.$age.' лет.';

unset($name,$age);
?>
<br>

<?php
define("CITY","Набережные Челны");
if (defined("CITY")) {
    echo 'Значение константы: '.CITY.'.';
};
define("CITY","San Francisco"); //Попытка изменения значения созданной константы.
?>

<br>
<?php
$book = array(
    "title" => "\"Путь Кайзен\"",
    "author" => "Робертом Маурером"
);
$book["pages"]=188;
echo 'Недавно я прочитал книгу '.$book["title"]. ' написанную автором '.$book["author"].', я осилил все '.$book["pages"].' страниц, мне она очень понравилась.'
?>
<br>

<?php
$book1 = array(
    "title1" => "\"Путь Кайзен\"",
    "author1" => "Робертом Маурером",
    "pages1" => 188
);
$book2 = array(
    "title2" => "\"Поток\"",
    "author2" => "Михай Чиксентмихайи",
    "pages2" => 357
);
$books = array (
    1=> $book1 ,
    2=> $book2
);
echo 'Недавно я прочитал книги '.$books[1]["title1"].' и '.$books[2]["title2"]
        .', написанная соответственно авторами '.$books[1]["author1"].' и '.$books[2]["author2"].', я осилил в сумме '
        .$sum = $books[1]["pages1"] + $books[2]["pages2"].' страниц.'
?>
