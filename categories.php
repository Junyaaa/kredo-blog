<?php
  session_start();
  require_once 'connection.php';

  function addNewCategory($newCategory){
    if (empty($newCategory)) {
      echo "Category name is required.";
    }else {
      $conn = connectDatabase();
      $sql = "INSERT INTO categories(category_name) VALUES('$newCategory')";
      if (!$conn->query($sql))
      {
        echo "Error Adding New Category.";
      }else {
        header("location:categories.php");
      }
    }
  }

  error_reporting(0);
  function displayAllNewCategories(){
    $conn = connectDatabase();
    $sql = "SELECT * FROM categories";
      if($result = $conn->query($sql))
      {
        while ($row = $result->fetch_assoc()) {
          $allCategories[] = $row;
        }
        return $allCategories;
      }else {
        return 0;
      }
  }
  $showAllCategories = displayAllNewCategories();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Categories Page</title>
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
      <div class="container-fluid bg-success text-white">
          <div class="col">
                <h4 class="display-1"><i class="fa-solid fa-folder"></i> Categories</h4>
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
   

    <div class="container mt-2 mb-2 p-2" style="width:400px;">
      <form class="text-center" action="" method="post" autocomplete="off">
        <label for="add-categories" class="form-label">Add Category</label>
        <input type="text" name="add_categories" id="add-categories" class="form-control">
        <button class=" form-control mt-2 btn btn-success" name="btn_categories">ADD</button>
              <?php
              error_reporting(0);
                if(isset($_POST['btn_categories']))
                {
                    $newCategory = $_POST['add_categories'];
                    addNewCategory($newCategory);
                }
              ?>
      </form>
    </div>
    <main>
      <div class="container mt-2 w-50 bg-light">
        <table class="table table-hover">
          <thead class="table-dark">
                <th>ID</th>
                <th>Category Name</th>
                <th></th>
          </thead>
          <tbody>
            <?php
              if (empty($showAllCategories)) {
            ?>
                <tr>
                  <td colspan="3" class="text-danger">CATEGORY NAME NOT FOUND</td>
                </tr>
            <?php
              }else {
                foreach ($showAllCategories as $listCategory) {
            ?>
              <tr>
                  <td><?= $listCategory['category_id']?></td>
                  <td><?= $listCategory['category_name']?></td>
                  <td>
                    
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