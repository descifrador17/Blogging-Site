<?php include "includes/header.php";
include "../includes/db.php";
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
                            Welcome to Admin
                            <small><?php echo $_SESSION['user_fname'];?></small>
                        </h1>


                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM posts";
                                                $result =  mysqli_query($connection,$query);
                                                $count = mysqli_num_rows($result);
                                                ?>
                                                <div class='huge'><?php echo $count;?></div>
                                                <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM comments";
                                                $result =  mysqli_query($connection,$query);
                                                $count = mysqli_num_rows($result);
                                                ?>
                                                <div class='huge'><?php echo $count;?></div>
                                                <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM users";
                                                $result =  mysqli_query($connection,$query);
                                                $count = mysqli_num_rows($result);
                                                ?>
                                                <div class='huge'><?php echo $count;?></div>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM categories";
                                                $result =  mysqli_query($connection,$query);
                                                $count = mysqli_num_rows($result);
                                                ?>
                                                <div class='huge'><?php echo $count;?></div>
                                                <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->



                        <?php


                        $query = "SELECT * FROM posts WHERE post_status = 'published'";
                        $result = mysqli_query($connection,$query);
                        $post_publish = mysqli_num_rows($result);
                        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                        $result = mysqli_query($connection,$query);
                        $post_draft = mysqli_num_rows($result);

                        $query = "SELECT * FROM comments WHERE comm_status = 'publish'";
                        $result = mysqli_query($connection,$query);
                        $comm_publish = mysqli_num_rows($result);
                        $query = "SELECT * FROM comments WHERE comm_status = 'draft'";
                        $result = mysqli_query($connection,$query);
                        $comm_draft = mysqli_num_rows($result);

                        $query = "SELECT * FROM users WHERE user_role = 'admin'";
                        $result = mysqli_query($connection,$query);
                        $user_admin = mysqli_num_rows($result);
                        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                        $result = mysqli_query($connection,$query);
                        $user_sub = mysqli_num_rows($result);

                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($connection,$query);
                        $cat_count = mysqli_num_rows($result);

                        $fields = ['Published Posts','Draft Posts','Published Comments','Draft Comments','Admins','Subscribers','Categories'];
                        $values = [$post_publish,$post_draft,$comm_publish,$comm_draft,$user_admin,$user_sub,$cat_count];
                        ?>

                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);


                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Data', 'Count'],
                                    <?php
                                    for ($i=0;$i<7;$i++){
                                        echo "['{$fields[$i]}'".","."{$values[$i]}],";
                                    }
                                    ?>

                                ]);

                                var options = {
                                    chart: {
                                        title: '',
                                        subtitle: '',
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>

                        <div id="columnchart_material" style="width:auto; height: 500px;"></div>

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