<div class="container-fluide mt-5">
    <div class="our-projects">
        <div class="project-text">
            <h1 class="h-fonts text-center">DRIVE IT ALL THE WAY</h1>
            <p class="text-center">Go Through some of our recent projects</p>
        </div>
        <div class="project-img container mt-3">
            <div class="swiper swiper-project">
                <div class="swiper-wrapper mb-5">
                    <?php
                        $photography_res = mysqli_query($con,"SELECT * FROM `photography` ORDER BY id DESC LIMIT 5");
                        while($photography_data = mysqli_fetch_assoc($photography_res)){

       
                            // get thumbnail of image
                            $photography_thumb = PHOTOGRAPHY_IMG_PATH."thumbnail.jpg";
                            $thumb_q = mysqli_query($con,"SELECT * FROM `photography_images` WHERE `photography_id`='$photography_data[id]' AND `thumb`='1'");
                            
                            if(mysqli_num_rows($thumb_q)>0){
                                $thumb_res = mysqli_fetch_assoc($thumb_q);
                                $photography_thumb = PHOTOGRAPHY_IMG_PATH.$thumb_res['image'];
                            }
                    
                            // print photography card
                

                                echo <<<output

                                    <div class="swiper-slide bg-white">
                                        <a href='./photography_Project.php?id=$photography_data[id]'>
                                            <img src="$photography_thumb" class="w-100 d-block" />
                                        </a>
                                    </div>

                                output;
                    
                               
                        }
                    ?>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

</div>