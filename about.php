<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Autofocus - About</title>
    <?php require("./includes/links.php"); ?>
    <link rel="stylesheet" href="./css/about.css">
    <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">

</head>

<body>

    <!-- nav-bar -->
    <?php include("./includes/header.php"); ?>
    <!-- nav-bar-end  -->

    <!-- first-section  -->
    <div class="container-fluid p-0">
        <div class="kunal-about">
            <img src="./images/about/Kunal.png" alt="">
            <div class="kunal-about-text">
                <h4>KUNAL KELKAR</h4>
                <div class="kanika-con">
                    <!-- <a href="#"><i class="bi bi-facebook me-1"></i></a> -->
                    <a href="https://instagram.com/theautofocus?igshid=MmU2YjMzNjRlOQ==" target="_blank"><i class="bi bi-instagram me-1"></i></a>
                </div>
                <p>
                    There is nothing more satisfying than taking an enjoyable drive to a beautiful location in a spectacular car and then photographing that car. I live and breathe photography and automobiles.
                </p>
                <p>

                     In 2012 I decided to leave Cell Biology behind and moved back to India to make photography my career. I dabbled in fashion, lifestyle and wildlife photography before picking out automobiles as my niche. Having had some experience in these various styles of photography allows me to integrate my skills when it comes to photographing cars or bikes.
                </p>
            </div>

        </div>
    </div>
    <!-- first-section end -->
    <!-- second-section end -->
    <div class="container-fluid mt-3 p-0">
        <div class="kanika-about">
            <img src="./images/about/Kanika About.jpg" alt="">
            <div class="kanika-about-text">
                <h4>KANIKA KELKAR</h4>
                <div class="kanika-con">
                    <!-- <a href="#"><i class="bi bi-facebook me-1"></i></a> -->
                    <a href="https://instagram.com/kanikasood_?igshid=MmU2YjMzNjRlOQ==" target="_blank"><i class="bi bi-instagram me-1"></i></a>
                </div>
                <p>
                    Kanika has spent little over a decade in marketing, branding and producing creative content for the some of the most desired brands in the automotive, lifestyle and luxury space. A journey that started with a love for cameras, blended with the interest in advertising and film production. Soon the creative aspect of her personality, met the business acumen that helps her to crack this industry so well.
                    Now at The Autofocus she leads the core conceptualization team and spends most of her time in cultivating relationships with clients. While managing the process of treatments and storyboards, most importantly budgeting, scheduling and handling production for most of our work.
                    It’s taken a while to have built this ecosystem which allows her to have amazing experiences while traveling and working in over 28 countries
                </p>
            </div>

        </div>
    </div>

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
                <a type="button" class="expand-video-link" href="./Films.php"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>EXPAND VIDEO</a>

            </div>
        </div>
    </div>

    <!-- hero section end -->


    <!--Footer-->
    <?php include("./includes/footer.php"); ?>
    <!--Footer end-->


    <!-- js -->



</body>

</html>