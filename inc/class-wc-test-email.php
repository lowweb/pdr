<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* A custom test Order WooCommerce Email class
*
* @since 0.1
* @extends \WC_Email
*/
class WC_Test_Email extends WC_Email {

  public function __construct(){
    $this->id = 'wc_arrived';
    $this->customer_email   = true;
    $this->title = __('Order arrived to Vladivostok','fstore');
    $this->description = __('This email is sent when order has arrived to local store','fstore');
    $this->heading = __('Order arrived heading','fstore');
    $this->subject = __('Order arrived to Vladivostok','fstore');
    $this->template_html = 'emails/email-arrived.php';
    $this->template_plain = 'emails/email-arrived.php';

    // Trigger on new paid orders
    // /*this works*/add_action('woocommerce_order_status_pending_to_processing_notification',[$this,'trigger']);
    // add_action('woocommerce_order_status_on-hold_to_arrived_notification',[$this,'trigger']);
    // add_action( 'woocommerce_order_status_arrived', array( WC(), 'send_transactional_email' ), 10, 10 );
    add_action('woocommerce_order_status_changed',[$this,'trigger']);
    // add_action('woocommerce_order_status_arrived',[$this,'trigger']);


    // Call parent constructor to load any other defaults not explicity defined here
    parent::__construct();


    // if none was entered, just use the WP admin email as a fallback
    // if ( ! $this->recipient )
    //     $this->recipient = get_option( 'admin_email' );
  }

  /**
   * Determine if the email should actually be sent and setup email merge variables
   *
   * @param int $order_id
   */
  public function trigger($order_id) {
           // bail if no order ID is present
           if ( ! $order_id ) {
             error_log('no order id');
             log_error('no order id');
             return;
           }

          // setup order object
          $this->object = new WC_Order($order_id);
          $status = $this->object->get_status();
          $this->recipient = $this->object->get_billing_email();

          //bail if status is not 'arrived'
          if ($status != 'arrived')
            return;

          //replace vars in the subject/headings
          $this->find[] = '{order_date}';
          $this->replace[] = date_i18n(wc_date_format(),strtotime($this->object->get_date_created()));

          $this->find[] = '{order_number}';
          $this->replace[] = $this->object->get_order_number();

          if (! $this->is_enabled() || ! $this->get_recipient()) {
            error_log('not enabled or no recipient');
            log_error('not enabled or no recipient');
            return;
          }

          // send the email
          $this->send( $this->get_recipient(),$this->get_subject(),$this->get_content(),$this->get_headers(), $this->get_attachments());

   }


   /**
    * get_content_html function.
    *
    * @since 0.1
    * @return string
    */
    public function get_content_html() {
      ob_start();
      wc_get_template($this->template_html, array(
        'order' => $this->object,
        'email_heading' => $this->get_heading()
      ));
      return ob_get_clean();
    }

    /**
     * get_content_plain function.
     *
     * @since 0.1
     * @return string
     */
    public function get_content_plain() {
        ob_start();
        wc_get_template( $this->template_plain, array(
            'order'         => $this->object,
            'email_heading' => $this->get_heading()
        ) );
        return ob_get_clean();
    }

    /**
     * Initialize Settings Form Fields
     *
     * @since 0.1
     */
    public function init_form_fields() {

        $this->form_fields = array(
            'enabled'    => array(
                'title'   => 'Enable/Disable',
                'type'    => 'checkbox',
                'label'   => 'Enable this email notification',
                'default' => 'yes'
            ),
            'recipient'  => array(
                'title'       => 'Recipient(s)',
                'type'        => 'text',
                'description' => sprintf( 'Enter recipients (comma separated) for this email. Defaults to <code>%s</code>.', esc_attr( get_option( 'admin_email' ) ) ),
                'placeholder' => '',
                'default'     => ''
            ),
            'subject'    => array(
                'title'       => 'Subject',
                'type'        => 'text',
                'description' => sprintf( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', $this->subject ),
                'placeholder' => '',
                'default'     => ''
            ),
            'heading'    => array(
                'title'       => 'Email Heading',
                'type'        => 'text',
                'description' => sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.' ), $this->heading ),
                'placeholder' => '',
                'default'     => ''
            ),
            'email_type' => array(
                'title'       => 'Email type',
                'type'        => 'select',
                'description' => 'Choose which format of email to send.',
                'default'     => 'html',
                'class'       => 'email_type',
                'options'     => array(
                    'plain'     => 'Plain text',
                    'html'      => 'HTML', 'woocommerce',
                    'multipart' => 'Multipart', 'woocommerce',
                )
            )
        );
    }

} // end WC_Test_Email class
