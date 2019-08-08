<?php
include('functions.php');

// HEADER
include('layout/header.php');
?>
<div class="row pb-4">
    <div class="col-sm-12">
        <div id="carouselIndicators" class="carousel slide carousel-fade">
            <ol class="carousel-indicators">
                <li class="active" data-target="#carouselIndicators" data-slide-to="0"></li>
                <li data-target="#carouselIndicators" data-slide-to="1"></li>
                <li data-target="#carouselIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card bg-dark">
                        <img src="<?php echo baseURL();?>img/test.jpg" alt="" class="card-img">
                        <div class="card-img-overlay ml-5 mt-2">
                            <h5 class="card-title" style="text-shadow: 0px 0px 10px white;"><strong>The New Curricullum of Pangasinan State University</strong></h5>
                            <p class="card-text" style="text-shadow: 0px 0px 10px white;">April 5, 2019</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo baseURL();?>img/test.jpg" alt="" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo baseURL();?>img/test.jpg" alt="" class="d-block w-100">
                </div>
            </div>
            <!--<a href="#carouselIndicators" role="button" data-slide="prev" class="carousel-control-prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a href="#carouselIndicators" role="button" data-slide="next" class="carousel-control-next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">Next</span>-->
            </a>
        </div>
    </div>
</div>
<div class="row pb-3">
    <div class="col-sm-8">
        <div class="row pb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4"><img src="<?php echo baseURL();?>img/test-thumbnail.png" class="img-fluid py-2"></div>
                            <div class="col-sm-8">
                                <div class="py-2">
                                    <h4>New's Title</h4>
                                    <h6>Writer's Name | August 10, 2019 </h6>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam eaque nesciunt suscipit veritatis recusandae provident. Unde fugit at reiciendis laborum voluptas repudiandae, harum minus voluptates natus assumenda aperiam id voluptate.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-danger">
            <div class="card-header text-danger">
                <strong>Trending News</strong>                
            </div>
            <div class="card-body text-danger">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h4 class="card-title">Lorem Ipsum</h4>
                        <p>April 22, 2019</p>
                        <a href="">Read More >>></a>
                    </li>
                    <li class="list-group-item">
                        <h4 class="card-title">Lorem Ipsum</h4>
                        <p>April 22, 2019</p>
                        <a href="">Read More >>></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
// FOOTER
include('layout/footer.php')
?>