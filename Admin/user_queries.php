<?php
require('./inc/essentials.php');
require('./inc/db_config.php');
adminLogin();

if(isset($_GET['seen'])){
    $frm_data = filteration($_GET);
    if($frm_data['seen']=='all'){
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if(update($q,$values,'i')){
            alert('success','Marked all as read!');
        }
        else{
            alert('error','Operation Failed!');
        }
    }
    else{
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1,$frm_data['seen']];
        if(update($q,$values,'ii')){
            alert('success','Marked as read!');
        }
        else{
            alert('error','Operation Failed!');
        }
    }
}
if(isset($_GET['del'])){
    $frm_data = filteration($_GET);
    if($frm_data['del']=='all'){
        $q = "DELETE FROM `user_queries`";
        if(mysqli_query($con,$q)){
            alert('success','All Data deleted');
        }
        else{
            alert('error','Operation Failed!');
        }
    }
    else{
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if(delete($q,$values,'i')){
            alert('success','Data deleted');
        }
        else{
            alert('error','Operation Failed!');
        }
    }
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>
    <?php require("./inc/links.php"); ?>
</head>

<body class="bg-light">
    <?php require('./inc/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
                <h3 class="mb-4">User Queries</h3>
                <!-- user_queries section  -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm"><i class="bi bi-check-all me-1"></i>Mark All as Read</a>
                            <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm"><i class="bi bi-trash3-fill me-1"></i>Delete All</a>
                        </div>


                        <div class="table-responsive-md" style="height: 500px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col" >First Name</th>
                                        <th scope="col" >Last Name</th>
                                        <th scope="col">Contact No</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width ="25%" >Message</th>
                                        <th scope="col" width ="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                        $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                        $data = mysqli_query($con,$q);
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($data)){
                                            $seen = '';
                                            if($row['seen']!=1){
                                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary mt-1 me-2'><i class='bi bi-check2-circle me-1'></i> Mark as read </a>";     
                                            }
                                            $seen.= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-1'> <i class='bi bi-trash3-fill me-1'></i> Delete </a>";
                                            echo<<<query
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[first_name]</td>
                                                    <td>$row[last_name]</td>
                                                    <td>$row[contact]</td>
                                                    <td>$row[email]</td>
                                                    <td>$row[message]</td>
                                                    <td>$seen</td>
                                                </tr>

                                            query;
                                            $i++;
                                        }
                                        
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- user_queries section end  -->

            </div>
        </div>
    </div>




    <?php require("./inc/scripts.php"); ?>
</body>

</html>