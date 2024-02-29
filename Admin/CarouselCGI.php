<?php
require('./inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CGI Carousel</title>
    <?php require("./inc/links.php"); ?>
</head>

<body class="bg-light">
    <?php require('./inc/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
                <h3 class="mb-4">CGI Carousel</h3>
                
                <!-- CGI Carousel section  -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">CGI Carousel</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#CGI-carousel-s">
                                <i class="bi bi-plus-square me-1"></i> ADD
                            </button>
                        </div>
                        <div class="row" id="CGI-carousel-data">
                        </div>
                    </div>
                </div>
                <!-- CGI Carousel section end  -->

                <!-- CGI Carousel modal section  -->
                <div class="modal fade" id="CGI-carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form method="POST" id="CGI_carousel_form">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add CGI Carousel</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="CGI_carousel_picture" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" id="CGI_carousel_picture_inp" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="CGI_carousel_picture_inp.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- CGI Carousel modal section end  -->
            </div>
        </div>
    </div>


    

    <?php require("./inc/scripts.php"); ?>
    <script src="./scripts/cgi_carousel.js"></script>
</body>

</html>