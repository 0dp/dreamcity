<?php
/* Admin Dashboard */
?>
<div class="wrap">
    <h2><?php _e( 'Dream-city Projects', 'new-user-approve' ); ?></h2>


<?php 
$approved = $wpdb->get_results( 
"SELECT DISTINCT wp0_users.display_name, wp0_users.user_email, wp0_usermeta.*, wp0_dc_camp.*,wp0_dc_camp_meta.*
FROM wp0_dc_camp 
LEFT JOIN wp0_dc_camp_meta ON wp0_dc_camp.camp_id = wp0_dc_camp_meta.camp_id
LEFT JOIN wp0_users ON wp0_dc_camp.user_id = wp0_users.ID
LEFT JOIN wp0_usermeta ON wp0_usermeta.user_id = wp0_users.ID WHERE wp0_usermeta.meta_value = 'approved' GROUP BY wp0_users.ID
"); 

$pending = $wpdb->get_results( 
"SELECT DISTINCT wp0_users.display_name, wp0_users.user_email, wp0_usermeta.*, wp0_dc_camp.*,wp0_dc_camp_meta.*
FROM wp0_dc_camp 
LEFT JOIN wp0_dc_camp_meta ON wp0_dc_camp.camp_id = wp0_dc_camp_meta.camp_id
LEFT JOIN wp0_users ON wp0_dc_camp.user_id = wp0_users.ID
LEFT JOIN wp0_usermeta ON wp0_usermeta.user_id = wp0_users.ID WHERE wp0_usermeta.meta_value = 'pending' GROUP BY wp0_users.ID
"); 

$denied = $wpdb->get_results( 
"SELECT DISTINCT wp0_users.display_name, wp0_users.user_email, wp0_usermeta.*, wp0_dc_camp.*,wp0_dc_camp_meta.*
FROM wp0_dc_camp 
LEFT JOIN wp0_dc_camp_meta ON wp0_dc_camp.camp_id = wp0_dc_camp_meta.camp_id
LEFT JOIN wp0_users ON wp0_dc_camp.user_id = wp0_users.ID
LEFT JOIN wp0_usermeta ON wp0_usermeta.user_id = wp0_users.ID WHERE wp0_usermeta.meta_value = 'denied' GROUP BY wp0_users.ID
"); 

 //echo "<pre>"; print_r($result); echo "</pre>";
?>


<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a data-toggle="tab" href="#pending">Pending Projects</a></li>
  <li role="presentation"><a data-toggle="tab" href="#approved">Approved</a></li>
  <li role="presentation"><a data-toggle="tab" href="#denied">Denied</a></li>
</ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="pending">
        <form method="post" id="download_form" action="">
            <input type="submit" style="float: right;" name="download_csv" class="btn btn-primary" value="Export Pending Dreamers (.csv)" />
    </form>
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Camp Name</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>#Residents</th>
                <th>Short Description</th>
                <th>Project Description</th>
                <th>Project Construction</th>
                <th>Workshop</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pending as $row) { ?>
            <tr>
                <td><?php echo $row->camp_name; ?></td>
                <td><?php echo $row->display_name; ?></td>
                <td><?php echo $row->user_email; ?></td>
                <td><?php echo $row->camp_phone; ?></td>
                <td><?php echo $row->camp_residents; ?></td>
                <td><?php echo $row->camp_short_description; ?></td>
                <td><?php echo $row->camp_description; ?></td>
                <td><?php echo $row->camp_construction; ?></td>
                <td><?php echo $row->meta_value; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="approved">
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
            <?php foreach($approved as $row) { ?>
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
    <div role="tabpanel" class="tab-pane fade" id="denied">
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
            <?php foreach($denied as $row) { ?>
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
  </div>


</div>


