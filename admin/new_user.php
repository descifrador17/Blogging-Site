<?php include "includes/header.php";
include "../includes/db.php"?>

<?php
//adding post to database

if(isset($_POST['submit_btn'])){

    $username = $_POST['username'];
    $user_pass = $_POST['user_pass'];
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];

    $user_img = $_FILES['user_img']['name'];
    $user_img_tmp = $_FILES['user_img']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_img_tmp, "../images/$user_img");

    if(trim($username)=='' || trim($user_fname)=='' || trim($user_pass)=='' || trim($user_email)==''){
        echo "Please Enter All Mandatory Details";//not shown because of header below
    }
    else{

        $query = "SELECT randsalt FROM users";
        $result = mysqli_query($connection,$query);
        while( $row = mysqli_fetch_assoc($result)){
            $ranssalt = $row['randsalt'];
        }

        $user_pass_crypt = crypt($user_pass , $ranssalt);


        $query = "INSERT INTO users (username,user_pass,user_fname,user_lname,user_img,user_email,user_role) VALUE ";
        $query .= "('{$username}','{$user_pass_crypt}','{$user_fname}','{$user_lname}','{$user_img}','{$user_email}','{$user_role}')";
        $result = mysqli_query($connection,$query);
        if(!$result)
            die("Connection Error ".mysqli_error());
    }

    header('Location: view_users.php');
    exit;
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
                            Add New User
                        </h1>


                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group" style="width: 250px">
                                <label>Username*</label>
                                <input name="username" type="text" class="form-control">
                            </div>

                            <div class="form-group" style="width: 250px">
                                <label>Password*</label>
                                <input name="user_pass" type="password" class="form-control">
                            </div>

                            <div class="form-group" style="width: 250px">
                                <label>First Name*</label>
                                <input name="user_fname" type="text" class="form-control">
                            </div>


                            <div class="form-group" style="width: 250px">
                                <label>Last Name</label>
                                <input name="user_lname" type="text" class="form-control">
                            </div>

                            <div class="form-group" style="width: 250px">
                                <label>Email*</label>
                                <input name="user_email" type="email" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Profile Picture</label>
                                <input name="user_img" type="file">
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>Role</label>
                                <select name="user_role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="subscriber" selected>Subscriber</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <input name="submit_btn" value="Add User" type="submit" class="btn btn-primary">
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