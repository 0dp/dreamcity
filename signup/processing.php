<?php

// //basic wordpress user registration
// //username: email
// //email: email
// //display name: camp/project name
// //use default wordpress user table and function 
// //when user sign up hold account for moderation. using https://wordpress.org/plugins/new-user-approve/
// // ** lets create a view for pending records, aproved records, denied records.


// //additional profile fields registered into database table
//     //for reference wp_user table where ID is primary key. use key from above to create record:
//     /*  `ID` bigint(20) UNSIGNED NOT NULL,
//       `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//       `user_pass` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//       `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//       `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//       `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//       `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
//       `user_activation_key` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//       `user_status` int(11) NOT NULL DEFAULT '0',
//       `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
//     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;*/



// register a new user
function dc_add_new_dreamer() {
    if (isset( $_POST["dc_user_email"] ) && wp_verify_nonce($_POST['dc_register_nonce'], 'dc-register-nonce')) {
    $user_login   = $_POST["dc_user_email"];  
    $user_email   = $_POST["dc_user_email"];
    $user_first   = $_POST["dc_user_first"];
    $user_last    = $_POST["dc_user_last"];
    //$user_pass    = $_POST["dc_user_pass"];
    //$pass_confirm   = $_POST["dc_user_pass_confirm"];
 
    // this is required for username checks
    // require_once(ABSPATH . WPINC . '/registration.php');
 
    // if(username_exists($user_login)) {
    //   // Username already registered
    //   dc_errors()->add('username_unavailable', __('Username already taken'));
    // }
    // if(!validate_username($user_login)) {
    //   // invalid username
    //   dc_errors()->add('username_invalid', __('Invalid username'));
    // }
    // if($user_login == '') {
    //   // empty username
    //   dc_errors()->add('username_empty', __('Please enter a username'));
    // }
    // if(!is_email($user_email)) {
    //   //invalid email
    //   dc_errors()->add('email_invalid', __('Invalid email'));
    // }
    // if(email_exists($user_email)) {
    //   //Email address already registered
    //   dc_errors()->add('email_used', __('Email already registered'));
    // }
    //if($user_pass == '') {
      // passwords do not match
     // dc_errors()->add('password_empty', __('Please enter a password'));
    //}
    //if($user_pass != $pass_confirm) {
      // passwords do not match
      //dc_errors()->add('password_mismatch', __('Passwords do not match'));
    //}
 
   // $errors = dc_errors()->get_error_messages();
    $errors = '';
 
    // only create the user in if there are no errors
    if(empty($errors)) {
 
      $new_user_id = wp_insert_user(array(
          'user_login'    => $user_login,
          'user_pass'     => $user_pass,
          'user_email'    => $user_email,
          'first_name'    => $user_first,
          'last_name'     => $user_last,
          'user_registered' => date('Y-m-d H:i:s'),
          'role'        => 'dreamer'
        )
      );
      if($new_user_id) {
        // send an email to the admin alerting them of the registration
        wp_new_user_notification($new_user_id, '', 'both');
 
        // log the new user in
        //wp_setcookie($user_login, $user_pass, true);
        //wp_set_current_user($new_user_id, $user_login); 
        //do_action('wp_login', $user_login);
 
        // send the newly created user to the home page after logging them in and add a confirmation message
        wp_redirect(home_url()); exit;
      }
 
    }
 
  }
}
add_action('init', 'dc_add_new_dreamer');
?>



