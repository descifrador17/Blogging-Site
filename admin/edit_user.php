<?php include "includes/header.php";
include "../includes/db.php"?>

<?php
//Updating post to database
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id}";

    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $user_pass = $row['user_pass'];
        $user_fname = $row['user_fname'];
        $user_lname = $row['user_lname'];
        $user_email = $row['user_email'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];
    }
}


if(isset($_POST['update_btn'])){
    $user_id = $_GET['user_id'];
    $username = $_POST['username'];
    $user_pass = $_POST['user_pass'];
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];


    $user_img = $_FILES['user_img']['name'];
    $user_img_tmp = $_FILES['user_img']['tmp_name'];

    move_uploaded_file($user_img_tmp, "../images/$user_img");

    if(empty($user_img)){
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($result)){
            $user_img = $row['user_img'];
            $db_user_pass = $row['user_pass'];
            $db_randsalt = $row['randsalt'];
        }
    }

    if(strcmp($db_user_pass,$user_pass)!=0){
        $user_pass = crypt($user_pass , $db_randsalt);
    }


    $query = "UPDATE users ";
    $query .= "SET username = '{$username}', ";
    $query .= "user_pass = '{$user_pass}', ";
    $query .= "user_fname = '{$user_fname}', ";
    $query .= "user_lname = '{$user_lname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_img = '{$user_img}' ";
    $query .= "WHERE user_id = {$user_id}";
    $result = mysqli_query($connection,$query);

    header("Location: view_users.php");
}

?>


    <div id="wrapper">

        <!-- Navigation : SideBar and TopBar-->
        <?php include "includes/navigation.php";?>


        <!-- Main Page Data -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit User
                            </h1>

                        <?php
                        if(!$result){
                            echo "Some Error Occured";
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group" style="width: 200px">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control" value="<?php echo $username?>">
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>User Password</label>
                                <input name="user_pass" type="password" class="form-control" value="<?php echo $user_pass?>">
                            </div>


                            <div class="form-group" style="width: 200px">
                                <label>User First Name</label>
                                <input name="user_fname" type="text" class="form-control" value="<?php echo $user_fname?>">
                            </div>


                            <div class="form-group" style="width: 200px">
                                <label>User Last Name</label>
                                <input name="user_lname" type="text" class="form-control" value="<?php echo $user_lname?>">
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>User Email</label>
                                <input name="user_email" type="email" class="form-control" value="<?php echo $user_email?>">
                            </div>

                            <div class="form-group">
                                <label>User Profile Picture</label><br>
                                <img src="..\images\<?php echo $user_img;?>" alt="No Image" width="300"><br><br>
                                <input name="user_img" type="file" value="..\images\<?php echo $user_img;?>">
                            </div>

                            <div class="form-group" style="width: 160px">
                                <label>User Role</label>
                                <select name="user_role" class="form-control">
                                    <option value="<?php echo $user_role?>" selected hidden><?php echo $user_role?></option>
                                    <option value="admin">Admin</option>
                                    <option value="subscriber">Subscriber</option>
                                </select>
                            </div>

                            <div class="form-group" style="text-align: right">
                                <input name="update_btn" value="UPDATE" type="submit" class="btn btn-primary">
                            </div>

                        </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    </div>

    <!-- Footer -->
<?php include "includes/footer.php";?>