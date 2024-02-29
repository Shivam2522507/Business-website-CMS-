<?php
require('../Admin/inc/db_config.php');
require('../Admin/inc/essentials.php');

session_start();

if(isset($_GET['fetch_video'])){


    // count no of video 
    $count_video = 0;
    $output = "";

    
    // query for video cards 
    $video_res = selectAll('video');

  

    while($video_data = mysqli_fetch_assoc($video_res)){

       
        // get thumbnail of image
        $video_thumb = VIDEO_IMG_PATH."thumbnail.jpg";
        $thumb_q = mysqli_query($con,"SELECT * FROM `video_images` WHERE `video_id`='$video_data[id]' AND `thumb`='1'");
        
        if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $video_thumb = VIDEO_IMG_PATH.$thumb_res['image'];
        }

        // print video card
        $output.= "
        <div class='col-lg-3 col-md-4 mb-5 video-img'>
        <iframe title='vimeo-player' src='$video_data[link]'  frameborder='0'    allowfullscreen></iframe>
        
    </div>
            ";

            $count_video++;
    }


    if($count_video>0){
        echo $output;
    }
    else{
        echo "<h3 class='text-center text-danger'> No video to show!</h3>";
    }

}
