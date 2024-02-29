<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <?php 
    session_start();
    require ('./Admin/inc/db_config.php');
    require ('./Admin/inc/essentials.php');


    if(isset($_POST['mess_send'])){
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