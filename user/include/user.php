<?php
$id = $_SESSION["id"];
$loadUser = mysqli_query($con, "SELECT * FROM users WHERE id={$id}");

return mysqli_fetch_object($loadUser);