<?php
require('../Admin/inc/db_config.php');
require('../Admin/inc/essentials.php');

session_start();

if(isset($_GET['fetch_photography'])){


    // count no of photography 
    $count_photography = 0;
    $output = "";

    
    // query for photography cards 
    $photography_res = selectAll('photography');

  

    while($photography_data = mysqli_fetch_assoc($photography_res)){

       
        // get thumbnail of image
        $photography_thumb = PHOTOGRAPHY_IMG_PATH."thumbnail.jpg";
        $thumb_q = mysqli_query($con,"SELECT * FROM `photography_images` WHERE `photography_id`='$photography_data[id]' AND `thumb`='1'");
        
        if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $photography_thumb = PHOTOGRAPHY_IMG_PATH.$thumb_res['image'];
        }

        // print photography card
        $output.= "
        <div class='col-lg-3 col-md-4 mb-5   photography-img'>
        <a href='./photography_Project.php?id=$photography_data[id]'>
            <div class='img-cont'>
                <img src='$photography_thumb'  class='w-100 d-block'>
            </div>
            <div class='photography-title'>
                <h6>$photography_data[upper_text]</h6>
                <br>
                <h1>$photography_data[middle_text]</h1>
                <br>
                <p>view details</p>
            </div>
        </a>
    </div>
            ";

            $count_photography++;
    }


    if($count_photography>0){
        echo $output;
    }
    else{
        echo "<h3 class='text-center text-danger'> No photography to show!</h3>";
    }

}
