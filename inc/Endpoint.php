<?php

class Custom_Endpoint {

  public $endpoint;
  public $icon;

  /**
  * Actions
  */

  public function __construct($endpoint = '') {
    if (!empty($endpoint)) {
      $this->endpoint = $endpoint;
    }
    // Actions to insert a new endpoint
    add_action('init',array($this,'add_endpoints'));
    add_filter('query_vars',array($this,'add_query_vars'),0);

    // Inserting tab
    add_filter('woocommerce_account_menu_items',[$this,'new_menu_items']);
    add_action('woocommerce_account_' . $this->endpoint . '_endpoint',[$this, 'endpoint_content']);

  }

  /**
  * Register new endpoint
  * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
  */

  public function add_endpoints() {
    add_rewrite_endpoint($this->endpoint, EP_ROOT | EP_PAGES);
  }

  /**
  * Add new query var.
  */
  public function add_query_vars($vars) {
    $vars[] = $this->endpoint;
    return $vars;
  }

  /**
  * Set endpoint title
  */
  public function endpoint_title($title){
    global $wp_query;

    $is_edpoint = isset($wp_query->query_vars[$this->endpoint]);

    if ($is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page()) {
      // New page title.
      $title = __($this->endpoint,'fstore');

      remove_filter('the_title',[$this,'endpoint_title']);
    }
    return $title;
  }

  /**
  * Set endpoint icon
  */
  public function set_icon($icon = ''){
    $this->icon = $icon;
  }

  /**
  * Insert into nav
  */
  public function new_menu_items($items) {
    /**
    * Items are set up in account.php
    */
    // Remove the logout menu item
    // $logout = $items['customer-logout'];
    // unset($items['customer-logout']);
    //
    // // Insert your custom endpoint.
    // $items[$this->endpoint] = __('Support','fstore');
    //
    // // Get back the logout item.
    // $items['customer-logout'] = $logout;
    return $items;
  }

  /**
  * Endpoint html content
  */
  public function endpoint_content() {
    // echo '<p>Hello World!</p>';
    wc_get_template( 'myaccount/'.$this->endpoint.'.php', array('user' => get_user_by('id', get_current_user_id())));
  }

  /**
  * Install action
  * Flush rewrite rules to make our ustom endpoint available.
  */
  public static function install() {
    flush_rewrite_rules();
  }

}
