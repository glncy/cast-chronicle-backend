<?php
session_start();

include('../../config/connection.php');

$id = $_POST['writer_id'];

$img = htmlspecialchars($conn->real_escape_string($_POST['imgb64']));

$sql = "UPDATE op_users SET img='$img' WHERE id='$id'";

if ($conn->query($sql)){
    echo "<script>alert('Image Picture Updated Successfully');window.location.href = '../writers.php';</script>";
}
else {
    echo "<script>alert('Failed to update due to Server Error.');window.location.href = '../writers.php';</script>";
}
?>