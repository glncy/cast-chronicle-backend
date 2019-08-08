<?php
session_start();
unset($_SESSION['writer_id']);
header("Location: index.php");