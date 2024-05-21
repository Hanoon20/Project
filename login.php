<?php
  include('../includes/connect.php');
  include('../Functions/common_functions.php');


  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

<link rel="stylesheet" href="style.css">

     <!--bootatrap css Link-->
     <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .card-img-top{
            height: 350px;
            width: 350px;
        }

        .username {
            width: 100%;
        }

        .logo {
            width: 100%; /* You can adjust this as needed */
            max-height: 400px; /* Adjust the maximum height */
            padding: 0;
            margin: 0 auto; /* Center the image horizontally */
            align-items: center; /* Center content vertically */
           
        }



    </style>

</head>
<body>
<div class='container-fluid mt-3'>
    <div class="row d-flex align-items-center ">
        
        <div class="col-md-6 col-sm-1 px-5 d-flex flex-column justify-content-center align-items-center mx-auto">
            <h2 class="text-center">Login</h2>
            <img class="card-img-top" src="../uploads/4707071.jpg" alt="">
        </div>

        <div class="col-md-6 col-xl-4  px-5 mx-5 mt-5 flex-column justify-content-center align-items-center mx-auto">
            <form action="" method="post" enctype="multipart/form-data">

                <img class="my-0 mb-1 logo" src="../Home/images/logoblack.png" >

                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" placeholder="Username" class="form-control" required="required" name="username">
                </div>
            
                <div class="input-group">
                    <div class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" placeholder="Password" class="form-control" required="required" name="password">
                </div>

                <div class="row d-flex justify-content-end align-items-center mt-3">
                    <div class="col-sm-6 text-end">
                        <input type="submit" value="Signin" class="btn btn-primary text-center px-5" name="Login">
                    </div>
                </div>
               
                <div class="d-flex align-items-center">
                    <p class="justify-content-start mb-0">Dont't have an account?  
                        <a href="./User_Registration.php" class="ml-3 justify-content-start">Register </a> </p>
                       
                </div>
                <br><br><br>
                
            </form>
            <p class='text-center'>Login as</p>
            <hr>
            <p class="d-inline-flex gap-1 align-center justify-content-center mx-auto">
                <a href="../Home/index.php"><button aria-disabled="true" class="btn btn-success text-center px-3">
                    + Guest </button></a>

                <a href=""><button aria-disabled="true" class="btn btn-secondary disabled text-center px-3 mx-auto ">
                    <i class="fa-brands fa-google-plus-g fa-sm"></i>  Google </button></a>

                <a href=""><button aria-disabled="true" class="btn btn-primary disabled text-center px-3 mx-auto ">
                    <i class="fa-brands fa-facebook-f fa-sm"></i>    Facebook </button></a>
            </p>

        </div>
    </div>
</div>




</body>
</html>


<?php



        if(isset($_POST['Login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $select_query = "SELECT * FROM `user` WHERE username='$username'";

            $result = mysqli_query($con, $select_query);
            $row_count = mysqli_num_rows($result);
            
            if($row_count > 0){
                $row_data = mysqli_fetch_assoc($result);
                // Assuming password is hashed in the database
                if (password_verify($password, $row_data['user_password'])) {
                    echo "<script>alert('Login Successful');window.location.href = '../Home/index.php';</script>";

                    $_SESSION['user_id'] = $row_data['user_id'];
                    $_SESSION['username'] = $row_data['username'];

                } else {
                    echo "<script>alert('Invalid Password')</script>";
                }
            } else {
                echo "<script>alert('Invalid Username')</script>";
            }
        }
?>
