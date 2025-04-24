<html>
  <head>
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
  </head>
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

    <form action="" method="POST">
      <input name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>" /><br>
      <input name="tel" <?php if ($errors['tel']) {print 'class="error"';} ?> value="<?php print $values['tel']; ?>" /><br>
      <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" /><br>
      <input name="dat" <?php if ($errors['dat']) {print 'class="error"';} ?> value="<?php print $values['dat']; ?>" /><br>
      <input name="bio" <?php if ($errors['bio']) {print 'class="error"';} ?> value="<?php print $values['bio']; ?>" /><br>
      <input name="contract_accepted" <?php if ($errors['contract_accepted']) {print 'class="error"';} ?> value="<?php print $values['contract_accepted']; ?>" /><br>
      <button type="submit" name="save" class="btn btn-primary">сохранить</button>

     
    </form>
  </body>
</html>
