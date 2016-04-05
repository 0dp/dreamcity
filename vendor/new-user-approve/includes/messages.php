<?php

/**
 * The default email message that will be sent to users as they are approved.
 *
 * @return string
 */
function nua_default_approve_user_message() {
	$message = __( 'You have been approved to access {sitename}', 'new-user-approve' ) . "\r\n\r\n";
	$message .= "{username}\r\n";
	$message .= "{password}\r\n\r\n";
	$message .= "{login_url}\r\n\r\n";
	$message .= '<strong>Please read the following mail thoroughly to get all information correct</strong>
<br></br>
<p>Horray,</p>
<p>
You have now completed one of the 3 steps in the registration process to be a part of Dream City
2016. Maybe you already attended a Safety Seminar as well as marked your camp on the city
map. If not, it isn’t too late.    
</p>
<p>
Sign up for the next Safe Seminar and/or attend a Dream City Talk to mark your camp. Check out
date, time and place at the website <a href="http://dream-city.dk">Dream-city.dk</a> or on the facebook site <a href"https://www.facebook.com/dreamcity.roskildefestival/">Dream City - Roskilde Festival.</a>    
</p>
<h3>Official Dream City contact person</h3>
<p>
You and your camp are now part of the Dream City 2016 and with that comes a responsibility to
know everything there is to know about the city.    
</p>
<p>
You are the official Dream City contact person, which makes you responsible to gather all
information you can get about Dream City and share it with the rest of your camp. You’ll also
receive newsletters, which provides you important information to share with the rest of your camp.    
</p>
<p>To make this process even easier for you, you also get an exclusive login that gives you access to
important documents for instance safety and construction guidelines. Remember if your dream
project include any construction work then send a description and drawing/picture to illustrate your
concept to <a href="mailto:bygdc@roskilde-festival.dk">bygdc@roskilde-festival.dk</a>
</p>
<br></br>
<a href="http://dream-city.dk/wp-content/uploads/2016/03/dc_samlede_dokumenter_2016.zip">http://dream-city.dk/wp-content/uploads/2016/03/dc_samlede_dokumenter_2016.zip</a>
<br></br>
<h3>Important stuff to know about Dream City</h3>
<p>
Get more information about <a href="http://dream-city.dk/dream-city-dogmas/">Dream City’s DOGMAS</a> or the <a href="http://dream-city.dk/important-dates-and-deadlines/">WRAP UP DAY</a> or <a href="http://dream-city.dk/important-dates-and-deadlines/">CLEAN UP DAY</a> at <a href="http://dream-city.dk">Dream City’s website.</a>    
</p>
<p>
You can also can get answers to most frequently asked questions about what you need to know as
a dreamer, about the building process and the clean up day and much more important stuff in the
<a href="http://dream-city.dk/faq/">FAQ section.</a>
</p>
<h3>Any questions?</h3>
<p>If you have any questions to this e-mail or other things about Dream City don’t hesitate to ask them
at facebook or write us an email at dreamcity@roskilde-festival.dk.
It’s so exciting to see what we all together Dream Up for this years Dream City!
</p>';

	$message = apply_filters( 'new_user_approve_approve_user_message_default', $message );

	return $message;
}

/**
 * The default email message that will be sent to users as they are denied.
 *
 * @return string
 */
function nua_default_deny_user_message() {
	$message = '<strong>Please read the following mail thoroughly to get all information correct</strong>
<br></br>
<p>Dear Dreamer,</p>
<p>
Unfortunately, your registration can’t yet be confirmed but don’t you worry, you still have time to
correct and submit a new registration. The reason why your registration can’t yet be confirmed is
due to one or more of the following issues:
</p>
<ul>
	<li>You’re missing to write an English camp description.</li>
    <li>You’ve missed to explain one or more of the 4 topics from the Dream Up Wheel.</li>
    <li>You didn’t upload a camp image. Your camp image is your camps official look to the public – the
image or picture will be used in the dreamer album on the website.</li>
    <li>Your camp is planning to build a music scene or to organize concerts in Dream City. The camps
are not allowed to build any scenes or organize concerts or DJ sets in Dream City. You may not
publish an official music and/or concert program in Dream City. Please be aware of this when you
create and design your Dream City project.</li>
</ul>
<p>
Get answers to most frequently asked questions about what you need to know as a dreamer and
what to do and not to do in Dream City and much more important stuff on the website in the <a href="http://dream-city.dk/faq/">FAQ section.</a>
</p>
<h3>Any questions?</h3>
<p>If you have any questions to this e-mail or other things about Dream City don’t hesitate to ask them
at <a href="https://www.facebook.com/dreamcity.roskildefestival/">Facebook Dream City - Roskilde Festival</a> or write us an email at dreamcity@roskilde-festival.dk.</p>
<br></br>
It’s so exciting to see what we all together Dream Up for this years Dream City!
<p>Best Regards, Dream City</p>';

	$message = apply_filters( 'new_user_approve_deny_user_message_default', $message );

	return $message;
}

/**
 * The default message that will be shown to the user after registration has completed.
 *
 * @return string
 */
function nua_default_registration_complete_message() {
	$message = sprintf( __( 'An email has been sent to the site administrator. The administrator will review the information that has been submitted and either approve or deny your request.', 'new-user-approve' ) );
	$message .= ' ';
	$message .= sprintf( __( 'You will receive an email with instructions on what you will need to do next. Thanks for your patience.', 'new-user-approve' ) );

	$message = apply_filters( 'new_user_approve_pending_message_default', $message );

	return $message;
}

/**
 * The default welcome message that is shown to all users on the login page.
 *
 * @return string
 */
function nua_default_welcome_message() {
	$welcome = sprintf( __( 'Welcome to {sitename}. This site is accessible to approved users only. To be approved, you must first register.', 'new-user-approve' ), get_option( 'blogname' ) );

	$welcome = apply_filters( 'new_user_approve_welcome_message_default', $welcome );

	return $welcome;
}

/**
 * The default notification message that is sent to site admin when requesting approval.
 *
 * @return string
 */
function nua_default_notification_message() {
	$message = __( '{username} ({user_email}) has requested a username at {sitename}', 'new-user-approve' ) . "\n\n";
	$message .= "{site_url}\n\n";
	$message .= __( 'To approve or deny this user access to {sitename} go to', 'new-user-approve' ) . "\n\n";
	$message .= "{admin_approve_url}\n\n";

	$message = apply_filters( 'new_user_approve_notification_message_default', $message );

	return $message;
}

/**
 * The default message that is shown to the user on the registration page before any action
 * has been taken.
 *
 * @return string
 */
function nua_default_registration_message() {
	$message = __( 'After you register, your request will be sent to the site administrator for approval. You will then receive an email with further instructions.', 'new-user-approve' );

	$message = apply_filters( 'new_user_approve_registration_message_default', $message );

	return $message;
}
