<?php
session_start();
if (!isset($_SESSION['copyreader_id'])) {
    header("Location: articles.php");
}