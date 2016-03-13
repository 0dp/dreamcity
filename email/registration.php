<?php
// Redefine user notification function
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('New Dreamer registration on %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New Dreamer Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__("We will moderate your application, and when it's approved you will receive your login credentials.") . "\r\n";
        $message .= sprintf(__("At which point you can log in here: "), wp_login_url()) . "\r\n";

        $message .= sprintf(__('If you have any problems, please contact us at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');

        wp_mail($user_email, sprintf(__('[%s] Thank You'), get_option('blogname')), $message);

    }
}

?>