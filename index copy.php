<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Autofocus</title>
    <?php require("./includes/links.php"); ?>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <meta name="description" content="As AI and creative tech progresses, we believe an amalgamation of photography and CGI is the way forward to achieve campaign goals smoothly and take the load off our clients.">
    <meta name="og:title" property="og:title" content="AutoFocus">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">

</head>

<body>



    <!-- nav-bar -->
    <?php include("./includes/header.php"); ?>
    <!-- nav-bar-end  -->

    <!-- hero section  -->
    <div class="hero-section container-fluid m-0 p-0">
        <div class="row m-0 p-0">
            <div class="col-lg-4 col-md-6 hero-img p-0">
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
            <div class="col-lg-4 col-md-6 hero-img2 p-0">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php

                        $cgi_path = CGI_CAROUSEL_PATH;
                        $c_carousel_R = selectAll('cgi_carousel');
                        $active2 = true;

                        while ($c_row = mysqli_fetch_assoc($c_carousel_R)) {
                            $active_class2 = ($active2) ? 'active' : '';

                            echo <<<data2
    
                                        <div class="carousel-item $active_class2">
                                            <img src="$cgi_path$c_row[picture]" alt="">
                                        </div>
    
                                    data2;

                            $active2 = false;
                        }


                        ?>

                    </div>
                </div>
                <a type="button" class="expand-cgi-link" href="./cgi.php"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>EXPAND CGI</a>


            </div>
            <div class="col-lg-4 hero-img3 p-0">
                <video autoplay muted loop>
                    <source src="./video/AutoFocus.webm" type="video/webm">
                </video>
                <!-- <img src="./images/films/films.webp" alt=""> -->
                <a type="button" class="expand-video-link" href="./Films.php"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>EXPAND VIDEO</a>

            </div>
        </div>
    </div>

    <!-- hero section end -->

    <!--project-->
    <?php include("./includes/index_project_sec.php"); ?>
    <!--project end-->

    <!--clients-->
    <?php include("./includes/index_clients.php"); ?>
    <!--clients end-->

    <!--about-->
    <?php include("./includes/index_about.php"); ?>
    <!--about end-->


    <!--SERVICES-->
    <?php include("./includes/index_services.php"); ?>
    <!--SERVICES end-->




    <!--contact-->
    <?php include("./includes/index_contact.php"); ?>
    <!--contact end-->



    <!--Footer-->
    <?php include("./includes/footer.php"); ?>
    <!--Footer end-->


    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper-clients", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });


        var swiper = new Swiper(".swiper-project", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 2,
                },

            },

        });
    </script>


</body>

</html>