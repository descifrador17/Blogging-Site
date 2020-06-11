<?php include "db.php";
session_start();

if(isset($_POST['login_btn'])){

    $username = $_POST['username'];
    $user_pass = $_POST['user_pass'];

    $username = mysqli_real_escape_string($connection,$username);
    $user_pass = mysqli_real_escape_string($connection,$user_pass);

    $query = "SELECT * FROM users WHERE username='{$username}'";
    $result = mysqli_query($connection,$query);
    while( $row = mysqli_fetch_assoc($result)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_pass = $row['user_pass'];
        $db_user_fname	= $row['user_fname'];
        $db_user_role = $row['user_role'];
        $db_randsalt = $row['randsalt'];

    }

    $user_pass = crypt($user_pass, $db_randsalt);

    if(trim($user_pass)=='' ||trim($username)==''){
        header("Location: ../index.php");
    }

    else if(strcmp($user_pass,$db_user_pass)==0){
        if(strcasecmp($db_user_role,"admin")==0){
            $_SESSION['user_fname'] = $db_user_fname;
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['user_role'] = $db_user_role;

            header("Location: ../admin/index.php");
        }
        else{
            header("Location: ../index.php");
        }
    }

    else{
        header("Location: ../index.php");
    }
}


?>
