<?php
include('process/auth.php');

$section = "admin-panel";

$pageSection = "about";

include('../functions.php');

// HEADER
include('../config/connection.php');
include('../layout/header.php');
?>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-body">
                <h4>
                    <strong>Change Password</strong>
                </h4>
                <hr/>
                <form action="process/change_password.php" method="POST" id="submitPassword">
                <label>Current Password</label>
                <input type="password" name="currentPw" class="form-control">
                <label>New Password</label>
                <input type="password" name="newPw" class="form-control">
                <label>Retype Password</label>
                <input type="password" name="retypeNewPw" class="form-control">
                </form>
                <br/>
                <button type="button" class="btn btn-success btn-block" onclick="document.getElementById('submitPassword').submit();">Change</button>
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>