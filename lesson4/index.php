<?php
header('Content-Type: text/html; charset=UTF-8');


function del_cook($cook, $del_val = 0){
  setcookie($cook.'_error', '', time() - 30 * 24 * 60 * 60);
  // if($del_val) setcookie($cook.'_value', '', time() - 30 * 24 * 60 * 60);
}

$db;

function conn(){
  global $db;
  include('database.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $fio = (!empty($_COOKIE['name_error']) ? $_COOKIE['name_error'] : '');
  $phone = (!empty($_COOKIE['number_error']) ? $_COOKIE['number_error'] : '');
  $email = (!empty($_COOKIE['email_error']) ? $_COOKIE['email_error'] : '');
  $birthday = (!empty($_COOKIE['data_error']) ? strtotime($_COOKIE['data_error']) : '');
  $gender = (!empty($_COOKIE['radio_error']) ? $_COOKIE['radio_error'] : '');
  $like_lang = (!empty($_COOKIE['like_lang_error']) ? $_COOKIE['like_lang_error'] : '');
  $biography = (!empty($_COOKIE['biography_error']) ? $_COOKIE['biography_error'] : '');
  $oznakomlen = (!empty($_COOKIE['check_mark_error']) ? $_COOKIE['_error'] : '');

  $errors = array();
  $messages = array();
  $values = array();
  
  function val_empty($enName, $val){
    global $errors, $values, $messages;

    $errors[$enName] = !empty($_COOKIE[$enName.'_error']);
    $messages[$enName] = "<div class='messageError'>$val</div>";
    $values[$enName] = empty($_COOKIE[$enName.'_value']) ? '' : $_COOKIE[$enName.'_value'];
    del_cook($enName);
    return;
  }
  
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages['success'] = '<div class="message">Спасибо, данные сохранены.</div>';
  }

  val_empty($name, "имя");
  val_empty($number, "телефон");
  val_empty($email, "email");
  val_empty($data, "дата");
  val_empty($radio, "пол", 1);
  val_empty($lang, "языки", 1);
  val_empty($biography, "биография");
  val_empty($check_mark, "ознакомлен", 2);

  $like_langsa = explode(',', $values['like_lang']);

  include('form.php');
}
else{ //POST
  $fio = (!empty($_POST['name']) ? $_POST['name'] : '');
  $phone = (!empty($_POST['number']) ? $_POST['number'] : '');
  $email = (!empty($_POST['email']) ? $_POST['email'] : '');
  $birthday = (!empty($_POST['data']) ? strtotime($_POST['data']) : '');
  $gender = (!empty($_POST['radio']) ? $_POST['radio'] : '');
  $like_lang = (!empty($_POST['like_lang']) ? $_POST['like_lang'] : '');
  $biography = (!empty($_POST['biography']) ? $_POST['biography'] : '');
  $oznakomlen = (!empty($_POST['check_mark']) ? $_POST['check_mark'] : '');
  $error = false;

  $number1 = preg_replace('/\D/', '', $number);

  function val_empty($cook, $comment, $usl){
    global $error;
    $res = false;
    $setVal = $_POST[$cook];
    if ($usl) {
      setcookie($cook.'_error', $comment, time() + 24 * 60 * 60); //сохраняем на сутки
      $error = true;
      $res = true;
    }
    
    if($cook == 'like_lang'){
      global $like_lang;
      $setVal = ($like_lang != '') ? implode(",", $like_lang) : '';
    }
    
    setcookie($cook.'_value', $setVal, time() + 30 * 24 * 60 * 60); //сохраняем на месяц
    return $res;
  }
  
  if(!val_empty('name', 'Заполните поле', empty($name))){
    if(!val_empty('name', 'Длина поля > 255 символов', strlen($name) > 255)){
      val_empty('name', 'Поле не соответствует требованиям: <i>Фаимлмя Имя (Отчество)</i>, латиницей', !preg_match('/^([а-яё]+-?[а-яё]+)( [а-яё]+-?[а-яё]+){1,2}$/Diu', $name));
    }
  }
  if(!val_empty('number', 'Заполните поле', empty($number))){
    if(!val_empty('number', 'Длина поля некорректна', strlen($number) != 11)){
      val_empty('number', 'Поле должен содержать только цифры"', ($number != $number1));
    }
  }
  if(!val_empty('email', 'Заполните поле', empty($email))){
    if(!val_empty('email', 'Длина поля > 255 символов', strlen($email) > 255)){
      val_empty('email', 'Поле не соответствует требованию example@mail.ru', !preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email));
    }
  }
  if(!val_empty('data', "Выберите дату рождения", empty($data))){
    val_empty('data', "Неверно введена дата рождения, дата больше настоящей", (strtotime("now") < $data));
  }
  val_empty('radio', "Выберите пол", (empty($radio) || !preg_match('/^(male|female)$/', $radio)));
  if(!val_empty('like_lang', "Выберите хотя бы один язык", empty($like_lang))){
    conn();
    try {
      $inQuery = implode(',', array_fill(0, count($like_lang), '?'));
      $dbLangs = $db->prepare("SELECT id, name FROM languages WHERE name IN ($inQuery)");
      foreach ($like_lang as $key => $value) {
        $dbLangs->bindValue(($key+1), $value);
      }
      $dbLangs->execute();
      $languages = $dbLangs->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
    
    val_empty('like_lang', 'Неверно выбраны языки', $dbLangs->rowCount() != count($like_lang));
  }
  if(!val_empty('biography', 'Заполните поле', empty($biography))){
    val_empty('biography', 'Длина текста > 65 535 символов', strlen($biography) > 65535);
  }
  val_empty('check_mark', "Ознакомьтесь с контрактом", empty($check_mark));
  
  if ($error) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    del_cook('name');
    del_cook('number');
    del_cook('email');
    del_cook('data');
    del_cook('radio');
    del_cook('like_lang');
    del_cook('biography');
    del_cook('check_mark');
  }
  
  try {
    $stmt = $db->prepare("INSERT INTO form_data (name, number, email, data, radio, biography) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $number, $email, $data, $radio, $biography]);
    $fid = $db->lastInsertId();
    $stmt1 = $db->prepare("INSERT INTO form_data_lang (id_form, id_lang) VALUES (?, ?)");
    foreach($languages as $row){
        $stmt1->execute([$fid, $row['id']]);
    }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
  setcookie('name_value', $name, time() + 24 * 60 * 60 * 365);
  setcookie('number_value', $number, time() + 24 * 60 * 60 * 365);
  setcookie('email_value', $email, time() + 24 * 60 * 60 * 365);
  setcookie('data_value', $data, time() + 24 * 60 * 60 * 365);
  setcookie('radio_value', $radio, time() + 24 * 60 * 60 * 365);
  setcookie('like_value', $like, time() + 24 * 60 * 60 * 365);
  setcookie('biography_value', $biography, time() + 24 * 60 * 60 * 365);
  setcookie('check_mark_value', $check_mark, time() + 24 * 60 * 60 * 365);

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
?>
