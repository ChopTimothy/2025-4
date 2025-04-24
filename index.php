<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }


  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['tel'] = !empty($_COOKIE['tel_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['dat'] = !empty($_COOKIE['dat_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['contract_accepted'] = !empty($_COOKIE['contract_accepted_error']);
  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['fio']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('fio_error', '', 100000); 
    setcookie('fio_value', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['tel']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('tel_error', '', 100000); 
    setcookie('tel_value', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните телефон.</div>';
  }
  if ($errors['email']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('email_error', '', 100000); 
    setcookie('email_value', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните почту.</div>';
  }
  if ($errors['dat']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('dat_error', '', 100000); 
    setcookie('dat_value', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните дату.</div>';
  }
  if ($errors['bio']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('bio_error', '', 100000); 
    setcookie('bio_value', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">напишите биографию.</div>';
  }
  if ($errors['contract_accepted']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('contract_accepted_error', '', 100000); 
    setcookie('contract_accepted_value', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">ознакомтесь с контрактом.</div>';
  }
  
  // TODO: тут выдать сообщения об ошибках в других полях.

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['tel'] = empty($_COOKIE['tel_value']) ? '' : $_COOKIE['tel_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['dat'] = empty($_COOKIE['dat_value']) ? '' : $_COOKIE['dat_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['contract_accepted'] = empty($_COOKIE['contract_accepted_value']) ? '' : $_COOKIE['contract_accepted_value'];
  // TODO: аналогично все поля.

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['fio']) || !ctype_alpha($_POST['fio']) || strlen($_POST['fio'])>150) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  else setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60);

// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.

$errors = FALSE;
  if (empty($_POST['tel']) || !is_numeric($_POST['tel']) || strlen($_POST['tel'])!=11) {
    // Выдаем куку на день с флажком об ошибке
    setcookie('tel_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  else setcookie('tel_value', $_POST['tel'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['email']) || !preg_match('/@/', $_POST['email'])) {
    // Выдаем куку на день с флажком об ошибке
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  else setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['dat']) || (!is_numeric($_POST['dat']) && !preg_match('/./', $_POST['dat']))) {
    // Выдаем куку на день с флажком об ошибке
    setcookie('dat_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  else setcookie('dat_value', $_POST['dat'], time() + 30 * 24 * 60 * 60);
  
  if (empty($_POST['bio']) || strlen($_POST['bio'])<10) {
    // Выдаем куку на день с флажком об ошибке
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  else setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  
  if (empty($_POST['contract_accepted'])) {
    // Выдаем куку на день с флажком об ошибке
    setcookie('contract_accepted_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  else setcookie('contract_accepted_value', $_POST['contract_accepted'], time() + 30 * 24 * 60 * 60);


  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
    setcookie('tel_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('dat_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('contract_accepted_error', '', 100000);
  }

  // Сохранение в БД.
  // ...
  $user = 'u68671'; // Заменить на ваш логин uXXXXX
  $pass = '5868553'; // Заменить на пароль
  $db = new PDO('mysql:host=localhost;dbname=u68671', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX
  
  // Подготовленный запрос. Не именованные метки.
  try {
    $stmt = $db->prepare("INSERT INTO applications (fio, tel, email, dat, pol, bio, agreement) VALUES (:fio, :tel, :email, :dat, :pol, :bio, :contract)");
    $stmt->execute([
      ':fio' => $_POST['fio'],
      ':tel' => $_POST['tel'],
      ':email' => $_POST['email'],
      ':dat' => $_POST['dat'],
      ':pol' => $_POST['pol'],
      ':bio' => $_POST['bio'],
      ':contract' => isset($_POST['contract_accepted']) ? 1 : 0
  ]);
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }



  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
