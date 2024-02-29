<?php
require('./inc/essentials.php');
require('./inc/db_config.php');
adminLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Photography</title>
    <?php require("./inc/links.php"); ?>
</head>

<body class="bg-light">
    <?php require('./inc/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
                <h3 class="mb-4">PHOTOGRAPHY</h3>
                <!-- Photography section  -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-photography">
                                <i class="bi bi-plus-square me-1"></i> ADD
                            </button>
                        </div>
                        <div class="table-responsive" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Project Title</th>
                                        <th scope="col">Hover Upper Text</th>
                                        <th scope="col">Hover Middle Text</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="photography-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- photography section end  -->
            </div>
        </div>
    </div>

    <!--Add photography modal section  -->
    <div class="modal fade" id="add-photography" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form method="POST" id="add_photography_form" autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Photography</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Project Title</label>
                                <input type="text" name="title" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hover Upper Text</label>
                                <input type="text" name="upper_text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hover Middle Text</label>
                                <input type="text" name="middle_text" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SAVE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Add photography modal section end  -->
    <!--Edit photography modal section  -->
    <div class="modal fade" id="edit-photography" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form method="POST" id="edit_photography_form" autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit photography</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Project Title</label>
                                <input type="text" name="title" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hover Upper Text</label>
                                <input type="text" name="upper_text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hover Middle Text</label>
                                <input type="text" name="middle_text" class="form-control shadow-none" required>
                            </div>

                            <input type="hidden" name="photography_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SAVE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--edit photography modal section end  -->
    <!--Manage photography images modal section  -->
    <div class="modal fade" id="photography-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Photography Title</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                            <button class="btn custom-bg text-white shadow-none">ADD</button>
                            <input type="hidden" name="photography_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="photography-image-data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Manage photography images modal section end  -->

    <?php require("./inc/scripts.php"); ?>
    <script src="./scripts/photography.js"></script>



</body>

</html>