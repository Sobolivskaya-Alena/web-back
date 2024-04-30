<form action="" method="post">
      <div>
        <div class="header">
          <h2><b>Форма обратной связи</b></h2>
        </div>

        <div>
          <label>
            <input name="name" type="text" class="input" placeholder="Ф. И .О" />
          </label>
        </div>

        <div>
          <label>
            <input
              type="tel"
              name="number"
              class="input"
              placeholder="Номер телефона"
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
              type="date"
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
                name="radio"
                value="m"
              />М
            </label>
            <label>
              <input
                class="ml-3"
                type="radio"
                name="radio"
                value="f"
              />Ж
            </label>
          </div>
        </div>

        <div >
          <label class="input">
            Любимый язык программирования<br />
            <select  id="lang" class="my-2" name="lang[]" multiple="multiple">
              <option value="Pascal">Pascal</option>
              <option value="C">C</option>
              <option value="C++">C++</option>
              <option value="JavaScript">JavaScript</option>
              <option value="PHP">PHP</option>
              <option value="Python">Python</option>
              <option value="Java">Java</option>
              <option value="Haskel">Haskel</option>
              <option value="Clojure">Clojure</option>
              <option value="Scala">Scala</option>
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
          <label for="oznakomlen">
            <input type="checkbox" name="check_mark" id="oznakomlen"/>
            с контрактом ознакомлен(а)
          </label>
        </div>

        <button type="submit" class="form_button my-3">Отправить</button>
      </div>
    </form>
</body>
</html>