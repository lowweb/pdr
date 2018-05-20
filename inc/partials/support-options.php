<?php

  if (!empty($_POST)) {
    if (!empty($_POST['support-emails'])) {
      update_option('support-emails',$_POST['support-emails']);
    }

    if (!empty($_POST['ceo-emails'])) {
      update_option('ceo-emails',$_POST['ceo-emails']);
    }

    if (!empty($_POST['callback-emails'])) {
      update_option('callback-emails',$_POST['callback-emails']);
    }

    echo '
    <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
    <p><strong>Настройки сохранены.</strong></p>
    <button type="button" class="notice-dismiss">
    <span class="screen-reader-text">Скрыть это уведомление.</span>
    </button>
    </div>';
  }

?>

<div class="wrap">
  <h1>Настройки поддержки и связи с директором</h1>

  <form method="post" action="" novalidate="novalidate">

    <table class="form-table">
      <tr>
        <th scope="row">
          <label for="support-emails">Адреса поддерки, через запятую</label>
        </th>
        <td>
          <input name="support-emails" type="email" class="regular-text" value="<?php echo get_option('support-emails') ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="ceo-emails">Адреса директора, через запятую</label>
        </th>
        <td>
          <input name="ceo-emails" type="email" class="regular-text" value="<?php echo get_option('ceo-emails') ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="callback-emails">Адреса для обратного звонка, через запятую</label>
        </th>
        <td>
          <input name="callback-emails" type="email" class="regular-text" value="<?php echo get_option('callback-emails') ?>">
        </td>
      </tr>
    </table>

    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения">
    </p>
  </form>

</div>
