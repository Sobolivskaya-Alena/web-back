<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link href="style4.css" rel="stylesheet" type="text/css" />
    <title>Задание №4</title>
  </head>
  <body class="m-4">
      
    <form action="" method="post">
      <div>
        <div class="header">
          <h2><b>Форма обратной связи</b></h2>
        </div>
        <div class="message"><?php if(isset($messages['success'])) echo $messages['success']; ?></div>
        <div>
          <label>
            <input class="input <?php echo (isp($errors['name']) != NULL) ? 'borred' : ''; ?>" value="<?php echo isp($values['name']); ?>" type="text" name="name" placeholder="Ф.И.О">
            <div class="errpodinp"><?php echo $messages['name']?></div>
          </label>
        </div>

        <div>
          <label>
            <input class="input <?php echo (isp($errors['number']) != NULL) ? 'borred' : ''; ?>" value="<?php echo isp($values['number']); ?>" type="tel" name="number" placeholder="Номер телефона">
            <div class="errpodinp"><?php echo $messages['number']?></div>
          </label>
        </div>

        <div>
          <label>
            <input class="input <?php echo (isp($errors['email']) != NULL) ? 'borred' : ''; ?>" value="<?php echo isp($values['email']); ?>" type="email" name="email" placeholder="Введите почту">
            <div class="errpodinp"><?php echo $messages['email']?></div>

          </label>
        </div>

        <div>
          <label>
            <input class="input <?php echo (isp($errors['data']) != NULL) ? 'borred' : ''; ?>" value="<?php echo isp($values['data']); ?>" type="date" name="data">
            <div class="errpodinp"><?php echo $messages['data']?></div>
          </label>
        </div>

        <div>
          Пол
          <br />
          <div class="my-2">
            <label>
              <input
                class="ml-3 <?php echo (isp($errors['radio']) != NULL) ? 'colred' : ''; ?>"
                type="radio"
                name="radio"
                value="m"
              />М
            </label>
            <label>
              <input
                class="ml-3 <?php echo (isp($errors['radio']) != NULL) ? 'colred' : ''; ?>"
                type="radio"
                name="radio"
                value="f"
              />Ж
            </label>
          </div>
        </div>

        <div>
          <label class="input">
            Любимый язык программирования<br />
            <select  id="lang" class="my-2 <?php echo (isp($errors['like_lang']) != NULL) ? 'borred' : ''; ?>"  name="lang[]" multiple="multiple">
              <option value="Pascal" <?php echo (in_array('Pascal', $like_langsa)) ? 'selected' : ''; ?>>Pascal</option>
              <option value="C" <?php echo (in_array('C', $like_langsa)) ? 'selected' : ''; ?>>C</option>
              <option value="C++" <?php echo (in_array('C++', $like_langsa)) ? 'selected' : ''; ?>>C++</option>
              <option value="JavaScript" <?php echo (in_array('JavaScript', $like_langsa)) ? 'selected' : ''; ?>>JavaScript</option>
              <option value="PHP" <?php echo (in_array('PHP', $like_langsa)) ? 'selected' : ''; ?>>PHP</option>
              <option value="Python" <?php echo (in_array('Python', $like_langsa)) ? 'selected' : ''; ?>>Python</option>
              <option value="Java" <?php echo (in_array('Java', $like_langsa)) ? 'selected' : ''; ?>>Java</option>
              <option value="Haskel" <?php echo (in_array('Haskel', $like_langsa)) ? 'selected' : ''; ?>>Haskel</option>
              <option value="Clojure" <?php echo (in_array('Clojure', $like_langsa)) ? 'selected' : ''; ?>>Clojure</option>
              <option value="Scala" <?php echo (in_array('Scala', $like_langsa)) ? 'selected' : ''; ?>>Scala</option>
            </select>
            <div class="errpodinp"><?php echo $messages['like_lang']?></div>
          </label>
        </div>

        <div class="my-3">
          Биография <br />
          <label>
            <textarea name="biography" placeholder="Биография" class="input <?php echo (isp($errors['biography']) != NULL) ? 'borred' : ''; ?>"><?php echo isp($values['biography']); ?></textarea>
            <div class="errpodinp"><?php echo $messages['biography']?></div>
          </label>
        </div>

      
        <div>
            <input type="checkbox" name="check_mark" id="oznakomlen" <?php echo ( isp($values['check_mark']) != NULL) ? 'checked' : ''; ?>>
            <label for="oznakomlen" class="<?php echo (isp($errors['check_mark']) != NULL) ? 'colred' : ''; ?>">С контрактом ознакомлен (а)</label>
            <div class="errpodinp"><?php echo $messages['check_mark']?></div>
        </div>

        <button type="submit" class="form_button my-3">Отправить</button>
      </div>
    </form>
</body>
</html>
