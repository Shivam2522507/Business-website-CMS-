<?php 

//  // frontend purpose data 
// define('SITE_URL','http://theautofocus.com/');
// define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
// define('FEATURES_IMG_PATH',SITE_URL.'images/facilities/');
// define('PHOTOGRAPHY_IMG_PATH',SITE_URL.'images/photography/');
// define('CGI_IMG_PATH',SITE_URL.'images/cgi/');
// define('VIDEO_IMG_PATH',SITE_URL.'images/films/');
// define('PHOTOGRAPHY_CAROUSEL_PATH',SITE_URL.'images/photography_Carousel/');
// define('CGI_CAROUSEL_PATH',SITE_URL.'images/cgi_Carousel/');



// // backend upload process needs this data 
// define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/images/');
// define('ABOUT_FOLDER','about/');
// define('PHOTOGRAPHY_FOLDER','photography/');
// define('CGI_FOLDER','cgi/');
// define('VIDEO_FOLDER','films/');
// define('PHOTOGRAPHY_CAROUSEL_FOLDER','photography_Carousel/');
// define('CGI_CAROUSEL_FOLDER','cgi_Carousel/');


// frontend purpose data 
define('SITE_URL','http://localhost/focus/');
define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
define('FEATURES_IMG_PATH',SITE_URL.'images/facilities/');
define('PHOTOGRAPHY_IMG_PATH',SITE_URL.'images/photography/');
define('CGI_IMG_PATH',SITE_URL.'images/cgi/');
define('VIDEO_IMG_PATH',SITE_URL.'images/films/');
define('PHOTOGRAPHY_CAROUSEL_PATH',SITE_URL.'images/photography_Carousel/');
define('CGI_CAROUSEL_PATH',SITE_URL.'images/cgi_Carousel/');



// backend upload process needs this data 
define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/focus/images/');
define('ABOUT_FOLDER','about/');
define('PHOTOGRAPHY_FOLDER','photography/');
define('CGI_FOLDER','cgi/');
define('VIDEO_FOLDER','films/');
define('PHOTOGRAPHY_CAROUSEL_FOLDER','photography_Carousel/');
define('CGI_CAROUSEL_FOLDER','cgi_Carousel/');




function adminLogin(){
    session_start();
    if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
        echo"<script>window.location.href='./index.php';</script>";
        exit;
    }
    // session_regenerate_id(true);
}

function redirect($url){
    echo"<script>window.location.href='$url';</script>";
    exit;
}

function alert($type,$msg){
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
}


function uploadImage($image,$folder)
{
    $valid_mime = ['image/jpeg','image/png','image/webp','image/svg+xml'];
    $img_mime = $image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img';  // invalid image mime or format
    }
    else if(($image['size']/(1024*1024))>1){
        return 'inv_size'; // invalid image size greater than 1 mb
    }
    else{
        $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(11111,99999).".$ext";
        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
        }
        else{
            return 'upd_failed';
        }

    }
}

function deleteImage($image,$folder)
{
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }
    else{
        return false;
    }
}


?>