<?php include "includes/header.php";
include "../includes/db.php"?>

<?php
//Updating post to database
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";

    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)) {
        $post_catID = $row['post_catID'];
        $post_title = $row['post_title'];
        $post_auth = $row['post_auth'];
        $post_date = $row['post_date'];
        $post_img = $row['post_img'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comm_count = $row['post_comm_count'];
        $post_status = $row['post_status'];
        $post_view_count = $row['post_view_count'];

    }
}


if(isset($_POST['update_btn'])){

    $post_catID = $_POST['cat_ID'];
    $post_title = $_POST['post_title'];
    $post_auth = $_POST['post_auth'];
    $post_date = date('Y-m-d');

    $post_img = $_FILES['post_img']['name'];
    $post_img_tmp = $_FILES['post_img']['tmp_name'];

    move_uploaded_file($post_img_tmp, "../images/$post_img");

    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];


    if(empty($post_img)){
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $result = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($result)){
            $post_img = $row['post_img'];
        }
    }

    $query = "UPDATE posts ";
    $query .= "SET post_catID = {$post_catID}, ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_auth = '{$post_auth}', ";
    $query .= "post_date = '{$post_date}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_img = '{$post_img}' ";
    $query .= "WHERE post_id = {$post_id}";
    $result = mysqli_query($connection,$query);

    header("Location: view_posts.php");
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
                            New Post
                            <small>Author</small>
                        </h1>

                        <?php
                        if(!$result){
                            echo "Some Error Occured";
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group" style="width: 200px">
                                <label>Post Title</label>
                                <input name="post_title" type="text" class="form-control" value="<?php echo $post_title?>">
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>Category ID</label>
                                <select name="cat_ID" class="form-control">

                                    <option value="<?php echo $post_catID?>" selected hidden></option>

                                    <?php

                                    $cat_query = "SELECT * FROM categories";
                                    $cat_result = mysqli_query($connection,$cat_query);
                                    if(!$result)
                                        echo "error";
                                    else{
                                        while($row = mysqli_fetch_assoc($cat_result)){
                                            $cat_title = $row['cat_title'];
                                            $cat_id = $row['cat_id'];

                                            echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                        }
                                    }

                                    ?>

                                </select>
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>Post Author</label>
                                <input name="post_auth" type="text" class="form-control" value="<?php echo $post_auth?>">
                            </div>

                            <div class="form-group" style="width: 160px">
                                <label>Post Status</label>
                                <select name="post_status" class="form-control">
                                    <option value="<?php echo $post_status?>" selected hidden><?php echo $post_status?></option>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Post Image</label><br>
                                <img src="\CMS\images\<?php echo $post_img;?>" alt="No Image" width="300"><br><br>
                                <input name="post_img" type="file" value="\CMS\images\<?php echo $post_img;?>">
                            </div>

                            <div class="form-group" style="width: 50%">
                                <label>Post Tags</label>
                                <input name="post_tags" type="text" class="form-control" value="<?php echo $post_tags?>">
                            </div>

                            <div class="form-group">
                                <label>Post Content</label>
                                <textarea name="post_content" class="form-control" rows="10" ><?php echo $post_content?></textarea>
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