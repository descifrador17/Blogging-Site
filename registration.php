<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navbar.php"; ?>
    
    <?php
    //registration

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $user_pass = $_POST['password'];
        $user_email = $_POST['email'];

        $username = mysqli_real_escape_string($connection,$username);
        $user_pass = mysqli_real_escape_string($connection,$user_pass);
        $user_email = mysqli_real_escape_string($connection,$user_email);

        if(trim($username)=='' || trim($user_pass)=='' || $user_email==''){
            header("Location: registration.php");
        }

        $query = "SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result)>0){
            echo "<div style='color: red;' class='col-xs-6 col-xs-offset-3'><strong>username taken</strong></div>";
        }

        $query = "SELECT * FROM users WHERE user_email='{$user_email}'";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result)>0){
            echo "<div style='color: red;' class='col-xs-6 col-xs-offset-3'><strong>Email taken</strong></div>";
        }

        else {
            $query = "SELECT randsalt FROM users";
            $result = mysqli_query($connection,$query);
            while( $row = mysqli_fetch_assoc($result)){
                $ranssalt = $row['randsalt'];
            }

            $user_pass_crypt = crypt($user_pass , $ranssalt);

            $query = "INSERT INTO users (username,user_pass,user_email)";
            $query .= "VALUES ('{$username}','{$user_pass_crypt}','{$user_email}')";
            $result = mysqli_query($connection,$query);

            header("Location: index.php");
        }
    }
    ?>


    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
