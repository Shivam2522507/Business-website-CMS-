<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Autofocus - CGI</title>
    <?php require("./includes/links.php"); ?>
    <link rel="stylesheet" href="./css/cgi.css">
    <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">


</head>

<body>



    <!-- nav-bar -->
    <?php include("./includes/header.php"); ?>
    <!-- nav-bar-end  -->

    <div class="container-fluid m-0 p-0 hero-sec">
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
                                            <img src="$cgi_path$c_row[picture]" alt="" class="w-100 d-block">
                                        </div>
    
                                    data2;

                            $active2 = false;
                        }


                        ?>

                    </div>
                </div>
    </div>

    <div class="container">
        <div class="row justify-content-evenly align-items-center px-lg-0 px-md-0 px-2" id="cgi-data">
          
        </div>
    </div>


    <!-- hero section  -->
    <div class="hero-section container-fluid m-0 p-0">
        <div class="row m-0 p-0">
            <div class="col-lg-7 col-md-6 hero-img p-0">
                <h1>ALWAYS HAPPY <br><span>to</span> HERE FROM YOU</h1>
                <img src="./images/Contacts Image.jpg" alt="">
                <button type="button" class="expand-photo-link" data-bs-toggle="modal" data-bs-target="#contact"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>CONTACT US</button>

            </div>
            <div class="col-lg-5 col-md-6 hero-img3 p-0">
            <video autoplay muted loop>
                    <source src="./video/AutoFocus.webm" type="video/webm">
                </video>
                <a type="button" class="expand-video-link"  href="./Films.php"><i class="bi bi-arrows-angle-expand ms-1 me-3"></i>EXPAND VIDEO</a>
            </div>
        </div>
    </div>

  

    <!-- hero section end -->


    <!--Footer-->
    <?php include("./includes/footer.php"); ?>
    <!--Footer end-->


    <!-- js -->

    <script>
        let cgi_data = document.getElementById('cgi-data');

        function fetch_cgi() {

            let xhr = new XMLHttpRequest();
            xhr.open("GET", "ajax/cgi.php?fetch_cgi", true);
            xhr.onprogress = function() {
                cgi_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>`
            }

            xhr.onload = function() {
                cgi_data.innerHTML = this.responseText;

            }

            xhr.send();
        }

        fetch_cgi();
    </script>


</body>

</html>