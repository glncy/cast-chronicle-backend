<?php
include('functions.php');

// HEADER
include('layout/header.php');
if (isset($_GET['aid'])) {
    $isAvailable = true;
}
else {
    $isAvailable = false;
}

if ($isAvailable) {
?>
<div class="row pb-4">
    <div class="col-sm-8">
        <div class="row pb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><strong>Lorem Ipsum</strong></h3>
                        <span>By <strong>Juan Dela Cruz</strong><br/>April 10, 2019<br/>Category: <a href="">Sports</a></span>
                        <hr/>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut tempore quia possimus aspernatur totam numquam facilis soluta consectetur mollitia officiis. Temporibus odio repellendus nulla et omnis corporis, itaque unde dignissimos!</p>
                        <hr/>
                        <h5>Comments</h5>
                        <div class="p-2">
                            <h6><strong>Juan Dela Cruz</strong></h6>
                            <p>That was an Amazing Article!</p>
                        </div>
                        <div class="p-2">
                            <h6><strong>Juan Dela Cruz</strong></h6>
                            <p>That was an Amazing Article!</p>
                        </div>
                        <hr/>
                        <h5>Comment Here</h5>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="" id="" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea class="form-control" rows="3" placeholder="Comment Here..."></textarea>
                        </div>
                        <button class="btn btn-success float-right">Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="row pb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">More on Sports...</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5>Lorem Ipsum</h5>
                                <h6>April 22, 2019</h6>
                                <a href="">Read More >>></a>
                            </li>
                            <li class="list-group-item">
                                <h5>Lorem Ipsum</h5>
                                <p>April 22, 2019</p>
                                <a href="">Read More >>></a>
                            </li>
                            <li class="list-group-item">
                                <h5>Lorem Ipsum</h5>
                                <p>April 22, 2019</p>
                                <a href="">Read More >>></a>
                            </li>
                            <li class="list-group-item">
                                <h5>Lorem Ipsum</h5>
                                <p>April 22, 2019</p>
                                <a href="">Read More >>></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
else {
?>
<div class="row pb-4 justify-content-center" style="height: 60vh;">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <center>
                    <h3><strong>Uh Oh! Page Not Found.</strong></h3>
                    <hr/>
                    <p>Seems you are entering to unavailable link. <a href="">Click Here</a> to go Home.</p>
                </center>
            </div>
        </div>
    </div>
</div>
<?php
}
// FOOTER
include('layout/footer.php')
?>