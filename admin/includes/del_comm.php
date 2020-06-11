<?php
include "../includes/db.php";

?>

<?php

if(isset($_POST['delete'])){
    $comm_id = $_GET['comm_id'];

    $query = "DELETE FROM comments WHERE comm_id = {$comm_id}";
    $result = mysqli_query($connection,$query);

    header("Location: comments.php");
}
?>


<h4>Are you sure you want to delete the Post?</h4>
<form action="" method="post">
    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
</form>
