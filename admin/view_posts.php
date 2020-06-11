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
                            All Posts
                            <small>by Author</small>
                        </h1>

                        <?php

                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }
                        else{
                            $source = '';
                        }

                        switch ($source){
                            case 'add_post':
                                include "new_post.php";
                                break;
                            case 'edit_post':
                                include "edit_post.php";
                                break;
                            case 'del_post':
                                include "includes/del_post.php";
                                break;
                            default:
                                include "includes/view_posts_selective.php";
                        }

                        ?>

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