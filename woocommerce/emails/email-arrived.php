<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style></style>
  </head>
  <body style="font-family: 'bsans',sans-serif;max-width: 735px;color: #414042;margin: 0;">
    <header style="width: 100%;background-color: #3f419a;color: #fff;text-align: center;padding: 36px 0;box-sizing: border-box;">
      <?php
        if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
          echo '<img src="'. esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" />';
        }
      ?>
    </header>
    <section id="top" style="padding: 0 64px;">
      <h3 style="font-size: 14px;line-height: 1.5;margin: 32px 0 16px;">Здравствуйте, <?php echo $order->get_billing_first_name(); ?></h3>
      <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">Ваш заказ <span id="order-number" style="font-weight: 600;color: #302c88;">№<?php echo $order->get_order_number(); ?></span> доставлен на склад “Подряда” во Владивостоке.<br><br>
        В течение трех дней мы вышлем его по указанному адресу: <?php echo $order->get_billing_address_1(); ?><br>
        Чтобы изменить адрес доставки, <a href="<?php echo site_url('/my-account/support/'); ?>" style="color: #3f419a;">напишите нам</a>. </p>
        <!-- <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">
        <a href="<?php echo site_url('shop') ?>" class="btn" style="color: #fff;display: inline-block;font-size: 12px;background-color: #3f419a;border-radius: 36px;text-decoration: none;width: 166px;height: 40px;font-weight: 400;line-height: 3.2;text-align: center;">Продолжить покупки</a>
        </p> -->
    </section>
    <section id="manager" style="padding: 0 64px;border-top: solid 1px #f1f2f2;padding-top: 32px;font-weight: 600;">
      <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">
        Если у вас возникли вопросы, звоните нашему менеджеру по телефонам<br>
        8 (423) 249-95-20 или 8 (423) 249-94-03.
      </p>
    </section>
    <section id="cred" style="padding: 0 64px;border-top: solid 1px #f1f2f2;padding-top: 32px;font-size: 14px;line-height: 1.71;color: #a7a9ac;">
      <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">
        <strong>Реквизиты компании:</strong><br>
        Индивидуальный предприниматель Синельникова Оксана Анатольевна<br>
        ОГРНИП 311253612400012<br>
        Юридический адрес: 690022, г. Владивосток, ул. Чапаева, 12, кв. 232<br>
      </p>
    </section>
    <footer style="border-top: solid 1px #f1f2f2;padding: 40px 64px;height: 112px;box-sizing: border-box;">
      <img id="footer-logo" src="<?php echo FROOT.'/img/footer-logo.png'?>" style="width:28px;height:28px;margin-right: 24px;vertical-align: middle;">
      <span id="footer-span" style="font-size: 14px;font-weight: 600;color: #3f419a;">Служба поддержки компании «Подряд».</span>
    </footer>
  </body>
</html>
