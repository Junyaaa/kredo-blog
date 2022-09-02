<?php
  session_start();
  require_once 'connection.php';

  if (isset($_SESSION['account_id'])) {
      $user_id = $_SESSION['account_id'];
      $user_name = $_SESSION['username'];
  }else {
    header("location: login.php");
  }

  function showAllUserPosts(){
    $user_id = $_SESSION['account_id'];
    $conn = connectDatabase();

    $sql = "SELECT * FROM posts INNER JOIN accounts ON accounts.account_id = posts.account_id WHERE accounts.account_id='$user_id'";
    $sqlResult = $conn->query($sql);
    if ($sqlResult->num_rows > 0) {
      while ($row = $sqlResult->fetch_assoc()) {
        $usersPosts[] = $row;
      }
      return $usersPosts;
    }else {
      echo "Error retrieving user posts.";
    }
  }
  $displayUsersPosts = showAllUserPosts();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Post Page</title>
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
                <h2 class="display-1"><i class="fa-solid fa-pen-nib"></i> Posts</h2>
          </div>
          <div class="col">
                <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white">Welcome, <?php echo $_SESSION['username']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                  </li>
                </ul>
          </div> 
      </div>
   </nav>
  <main>
    <div class="container mt-3 bg-light">
        <table class="table table-hover">
          <thead class="bg-dark text-white">
            <th>Title</th>
            <th>Date</th>
            <th>Category</th>
            <th>Message</th>
            <th>Author</th>
          </thead>
          <tbody>
            <?php
              if (empty($displayUsersPosts)) {
            ?>
              <tr>
                <td colspan="5" class="text-center text-danger">No posts to show</td>
              </tr>
            <?php
              }else{
                foreach ($displayUsersPosts as $usersPostDetails) {
            ?>   
              <tr>
                <td><?= $usersPostDetails['post_title']?></td>
                <td><?= $usersPostDetails['posts_date']?></td>
                <td><?= $usersPostDetails['category_name']?></td>
                <td><?= $usersPostDetails['posts_message']?></td>
                <td><?= $usersPostDetails['username']?></td>
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