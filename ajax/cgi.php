<?php
require('../Admin/inc/db_config.php');
require('../Admin/inc/essentials.php');

session_start();

if(isset($_GET['fetch_cgi'])){


    // count no of cgi 
    $count_cgi = 0;
    $output = "";

    
    // query for cgi cards 
    $cgi_res = selectAll('cgi');

  

    while($cgi_data = mysqli_fetch_assoc($cgi_res)){

       
        // get thumbnail of image
        $cgi_thumb = CGI_IMG_PATH."thumbnail.jpg";
        $thumb_q = mysqli_query($con,"SELECT * FROM `cgi_images` WHERE `cgi_id`='$cgi_data[id]' AND `thumb`='1'");
        
        if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $cgi_thumb = CGI_IMG_PATH.$thumb_res['image'];
        }

        // print cgi card
        $output.= "
        <div class='col-lg-3 col-md-4 mb-5 cgi-img'>
        <a href='./cgi_Project.php?id=$cgi_data[id]'>
            <div class='img-cont'>
                <img src='$cgi_thumb'  class='w-100 d-block'>
            </div>
            <div class='cgi-title'>
                <h6>$cgi_data[upper_text]</h6>
                <br>
                <h1>$cgi_data[middle_text]</h1>
                <br>
                <p>view details</p>
            </div>
        </a>
    </div>
            ";

            $count_cgi++;
    }


    if($count_cgi>0){
        echo $output;
    }
    else{
        echo "<h3 class='text-center text-danger'> No cgi to show!</h3>";
    }

}
