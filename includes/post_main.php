<?php
include "db.php";

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    $query = "SELECT * FROM posts WHERE post_id={$post_id}";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
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
?>


<div class="col-lg-8">
    <!-- Blog Post -->
    <!-- Title -->
    <h1><?php echo $post_title;?></h1>
    <!-- Author -->
    <p class="lead">
        by <a href="#"><?php echo $post_auth;?></a>
    </p>

    <hr><!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>

    <hr><!-- Preview Image -->
    <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="">
    <hr>

    <!-- Post Content -->
    <p class="text-justify"><?php echo nl2br($post_content);?></p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->

    <?php
        if(isset($_POST['comm_submit'])){

            $comm_post_id = $_GET['post_id'];
            $comm_author = $_POST['comm_author'];
            $comm_email = $_POST['comm_email'];
            $comm_content = $_POST['comm_content'];
            $comm_status = "draft";
            $comm_date = date('Y-m-d');

            if(trim($comm_author)=='' || trim($comm_content)=='' || trim($comm_email)==''){
                echo "<p style='color: red'>Please Enter Details</p>";//not shown because of header below
            }
            else{
                $query = "INSERT INTO comments (comm_post_id,comm_author,comm_email,comm_content,comm_status,comm_date) VALUE ";
                $query .= "('{$comm_post_id}','{$comm_author}','{$comm_email}','{$comm_content}','{$comm_status}','{$comm_date}')";
                $result = mysqli_query($connection,$query);
                if(!$result)
                    die("Connection Error ".mysqli_error());
            }

            $count_query = "UPDATE posts SET post_comm_count = post_comm_count + 1 ";
            $count_query .= "WHERE post_id = {$comm_post_id}";
            $count_query_result = mysqli_query($connection,$count_query);



            header("Location: ./post.php?post_id=".$post_id);
            exit;
        }
    ?>


    <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="" method="post" role="form">
            <div class="form-group">
                <label for="comm_auth">Author</label>
                <input name="comm_author" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="comm_email">Email</label>
                <input name="comm_email" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="comm_auth">Comment</label>
                <textarea name="comm_content" class="form-control" rows="3"></textarea>
            </div>

            <button name="comm_submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <hr>

    <!-- Posted Comments -->


    <?php

    $query = "SELECT * FROM comments WHERE comm_post_id={$_GET['post_id']}";
    $result = mysqli_query($connection,$query);
    while( $row = mysqli_fetch_assoc($result)){

        $comm_author = $row['comm_author'];
        $comm_email = $row['comm_email'];
        $comm_content = $row['comm_content'];
        $comm_status = $row['comm_status'];
        $comm_date = $row['comm_date'];

        if(strcasecmp($comm_status,'publish') == 0){ ?>

            <!-- Comment -->
            <div class="media">
                <div class="pull-left">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comm_author?>
                        <small><?php echo $comm_date?></small>
                    </h4>
                    <?php echo $comm_content?>
                </div>
            </div>



            <?php
        }
    }

    ?>






</div>

