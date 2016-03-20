<?php


function dc_email_header() {
		
		$admin_email = 'noreply@' . $_SERVER['SERVER_NAME'];
		
		$from_name = "Dream City";

		$headers = array(
			"From: \"{$from_name}\" <{$admin_email}>\n",
			"Content-Type: text/plain; charset=\"" . get_option( 'blog_charset' ) . "\"\n",
		);

		//$headers = apply_filters( 'new_dreamcity_email_header', $headers );

		return $headers;
	}

function dc_emailExists($stremail){
	

	return false;
}

function dc_phoneExists($strPhone){
	
	return false;
}

//Completely sanitizes text
function sanitize($str)
{
	return strtolower(strip_tags(trim(($str))));
}

//Completely sanitizes text
function sanitizeKeepNewline($str)
{
	return strtolower(strip_tags(trim($str, "\n\r")));
}

?>
