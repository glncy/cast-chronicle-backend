<?php
include('process/auth.php');

header('X-XSS-Protection:0');
$section = "writers-panel";

if (isset($_POST['submitDraft'])) {
    include('../config/connection.php');
    $articleBody = $_POST['articleBody'];
    $sql = "INSERT INTO op_test (article) VALUES ('$articleBody')";
    $conn->query($sql);
}

include('../functions.php');

// HEADER
include('../layout/header.php');
?>

<div class="row">
    <div class="col-sm-8">
        <div class="card mb-3">
            <div class="card-header">
                Compose Draft
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="articleTitle">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <div id="editor">
                            <p>Hello World!</p>
                            <p>Some initial <strong>bold</strong> text</p>
                            <p><br></p>
                        </div>
                    </div>
                    <div id="test" class="ql-editor">
                    <iframe class="ql-video" frameborder="0" allowfullscreen="true" src="https://www.youtube.com/embed/c7rCyll5AeY?showinfo=0"></iframe><p>dsadsaasdasasdasd</p><p>alskjdlsakjd</p><p>Hello World!</p><p>Some initial <strong>bold</strong> text</p><p><br></p>
                    </div>
                    <button type="button" class="btn btn-success btn-sm float-right" onclick="confirmSubmit();" id="submitButton">Save Draft</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-header">
                Approved
            </div>
            <div class="card-body">
                <br/>
            </div>
            <div class="card-header">
                Pending
            </div>
            <div class="card-body">
                <br/>
            </div>
            <div class="card-header">
                Drafts
            </div>
            <div class="card-body">
                <br/>
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>