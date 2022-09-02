<?php
    session_start();
    require_once 'connection.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .loginLabel{
            outline: none;
            border: none;
            /* border-bottom: 1px solid blue; */
            box-shadow: none !important;
        }
        .underline-blue{
            color: blue;
        }
        .loginPageLink a {
            text-decoration: none;
            padding: auto;
        }
    </style>
  </head>

  <body>
   
   <div class="container mt-5 text-center" style="width: 500px;">
        <div class="card">
            <div class="card header border-0 mt-3">
                <h2 class="text-center">Login</h2>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <input placeholder="USERNAME" type="text" name="user_name" id="user-name" class="form-control loginLabel" required>
                    <hr class="underline-blue">
                    <input placeholder="PASSWORD" type="password" name="password" id="password" class="form-control loginLabel">
                    <hr>
                    <input type="submit" name="btn_login" value="ENTER" class="form-control btn btn-success">
                    <div class="loginPageLink">
                        <a href="register.php">Create an Account</a>
                        <a href="#">Recover an Account</a>
                    </div>
                </form>
                <?php
                    if(isset($_POST['btn_login']))
                    {
                        $username = $_POST['user_name'];
                        $password = $_POST['password'];
                        
                        login($username, $password);
                    }
                    
                ?>
            </div>
        </div>
    </div>
    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    function login($username, $password){
        $conn = connectDatabase();
        
        $sql = "SELECT * FROM accounts WHERE username = '$username'";

        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $user_details = $result->fetch_assoc();

            if(password_verify($password, $user_details['password'])){
                
                // SESSION VARIABLES
                $_SESSION['username'] = $user_details['username'];
                $_SESSION['account_id'] = $user_details['account_id'];
                // echo $_SESSION['account_id'];

                if ($user_details['user_role'] == 'A') {
                    header("location: dashboard.php");
                }else {
                    header("location: profile.php");
                }

                //REDIRECTION
                //header("location: dashboard.php");
            }else{
                die("ERROR: Password Incorrect");
            }
        }else{
            die("ERROR: Username not found");
        }
    }
?>