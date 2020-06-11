<?php

if(isset($_GET['change_role_btn'])){
    $user_role = $_GET['choice'];
    $user_id = $_GET['change_role_btn'];
    $query = "UPDATE users SET user_role='{$user_role}' WHERE user_id = {$user_id}";
    $result = mysqli_query($connection,$query);
    if($result){
        header("Location: ./view_users.php");
        exit;
    }
    else{
        echo "fail";
    }
}
?>


<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>DP</th>
        <th>Role</th>
        <th class="col-md-2" style="text-align: center">Delete / Edit Role</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * from users";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_fname	= $row['user_fname'];
        $user_lname	= $row['user_lname'];
        $user_email	= $row['user_email'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];

        ?>

        <tr>
            <td><?php echo $user_id ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $user_fname ?></td>
            <td><?php echo $user_lname ?></td>
            <td><?php echo $user_email ?></td>
            <td><img src="\CMS\images\<?php echo $user_img;?>" width="100" alt="No IMG"></td>
            <td><?php echo $user_role ?></td>
            <td>
                <div>
                    <div class="col-md-1">
                        <a href="./edit_user.php?user_id=<?php echo $user_id?>" class="fa fa-fw fa-pencil " style="margin-top: 10px"></a>
                    </div>
                    <div class="col-md-1">
                        <a href="?source=del_user&user_id=<?php echo $user_id?>" class="fa fa-fw fa-trash " style="margin-top: 10px"></a>
                    </div>
                    <div class="col-md-1">
                        <form class="form-group" style="width: 240px;" method="get">
                            <div class="col-xs-6">
                                <select class="form-control" name="choice">
                                    <option value="admin" selected>Admin</option>
                                    <option value="subscriber">Subscriber</option>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <button name="change_role_btn" value="<?php echo $user_id?>" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </td>
        </tr>

    <?php } ?>

    </tbody>
</table>

<div style="text-align: right">
    <button type="submit" name="add_user_button" onclick="window.location.href='./new_user.php';" class="btn btn-primary"> Add User </button>
</div>
