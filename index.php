
<?php
header('Content-type: text/html; charset=utf-8');
$name = "Ильнар";
$age = 28;
echo 'Меня зовут '.$name.'. Мне '.$age.' лет.';

unset($name,$age);


define("CITY","Набережные Челны");?>
<br>
<?php
if (defined("CITY")) {
    echo 'Значение константы: '.CITY.'.';
};
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
$books = array (
    0=> $book1 =  array(
        "title1" => "\"Путь Кайзен\"",
        "author1" => "Робертом Маурером",
        "pages1" => 188
    ),
    1=> $book2 = array(
        "title2" => "\"Поток\"",
        "author2" => "Михай Чиксентмихайи",
        "pages2" => 357
    )
);
echo 'Недавно я прочитал книги '.$book1["title1"].' и '.$book2["title2"]
        .', написанная соответственно авторами '.$book1["author1"].' и '.$book2["author2"].', я осилил в сумме '
        .$sum = $book1["pages1"] + $book2["pages2"].' страниц.'
?>
