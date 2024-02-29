<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Autofocus-Films</title>
    <?php require("./includes/links.php"); ?>
    <link rel="stylesheet" href="./css/films.css">
    <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">


</head>

<body>



    <!-- nav-bar -->
    <?php include("./includes/header.php"); ?>
    <!-- nav-bar-end  -->

    <div class="container-fluid m-0 p-0 hero-sec">
        <video autoplay muted loop>
            <source src="./video/AutoFocus.webm" type="video/webm">
        </video>
    </div>

    <div class="container">
        <div class="row justify-content-evenly align-items-center px-lg-0 px-md-0 px-5" id="video-data">

        </div>
    </div>


    <!-- hero section  -->
    <div class="hero-section container-fluid m-0 p-0">
        <div class="row m-0 p-0">
            <div class="col-lg-7 col-md-6 hero-img p-0">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php

                        $photo_path = PHOTOGRAPHY_CAROUSEL_PATH;
                        $p_carousel_R = selectAll('photography_carousel');
                        $active1 = true;

                        while ($p_row = mysqli_fetch_assoc($p_carousel_R)) {
                            $active_class1 = ($active1) ? 'active' : '';

                            echo <<<data1
        
                                            <div class="carousel-item $active_class1">
                                                <img src="$photo_path$p_row[picture]" alt="">
                                            </div>
        
                                        data1;

                            $active1 = false;
                        }


                        ?>
                    </div>
                </div>
                <a type="button" class="expand-photo-link" href="./photography.php"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>EXPAND PHOTO</a>

            </div>
            <div class="col-lg-5 col-md-6 hero-img3 p-0">
                <h1>ALWAYS HAPPY <br><span>to</span> HERE FROM YOU</h1>
                <img src="./images/Contacts Image.jpg" alt="">
                <button type="button" class="expand-video-link" data-bs-toggle="modal" data-bs-target="#contact"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>CONTACT US</button>

            </div>
        </div>
    </div>

    <!-- hero section end -->


    <!--Footer-->
    <?php include("./includes/footer.php"); ?>
    <!--Footer end-->


    <!-- js -->

    <script>
        let video_data = document.getElementById('video-data');

        function fetch_video() {

            let xhr = new XMLHttpRequest();
            xhr.open("GET", "ajax/video.php?fetch_video", true);
            xhr.onprogress = function() {
                video_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>`
            }

            xhr.onload = function() {
                video_data.innerHTML = this.responseText;

            }

            xhr.send();
        }

        fetch_video();
    </script>


</body>

</html>