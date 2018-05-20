<?php
/**
* @hooked WC_Emails::order_details() Shows the order details table.
* @hooked WC_Structured_Data::generate_order_data() Generates structured data.
* @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates/Emails
 * @version     2.5.0
*/ ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style></style>
  </head>
  <body style="font-family: 'bsans',sans-serif;max-width: 735px;color: #414042;margin: 0;font-size:14px;">
    <div style="width: 100%;background-color: #3f419a;color: #fff;text-align: center;padding: 36px 0;box-sizing: border-box;">
    	<?php
    		if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
    			echo '<img src="'. esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" />';
    		}
    	?>
    </div>

    <section id="top" style="padding: 0 40px 0 64px;">
      <h3 style="font-size: 14px;line-height: 1.5;margin: 32px 0 16px;color: #414042;">Здравствуйте, <?php echo $order->get_billing_first_name(); ?></h3>
      <!-- <p><?php _e( "Your order is on-hold until we confirm payment has been received. Your order details are shown below for your reference:", 'woocommerce' ); ?></p> -->
      <p style="margin-top:0">
        Меня зовут Александр Тумаков, я менеджер интернет-магазина «Подряд».<br>
        Вы сделали заказ на нашем сайте. Давайте проверим его:
      </p>
    </section>

    <section id="items" style="padding: 32px 64px;">
      <?php
      do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

    </section>

    <section id="whatnext" style="padding: 0 40px 16px 64px;">
      <h3 style="font-size: 14px; line-height: 1.5; color:#414042;">Что будет дальше</h3>
      <ol style="font-size: 14px; line-height: 1.71; padding-left: 18px;">
        <li>Я или мои коллеги свяжемся с вами для подтверждения заказа по номеру 8 (950) 321-45-67.</li>
        <li>Мы соберем и отправим ваш заказ. </li>
        <li>Служба доставки привезет ваш заказ в указанное место.</li>
      </ol>
      <p>Вы можете изменить адрес доставки по телефону</p>
    </section>

    <section id="manager" style="border-top: solid 1px #f1f2f2; padding: 32px 64px 0; font-weight: 600;">
      <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">
        По всем вопросам звоните по телефону 8 (423) 249-95-20.<br>
        Мы работаем с 9 до 18 часов по Владивостокскому времени (МСК +7).<br>
        Будем рады помочь!
      </p>
      <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">
        <a href="<?php echo site_url('shop') ?>" class="btn" style="color: #fff;display: inline-block;font-size: 12px;background-color: #3f419a;border-radius: 36px;text-decoration: none;width: 166px;height: 40px;font-weight: 400;line-height: 3.2;text-align: center;">Продолжить покупки</a>
      </p>
    </section>

    <section id="footer" style="border-top: solid 1px #f1f2f2; padding: 40px 64px; overflow: auto; height: 105px;">
      <img id="footer-logo" src="<?php echo FROOT.'/img/footer-logo.png'?>" style="width:28px; height:28px; margin-right: 24px; vertical-align: middle; float:left;">
      <div class="footer-block" style="float:left">
        <span id="footer-span" style="font-size: 14px;font-weight: 600;color: #3f419a;">С уважением, менеджер по продажам Александр Тумаков<br>Интернет магазин «Подряд».</span>
        <br><br>
        <a href="tel:8(423)249-95-20" style="display: block;font-size: 14px;font-weight: 600;line-height: 1.5;color: #3f419a;text-decoration: none;">8 (423) 249-95-20</a>
        <a href="http://shop.podryad.tv" style="display: block;font-size: 14px;font-weight: 600;line-height: 1.5;color: #3f419a;text-decoration: none;">shop.podryad.tv</a>
      </div>
    </section>

    <section id="cred" style="border-top: solid 1px #f1f2f2; padding: 32px 64px; font-size: 14px; line-height: 1.71; color: #a7a9ac;">
      <p style="font-size: 14px;line-height: 1.5;margin: 0 0 32px;">
        <strong>Реквизиты компании:</strong><br>
        Индивидуальный предприниматель Синельникова Оксана Анатольевна<br>
        ОГРНИП 311253612400012<br>
        Юридический адрес: 690022, г. Владивосток, ул. Чапаева, 12, кв. 232<br>
      </p>
    </section>

  </body>
</html>
