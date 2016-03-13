<?php
/* Admin Dashboard */
?>
<div class="wrap">
    <h2><?php _e( 'Approved Dream-city Projects', 'new-user-approve' ); ?></h2>


<?php 
$result = $wpdb->get_results( "SELECT wp0_users.display_name, wp0_users.user_email,  wp0_dc_camp.*,wp0_dc_camp_meta.*
FROM wp0_dc_camp 
LEFT JOIN wp0_dc_camp_meta ON wp0_dc_camp.camp_id = wp0_dc_camp_meta.camp_id
LEFT JOIN wp0_users ON wp0_dc_camp.user_id = wp0_users.ID
"); 

// echo "<pre>"; print_r($result); echo "</pre>";



?>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Camp Name</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>#Residents</th>
                <th>Project Description</th>
                <th>Project Construction</th>
                <th>Workshop</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($result as $row) { ?>
            <tr>
                <td><?php echo $row->camp_name; ?></td>
                <td><?php echo $row->display_name; ?></td>
                <td><?php echo $row->user_email; ?></td>
                <td><?php echo $row->camp_phone; ?></td>
                <td><?php echo $row->camp_residents; ?></td>
                <td><?php echo $row->camp_description; ?></td>
                <td><?php echo $row->camp_construction; ?></td>
                <td><?php echo $row->meta_value; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


