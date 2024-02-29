<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

  if(isset($_POST['add_cgi']))
  {
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `cgi`(`title`, `upper_text`, `middle_text`) VALUES (?,?,?)";
    $values = [$frm_data['title'],$frm_data['upper_text'],$frm_data['middle_text']];
    if(insert($q1,$values,'sss')){
      $flag = 1;
    }

    $cgi_id = mysqli_insert_id($con);

    
    if($flag){
      echo 1;
    }
    else{
      echo 0;
    }
  }

  if(isset($_POST['get_all_cgi']))
  {
    $res = selectAll('cgi');
    $i=1;
    $data = "";
    while($row = mysqli_fetch_assoc($res))
    {
     $data.="
     <tr class='align-middle'>
        <td>$i</td>
        <td>$row[title]</td>
        <td>$row[upper_text]</td>
        <td>$row[middle_text]</td>
        <td>
            <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-cgi'>
              <i class='bi bi-pencil-square me-1'></i>
            </button>
            <button type='button' onclick=\"cgi_images($row[id],'$row[title]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#cgi-images'>
              <i class='bi bi-images me-1'></i>
            </button>
            <button type='button' onclick='remove_cgi($row[id])' class='btn btn-danger shadow-none btn-sm'>
              <i class='bi bi-trash me-1'></i>
            </button>
        </td>
      </tr>  
     ";
     $i++;
      
    }
    echo $data;
  }

  if(isset($_POST['get_cgi']))
  {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `cgi` WHERE `id`=?",[$frm_data['get_cgi']],'i');

    $cgidata = mysqli_fetch_assoc($res1);
    
  

    $data = ["cgidata"=> $cgidata];
    $data = json_encode($data);
    
    echo $data;
 
  }

  if(isset($_POST['edit_cgi']))
  {
   
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `cgi` SET `title`=?,`upper_text`=?,`middle_text`=? WHERE `id`=?";
    $values = [$frm_data['title'],$frm_data['upper_text'],$frm_data['middle_text'],$frm_data['cgi_id']];
    if(update($q1,$values,'sssi')){
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
    $img_r = uploadImage($_FILES['image'],CGI_FOLDER);
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
        $q = "INSERT INTO `cgi_images`(`cgi_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['cgi_id'],$img_r];
        $res = insert($q,$values,'is');
        echo $res;
    }
}


  if(isset($_POST['get_cgi_images']))
{   
    $frm_data = filteration($_POST) ;
    $res = select("SELECT * FROM `cgi_images` WHERE `cgi_id`=?",[$frm_data['get_cgi_images']],'i');

    $path= CGI_IMG_PATH; 

    while($row = mysqli_fetch_assoc($res)){

      if($row['thumb']==1){
        $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
      }
      else{
        $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[cgi_id])' class='btn btn-secondary shadow-none'><i class='bi bi-check-lg'></i></button>";
      }


      echo<<<data
          <tr class='align-middle'>
            <td><img src = '$path$row[image]' class='img-fluid'></td>
            <td>$thumb_btn</td>
            <td>
              <button onclick='rem_image($row[sr_no],$row[cgi_id])' class='btn btn-danger shadow-none'>
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
    $values = [$frm_data['image_id'],$frm_data['cgi_id']];

    $pre_q = "SELECT * FROM `cgi_images` WHERE `sr_no`=? AND `cgi_id`=?";
    $res = select($pre_q,$values,'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],CGI_FOLDER)){
      $q = "DELETE FROM `cgi_images` WHERE `sr_no`=? AND `cgi_id`=?";
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
 
    $pre_q = "UPDATE `cgi_images` SET `thumb`=? WHERE `cgi_id`=?";
    $pre_v = [0, $frm_data['cgi_id']];
    $pre_res = update($pre_q,$pre_v,'ii');

    $q = "UPDATE `cgi_images` SET `thumb`=? WHERE `sr_no`=? AND `cgi_id`=?";
    $v = [1, $frm_data['image_id'],$frm_data['cgi_id']];
    $res = update($q,$v,'iii');

    echo $res;

}
  if(isset($_POST['remove_cgi']))
{   
    $frm_data = filteration($_POST) ;

    $res1 = select("SELECT * FROM `cgi_images` WHERE `cgi_id`=?",[$frm_data['cgi_id']],'i');

    while($row = mysqli_fetch_assoc($res1)){
      deleteImage($row['image'],CGI_FOLDER);  
    }

    $res2= delete("DELETE FROM `cgi_images` WHERE `cgi_id`=?",[$frm_data['cgi_id']],'i');
    $res3= delete("DELETE FROM `cgi` WHERE `id`=?",[$frm_data['cgi_id']],'i');

    if($res2 || $res3){
      echo 1;
    }
    else{
      echo 0;
    }
  

}



