<h1 class="mt-5 pt-4 mb-5 text-center index_contact_h1 fw-bold h-fonts">
    CONTACT
</h1>
<div class="container mb-5">
    <div class="row justify-content-evenly index_contact_sec align-items-center px-lg-0 px-md-0 px-5">
        <div class="col-lg-7">
            <h1>CALL US <span>or</span><br>LEAVE A MESSAGES</h1>

            <p>Email us at <br>
                <a href="mailto:KK@THEAUTOFOCUS.com">KK@THEAUTOFOCUS.com</a>
            </p>


            <p>CALL US ON <br>
                <a href="tel: +91 9930013820">+91 9930013820</a>
                <a href="tel: +91 0000000000">+91 9999904969</a>
            </p>

            <a href="https://www.instagram.com/theautofocus/" class="d-inline-block mb-3" target="_blank">
                <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-instagram me-1"></i>Instagram
                </span>
            </a>

            <a href="https://www.behance.net/TheAutofocusSocial" class="d-inline-block mb-3" target="_blank">
                <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-behance me-1"></i>Behance
                </span>
            </a>

        </div>
        <div class="col-lg-5">
            <form action="" method="post">
                <div class="row justify-content-evenly align-items-center">
                    <div class="col-md-6 ps-0 mb-3">
                        <input type="text" name="first_name" class="form-control shadow-none" placeholder="FIRST NAME" required>
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <input type="text" name="last_name" class="form-control shadow-none" placeholder="LAST NAME">
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <input type="number" name="phone" class="form-control shadow-none" placeholder="PHONE">
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <input type="email" name="email" class="form-control shadow-none" placeholder="EMAIL">
                    </div>
                    <div class="col-md-12 ps-0 mb-3">
                        <input type="text" name="message" class="form-control shadow-none" placeholder="YOUR MESSAGE">
                    </div>
                    <div class="col-md-12 ps-0 mb-3 d-flex justify-content-center mt-4">
                        <button type="submit" name="index-cont" class="btn btn-c-form">submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php 
  if(isset($_POST['index-cont'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $insert_query = "INSERT INTO `user_queries`( `first_name`, `last_name`, `contact`, `email`, `message`) VALUES ('$first_name','$last_name','$phone','$email','$message')";
    $sql_execute=mysqli_query($con,$insert_query);

    if($sql_execute){
        echo "<script>alert('Your Query is Send to the Admin')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }else{
        echo "error";
    }
}




?>