<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link href="style3.css" rel="stylesheet" type="text/css" />
    <title>Задание №3</title>
  </head>
  <body class="m-4">



<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.






$name = $_POST['name'];
$number=$_POST['number'];
$email=$_POST['email'];
$data=$_POST['data'];
$radio=$_POST['radio'];
$languages=$_POST['languages'];
$biography=$_POST['biography'];
$check_mark=$_POST['check_mark'];

if(empty ($name)){
  print("пустое поле имя");
}
if(empty ($number)){
  print("пустое поле номер");
}
if(empty ($email)){
  print("пустое поле email");
}
if(empty ($data)){
  print("пустое поле дата");
}
if(empty ($radio)){
  print("радио кнопка не выбрана");
}
if(empty ($lang)){
  print("пустое поле язык");
}
if(empty ($biography)){
  print("пустое поле биография");
}
if(empty ($check_mark)){
  print("chekbox не выбран");
}



$phone = preg_replace('/\D/', '', $phone);
  
$lang = array_map(function($item) { return "'" . $item . "'"; }, $lang);
$langs = ($lang != '') ? implode(", ", $lang) : [];




if(empty($name)){
  print('пустое поле фио');
}

if(strlen($name) > 255 || count(explode(" ", $name)) < 2){
  $errors = 'Длина поля "ФИО" > 255 символов';
}
elseif(strlen($number) != 11){
  $errors = 'Неверное значение поля "Телефон"';
}
elseif(strlen($email) > 255){
  $errors = 'Длина поля "email" > 255 символов';
}
elseif(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)){
  $errors = 'Неверное значение поля "email"';
}
elseif(!is_numeric(strtotime($data)) || strtotime("now") < strtotime($data)){
  $errors = 'Укажите корректно дату';
}
elseif($check_mark != "male" && $check_mark != "female"){
  $errors = 'Укажите пол';
}
elseif(count($lang) == 0){
  $errors = 'Укажите языки';
}

if ($errors != '') {
  print($errors);
  exit();
}



$db = new PDO('mysql:host=localhost;dbname=u67404', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
print_r($langs);
$dbLangs = $conn->query("SELECT id, name FROM languages WHERE name IN (?)");
$stmt->execute([$langs]);
$languages = $dbLangs->fetchAll(PDO::FETCH_ASSOC);
if($dbLangs->rowCount() != count($lang)){
  $errors = 'Неверно выбраны языки';
}
elseif(strlen($biography) > 65535){
  $errors = 'Длина поля "Биография" > 65 535 символов';
}

if ($errors != '') {
  print($errors);
  exit();
}




//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
