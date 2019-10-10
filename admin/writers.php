<?php

$section = "admin-panel";
$pageSection = "writers";

include('../functions.php');
include('process/auth.php');

// HEADER
include('../layout/header.php');
?>

<div class="row" style="height:100vh;">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../layout/footer.php');
?>