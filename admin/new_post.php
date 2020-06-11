<?php include "includes/header.php";
include "../includes/db.php"?>

<?php
//adding post to database

if(isset($_POST['submit_btn'])){

    $post_title = $_POST['post_title'];
    $post_catID = $_POST['cat_ID'];
    $post_auth = $_POST['post_auth'];
    $post_status = $_POST['post_status'];

    $post_img = $_FILES['post_img']['name'];
    $post_img_tmp = $_FILES['post_img']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date("Y-m-d");

    move_uploaded_file($post_img_tmp, "../images/$post_img");

    if(trim($post_title)=='' || trim($post_catID)=='' || trim($post_auth)=='' || trim($post_tags)==''){
        echo "Please Enter Category Name";//not shown because of header below
    }
    else{
        $query = "INSERT INTO posts (post_catID,post_title,post_auth,post_date,post_img,post_content,post_tags,post_status) VALUE ";
        $query .= "('{$post_catID}','{$post_title}','{$post_auth}','{$post_date}','{$post_img}','{$post_content}','{$post_tags}','{$post_status}')";
        $result = mysqli_query($connection,$query);
        if(!$result)
            die("Connection Error ".mysqli_error());
    }

    header('Location: view_posts.php');
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
                            New Post
                            <small>Author</small>
                        </h1>


                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group" style="width: 200px">
                                <label>Post Title</label>
                                <input name="post_title" type="text" class="form-control">
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>Category ID</label>
                                <select name="cat_ID" class="form-control">

                                    <?php

                                    $cat_query = "SELECT * FROM categories";
                                    $cat_result = mysqli_query($connection,$cat_query);
                                    if(!$cat_result)
                                        echo "error";
                                    else{
                                        while($row = mysqli_fetch_assoc($cat_result)){
                                            $cat_title = $row['cat_title'];
                                            $cat_id = $row['cat_id'];
                                            echo $cat_title;

                                            echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                        }
                                    }

                                    ?>

                                </select>
                            </div>

                            <div class="form-group" style="width: 200px">
                                <label>Post Author</label>
                                <input name="post_auth" type="text" class="form-control">
                            </div>

                            <div class="form-group" style="width: 160px">
                                <label>Post Status</label>
                                <select name="post_status" class="form-control">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Post Image</label>
                                <input name="post_img" type="file">
                            </div>

                            <div class="form-group" style="width: 50%">
                                <label>Post Tags</label>
                                <input name="post_tags" type="text" class="form-control">
                            </div>

                            <div class="form-group" >
                                <label>Post Content</label>
                                <textarea name="post_content" class="form-control" rows="10" id="editor"></textarea>
                            </div>

                            <script>
                                ClassicEditor
                                    .create( document.querySelector( '#editor' ) )
                                    .catch( error => {
                                        console.error( error );
                                    } );
                            </script>

                            <div class="form-group" style="text-align: right">
                                <input name="submit_btn" value="SUBMIT" type="submit" class="btn btn-primary">
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