<?php

require('database.php');

$haveAdmin = 0;
  if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
    $qu = $db->prepare("SELECT id FROM users WHERE role = 'admin' and login = ? and password = ?");
    $qu->execute([$_SERVER['PHP_AUTH_USER'], md5($_SERVER['PHP_AUTH_PW'])]);
    $haveAdmin = $qu->rowCount();
  }

  if (!$haveAdmin) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    
    exit();
  }
  print('Авторизация прошла успешно');

  ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link href="style6.css" rel="stylesheet" type="text/css" />
    <title>Задание 6 (админка)</title>
</head>
<body class="admin">

  <header>
    <div><a href="#inform">Информация</a></div>
    <div><a href="#analit">Статистика</a></div>
</header>

  <table id="inform">
    <thead>
      <tr>
        <th>id</th>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Почта</th>
        <th>День рождения</th>
        <th>Пол</th>
        <th>Биография</th>
        <th>Язык</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
        $dbFD = $db->query("SELECT * FROM form_data ORDER BY id DESC");
        while($row = $dbFD->fetch(PDO::FETCH_ASSOC)){
          echo '<tr data-id='.$row['id'].'>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['number'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.date("d.m.Y", $row['data']).'</td>
                  <td>'.(($row['radio'] == "m") ? "Мужской" : "Женский").'</td>
                  <td class="wb">'.$row['biography'].'</td>
                  <td>';
          $dbl = $db->prepare("SELECT * FROM form_data_lang fdl
                                JOIN languages l ON l.id = fdl.id_lang
                                WHERE id_form = ?");
          $dbl->execute([$row['id']]);
          while($row1 = $dbl->fetch(PDO::FETCH_ASSOC)){
            echo $row1['name'].'<br>';
          }
          echo '</td>
                <td><a href="./index.php?uid='.$row['user_id'].'" target="_blank">Изменить</a></td>
                <td><button class="remove">Удалить</button></td>
                <td colspan="10" class="form_del hid">Данные удалена</td>
              </tr>';
        }
      ?>


    </tbody>
  </table>

  <table class="analize" id="analize">
    <thead>
      <tr>
        <th>ЯП</th>
        <th>Кол-во пользователей</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $qu = $db->query("SELECT l.id, l.name, COUNT(id_form) as count FROM languages l 
                            LEFT JOIN form_data_lang fd ON fd.id_lang = l.id
                            GROUP by l.id");
        while($row = $qu->fetch(PDO::FETCH_ASSOC)){
          echo '<tr>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['count'].'</td>
                </tr>';
        }
      ?>
    </tbody>
  </table>

  <script src="./core.js"></script>
</body>
</html>
