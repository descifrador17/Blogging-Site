<?php
include "../includes/db.php";

?>

<?php

if(isset($_POST['delete'])){
    $post_id = $_GET['post_id'];

    $query = "DELETE FROM posts WHERE post_id = {$post_id}";
    $result = mysqli_query($connection,$query);

    header("Location: view_posts.php");
}
?>


<h4>Are you sure you want to delete the Post?</h4>
<form action="" method="post">
    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
</form>
