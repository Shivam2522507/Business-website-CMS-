<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

  if(isset($_POST['add_video']))
  {
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `video`(`link`) VALUES (?)";
    $values = [$frm_data['link']];
    if(insert($q1,$values,'s')){
      $flag = 1;
    }

    $video_id = mysqli_insert_id($con);

    
    if($flag){
      echo 1;
    }
    else{
      echo 0;
    }
  }

  if(isset($_POST['get_all_video']))
  {
    $res = selectAll('video');
    $i=1;
    $data = "";
    while($row = mysqli_fetch_assoc($res))
    {
     $data.="
     <tr class='align-middle'>
        <td>$i</td>
        <td>$row[link]</td>
        <td>
            <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-video'>
              <i class='bi bi-pencil-square me-1'></i>
            </button>
            <button type='button' onclick='remove_video($row[id])' class='btn btn-danger shadow-none btn-sm'>
              <i class='bi bi-trash me-1'></i>
            </button>
        </td>
      </tr>  
     ";
     $i++;
      
    }
    echo $data;
  }

  if(isset($_POST['get_video']))
  {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `video` WHERE `id`=?",[$frm_data['get_video']],'i');

    $videodata = mysqli_fetch_assoc($res1);
    
  

    $data = ["videodata"=> $videodata];
    $data = json_encode($data);
    
    echo $data;
 
  }

  if(isset($_POST['edit_video']))
  {
   
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `video` SET `link`=? WHERE `id`=?";
    $values = [$frm_data['link'],$frm_data['video_id']];
    if(update($q1,$values,'si')){
        $flag = 1;
    }


    if($flag){
      echo 1;
    }
    else{
      echo 0;
    }

  }


  if(isset($_POST['add_image']))
{   
    $frm_data = filteration($_POST) ;
    $img_r = uploadImage($_FILES['image'],VIDEO_FOLDER);
    if($img_r == 'inv_img'){
        echo $img_r;
    }
    else if($img_r == 'inv_size'){
        echo $img_r;
    }
    else if($img_r == 'upd_failed'){
        echo $img_r;
    }
    else{
        $q = "INSERT INTO `video_images`(`video_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['video_id'],$img_r];
        $res = insert($q,$values,'is');
        echo $res;
    }
}


  if(isset($_POST['get_video_images']))
{   
    $frm_data = filteration($_POST) ;
    $res = select("SELECT * FROM `video_images` WHERE `video_id`=?",[$frm_data['get_video_images']],'i');

    $path= VIDEO_IMG_PATH; 

    while($row = mysqli_fetch_assoc($res)){

      if($row['thumb']==1){
        $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
      }
      else{
        $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[video_id])' class='btn btn-secondary shadow-none'><i class='bi bi-check-lg'></i></button>";
      }


      echo<<<data
          <tr class='align-middle'>
            <td><img src = '$path$row[image]' class='img-fluid'></td>
            <td>$thumb_btn</td>
            <td>
              <button onclick='rem_image($row[sr_no],$row[video_id])' class='btn btn-danger shadow-none'>
                <i class='bi bi-trash'></i>
              </button>
            </td>
          </tr>

      data;
    }
}

  if(isset($_POST['rem_image']))
{   
    $frm_data = filteration($_POST) ;
    $values = [$frm_data['image_id'],$frm_data['video_id']];

    $pre_q = "SELECT * FROM `video_images` WHERE `sr_no`=? AND `video_id`=?";
    $res = select($pre_q,$values,'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],VIDEO_FOLDER)){
      $q = "DELETE FROM `video_images` WHERE `sr_no`=? AND `video_id`=?";
      $res = delete($q,$values,'ii');
      echo $res;
    }
    else{
      echo 0;
    }
}


  if(isset($_POST['thumb_image']))
{   
    $frm_data = filteration($_POST) ;
 
    $pre_q = "UPDATE `video_images` SET `thumb`=? WHERE `video_id`=?";
    $pre_v = [0, $frm_data['video_id']];
    $pre_res = update($pre_q,$pre_v,'ii');

    $q = "UPDATE `video_images` SET `thumb`=? WHERE `sr_no`=? AND `video_id`=?";
    $v = [1, $frm_data['image_id'],$frm_data['video_id']];
    $res = update($q,$v,'iii');

    echo $res;

}
  if(isset($_POST['remove_video']))
{   
    $frm_data = filteration($_POST) ;

    $res1 = select("SELECT * FROM `video_images` WHERE `video_id`=?",[$frm_data['video_id']],'i');

    while($row = mysqli_fetch_assoc($res1)){
      deleteImage($row['image'],VIDEO_FOLDER);  
    }

    $res2= delete("DELETE FROM `video_images` WHERE `video_id`=?",[$frm_data['video_id']],'i');
    $res3= delete("DELETE FROM `video` WHERE `id`=?",[$frm_data['video_id']],'i');

    if($res2 || $res3){
      echo 1;
    }
    else{
      echo 0;
    }
  

}



