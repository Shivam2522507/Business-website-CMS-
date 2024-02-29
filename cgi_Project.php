<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Autofocus-CGI Project</title>
    <?php require("./includes/links.php"); ?>
    <link rel="stylesheet" href="./css/project.css">
    <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">
    <!-- Fancybox CSS library -->
    <link rel="stylesheet" href="./fancybox/jquery.fancybox.css">

    <!-- jQuery library -->
    <script src="./scripts/jquery.min.js"></script>

    <!-- Fancybox JS library -->
    <script src="./fancybox/jquery.fancybox.js"></script>

    <script>
        $("[data-fancybox]").fancybox();
    </script>



</head>

<body>



    <!-- nav-bar -->
    <?php include("./includes/header.php"); ?>
    <!-- nav-bar-end  -->

    <?php
    if (!isset($_GET['id'])) {
        redirect('cgi.php');
    }
    $data = filteration($_GET);

    $photo_res = select("SELECT * FROM `cgi` WHERE `id`=?", [$data['id']], 'i');
    if (mysqli_num_rows($photo_res) == 0) {
        redirect('cgi.php');
    }
    $photo_data = mysqli_fetch_assoc($photo_res);

    ?>

    <div class="container-fluid m-0 p-0 hero-sec">
        <div class="row  px-lg-0 px-md-0 px-5 mt-5 mb-5">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-lg-4 ps-md-4 ps-1">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded">
                    <div class="container-fluid flex-lg-column align-items-stretch filter-nav-div">
                        <button class="navbar-toggler filter-nav-btn" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <div class=" p-3 rounded mb-3 project-titles">
                                <?php
                                $photo_quer = selectAll('cgi');
                                while ($project_title = mysqli_fetch_assoc($photo_quer)) {

                                    if($project_title['id']===$data['id']){

                                        echo <<<title
    
    
                                            <a href="./cgi_Project.php?id=$project_title[id]" class="mb-3 d-flex align-items-center justify-content-between text-danger" style="font-size:18px;">
                                                $project_title[title]
                                            </a>
    
                                        title;
                                    }
                                    else{
                                        echo <<<title
    
    
                                            <a href="./cgi_Project.php?id=$project_title[id]" class="mb-3 d-flex align-items-center justify-content-between" style="font-size:18px;">
                                                $project_title[title]
                                            </a>
    
                                        title;
                                    }
                                   
                                }

                                ?>
                                <a href="./cgi.php " class="text-dark close-project">Close Project</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9 col-md-12 px-lg-0 px-md-2 px-2" id="project-data">
            <div class="gallery">
                <?php
                $photo_data_id = $photo_data['id'];
                    // Retrieve images from the database
                    $query = $con->query("SELECT * FROM cgi_images WHERE cgi_id = $photo_data_id ORDER BY sr_no DESC");
                    
                    if($query->num_rows > 0){
                        while($row = $query->fetch_assoc()){
                            $imageThumbURL = CGI_IMG_PATH.$row["image"];
                            $imageURL = CGI_IMG_PATH.$row["image"];
                    ?>
                        <a href="<?php echo $imageURL; ?>" data-fancybox="gallery" data-caption="<?php echo $row["sr_no"]; ?>" >
                            <img src="<?php echo $imageThumbURL; ?>" alt="" />
                        </a>
                <?php }
                } ?>
            </div>
                
            </div>
        </div>
    </div>



    <!--Footer-->
    <?php include("./includes/footer.php"); ?>
    <!--Footer end-->


    <!-- js -->
   

</body>

</html>