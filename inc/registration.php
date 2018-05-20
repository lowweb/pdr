<?php
/**
* Custom registration form
*/
function output_form($login, $password, $email){
  echo '
  <div id="reg-shortcode">
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="registration">
      <div class="control-wrap">
        <label for="login">'._x('Login','noun','fstore').'</label>
        <input type="text" name="login" value="' . ( isset( $_POST['login'] ) ? $login : null ) . '" autocomplete="new-login" required>
      </div>

      <div class="control-wrap">
        <label for="password">'.__('Password','fstore').'</label>
        <input type="password" name="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '" autocomplete="new-password" required>
      </div>

      <div class="control-wrap">
        <label for="email">'.__('Email','fstore').'</label>
        <input type="email" name="email" value="' . ( isset( $_POST['email'] ) ? $email : null ) . '" required>
      </div>

      <div class="control-wrap terms">
        <input type="checkbox" name="terms" class="fancy-box" required>
        <label for="terms" class="inline">'.__('I agree to <a href="/terms" target="_blank">terms & conditions</a>','fstore').'</label>
      </div>

      <div class="g-recaptcha" data-sitekey="6LcgCyUUAAAAAJytHQvH9uHbPbz9unE3WjXDQeBf"></div>

      <input type="submit" name="adduser" class="button" value="'.__('Register','fstore').'"/>
    </form>

  </div>
  ';
}


function output_success(){
  // echo '<pre>'.print_r($_POST,true).'</pre>';
  echo '<div id="reg-done">';
  _e('Registration complete.','fstore');
  echo '<a href="/my-account">'.__('Go to your account.','fstore').'</a>';
  echo '<a href="/cart">'.__('Go to your cart.','fstore').'</a>';
  echo '</div>';
}

function output_loggedin(){
  echo '<div id="reg-done">';
  _e('You are already registered','fstore');
  echo '<a href="/my-account">'.__('Go to your account.','fstore').'</a>';
  echo '</div>';
}

function registration_shortcode( $login, $password, $email ) {

  wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );

  ob_start();
  custom_registration();
  return ob_get_clean();
}
add_shortcode('registration','registration_shortcode');


function registration_validation( $login, $password, $email, $terms, $recap ) {
  global $reg_errors;
  $reg_errors = new WP_Error;

  if ( empty( $recap ))
      $reg_errors->add('norecap', __('Recaptcha is empty','fstore'));

  if ( !validateRecap('6LcgCyUUAAAAAFr3VYpTeeSK0yXLmj8oZveimpFi') )
      $reg_errors->add( 'terms', __('Recaptcha invalid','fstore') );

  if ( empty( $login ) || empty( $password ) || empty( $email ) ) {
      $reg_errors->add('field', __('Required form field is missing','fstore'));
  }

  if ( 4 > strlen( $login ) )
      $reg_errors->add( 'login_length', __('login too short. At least 4 characters is required','fstore') );

  if ( username_exists( $login ) )
      $reg_errors->add('user_name', __('Sorry, that login already exists!','fstore'));

  if ( ! validate_username( $login ) )
      $reg_errors->add( 'login_invalid', __('Sorry, the login you entered is not valid','fstore'));

  if ( 5 > strlen( $password ) )
      $reg_errors->add( 'password', __('Password length must be greater than 5','fstore'));

  if ( !is_email( $email ) )
      $reg_errors->add( 'email_invalid', __('Email is not valid','fstore'));

  if ( email_exists( $email ) )
      $reg_errors->add( 'email', __('Email Already in use','fstore') );

  if ( !$terms )
      $reg_errors->add( 'terms', __('You should accept terms to proceed','fstore') );

  if ( is_wp_error( $reg_errors ) ) {
      foreach ( $reg_errors->get_error_messages() as $error ) {
          echo '<div class="error-msg">';
          _e('Error','fstore');
          echo ': ' . $error . '<br/>';
          echo '</div>';
      }

  }
}


function complete_registration() {
    global $reg_errors, $login, $password, $email, $recap;

    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
      $userdata = array(
        'user_login'    =>   $login,
        'user_email'    =>   $email,
        'user_pass'     =>   $password
      );
      $user = wp_insert_user( $userdata );
      output_success();
      return;
    } else output_form($login, $password, $email);

}

function custom_registration() {
    global $login, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $recap;
    if (is_user_logged_in())
      output_loggedin();
    else if ( isset($_POST['adduser'] ) ) {
        registration_validation( $_POST['login'], $_POST['password'], $_POST['email'], $_POST['terms'], $_POST['g-recaptcha-response']);

        // sanitize user form input
        $login      =   sanitize_user( $_POST['login'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        // $recap      =   ;

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration( $login, $password, $email, $recap );
    } else output_form($login, $password, $email);
}
