<?php
    session_start();
    require_once 'connection.php';

    function totalCountOfPosts(){
        $conn = connectDatabase();

        $sql = "SELECT COUNT(*) AS cnt FROM posts";
        $sqlResult = $conn->query($sql);
        if ($sqlResult->num_rows > 0) {
            while ($row = $sqlResult->fetch_assoc()) {
                echo $row['cnt'];
            }
        }else {
            echo "Error retrieving no of posts";
        }
    }
    $totalPosts = totalCountOfPosts();
?>