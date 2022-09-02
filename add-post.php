<?php
    session_start();
    require_once 'connection.php';
    if (isset($_SESSION['username'])) {
        $user_id = $_SESSION['account_id'];
        // echo "Session is set";
        // echo $user_id;
    }else {
        header("location: login.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Add Posts</title>
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
                <h2 class="display-1"><i class="fa-solid fa-pen-nib"></i> Post</h2>
          </div>
          <div class="col">
                <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                      <a href="#" class="nav-link text-dark">You are logged-in as <?php echo $_SESSION['username']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="Logout.php">Logout</a>
                  </li>
                </ul>
          </div> 
      </div>
   </nav>

        <div class="container-fluid mt-2">
            <h2 class="display-3 text-center mt-4"><i class="fa-solid fa-pencil"></i>Add Posts</h2>
        </div>
        <div class="container mt-5 mx-auto w-50">
            <form action="" method="post" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-md-10 mx-auto">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Posts Title</span>
                            <input type="text" name="title" id="" class="form-control">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10 mx-auto">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Date Posted</span>
                            <input type="date" name="datePosts" id="" class="form-control">
                        </div>                  
                    </div>
                </div>
                <?php
                    function displayCategories(){
                        $conn = connectDatabase();
                        $Qry_Categories = "SELECT * FROM categories";
                        $qry_result = $conn->query($Qry_Categories);
                        if ($qry_result->num_rows > 0) {
                            while ($row = $qry_result->fetch_assoc()) {
                                    // $cat_id = $row['category_id'];
                                    echo "<option value='".$row['category_name']."'>".$row['category_name']."</option>";
                            }
                        }
                    }   
                ?>
                <div class="form-row">
                    <div class="form-group col-md-10 mx-auto">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Category</span>
                            <select class="form-select" name="categories" id="categories">
                                <option value="#" selected disabled>--Select a category--</option>
                                <?php displayCategories(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10 mx-auto">
                        <textarea name="post_message" id="" cols="30" rows="10" class="form-control border" placeholder="Message"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10 mx-auto">
                        <button class="form-control btn btn-info mt-4" type="submit" name="btn_add_post">POST</button>
                    </div>
                </div>
                <?php
                    if (isset($_POST['btn_add_post'])) {
                            $conn = connectDatabase();
                            $post_title = $_POST['title'];
                            $date_of_posts = $_POST['datePosts'];
                            $post_category_name = $_POST['categories'];
                            $post_message = $_POST['post_message'];
                            $user_id = $_SESSION['account_id'];
                            
                            $qryAddToDb = "INSERT INTO posts(post_title, posts_date, category_name, posts_message, account_id) VALUES('$post_title', '$date_of_posts', '$post_category_name', '$post_message', '$user_id')";
                            $qryAddTODb_result = $conn->query($qryAddToDb);
                            if(!$qryAddTODb_result)
                            {
                                echo "Error adding post to db.";
                            }else {
                                echo "<div class='form-row text-center text-white bg-success mt-2'>
                                        <div class='form-group col-md-10 mx-auto'>
                                            <p>Addedd Successfully</p>
                                        </div>
                                    </div";
                            }
                    }
                ?>   
            </form>
        </div> 
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>