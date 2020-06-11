
<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Tags</th>
        <th>Image</th>
        <th class="col-md-1">Date</th>
        <th class="col-md-1">post_status</th>
        <th class="col-md-1">Comments</th>
        <th class="col-md-1">Views</th>
        <th class="col-md-1">Edit</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * from posts";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $post_id = $row['post_id'];
        $post_catID = $row['post_catID'];
        $post_title = $row['post_title'];
        $post_auth = $row['post_auth'];
        $post_date = $row['post_date'];
        $post_tags = $row['post_tags'];
        $post_img = $row['post_img'];
        $post_comm_count = $row['post_comm_count'];
        $post_status = $row['post_status'];
        $post_view_count = $row['post_view_count'];
        ?>

        <tr>
            <td><?php echo $post_id ?></td>
            <td><?php echo $post_title ?></td>
            <td><?php echo $post_auth ?></td>

            <?php

            $dis_cat_query = "SELECT * FROM categories WHERE cat_id={$post_catID}";
            $dis_cat_result = mysqli_query($connection,$dis_cat_query);
            while($dis_cat_row = mysqli_fetch_assoc($dis_cat_result)){
                $cat_title = $dis_cat_row['cat_title'];
                echo "<td>$cat_title</td>";
            }

            ?>

            <td><?php echo $post_tags ?></td>
            <td><img src="\CMS\images\<?php echo $post_img;?>" width="100" alt="No IMG"></td>
            <td><?php echo $post_date ?></td>
            <td><?php echo $post_comm_count ?></td>
            <td><?php echo $post_view_count ?></td>
            <td><?php echo $post_status ?></td>
            <td>
                <div>
                    <span><a href="./edit_post.php?post_id=<?php echo $post_id?>" class="fa fa-pencil "></a></span>
                    &emsp;
                    <span><a href="?source=del_post&post_id=<?php echo $post_id?>" class="fa fa-fw fa-trash "></a></span>
                </div>
            </td>
        </tr>

    <?php } ?>

    </tbody>
</table>

<div style="text-align: right">
    <button type="submit" name="add_post_button" onclick="window.location.href='./new_post.php';" class="btn btn-primary"> Add Post </button>
</div>
