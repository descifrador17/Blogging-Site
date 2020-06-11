
<?php

if(isset($_GET['change_stat_btn'])){
    $comm_status = $_GET['choice'];
    $comm_id = $_GET['change_stat_btn'];
    $query = "UPDATE comments SET comm_status='{$comm_status}' WHERE comm_id = {$comm_id}";
    $result = mysqli_query($connection,$query);
    if($result){
        header("Location: ./comments.php");
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
        <th>Author</th>
        <th>Email</th>
        <th>Content</th>
        <th>Post</th>
        <th class="col-md-1">Status</th>
        <th class="col-md-1">Date</th>
        <th class="col-md-2">Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * from comments";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $comm_id = $row['comm_id'];

        $comm_post_id = $row['comm_post_id'];

        $post_name_query = "SELECT * FROM posts where post_id={$comm_post_id}";
        $post_name_result = mysqli_query($connection,$post_name_query);
        while($post_name_row = mysqli_fetch_assoc($post_name_result)){
            $comm_post = $post_name_row['post_title'];
        }


        $comm_author = $row['comm_author'];
        $comm_email = $row['comm_email'];
        $comm_content = substr($row['comm_content'],0,100);
        $comm_status = $row['comm_status'];
        $comm_date = $row['comm_date'];

        ?>

        <tr>
            <td><?php echo $comm_id ?></td>
            <td><?php echo $comm_author ?></td>
            <td><?php echo $comm_email ?></td>
            <td><?php echo $comm_content ?></td>
            <td><a href="../post.php?post_id=<?php echo $comm_post_id?>"><?php echo $comm_post ?></td></a>
            <td><?php echo $comm_status ?></td>
            <td><?php echo $comm_date ?></td>
            <td>
                <div>
                    <div class="col-md-2">
                        <a href="?source=del_comm&comm_id=<?php echo $comm_id?>" class="fa fa-fw fa-trash fa-2x " style="margin-top: 5px"></a>
                    </div>
                    <div class="col-md-2">
                        <form class="form-group" style="width: 220px;" method="get">
                            <div class="col-xs-6">
                               <select class="form-control" name="choice">
                                   <option value="draft" selected>Draft</option>
                                   <option value="publish">Publish</option>
                               </select>
                            </div>
                            <div class="col-xs-6">
                                <button name="change_stat_btn" value="<?php echo $comm_id?>" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </td>
        </tr>

    <?php } ?>

    </tbody>
</table>
