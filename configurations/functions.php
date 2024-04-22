<?php

date_default_timezone_set('Asia/Manila');
/* 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php'; */

function getTimeAndDate($format = "Y-m-d H:i:s")
{
    return date($format);
}
function getDateToday()
{
    return date("Y-m-d");
}


function formatdate($date, $format = "M d,Y h:i A")
{
    $date = strtotime($date);
    return date($format, $date);
}

function remove_on_array($needle, $haystack)
{
    $indexToRemove = array_search($needle, $haystack);
    if ($indexToRemove !== false) {
        unset($haystack[$indexToRemove]);
    }
    return array_values($haystack);
}

function error_field($field, $message)
{
    $msg = array(
        "success" => false,
        "field" => $field,
        "message" => $message
    );
    echo arraytojson($msg);
    die();
}
function response($success, $message, $extra = [])
{
    $msg = array(
        "success" => $success,
        "message" => $message,
        "extra" => arraytojson($extra)
    );
    echo arraytojson($msg);
    die();
}
function navigate($path)
{
    echo "<script>window.location.href='$path'</script>";
    exit();
}

function arraytojson($array)
{
    if (is_array($array)) {
        return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        return false;
    }
}

function send_email($content)
{

}
function generateUniqueCode($length, $uppercase = false)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[mt_rand(0, $max)];
    }

    return ($uppercase) ? strtoupper($code) : $code;
}
function adminLevel($level)
{
    if ($level == "superadmin") {
        return "Super Admin";
    }
}