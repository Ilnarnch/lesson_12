
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
    "title" => "\"Путь Кайзен\"",
    "author" => "Робертом Маурером",
    "pages" => 188
);
$book2 = array(
    "title" => "\"Поток\"",
    "author" => "Михай Чиксентмихайи",
    "pages" => 357
);
$books = array ($book1, $book2);
echo 'Недавно я прочитал книги '.$books[0]["title"].' и '.$books[1]["title"]
        .', написанная соответственно авторами '.$books[0]["author"].' и '.$books[1]["author"].', я осилил в сумме '
        .($books[0]["pages"] + $books[1]["pages"]).' страниц.'
?>
