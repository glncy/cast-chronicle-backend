<?php
session_start();
if (!isset($_SESSION['writer_id'])) {
    header("Location: index.php");
}