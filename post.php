<?php
include "includes/header.php";
include "includes/navbar.php";
ob_start();
?>


    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <?php include "includes/post_main.php";?>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"?>