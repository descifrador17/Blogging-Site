<?php
include "../includes/db.php";

?>

<?php

if(isset($_POST['delete'])){
    $user_id = $_GET['user_id'];

    $query = "DELETE FROM users WHERE user_id = {$user_id}";
    $result = mysqli_query($connection,$query);

    header("Location: view_users.php");
}
?>


<h4>Are you sure you want to delete the User?</h4>
<form action="" method="post">
    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
</form>
