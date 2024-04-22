<?php
include "../../vendor/autoload.php";

$pusher = new Pusher\Pusher(
    '5a00f0d723077865b510',
    '811a187e0c5b97c0dfae',
    '1748724',
    array(
    'cluster' => 'eu',
    'useTLS' => true
    )
);

$pusher->trigger('notification_channel', 'notification_event', []);