
<?php
header('Content-type: text/html; charset=utf-8');
$name = "Ильнар";
$age = 28;
echo 'Меня зовут '.$name.'. Мне '.$age.' лет.';

define("city","Набережные Челны");?>
<br>
<?php
if (defined("city")==true) {
    echo 'Значение константы: '.city.'.';
};
//city="San Francisco";
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
$book = array (
    "book1" => array (
        "title1" => "\"Путь Кайзен\"",
        "author1" => "Робертом Маурером",
        "pages1" => 188
    ),
    "book2" => array(
        "title2" => "\"Поток\"",
        "author2" => "Михай Чиксентмихайи",
        "pages2" => 357
    )
);
echo 'Недавно я прочитал книги '.$book["book1"]["title1"].' и '.$book["book2"]["title2"]
        .', написанная соответственно авторами '.$book["book1"]["author1"].' и '.$book["book2"]["author2"].', я осилил в сумме '
        .$sum = $book["book1"]["pages1"] + $book["book2"]["pages2"].' страниц.'
?>

