<?php
session_start();

if (isset($_SESSION['writer_id'])) {
    header("Location: dashboard.php");
}

include('../functions.php');
include('../config/connection.php');

$section = "login";

if (isset($_POST['login'])){
    $username = $conn->real_escape_string($_POST['username']);
    $pw = $conn->real_escape_string($_POST['pw']);
    
    $pw_hash = md5("psu".$pw."psu");

    $sql = "SELECT * FROM op_users WHERE username='$username' AND pw='$pw_hash' AND role='writer'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['writer_id']=$row['id'];
        header("Location: index.php");
    }
    else {
        $status = "Incorrect Credentials.";
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
                        <center>Writer's Panel</center>
                    </h4>
                    <hr/>
                    <?php
                    if (isset($status)) {
                    ?>
                    <center><span class="badge badge-pill badge-danger p-3"><?php echo $status;?></span></center>
                    <?php
                    }
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username">
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