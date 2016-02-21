<?php

//basic wordpress user registration
//username: email
//email: email
//display name: camp/project name
//use default wordpress user table and function 
//when user sign up hold account for moderation. using https://wordpress.org/plugins/new-user-approve/
// ** lets create a view for pending records, aproved records, denied records.


//additional profile fields registered into database table
    //for reference wp_user table where ID is primary key. use key from above to create record:
    /*  `ID` bigint(20) UNSIGNED NOT NULL,
      `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      `user_pass` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      `user_activation_key` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      `user_status` int(11) NOT NULL DEFAULT '0',
      `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;*/


?>