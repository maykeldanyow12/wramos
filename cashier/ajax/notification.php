<?php
include "../../../configurations/include.php";


$notifcations = $nosql->table("notifications")->desc("id")->limit(3)->load();
?>

<?php if(count($notifcations) > 0) {?>
    <?php foreach($notifcations as $notification) {?>
        <li>
            <div style="padding: 5px;">
                <strong>New Appointment</strong>
                	<p>Patients book an appointment <br> 
                        <b><?= $notification["creationDate"] ?></b>
                    </p>
                    <p></p>
                    <a href="<?= $notification["button_more_details_url"] ?>" class="btn btn-primary btn-block btn-sm">
                        View Appointment
                    </a>
                <hr>
            </div>
        </li>
    <?php } ?>
<?php }else{?>
    <div>No Notifcation</div>
<?php }?>
