<?php include "db.php"
?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="/CMS/includes/search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <div class="well">
        <h4><b>Admin Login</b></h4>
        <form action="includes/login.php" method="post">
            <div class="input-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" placeholder="Enter Username">
            </div>
            <br>
            <label>Password</label>
            <div class="input-group">
                <input name="user_pass" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button name="login_btn" class="btn btn-primary" type="submit">login</button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">

            <div class="col-lg-6">
                <ul class="list-unstyled">

                    <?php
                    $query = "SELECT * FROM categories";
                    $all_categories = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($all_categories)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='./category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>