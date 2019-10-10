<?php

include('../../functions.php');
include('auth.php');

$id = $_GET['id'];
$role = $_GET['role'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => baseURL()."api/user.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PATCH",
    CURLOPT_POSTFIELDS => "change_role=true&user_id=".$id."&role=".$role,
    CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $array = json_decode($response, true);
  if ($array['status']=="success_update") {
      echo "<script>alert('Updated Successfully!');window.location.href='".baseURL()."admin/writers.php'</script>";
  }
} 
?>