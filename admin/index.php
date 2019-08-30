<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
}

include('../functions.php');
include('../config/connection.php');

$section = "login";

if (isset($_POST['login'])){
    $studentId = $conn->real_escape_string($_POST['studentId']);
    $pw = $conn->real_escape_string($_POST['pw']);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => baseURL()."/api/auth.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "studentId=".$studentId."&pw=".$pw."&role=admin",
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
        $obj = json_decode($response, true);

        if ($obj[0]['status']!="invalid_login") {

            $access_token = $obj[0]['access_token'];
            $expiration = $obj[0]['expiration'];

            setcookie("access_token", $access_token, $expiration, "/");
            $_SESSION['admin_id'] = $obj[1]['id'];    

            header("Location: dashboard.php");
        }
        else {
            $status = $obj[0]['message'];
        }
    }
}

// HEADER
include('../layout/header.php');
?>
<div class="row justify-content-center" style="height:100vh;">
    <div class="col-sm-4">
        <div data-aos="fade-right">
            <div class="card text-white bg-dark mb-3" style="margin-top: 20%; box-shadow: 0px 0px 10px white;">
                <div class="card-body">
                    <center><img src="<?php echo baseURL(); ?>/img/logo-ccnp.png" class="img-fluid" style="-webkit-filter:drop-shadow(3px 3px 2px rgba(0,0,0,1));"></center>
                    <hr/>
                    <h4 class="card-title">
                        <center>Admin's Panel</center>
                    </h4>
                    <hr/>
                    <?php
                    if (isset($status)) {
                    ?>
                    <center><span class="badge badge-pill badge-danger p-3"><?php echo $status;?></span></center>
                    <hr/>
                    <?php
                    }
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="">Student ID / Username</label>
                            <input type="text" class="form-control" name="studentId">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="pw">
                        </div>
                        <button class="btn btn-success btn-block btn-lg" type="submit" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>