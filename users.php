<?php

  session_start();
  require_once 'connection.php';

  function getAllUsers(){
    $conn = db_connect();
    $sql = "SELECT * FROM users";

    if( $result = $conn->query($sql)){
      while($row = $result->fetch_assoc()){
        $user_list[] = $row;
      }
      return $user_list;
    }else{
      return 0;
    }
  }

  $user_list = getAllUsers();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Users Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>

  <nav class="navbar navbar-expand-lg">
      <div class="container-fluid bg-danger text-white">
          <div class="col">
                <h4 class="display-1"><i class="fa-solid fa-user"></i> Users</h4>
          </div>
          <div class="col">
                <ul class="navbar-nav justify-content-end">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="add-post.php">Add Posts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                  </li>
                </ul>
          </div> 
      </div>
   </nav>
   <main>
     <div class="container w-75 mt-5">
        <table class="table table-hover">
          <thead class="table-dark">
            <th>ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>CONTACT NO</th>
            <th>ADDRESS</th>
            <th></th>
          </thead>
          <tbody>
            <?php
              if(empty($user_list)){
            ?>
                <tr>
                  <td colspan="6" class="text-danger">NO RECORDS FOUND</td>
                </tr>
            <?php
              }else{
                foreach($user_list as $user){
            ?>
                <tr>
                  <td><?= $user['user_id']?></td>
                  <td><?= $user['first_name']?></td>
                  <td><?= $user['last_name']?></td>
                  <td><?= $user['contact_no']?></td>
                  <td><?= $user['useraddress']?></td>
                  <td>
                    <!-- EDIT AND DELETE BUTTONS -->
                  </td>
                </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>
     </div>
   </main>
   



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>