<?php
    session_start();
    require_once 'connection.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Register Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .registerLabel{
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
                <h2 class="text-center">Register</h2>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <input placeholder="First Name" type="text" name="user_first_name" id="first-name" class="form-control registerLabel" required>
                    <hr class="underline-blue">
                    <input placeholder="Last Name" type="text" name="user_last_name" id="last-name" class="form-control registerLabel" required>
                    <hr>
                    <input placeholder="Address" type="text" name="user_address" id="user-address" class="form-control registerLabel">
                    <hr>
                    <input placeholder="Contact No" type="number" name="user_contact_no" id="user-contact-no" class="form-control registerLabel">
                    <hr>
                    <input placeholder="Username" type="text" name="user_name" id="user-name" class="form-control registerLabel" required>
                    <hr>
                    <input placeholder="Password" type="password" name="user_password" id="user-password" class="form-control registerLabel" required>
                    <hr>
                    <input type="submit" name="btn-submit" value="Register" class="form-control btn btn-success">
                    <hr>
                    <div class="loginPageLink">
                        <p>Already have an account? <a href="login.php">Login</a></p>
                    </div>
                    <?php
                            if(isset($_POST['btn-submit'])){
                                $databaseConnection = db_connect();
                                $firstName = $_POST['user_first_name'];
                                $lastName = $_POST['user_last_name'];
                                $contactNo = $_POST['user_contact_no'];
                                $address = $_POST['user_address'];
                                $username = $_POST['user_name'];
                                //encrypt the password with password_hash()
                                $encryptedPass = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

                                //query db to check for username
                                $sqlCheckDb = "SELECT username FROM accounts WHERE username='$username'";
                                if ($rows = $databaseConnection->query($sqlCheckDb)) {
                                    if ($rows->num_rows == 1) {
                                        $row_data = $rows->fetch_assoc();
                                        //$row_data['username'];
                                        if ($row_data['username'] == $username) {
                                            echo "<div class='bg-danger text-center text-danger text-white '>Username already exists</div>";        
                                        }
                                    }else {
                                        // //create sql to insert data to accounts table in the database
                                        $sqlInsertIntoAccountsTbl = "INSERT INTO accounts(username, password) VALUES('$username', '$encryptedPass')";

                                        if($databaseConnection->query($sqlInsertIntoAccountsTbl)){
                                            //get the last id inserted
                                            $last_inserted_id = $databaseConnection->insert_id;
                                            $sqlInsertIntoUsersTbl = "INSERT INTO users(first_name, last_name, contact_no, useraddress, avatar, bio, account_id) VALUES('$firstName', '$lastName', '$contactNo', '$address', null, null, '$last_inserted_id')";
                                            if($databaseConnection->query($sqlInsertIntoUsersTbl)){
                                                header("location: login.php");
                                            }else {
                                                die("Error creating accounts. " . $databaseConnection->connect_error);
                                            }
                                        } 
                                    }
                                    
                                }                                
                            }
                        ?>
                </form>
            </div>
        </div>
    </div>
    




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>