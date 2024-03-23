<form action="" method="post">
      <div>
        <div class="header">
          <h2><b>Форма обратной связи</b></h2>
        </div>

        <div>
          <label>
            <input name="name" class="input" placeholder="Ф. И .О" />
          </label>
        </div>

        <div>
          <label>
            <input
              type="tel"
              name="number"
              class="input"
              list="tel-list"
              placeholder="Номер телефона"
              pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"
            />
          </label>
        </div>

        <div>
          <label>
            <input
              name="email"
              type="email"
              class="input"
              placeholder="Введите почту"
            />
          </label>
        </div>

        <div>
          <label>
            <input
              name="data"
              class="input"
              type="data"
              placeholder="Дата рождения"
            />
          </label>
        </div>

        <div>
          Пол
          <br />
          <div class="my-2">
            <label>
              <input
                class="ml-3"
                type="radio"
                name="radio-group-1"
                value="Значение1"
              />М
            </label>
            <label>
              <input
                class="ml-3"
                type="radio"
                checked="checked"
                name="radio-group-1"
                value="Значение2"
              />Ж
            </label>
          </div>
        </div>

        <div>
          <label class="input">
            Любимый язык программирования<br />
            <select class="my-2" name="language1" multiple="multiple">
              <option value="Значение1">Pascal</option>
              <option value="Значение2">C</option>
              <option value="Значение3">C++</option>
              <option value="Значение4">JavaScript</option>
              <option value="Значение5">PHP</option>
              <option value="Значение6" selected="selected">Python</option>
              <option value="Значение7">Java</option>
              <option value="Значение8">Haskel</option>
              <option value="Значение9">Clojure</option>
              <option value="Значение10">Scala</option>
            </select>
          </label>
        </div>

        <div class="my-3">
          Биография <br />
          <label>
            <textarea class="input" name="biography" placeholder="Биография">
            </textarea>
          </label>
        </div>

        <div>
          <label>
            <input type="checkbox" checked="checked" name="check_mark" />
            с контрактом ознакомлен(а)
          </label>
        </div>

        <button type="submit" class="form_button my-3">Отправить</button>
      </div>
    </form>