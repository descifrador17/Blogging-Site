<?php include "db.php";?>
<!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>


        <?php

        $query = "SELECT * FROM posts WHERE post_status = 'published'";

        $all_categories = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($all_categories)){
            $post_id = $row['post_id'];
            $post_catID = $row['post_catID'];
            $post_title = $row['post_title'];
            $post_auth = $row['post_auth'];
            $post_date = $row['post_date'];
            $post_img = $row['post_img'];
            $post_content = substr($row['post_content'],0,200).".....";
            $post_tags = $row['post_tags'];
            $post_comm_count = $row['post_comm_count'];
            $post_status = $row['post_status'];
            $post_view_count = $row['post_view_count'];

            ?>

            <h2> <a href="./post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title?></a> </h2>
            <p class="lead">by <a href="index.php"><?php echo $post_auth?></a></p>
            <p>
                <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?>
                <span style="float:right"><?php echo $post_comm_count?> <?php echo $post_view_count?></span>
            </p>
            <hr>
            <a href="./post.php?post_id=<?php echo $post_id;?>"> <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="images/posts.jpg"></a>
            <hr>
            <p><?php echo $post_content?></p>
            <a class="btn btn-primary" href="/CMS/post.php?post_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>

        <?php } ?>

        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul>

    </div>