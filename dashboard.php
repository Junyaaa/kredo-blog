<?php
  session_start();
  require_once 'connection.php';

  if (!isset($_SESSION['account_id'])) {
    header("location: login.php");
  }else {
    function displayUserPosts()
    {
      $user_id = $_SESSION['account_id'];
      $user_name = $_SESSION['username'];

      $conn = connectDatabase();
      
      $sql = "SELECT * FROM posts INNER JOIN categories ON categories.category_name = posts.category_name WHERE posts.account_id='$user_id'";
  
      $sqlResult = $conn->query($sql);
      if ($sqlResult->num_rows > 0) {
        while ($row = $sqlResult->fetch_assoc()) {
          $userPosts[] = $row;
        }
        return $userPosts;
      }else {
        return 0;
      }
    }
  
    $showUserPosts = displayUserPosts(); 
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard Page</title>
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
      <div class="container-fluid bg-info text-white">
          <div class="col">
                <h2 class="display-1"><i class="fa-solid fa-user-gear"></i> Dashboard</h2>
          </div>
          <div class="col">
                <ul class="navbar-nav justify-content-end">
                  <li class="nav-item">
                    <a class="nav-link text-white">Welcome, <?php echo $_SESSION['username']." ";?><i class="fa-solid fa-user"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                  </li>
                </ul>
          </div> 
      </div>
   </nav>   

   <div class="container-fluid bg-light p-5">
      <div class="row">
        <div class="col">
          <a href="add-post.php" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i>Add Posts</a>
        </div>
        <div class="col">
          <a href="categories.php" class="btn btn-success w-100"><i class="fa-solid fa-plus"></i>Add Categories</a>
        </div>
        <div class="col">
          <a href="users.php" class="btn btn-warning w-100"><i class="fa-solid fa-plus"></i> Add User</a>
        </div>
      </div>
  </div>
  <!-- Main Content Page -->
  <div class="container mt-3">
    <div class="row">
      <div class="col-10 bg-light">
        <table class="table table-hover mt-3">
            <thead class="bg-dark text-white text-center">
              <th>Post ID</th>
              <th>Title</th>
              <th>Date Posted</th>
              <th>Category</th>
              <th>Post Details</th>
            </thead>
            <tbody>
                <?php
                  if (empty($showUserPosts)) {
                ?>
                  <tr>
                    <td colspan="5" class="text-danger">There is no post to show here.</td>
                  </tr>
                <?php
                  }else {
                    foreach ($showUserPosts as $posts) {
                ?>
                  <tr>
                    <td><?= $posts['post_id']?></td>
                    <td><?= $posts['post_title']?></td>
                    <td><?= $posts['posts_date']?></td>
                    <td><?= $posts['category_name']?></td>
                    <td><a href="posts-details.php" class="btn btn-info" role="button">Details</a></td>
                  </tr>
                <?php    
                    }
                
                  }
                ?>
            </tbody>
        </table>
      </div>
      <div class="col-2">
        <div class="row">
          <div class="col bg-success text-center text-white p-3">
                  <h2>Posts <i class="fa-solid fa-pen"></i></h2>
                  <?php

                      require_once 'includes/connection.inc.php';

                      function totalCountOfPosts(){
                          $conn = connectDatabase();

                          $sql = "SELECT COUNT(*) AS cnt FROM posts";
                          $sqlResult = $conn->query($sql);
                          if ($sqlResult->num_rows > 0) {
                              while ($row = $sqlResult->fetch_assoc()) {
                                  echo "<h2>".$row['cnt']."</h2>";
                              }
                          }else {
                              echo "Error retrieving no of posts";
                          }
                      }
                      $totalPosts = totalCountOfPosts();

                  ?>
                  <p><a class="text-white" href="">View</a></p>
          </div>
        </div>
        <div class="row">
          <div class="col bg-info text-center text-white p-3">
            <h2>Category <i class="fa-solid fa-folder-open"></i></h2>
            <?php

                      require_once 'includes/connection.inc.php';

                      function totalCountOfCategories(){
                          $conn = connectDatabase();

                          $sql = "SELECT COUNT(*) AS cgt FROM categories";
                          $sqlResult = $conn->query($sql);
                          if ($sqlResult->num_rows > 0) {
                              while ($row = $sqlResult->fetch_assoc()) {
                                  echo "<h2>".$row['cgt']."</h2>";
                              }
                          }else {
                              echo "Error retrieving no of categories";
                          }
                      }
                      $totalCategories = totalCountOfCategories();

                  ?>
            <p><a class="text-white" href="">View</a></p>
          </div>
        </div>
        <div class="row">
          <div class="co bg-secondary text-center text-white p-3">
            <h2>Users <i class="fa-solid fa-users"></i></h2>
            <?php

                      require_once 'includes/connection.inc.php';

                      function totalCountOfUsers(){
                          $conn = connectDatabase();

                          $sql = "SELECT COUNT(*) AS urs FROM users";
                          $sqlResult = $conn->query($sql);
                          if ($sqlResult->num_rows > 0) {
                              while ($row = $sqlResult->fetch_assoc()) {
                                  echo "<h2>".$row['urs']."</h2>";
                              }
                          }else {
                              echo "Error retrieving no of users";
                          }
                      }
                      $totalUsers = totalCountOfUsers();

                  ?>
            <p><a class="text-white" href="">View</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>