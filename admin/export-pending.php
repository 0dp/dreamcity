<?php
global $wpdb;

$pending = $wpdb->get_results( 
"SELECT DISTINCT wp0_users.display_name, wp0_users.user_email, wp0_usermeta.*, wp0_dc_camp.*,wp0_dc_camp_meta.*
FROM wp0_dc_camp 
LEFT JOIN wp0_dc_camp_meta ON wp0_dc_camp.camp_id = wp0_dc_camp_meta.camp_id
LEFT JOIN wp0_users ON wp0_dc_camp.user_id = wp0_users.ID
LEFT JOIN wp0_usermeta ON wp0_usermeta.user_id = wp0_users.ID WHERE wp0_usermeta.meta_value = 'pending' GROUP BY wp0_users.ID
"); 

echo "<pre>"; print_r($result); echo "</pre>";
?>