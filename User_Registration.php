<?php
  include('../includes/connect.php');
  include('../Functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link rel="stylesheet" href="style.css">

    <!--bootatrap css Link-->
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .card-img-top{
            height: 300px;
            width: 300px;
        }

        img{
            width: 100%;
            height: 140px;
            object-fit: contain;
            margin: 0px;
           
        }
    </style>
</head>
<body>
    
<div class='container-fluid mt-3'>
    <div class="row d-flex align-items-center ">

    <div class="col-md-6 col-sm-1 px-5 d-flex flex-column justify-content-center align-items-center mx-auto">
            
            <img class="my-0" src="../Home/images/logoblack.png" >
            <h4 class="mb-2  px-0 ">New User Register</h4>
            <img class="card-img-top justify-content-center" src="../uploads/6333050.jpg" alt="">
        </div>

    <div class="col-md-6 col-xl-6 d-flex flex-column justify-content-center align-items-center mx-0 px-3 ">
        <form action="" method="post" enctype="multipart/form-data">

            
                <div class="input-group mb-2 my-5">
                    <div class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" id="user-username" class="form-control" placeholder="Enter username" autocomplete="off" required="required" name="user_username">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" id="user-email" class="form-control" placeholder="Enter Your email" autocomplete="off" required="required" name="user_email">
                </div>

                
                    <div class="input-group mb-2">
                        <div class="input-group-text">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" id="user-password" class="form-control" placeholder="Enter Your password" autocomplete="off" required="required" name="user_password">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-text">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <input type="password" id="user-Confirmpassword" class="form-control" placeholder="Enter Your Confirm password" autocomplete="off" required="required" name="user_Confirmpassword">
                    </div>
                

                <div class="input-group mb-2">
                    <div class="input-group-text">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <input type="text" id="user-address" class="form-control" placeholder="Enter Your address" autocomplete="off" required="required" name="user_address">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-text">
                        <i class="fa-solid fa-mobile"></i>
                    </div>
                    <input type="text" id="user-number" class="form-control" placeholder="Enter Your Mobile Number" autocomplete="off" required="required" name="user_number">
                </div>

                <div class="form-outline mb-2">
                    <label for="user-image" class="form-label">Profile Image</label>
                    <input type="file" id="user-image" class="form-control" style="height: auto !important;" autocomplete="off" name="user_image">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p class='fs-8'>Already have an account? <a href="./login.php">Login</a></p>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-success float-end px-5" value="Register" name="user_register">
                    </div>
                </div>

        </form>

        <p class='text-center'>Register as</p>
        <hr class="my-1">
                    <p class=" d-inline-flex gap-1 align-center">
                        <a href=""><button aria-disabled="true" class="btn btn-secondary disabled text-center px-3 text-center ">
                        <i class="fa-brands fa-google-plus-g fa-sm"></i>  Google </button></a>

                        <a href=""><button aria-disabled="true" class="btn btn-primary disabled text-center px-3 text-center ">
                        <i class="fa-brands fa-facebook-f fa-sm"></i>    Facebook </button></a>
                    </p>
    </div>
       

    </div>
</div>


</body>
</html>


 

<?php
    
   
if(isset($_POST['user_register'])){
    $username = $_POST['user_username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    $con_Password = $_POST['user_Confirmpassword'];
    $address = $_POST['user_address'];
    $number = $_POST['user_number'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    // Assuming getIpAddress() is a custom function, adjust it accordingly
    $user_ip = getIpAddress();

    // select query
    $select_query = "SELECT * FROM user WHERE user_email = '$email'";
    $result_query = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result_query);
    
    if($rows_count > 0){
        echo "<script>alert('Email is Already Exist')</script>";
    } elseif($password!=$con_Password){
        echo "<script>alert('Passwords do not Match')</script>";
    }
    
    else {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        // insert query
        $insert_query = "INSERT INTO user (username, user_email, user_password, user_image, user_ip, user_address, user_mobile)
                        VALUES ('$username', '$email', '$hash_password', '$user_image', '$user_ip', '$address', '$number')";

        $sql_execute = mysqli_query($con, $insert_query); 

        if($sql_execute){
            echo "<script>alert('Registered Successfully, Please Login');window.location.href = './login.php';</script>";
            exit();
        }
        else{
            die(mysqli_error($con));
        }
    }
}

    
?> 