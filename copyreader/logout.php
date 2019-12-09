<?php
session_start();
session_destroy();
unset($_COOKIE['access_token']);
setcookie("access_token", '', time() - 3600);
header("Location: index.php");