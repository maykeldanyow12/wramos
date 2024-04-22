<?php
session_start();
include "../configurations/include.php";
$uip = $_SERVER['REMOTE_ADDR'];

$id = $form->name("service_id")->as("service_id")->rules("required");
$username = $form->name("email")->as("email")->rules("required");
$password = $form->name("password")->as("password")->rules("required");
$password = md5($password);
$ValidateAccountQry = $db->query("SELECT * FROM users WHERE email = '{$username}' AND password = '{$password}' LIMIT 1");

if ($ValidateAccountQry->num_rows < 1) {
    $LogUser = $db->query("INSERT INTO userlog (`username`,`userip`,`status`) VALUES ('$username','$uip','0')");
    response(false, "Invalid username or password, please try again.");
}

$User = $ValidateAccountQry->fetch_object();

$session->key("id")->value($User->id);
$session->key("login")->value($username);
$session->key("book_services_id")->push($id);

response(true, "");