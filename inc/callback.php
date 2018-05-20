<?php

  add_shortcode('callback','callback_btn');
  function callback_btn(){
    wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
    return '<a class="callback-btn"><svg><use xlink:href="#callback"></use></svg>'.__('Order call','fstore').'</a>';
  }

  add_action('get_footer','callback_modal');
  function callback_modal() {
    echo '
      <div class="cb-fade">
        <div class="cb-popup">
          <button class="cb-close">&times;</button>
          <p class="cb-text">Оставьте заявку на звонок, наш менеджер свяжется с вами в ближайшее время.</p>
          <form class="cb-form">
            <input type="text" name="cb-num" class="cb-num" placeholder="+7 (xxx) xxx-xx-xx" required/>
            <button type="submit" class="btn g-recaptcha"
            data-sitekey="6LcueUcUAAAAAPgPVk9-p1XA5gbijlhPHJIKFWCb"
            data-callback="recapCallback"
            >Заказать звонок</button>
          </form>

          <div class="cb-success">
            <h3>Ваша заявка принята!</h3>
          </div>

        </div>
      </div>
    ';
  }

  add_action('wp_ajax_submit_callback','submit_callback');
  add_action('wp_ajax_nopriv_submit_callback','submit_callback');
  function submit_callback(){
    $num = $_POST['cb-num'];

    if (validateRecap('6LcueUcUAAAAAF5V4px8k7vuL8BbCKgArjBqkpae')) {
      if (wp_mail($to,$subj,$msg)) die();
      else echo "something went wrong with wp_mail()";
      die();
    }

    // $to = 'alex.sales@podryad.tv, subkhangulova_e@podryad.tv, april504@yandex.ru';
    $to = get_option('callback-emails');
    $subj = __('Сallback request','fstore');
    $date = date_i18n( 'd F Y', current_time('timestamp') );


    $icon = base64_encode(file_get_contents(FROOT.'/img/clock.png'));
    $msg = '<div id="box" style="max-width: 300px;border-radius: 4px;box-shadow: 0 0 26px 0 rgba(0, 0, 0, 0.07);padding: 40px;font-family: "beau-sans","beau sans",sans-serif;color: #414042;box-sizing: border-box;">
        <h3 style="margin: 0 0 63px;font-weight: 400;font-size: 18px;">'.$subj.'</h3>
        <a id="number" href="tel:'.$num.'" style="font-size: 22px;font-weight: 300;color: #3f419a;display: block;text-decoration: none;margin-bottom: 24px;">'.$num.'</a>
        <span id="date" style="font-size: 14px;margin-right: 28px;">'.$date.'</span>
        <span id="time" style="font-size: 14px;margin-right: 28px;">
            <img src="data:image/png;base64,'.$icon.'">
            '.current_time('H:i').'
        </span>
    </div>';

    // html please
    function mail_content_type(){ return "text/html"; };
    add_filter( 'wp_mail_content_type','mail_content_type' );

  }

 ?>
